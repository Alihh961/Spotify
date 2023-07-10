- composer create-project symfony/website-skeleton firstProject "5.4.*"     => create a new project
- symfony server:start  => start symfony
- symfony serve  => start symfony^
- symfony server:stop => stop symfony
- symfony local:php:list  => list of php version in my computer
- symfony console doctrine:database:create  => creating a database (database named in .env.local )
- symfony console make:entity  => create a new entity 
- symfony console make:migration => create migration 
- symfony console doctrine:migration:migrate  => execute the migration and effect the database
- symfony console d:m:m => An Alias for doctrine:migration:migrate
- symfony console debug:router => have a table of the routers of a project
- symfony check:requirements => check if the project missses any requirments
- symfony console --version => check the version of symfony
- php bin/console --version => check the version of symfony
- symfony open:local => open symfony project in the browser after starting it
- symfony console cache:clear
- symfony console make:controller "NameOfController"
- symfony console make:user => create an user





* Hint to edit the class we try to create a class of the same name then it will propose to edit the class
* We must install annotation for symfony project using composer require annotations