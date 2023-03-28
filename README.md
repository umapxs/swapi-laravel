<h1>Swapi Laravel</h1>

<p>This is a simple Laravel project to <strong>consume</strong> a <a href="https://swapi.dev/">star wars API called Swapi</a> and <strong>store</strong> the data in a local database. <br/>
It also includes routes to display the stored data in tables.</p>

<h2>Installation</h2>

<ol>
    <li><strong>Clone the repository</strong>: <code>git clone https://github.com/noa1961/swapi-laravel.git</code></li>
    <li><strong>Install dependencies</strong>: <code>composer install</code></li>
    <li><strong>Set up your database credentials in the</strong> <code>.env</code> file</li>
    <li><strong>Run database migrations</strong>: <code>php artisan migrate</code></li>
    <li><strong>Start the server</strong>: <code>php artisan serve</code></li>
</ol>

<h2>Usage</h2>

<h4>Fetching Data</h4>

<p>The <code>/starships/store</code>, <code>/peoples/store</code>, and <code>/films/store</code> routes can be used to fetch data from the Swapi API and store it in the local database.</p>

<h4>Displaying Data</h4>

<p>The following routes are available to <strong>display the stored data</strong> in tables:</p>

<ul>
    <li><code>/table/starship</code>: displays a table of <code>starships</code> and their details</li>
    <li><code>/table/people</code>: displays a table of <code>people</code> and their details</li>
    <li><code>/table/film</code>: displays a table of <code>films</code> and their details</li>
</ul>

<h2>License</h2>

<p>This project is licensed under the [MIT License](https://github.com/noa1961/swapi-laravel/blob/main/LICENSE).</p>
