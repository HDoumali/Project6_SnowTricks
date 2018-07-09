# Project 6 Openclassrooms - SnowTricks

## Parcours développeur d'application - PHP/Symfony 

### Context 

This project was realized as part of my studies of application developer - PHP / Symfony.
Project 6 is the development of the community site "SnowTricks" using the Symfony framework.

To see the website code on github : https://github.com/HDoumali/Project6_SnowTricks.

### Installation

For the realization of the site, I used WAMP which you can download at the following address: www.wampserver.com.

Step 1 : Clone the Github repository : 
- https://github.com/HDoumali/Project6_SnowTricks.git

Step 2  : Open the file app/Config/parameters and insert the following parameters :
- database_name: project6 (project 6 bu default, you can choose name for the database)
- database_user: Enter your username for access to the mysql databse ("root" by default)
- database_password: Enter your password for access to the mysql database ("root" or "null" by default)

Step 3 : Creation of the database using the following command :
- php bin/console doctrine:database:create

Step 4 : Creation of database datas with fixtures using the following command :
- php bin/console doctrine:fixtures:load



