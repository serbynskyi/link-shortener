<?php

namespace App\Controller;

use App\Entity\Link;
use App\Form\LinkType;
use App\Repository\LinkRepository;
use App\Service\UrlTransformer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LinkController extends AbstractController
{
    #[Route('/', name: 'link')]
    public function index(
        LinkRepository $linkRepository,
        UrlTransformer $urlTransformer,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $form = $this->createForm((LinkType::class));
        $form->handleRequest($request);

        $shortLink = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $regularLink = $data['regular'];
            $foundLink = $linkRepository->findOneBy(['regular' => $regularLink]);

            if ($foundLink) {
                $shortLink = $foundLink->getShort();
            } else {
                $lastLink = $linkRepository->findLast();
                $id = $lastLink ? $lastLink->getId() + 1 : 1;
                $appUrl = $this->getParameter('app.url');
                $shortLink = $appUrl . $urlTransformer->convertToUniqueString($id);

                $link = new Link();
                $link
                    ->setRegular($regularLink)
                    ->setShort($shortLink)
                ;
                $entityManager->persist($link);
                $entityManager->flush();
            }
        }

        return $this->render('link.html.twig', [
            'linkForm' => $form->createView(),
            'shortLink' => $shortLink,
        ]);
    }
}
