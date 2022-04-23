<?php
// constantes pour l'accès à la base de données
define('DB_SERVER', 'localhost');	// serveur pgsql
define('DB_DATABASE', 'drive');		// nom de la base de données
define('DB_USER', 'postgres');			// nom d'utilisateur
define('DB_PWD', 'root');              	// mot de passe
define('DB_PORT', 5432);
define('APP_CONFIG', 'Client'); // BackOffice ou Client
define('DSN','pgsql:dbname='.DB_DATABASE.';host='.DB_SERVER.';port='.DB_PORT);