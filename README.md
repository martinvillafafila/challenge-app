## Superheroes Backend App

This is an application made in laravel to recover imported superhero data from CSV file and deliver the information through an endpoint with options like filtering, paginated, sorting and order by.


## How to use the project and import CSV data

To install the dependencies `Composer install`.

To create the database schema `php artisan migrate`.

To add csv Url into the database (the url is inside the .env variables)  run the SuperheroesSeeder with `php artisan db:seed --class=CsvDataSeeder`.

To add csv data to database run the SuperheroesSeeder with `php artisan db:seed --class=SuperheroesSeeder`.

To start the server `php artisan serve`.

To test the application `php artisan test`.


## Considerations

The application has a static authorization token, ideally it will be dynamic using the JWT library with an integration with the user model.

The database schema maps all the information into a single table, ideally attributes like height and weight will be in separate tables with a foreign key for normalization, for example Height/1 will be in a table `heights` with the atributes: `sueperheroesKey`, `value`, `metricSystem`.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
