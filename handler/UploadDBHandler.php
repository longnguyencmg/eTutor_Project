<?php
/**
 * Created by PhpStorm.
 * User: longnguyen
 * Date: 3/9/14
 * Time: 7:51 PM
 */

    include '../db_connection.php';
    if (isset($_POST['fileId'])) {
        $fileId = $_POST['fileId'];

    }
    if (isset($_POST['fileName'])) {
        $fileName = $_POST['fileName'];

    }
    if (isset($_POST['filePath'])) {
        $filePath = $_POST['filePath'];

    }
    if (isset($_POST['studentId'])) {
        $studentId = $_POST['studentId'];

    }
    if (isset($_POST['uploadDate'])) {
        $uploadDate = $_POST['uploadDate'];

    }
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];

    }
    if (isset($_POST['commentBy'])) {
        $commentBy = $_POST['commentBy'];

    }
    if (isset($_POST['commentDate'])) {
        $commentDate = $_POST['commentDate'];

    }

    $sql_query_upload = "INSERT INTO cms_upload(file_name, file_path, student_id, upload_date, comment_by) VALUES ('$fileName','$filePath','$studentId','$uploadDate','$commentBy')";

    $result_upload = mysqli_query($con,$sql_query_upload);
    if($result_upload)
    {
        echo "Success";
    }
    else
    {
        echo $sql_query_upload. " Error";
    }
    mysqli_close($con);

?>