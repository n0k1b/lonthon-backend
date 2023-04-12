# to get ready
1. clone the project
2. copy .env.example .env
3. check database name in .env file and mysql database
4. php artisan migrate:fresh --seed
5. php artisan key:generate
6. php storage:link

# Developer options
****** initiate this project ******
1. clone this repository
2. generate a copy of .env.example file with "copy .env.example .env"
3. create a database in mysql database as mentioned database name in .env file
4. migrations
    a. migrate all tables and make dummy data via "php artisan migrate --seed" or
    b. migrate all tables via "php artisan migrate"
    c. if dummy data needed then run this command "php artisan db:seed"
