<?php  session_start(); ?>
<?php
include '../db_connection.php';
if(!isset($_SESSION['id'])){
    echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
}

$id = $_SESSION['id'];
$sql_query_count_blog = "SELECT COUNT(*) AS total_blog FROM cms_message WHERE type_id = '1'";
$sql_query_count_request = "SELECT COUNT(*) AS total_request FROM cms_message WHERE type_id = '2'";
$sql_query_count_m2t = "SELECT COUNT(*) AS total_m2t FROM cms_message WHERE type_id = '3'";
$sql_query_count_mft = "SELECT COUNT(*) AS total_mft FROM cms_message WHERE type_id = '4'";

$result_blog = mysqli_query($con,$sql_query_count_blog);
$result_request = mysqli_query($con,$sql_query_count_request);
$result_m2t = mysqli_query($con,$sql_query_count_m2t);
$result_mft = mysqli_query($con,$sql_query_count_mft);

mysqli_close($con);
?>
<html>
<head>
    <title>Tutor Dashboard</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet"
          type="text/css"/>
    <!--[if lte IE 8]>
    <script src="../js/html5shiv.js"></script><![endif]-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/skel-panels.min.js"></script>
    <script src="../js/init.js"></script>
    <noscript>
        <link rel="stylesheet" href="../css/skel-noscript.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/style-wide.css"/>
    </noscript>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="../css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="../css/ie8.css"/><![endif]-->
    <style>
        .content{
            box-sizing:border-box;
            -moz-box-sizing:border-box;
            -webkit-box-sizing:border-box;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            border:2px solid darkslategrey;
        }

        div.content img{
            width: 175px;
            height: 131px;
        }

        .circle {
            border-radius: 50%;
            width: 42px;
            height: 45px;
            background: darkred;
            border: 3px solid dimgray;
            margin-left: 185px;
            margin-top: -25px;

        }
    </style>
</head>
<body>
<!-- Header -->
<div id="header" class="skel-panels-fixed">

    <div class="top">

        <!-- Logo -->
        <div id="logo">
            <span class="image avatar48"><img src="../images/Administrator.jpg" alt=""/></span>

            <h1 id="title">
                <?php
                echo $_SESSION['user'];
                ?>
            </h1>
            <span class="byline"><?php echo $_SESSION['id'] ?></span>
        </div>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="#home" id="home-link" class="skel-panels-ignoreHref active"><span
                            class="fa fa-home">Dashboard</span></a></li>
                <li><a href="blog_tutor.php" id="blog-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-pencil-square">Blog</span></a></li>
                <li><a href="upload_tutor.php" id="upload-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-upload">Upload</span></a></li>
                <li><a href="meeting_tutor.php" id="meeting-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-user">Meeting</span></a></li>
                <li><a href="message_tutor.php" id="contact-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-envelope">Message</span></a></li>
                <li><a href="../logout.php" id="logout-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-lock">Logout</span></a></li>
            </ul>
        </nav>

    </div>

    <div class="bottom">

        <!-- Social Icons -->
        <ul class="icons">
            <li><a href="#" class="fa fa-twitter solo"><span>Twitter</span></a></li>
            <li><a href="#" class="fa fa-facebook solo"><span>Facebook</span></a></li>
            <li><a href="#" class="fa fa-github solo"><span>Github</span></a></li>
            <li><a href="#" class="fa fa-dribbble solo"><span>Dribbble</span></a></li>
            <li><a href="#" class="fa fa-envelope solo"><span>Email</span></a></li>
        </ul>

    </div>

</div>

<!-- Main -->
<div id="main">

    <!-- Intro -->
    <section id="home" class="one">
        <div class="container">

            <a href="http://www.gre.ac.uk/‎" class="image featured"><img src="../images/greenwich_uni.jpg" alt=""/></a>

            <div class="row">
                <div class="3u">
                    <div class="content">
                        <div class="circle"><label style="color: white">
                                <?php
                                if($row = mysqli_fetch_array($result_blog)){
                                    echo $row['total_blog'];
                                }
                                ?>
                            </label></div>
                        <a href="blog_student.php"><img src="../images/blog.png"></a>
                    </div>
                    <p>Blog</p>
                </div>
                <div class="3u">
                    <div class="content">
                        <div class="circle"><label style="color: white"><?php
                                if($row = mysqli_fetch_array($result_request)){
                                    echo $row['total_request'];
                                }
                                ?>
                            </label></div>
                        <a href="meeting_student.php"><img src="../images/Meeting.png"></a>
                    </div>
                    <p>Meeting Request</p>
                </div>
                <div class="3u">
                    <div class="content">
                        <div class="circle"><label style="color: white">
                                <?php
                                if($row = mysqli_fetch_array($result_m2t)){
                                    echo $row['total_m2t'];
                                }
                                ?>
                            </label></div>
                        <a href="message_student.php"><img src="../images/message.jpg"></a>
                    </div>
                    <p>Message to tutor</p>
                </div>
                <div class="3u">
                    <div class="content">
                        <div class="circle"><label style="color: white">
                                <?php
                                if($row = mysqli_fetch_array($result_mft)){
                                    echo $row['total_mft'];
                                }
                                ?>
                            </label></div>
                        <a href="message_student.php"><img src="../images/message.jpg"></a>
                    </div>
                    <p>Message from tutor</p>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- Footer -->
<div id="footer">
    <!-- Copyright -->
    <div class="copyright">
        <p>&copy; 2013 Scum Masters. All rights reserved.</p>
        <ul class="menu">
            <li>University of Greenwich</li>
        </ul>
    </div>
</div>
</body>
</html>