<?php

$data = json_decode(file_get_contents('php://input'), true);
$countries=["UK", "Germany", "Poland", "USA", "China", "Japan", "Ukrain"];

// var_dump($data);
$validation = new Validation($data, $countries);
$errors = $validation->validateForm();

if(count($errors)!==0){
    header("Content-Type: application/json; charset=utf-8");
    echo json_encode($errors);
    exit();
} else{
    

}

