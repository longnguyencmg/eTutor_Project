<?php
/**
 * Created by PhpStorm.
 * User: longnguyen
 * Date: 3/9/14
 * Time: 1:39 PM
 */

$fileName = $_FILES["file1"]["name"]; // The file name
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: Please browse for a file before clicking the upload button!";
    exit();
}
//if($fileSize > 20480){
    //echo "ERROR: Can not upload file greater than 20MB!";
    //exit();
//}
$allowed = array('application/zip', 'application/pdf');
if(in_array($fileType, $allowed)){
        if(move_uploaded_file($fileTmpLoc, "../uploads/$fileName")){
            echo "File is uploaded successfully!";
        } else {
            echo "Move_uploaded_file function failed!";
        }
}else{
    echo "ERROR: Please upload pdf/zip file!";
    exit();
}

?>