<?php
/**
 * Created by PhpStorm.
 * User: longnguyen
 * Date: 3/9/14
 * Time: 1:29 PM
 */
    include '../db_connection.php';
    if (isset($_POST['student_id'])) {
        $student_id = $_POST['student_id'];

    }

    if (isset($_POST['tutor_id'])) {
        $tutor_id = $_POST['tutor_id'];

    }

    $sql_query_allocate = "UPDATE cms_student SET tutor_id='$tutor_id' WHERE student_id='$student_id'";

    $result_update = mysqli_query($con,$sql_query_allocate);
    if($result_update)
    {
        echo "Success";
    }
    else
    {
        echo "Error";
    }
    mysqli_close($con);
?>;