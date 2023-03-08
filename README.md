# Developer options

* database and data managements
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
