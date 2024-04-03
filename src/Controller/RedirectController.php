<?php

namespace App\Controller;

use App\Repository\LinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RedirectController extends AbstractController
{
    #[Route('/{path}', name: 'redirect')]
    public function index(
        LinkRepository $linkRepository,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response
    {
        $shortLink = $request->getUri();
        $foundLink = $linkRepository->findOneBy(['short' => $shortLink]);

        if ($foundLink) {
            $accessed = $foundLink->getAccessed() + 1;
            $foundLink->setAccessed($accessed);
            $entityManager->persist($foundLink);
            $entityManager->flush();
            return $this->redirect($foundLink->getRegular());
        } else {
            return $this->render('redirect.html.twig', [
                'shortLink' => $shortLink,
                'appUrl' => $this->getParameter('app.url'),
            ]);
        }

    }
}
