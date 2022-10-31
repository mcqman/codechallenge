<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once 'database.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $Step = htmlentities(trim($_GET['step'] ?? ''));

    switch($Step)
    {
        case '1':

            $_POST['name'] = strtoupper($_POST['name']);
            $_POST['address'] = strtoupper($_POST['address']);
            $_POST['email'] = strtoupper($_POST['email']);

            $stmt = $dbcon->prepare("SELECT `id` FROM `employer` WHERE `name` = ?");
            $stmt->bind_param('s', $_POST['name']);
            $stmt->execute();
            $id = $stmt->get_result()->fetch_assoc()['id'];
            $stmt->close();

            if(!$id)
            {
                Insert('employer', $_POST);
            }

            else
            {
                $_SESSION['INSERT_ID'] = $id;
                Update('employer', $_POST, ['id' => $id]);
            }

            header('Location: AddEmployee.php');

        break;

        case '2':

            $_POST['employer_id'] = $_SESSION['INSERT_ID'] ?? 0;
            $_POST['name'] = strtoupper($_POST['name']);

            $stmt = $dbcon->prepare("SELECT `id` FROM `employee` WHERE `name` = ? AND `age` = ? AND `employer_id` = ?");
            $stmt->bind_param('sii', $_POST['name'], $_POST['age'], $_POST['employer_id']);
            $stmt->execute();
            $id = $stmt->get_result()->fetch_assoc()['id'];
            $stmt->close();

            if(!$id)
            {
                Insert('employee', $_POST);
            }

            else
            {
                $_SESSION['INSERT_ID'] = $id;
                Update('employee', $_POST, ['id' => $id]);
            }

            header('Location: AllEmployees.php');
        
        break;
    }
}
