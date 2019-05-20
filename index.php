<!DOCTYPE html>
<!-- Bruce Turner, Professor Ostrander, Spring 2019 -->
<!-- IT 328 Full Stack Web Development -->
<!-- STANDALONE app for inclusion in Dating III Assignment, maybe -->
<!-- file: index.php -->
<!-- Mission Statement: -->
<!-- "Give Premium Members the ability to upload an image of themselves, -->
<!-- and display the image on their Profile Summary. (See chapter 9 in the -->
<!-- PHP text and the tutorial at http://www.w3schools.com/php/php_file_upload.asp -->
<!-- for instructions on uploading files.) Your form should only accept image -->
<!-- files using the following extensions: png, jpeg or jpg.-->
<!-- CREDIT DUE: -->
<!-- Jake Suhoversnik, The "Yota of 328" -->
<!-- http://www.w3schools.com/php/php_file_upload.asp -->
<!-- Text Book, "Chapter 9: Handling HTML Forms with PHP" page 295 -->
<html>
<body>

<form action="#" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>


<?php
//Assumes the existence of a sub directory called "uploads"
//also that your php.ini has been edited as per the w3 schools tutorial.
//This is not for the faint hearted. Don't forget the Linux context of the filesystem
//For the purpose of this example, a "$target_file" will be chosen using a Linux
//absolute path file specification. Note I have supplied a default file spec
//of "profileImage.jpg"
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$target_file = "../Dating0516/" . $target_dir . "profileImage.jpg";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    print_r($target_file);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}