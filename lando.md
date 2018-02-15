# Installing lando:

* Make sure you have Docker-CE installed (docker from brew/linux-repository is most likely outdated)

https://docs.docker.com/install/

For quick&easy install you can use docker’s own script:

https://get.docker.com/

* Install lando for your computer

https://docs.devwithlando.io/installation/installing.html

Note: in Ubuntu you needed to run the “caveats” part of adding the user to docker group.

* Not mandatory but you might want to install docker-compose

https://docs.docker.com/compose/install/

# Using Lando with drupal8

https://docs.devwithlando.io/tutorials/drupal8.html

## Basic usage:

* lando start

Start up the project, this needs to be run on the folder where you have your .lando.yml -recipe file.

* lando stop

Stop the project from running.

* lando destroy

Destroy all existing instances and free up the disc space they take.

* lando drush <command>

To run drush commands for the site you prefix drush with lando. Eg. lando drush cr

* lando composer <command>

To issue composer comands you again, prefix it with lando. Eg. lando composer install

* lando mysql

To get inside mysql database you can use this.

* lando db-import <file>

Importing database is simple with one command.

* lando db-export

Exporting database is easy and will automaticly output a nicely named file.
