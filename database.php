<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
ob_start();

$dbcon = new mysqli('localhost', 'root', 'nwoods99', 'demoapp');

if($dbcon->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

function Insert(String $Table, Array $Fields) {

    global $dbcon;
    $Table = trim(mysqli_real_escape_string($dbcon, htmlentities($Table)));
    $sql = "INSERT IGNORE INTO {$Table} (" . implode(', ', array_keys($Fields)) . ") VALUES(" . trim(htmlentities(rtrim(str_repeat('?, ', count($Fields)), ', '))) . ")";

    $stmt = $dbcon->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($Fields)), ...array_values($Fields));
    $success = $stmt->execute();
    $_SESSION['INSERT_ID'] = $stmt->insert_id;
    $stmt->close();

    return $success;
}

function Update(String $Table, Array $Fields, Array $WhereClause = []) {

    global $dbcon;
    $Table = trim(mysqli_real_escape_string($dbcon, htmlentities($Table)));
    $sql = "UPDATE {$Table} SET " . trim(rtrim(htmlentities(implode(' = ?, ', array_keys($Fields))), ', ')) . " = ?";

    for($i = 0; $i < count($WhereClause); $i++) {

        if($i) {
            $sql .= " AND " . array_keys($WhereClause)[$i] . " = ?";
            continue;
        }

        $sql .= " WHERE " . array_keys($WhereClause)[$i] . " = ?";
    }

    $bindings = array_merge(array_values($Fields), array_values($WhereClause));

    $stmt = $dbcon->prepare($sql);
    $stmt->bind_param(str_repeat('s', count($bindings)), ...$bindings);
    $success = $stmt->execute();
    $stmt->close();

    return $success;
}