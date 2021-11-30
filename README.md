# boilerplate api_platform project still has to add chmod -R 777 yet

Once it's done, launch :
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
