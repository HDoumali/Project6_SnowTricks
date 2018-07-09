# Project 6 Openclassrooms - SnowTricks

## Parcours développeur d'application - PHP/Symfony 

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/1f553232691c49d5aeebc3477a768098)](https://www.codacy.com/app/HDoumali/Project6_SnowTricks?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=HDoumali/Project6_SnowTricks&amp;utm_campaign=Badge_Grade)

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



