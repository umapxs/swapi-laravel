Swapi Laravel
=============

This is a simple Laravel project to consume the [Star Wars API (Swapi)](https://swapi.dev/) and store the data in a local database. It includes routes to display the stored data in tables.

Installation
------------

1.  Clone the repository: `git clone https://github.com/noa1961/swapi-laravel.git`
2.  Install dependencies: `composer install`
3.  Set up your database credentials in the `.env` file
4.  Run database migrations: `php artisan migrate`
5.  Start the server: `php artisan serve`

Usage
-----

### Fetching Data

The `/starships/store`, `/peoples/store`, and `/films/store` routes can be used to fetch data from the Swapi API and store it in the local database.

### Displaying Data

The following routes are available to display the stored data in tables:

-   `/table/starship`: displays the list of starships and their details
-   `/table/people`: displays the list of people and their details
-   `/table/film`: displays the list of films and their details

License
-------

This project is licensed under the [MIT License](https://github.com/noa1961/swapi-laravel/blob/main/LICENSE).
