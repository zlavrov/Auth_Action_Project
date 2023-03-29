# Auth_Action_Project
Simple web project with track user activity and action.

Structure:

login, logout, registration, page A, page B

page A with button “Buy a cow“ (after click, it is disappeared and show message 'thankYou' instead)

page B with button “Download“ (after click button, starting download any exe-file)

page with Statistic of users activity and user event.

Get Start:

sudo docker-compose up

database configuration:

    -> from docker-compose.yml
    -> to main/app/Config/AppConfig.php:DBConfig();
    -> database settings should be the same


http://localhost:8081:

    -> phpmyadmin
    -> import
    -> my_database.sql from dump/my_database.sql
    -> leave everything else as default


http://localhost:8085 - app

    -> register
    -> login
    -> enjoy

