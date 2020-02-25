<?php
// (0) CONFIG
// MUTE NOTICES
error_reporting(E_ALL & ~E_NOTICE);

// DATABASE SETTINGS 
// ! CHANGE THESE TO YOUR OWN !
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// (1) FILE CHECK
// * HTML file type restriction can still miss at times
// @TODO - Add more of your own file checks if you want. 
// E.g. Restrict upload size to prevent resource hogging.
if (!isset($_FILES['upexcel']['tmp_name']) || !in_array($_FILES['upexcel']['type'], [
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'text/x-csv',
        'text/csv',
        'text/plain',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ])) {
    die("Invalid file type");
}

// (2) INIT MYSQL
// ATTEMPT CONNECT
try {
    $str = "mysql:host=" . DB_HOST . ";charset=" . DB_CHARSET;
    if (defined('DB_NAME')) {
        $str .= ";dbname=" . DB_NAME;
    }
    $pdo = new PDO(
        $str, DB_USER, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} // ERROR
catch (Exception $ex) {
    die("Failed to connect to database");
}

// (3) INIT PHP SPREADSHEET
require 'vendor/autoload.php';
if (pathinfo($_FILES['upexcel']['name'], PATHINFO_EXTENSION) == 'csv') {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
} else {
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
}
$spreadsheet = $reader->load($_FILES['upexcel']['tmp_name']);

// (4) READ DATA & IMPORT
// ! NOTE ! EXCEL MUST BE IN EXACT FORMAT!
// @TODO - Add your own data validation checks if you want.
// @TODO - Output a nicer HTML import result if you want.
$worksheet = $spreadsheet->getActiveSheet();
$sql = "INSERT INTO `test` (`name`, `email`) VALUES (?, ?)";
foreach ($worksheet->getRowIterator() as $row) {
    // Fetch data
    $cellIterator = $row->getCellIterator();
    $cellIterator->setIterateOnlyExistingCells(false);
    $data = [];
    foreach ($cellIterator as $cell) {
        $data[] = $cell->getValue();
    }

    // Insert database
    print_r($data);
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        // $this->pdo->lastInsertId(); // If you need the last insert ID
        echo "OK<br>";
    } catch (Exception $ex) {
        echo "ERROR<br>";
    }
    $stmt = null;
}

// (5) CLOSE DATABASE CONNECTION
if ($stmt !== null) {
    $stmt = null;
}
if ($pdo !== null) {
    $pdo = null;
}
?>