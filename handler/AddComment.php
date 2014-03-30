<?php
/**
 * Created by PhpStorm.
 * User: longnguyen
 * Date: 3/10/14
 * Time: 9:57 PM
 */

    include '../db_connection.php';
    if (isset($_POST['file_id'])) {
        $file_id = $_POST['file_id'];

    }
    if (isset($_POST['comment'])) {
        $comment = $_POST['comment'];

    }
    if (isset($_POST['comment_date'])) {
        $comment_date = $_POST['comment_date'];

    }

    $sql_query_add_comment = "UPDATE cms_upload SET comment='$comment', comment_date='$comment_date' WHERE file_id='$file_id'";

    $result_add_comment = mysqli_query($con,$sql_query_add_comment);
    if($result_add_comment)
    {
        echo "Success";
    }
    else
    {
        echo "Error";
    }
    mysqli_close($con);

?>;