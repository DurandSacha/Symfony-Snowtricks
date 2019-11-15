<a href="https://codeclimate.com/github/DurandSacha/Symfony-Snowtricks/maintainability"><img src="https://api.codeclimate.com/v1/badges/2295e37585a45075da96/maintainability" /></a><br/>

<a href="https://codeclimate.com/github/DurandSacha/Symfony-Snowtricks/test_coverage"><img src="https://api.codeclimate.com/v1/badges/2295e37585a45075da96/test_coverage" /></a><br/>

[![dependency](https://badgen.now.sh/david/dep/styfle/packagephobia)](https://github.com/DurandSacha/Symfony-Snowtricks)<br/>
<hr>

-----------------

# Symfony-Snowtricks in general
Snowtricks symfony website is a community site related to snowboarding. So you can share snowboard figures and exchange on these same figures of style.

This site has a member area dedicated to users or you can change the settings of your account and post figures and media

## Technology 

This site is developed with PHP and the symfony framework. This architecture proposes a reutilisable code and easy to maintain. It also provides good practice like MVC layout and object oriented

## The deployment 

Several solutions to deploy this project : 
-  You can clone this project on your environment 
-  You can configure a web server with a ansible playbook ( include in repository )
   `ansible-playbook ansible/playbook.yml -i ansible/hosts.ini --ask-vault-pass`
-  You can run this project with docker containers (docker-compose included in this repository )

## Other information 

The graphical data model is accessible in the SQL file. You can also find the UML shema in the respective file

## Installation

1. Clone this project 
2. Configure your environments ( BDD,..)
3. make composer install







