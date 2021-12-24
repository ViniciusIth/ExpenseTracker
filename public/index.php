<?php

declare(strict_types = 1);

//$root = directory/subdirectory/
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);



// The App side of the program
require APP_PATH . 'App.php';

$files = getTransactionFiles(FILES_PATH);
$transactions = [];

foreach ($files as $file) {
	//For each file got from getTransactionFiles, merge the contect with the existing transaction list file.
	$transactions = array_merge($transactions, getTransactions($file));
}
$total = calcTotal($transactions);

// The view of the program
require VIEWS_PATH . 'format.php';
require VIEWS_PATH . 'transaction.php';

