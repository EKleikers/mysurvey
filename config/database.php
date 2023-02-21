<?php

use Illuminate\Support\Str;

if (! $app->runningInConsole()) {

    include_once $_SERVER['DOCUMENT_ROOT'] . '/myadmin/resources/helpers/helper.php';
    $response = callAppsForceAPI(100000046, 'env');
    if ($response == null) {
        header('Location: /issue?message=Error accessing Environment APIs');
        die();
    }
    if ($response['code'] != '200') {
        header('Location: /login');
        die();
    }
    $env = $response['data'];
    $appsforceDB = $env['dbdatabase'];
    $appsforceDBHost = $env['dbhost'];
    $appsforceDBUser = $env['dbuser'];
    $appsforceDBPass = $env['dbpassword'];
    $appsforceDBName = $env['dbprefix'] . 'mysurvey';
} else {
    $env = file( __DIR__ . '/../../myadmin/.env');
    $appsforceDBPrefix = "";
    foreach ($env as $parameter)
   {
        $ar = explode("=", $parameter);

        if (count($ar)>1) {
            if ($ar[0] == "DB_HOST") $appsforceDBHost = str_replace("\r\n", '', $ar[1]);
            if ($ar[0] == "DB_USERNAME") $appsforceDBUser = str_replace("\r\n", '', $ar[1]);
            if ($ar[0] == "DB_PASSWORD") $appsforceDBPass = str_replace("\r\n", '', $ar[1]);
            if ($ar[0] == "DB_PREFIX") $appsforceDBPrefix = str_replace("\r\n", '', $ar[1]);
        }    
   }
   $appsforceDBHost = str_replace("\n", '', $appsforceDBHost);
   $appsforceDBUser = str_replace("\n", '', $appsforceDBUser);
   $appsforceDBPass = str_replace("\n", '', $appsforceDBPass);
   $appsforceDBPrefix = str_replace("\n", '', $appsforceDBPrefix);

    $appsforceDBName = $appsforceDBPrefix . 'mysurvey';
}

return [
    /*
      |--------------------------------------------------------------------------
      | Default Database Connection Name
      |--------------------------------------------------------------------------
      |
      | Here you may specify which of the database connections below you wish
      | to use as your default connection for all database work. Of course
      | you may use many connections at once using the Database library.
      |
     */

    'default' => env('MYDB_CONNECTION', 'mysql'),
    /*
      |--------------------------------------------------------------------------
      | Database Connections
      |--------------------------------------------------------------------------
      |
      | Here are each of the database connections setup for your application.
      | Of course, examples of configuring each database platform that is
      | supported by Laravel is shown below to make development simple.
      |
      |
      | All database work in Laravel is done through the PHP PDO facilities
      | so make sure you have the driver for your particular database of
      | choice installed on your machine before you begin development.
      |
     */
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => $appsforceDBHost,
            'port' => '3306',
            'database' => $appsforceDBName,
            'username' => $appsforceDBUser,
            'password' => $appsforceDBPass,
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
    ],
    /*
      |--------------------------------------------------------------------------
      | Migration Repository Table
      |--------------------------------------------------------------------------
      |
      | This table keeps track of all the migrations that have already run for
      | your application. Using this information, we can determine which of
      | the migrations on disk haven't actually been run in the database.
      |
     */
    'migrations' => 'migrations',
    /*
      |--------------------------------------------------------------------------
      | Redis Databases
      |--------------------------------------------------------------------------
      |
      | Redis is an open source, fast, and advanced key-value store that also
      | provides a richer set of commands than a typical key-value systems
      | such as APC or Memcached. Laravel makes it easy to dig right in.
      |
     */
    'redis' => [
        'client' => env('REDIS_CLIENT', 'predis'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'predis'),
            'prefix' => Str::slug(env('APP_NAME', 'laravel'), '_') . '_database_',
        ],
        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],
        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],
    ],
];



