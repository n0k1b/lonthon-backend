# Developer options

****** initiate this project ******
1. clone this repository
2. generate a copy of .env.example file with "copy .env.example .env"
3. create a database in mysql database as mentioned database name in .env file
4. migrations
    a. migrate all tables and make dummy data via "php artisan migrate --seed" or
    b. migrate all tables via "php artisan migrate"
    c. if dummy data needed then run this command "php artisan db:seed"

****** database and data managements ******
1. create table and migrate
    a. create migration via "php artisan make:migration create_name_table"
    b. write column names
    c. migrate the table via "php artisan migrate"
2. create factory and seed
    a. create factory via "php artisan make:factory NameFactory"
    b. write columns with fake/dummy data
    c. create model via "php artisan make:model Name"
    d. place this \App\Models\Name::factory(count)->create(); in seeders/DatabaseSeeer.php file
    f. seed the data via "php artisan seed"
