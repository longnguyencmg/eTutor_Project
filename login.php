<?php
    session_start();
    include 'db_connection.php';

    if(isset($_SESSION['id'])){
        if($_SESSION['role'] == 1){
            echo '<script type="text/javascript"> window.open("admin/index_admin.php","_self");</script>';
        }else if($_SESSION['role'] == 2){
            echo '<script type="text/javascript"> window.open("tutor/index_tutor.php","_self");</script>';
        }else if($_SESSION['role'] == 3){
            echo '<script type="text/javascript"> window.open("student/index_student.php","_self");</script>';
        }
    }

    if(isset($_POST['login'])){
        $user = $_POST['loginEmail'];
        $pass = $_POST['loginPass'];

        $sql_query_admin = "SELECT * FROM cms_admin WHERE username = '$user' and password = '$pass'";
        $sql_query_tutor = "SELECT * FROM cms_tutor WHERE username = '$user' and password = '$pass'";
        $sql_query_student = "SELECT * FROM cms_student WHERE username = '$user' and password = '$pass'";

        $result_admin = mysqli_query($con,$sql_query_admin);
        if($row = mysqli_fetch_array($result_admin))
        {
            $_SESSION['id'] = $row['username'];
            $_SESSION['role'] = $row['role_id'];
            $_SESSION['user'] = $row['fullname'];

            echo '<script type="text/javascript"> window.open("admin/index_admin.php","_self");</script>';
        }

        $result_tutor = mysqli_query($con,$sql_query_tutor);
        if($row = mysqli_fetch_array($result_tutor)){
            $_SESSION['id'] = $row['tutor_id'];
            $_SESSION['role'] = $row['role_id'];
            $_SESSION['user'] = $row['firstname']. " " .$row['surname'];
            $_SESSION['imageUrl'] = $row['imageUrl'];
            $_SESSION['position'] = $row['position'];

            echo '<script type="text/javascript"> window.open("tutor/index_tutor.php","_self");</script>';
        }

        $result_student = mysqli_query($con,$sql_query_student);
        if($row = mysqli_fetch_array($result_student)){
            $_SESSION['id'] = $row['student_id'];
            $_SESSION['role'] = $row['role_id'];
            $_SESSION['user'] = $row['firstname']. " " .$row['surname'];
            $_SESSION['imageUrl'] = $row['imageUrl'];
            $_SESSION['tutor'] = $row['tutor_id'];

            echo '<script type="text/javascript"> window.open("student/index_student.php","_self");</script>';
        }

        mysqli_close($con);
    }

?>;
<html>
<head>
    <meta charset="utf-8"/>
    <title>Student Portal Login</title>
    <link rel="shortcut icon" href="assets/img/browser tab.png">
    <script src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="css/login_style.css"/>
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body>

<div id="formContainer">
    <form id="login" method="post" action="">
        <a href="#" id="flipToRecover" class="flipLink">Forgot?</a>
        <input type="text" name="loginEmail" id="loginEmail" value="User Name"/>
        <input type="password" name="loginPass" id="loginPass" value="Password"/>
        <input type="submit" name="login" value="Login"/>
    </form>
    <form id="recover" method="post" action="">
        <a href="#" id="flipToLogin" class="flipLink">Forgot?</a>
        <input type="text" name="recoverEmail" id="recoverEmail" value="Email"/>
        <input type="submit" name="recover" value="Recover"/>
    </form>
</div>

<footer>
    <h2 align="center">Copyright@ 2013-14 Scrum Masters. All Rights Reserved. </h2>

</footer>
<script>
    $(document).ready(function () {
        // Checking for CSS 3D transformation support
        $.support.css3d = supportsCSS3D();

        var formContainer = $('#formContainer');

        // Listening for clicks on the ribbon links
        $('.flipLink').click(function (e) {

            // Flipping the forms
            formContainer.toggleClass('flipped');

            // If there is no CSS3 3D support, simply
            // hide the login form (exposing the recover one)
            if (!$.support.css3d) {
                $('#login').toggle();
            }
            e.preventDefault();
        });

        // A helper function that checks for the
        // support of the 3D CSS3 transformations.
        function supportsCSS3D() {
            var props = [
                'perspectiveProperty', 'WebkitPerspective', 'MozPerspective'
            ], testDom = document.createElement('a');

            for (var i = 0; i < props.length; i++) {
                if (props[i] in testDom.style) {
                    return true;
                }
            }

            return false;
        }

        $('#loginEmail').focus(function(){
            $('#loginEmail').val("");
        });
        $('#loginPass').focus(function(){
            $('#loginPass').val("");
        });
        $('#recoverEmail').focus(function(){
            $('#recoverEmail').val("");
        });
    });
</script>
</body>
</html>

