<?php

require_once __DIR__ . '/admin/vendor/autoload.php';

//Autoloader class
function autoloader($class){
    require_once 'include/'. $class . '.class.php';
}
spl_autoload_register('autoloader');



//Show error
ini_set('error_reporting', E_ALL);

//DB Konfiguracja
define('DB_CONN','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_DBNAME','test');

// Directory Configuration
define('SITE_ROOT', 'localhost');
define('SITE_URL', 'localhost/CMS/CMS/');

// Open Database
$db = new sql();

if(!$db->polaczenie(DB_CONN, DB_USER, DB_PASS, DB_DBNAME))
{
	$mysql_err = "Could not connect to database.";
}

// Init user
$user = new user($db); // Musimy przekazaæ zmienn¹ $db, poniewa¿ musimy przekazaæ do wewnêtrznej funkcji by wykonaæ zapytanie(inaczej nie da sie tego przekazaæ).

// Facebook config
$fb = new Facebook\Facebook([
  'app_id' => '612623832121654',
  'app_secret' => '8d352e3a7dffedf15df42a52b5da3d1d',
  'default_graph_version' => 'v2.5',
]);
?>