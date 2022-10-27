<?php
$status = '';
$statusMsg = '';

if (isset($_FILES["user-img"])) {
    $status = 'error';

    if (!empty($_FILES["user-img"]["name"])) {
        // Get file info 
        $fileName = basename($_FILES["user-img"]["name"]);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg');
        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES["user-img"]['tmp_name'];
            $location = "uploads/user-images/" . $fileName;
            if (move_uploaded_file($image, $location)) {
                $status = "success";
            } else {
                $statusMsg = "Please, try again";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select an image file to upload.';
    }
}
$data = array("status" => $status, "imgUrl" => $location ? $location : "null", "statusMsg" => $statusMsg !== "" ? $statusMsg : "null");
header("Content-Type: application/json; charset=utf-8");
echo json_encode($data);
exit();
