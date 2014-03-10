<?php
/**
 * Created by PhpStorm.
 * User: longnguyen
 * Date: 3/9/14
 * Time: 12:32 PM
 */

    include '../db_connection.php';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

    }
    if (isset($_POST['title'])) {
        $title = $_POST['title'];

    }
    if (isset($_POST['content'])) {
        $content = $_POST['content'];

    }
    if (isset($_POST['date'])) {
        $date = $_POST['date'];

    }
    if (isset($_POST['studentId'])) {
        $studentId = $_POST['studentId'];

    }
    if (isset($_POST['tutorId'])) {
        $tutorId = $_POST['tutorId'];

    }
    if (isset($_POST['typeId'])) {
        $typeId = $_POST['typeId'];

    }

    $sql_query_add_request = "INSERT INTO cms_message (title, content, created_date, student_id, tutor_id, type_id) VALUES ('$title', '$content', '$date', '$studentId', '$tutorId', '$typeId')";

    $result_add_request = mysqli_query($con,$sql_query_add_request);
    if($result_add_request)
    {
        echo "Success";
    }
    else
    {
        echo "Error";
    }
    mysqli_close($con);

?>;