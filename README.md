## Superheroes Backend App

This is an application to recover imported superhero data from CSV file wiht options like filtering, sorting and order by.


## How to use the projecvt and import CSV data
To install the dependencies 'Composer install'.

To create the database schema 'php artisan migrate'

To add csv data to database, place the csv file inside database/csv (is there one already), and run the SuperheroesSeeder with 'php artisan db:seed --class=SuperheroesSeeder'.

To start the server 'Php artisan serve'.


## Considerations

The application has a static authorization token, ideally it will be dynamic using the JWT library.

The database schema maps all the information into a single table, ideally attributes like height and weight will be in separate tables with a foreign key for normalization, for example Height/1 will be in a table heights with atributes sueperheroesKey, value, metricSystem.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
