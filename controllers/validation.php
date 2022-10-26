<?php

$data = json_decode(file_get_contents('php://input'), true);
$countries = ["UK", "Germany", "Poland", "USA", "China", "Japan", "Ukrain"];

// var_dump($data);
// $result=$database->checkSingle("users", "email", $data["email"]);
// echo $result;
// die();
$validation = new Validation($data, $countries, $database);
$results = $validation->validateForm();

if (count($results["errors"]) !== 0) {
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($results["errors"]);
    exit();
} else {
    // var_dump($results["data"]);
    $database->addNewUser('users', $results["data"]);
    echo true;
}
