<?php
// read excel spreadsheet
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
if ($reader) {
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($target_file);
    $sheetData = $spreadsheet->getActiveSheet()->toArray();

    foreach ($sheetData as $row) {
// get columns
        $testTaker = isset($row[0]) ? $row[0] : "";
        $correctAnswers = isset($row[1]) ? $row[1] : "";
        $incorrectAnswers = isset($row[2]) ? $row[2] : "";

// insert item
        $query = "INSERT INTO item(testTaker, correctAnswers, incorrectAnswers) ";
        $query .= "values(?, ?, ?)";
        $prep = $dbh->prepare($query);
        $prep->execute(array($testTaker, $correctAnswers, $incorrectAnswers));
    }
}