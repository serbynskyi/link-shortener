Link Shortener
===============

Link Shortener provides a link shortener service and redirects.

Installation
-------

1. Clone repository
   
2. Build docker project: 
   docker compose up --build

3. Install packages (in php container): composer install

4. Setup database (in php container): php bin/console doctrine:migrations:migrate

Usage
-------

Create short links at the home page: http://localhost/

Follow created link and receive redirect