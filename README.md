<h1>Swapi Laravel</h1>

<p>This is a simple Laravel project with a focus on <strong>learning</strong> about <strong> API consumption</strong> with a <a href="https://swapi.dev/">Star Wars API</a> called Swapi.


<h2>Installation</h2>

<ol>
    <li><strong>Clone the repository</strong>: <code>git clone https://github.com/noa1961/swapi-laravel.git</code></li>
    <li><strong>Install dependencies</strong>: <code>composer install</code></li>
    <li><strong>Set up your database credentials in the</strong> <code>.env.example</code> file and change its name to <code>.env</code></li>
    <li><strong>Run database migrations</strong>: <code>php artisan migrate</code></li>
    <li><strong>Start the server</strong>: <code>php artisan serve</code></li>
</ol>


<h2>Usage</h2>

<h4>Fetching Data</h4>

<p>The <code>/starships/store</code>, <code>/peoples/store</code>, and <code>/films/store</code> routes can all be used to fetch data respectively from the Swapi API and to also store it locally in a database.</p>

<h4>Displaying Data</h4>

<p>The following routes are available to <strong>display the stored data</strong> in tables:</p>

<ul>
    <li><code>/table/starship</code>: displays a table of <code>starships</code> and their details</li>
    <li><code>/table/people</code>: displays a table of <code>people</code> and their details</li>
    <li><code>/table/film</code>: displays a table of <code>films</code> and their details</li>
</ul>


<h2> Contributing </h2>
<p>Contributions are welcome! Please <strong>open an issue</strong> or a <strong>pull request</strong> for any changes or additions.</p>


<h2>License</h2>

<p>This project is licensed under the <a href="https://github.com/noa1961/swapi-laravel/blob/main/LICENSE">Zlib License</a>.</p>
