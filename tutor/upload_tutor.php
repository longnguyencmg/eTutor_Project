<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    $sql_query_upload = "SELECT * FROM cms_upload";

    $result_upload = mysqli_query($con,$sql_query_upload);

    mysqli_close($con);
?>
<html>
<head>
    <title>Upload</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet"
          type="text/css"/>
    <!--[if lte IE 8]>
    <script src="../js/html5shiv.js"></script><![endif]-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.tablesorter.min.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/skel-panels.min.js"></script>
    <script src="../js/init.js"></script>
    <link rel="stylesheet" href="../css/blue/style.css">
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
        #mytable th:nth-child(4), th:nth-child(1){
            display: none;
        }
        #mytable td:nth-child(4), td:nth-child(1){
            display: none;
        }
    </style>
</head>
<body>

<!-- Header -->
<div id="header" class="skel-panels-fixed">

    <div class="top">

        <!-- Logo -->
        <div id="logo">
            <span class="image avatar72"><img src="../images/<?php echo $_SESSION['imageUrl'];?>" alt=""/></span>

            <h1 id="title">
                <?php
                echo $_SESSION['user'];
                ?>
            </h1>
            <span class="byline"><?php echo $_SESSION['position'] ?></span>
        </div>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="index_tutor.php" id="home-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-home">Dashboard</span></a></li>
                <li><a href="blog_tutor.php" id="blog-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-pencil-square">Blog</span></a></li>
                <li><a href="#upload" id="upload-link" class="skel-panels-ignoreHref active"><span
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

    <!-- Blog -->
    <section id="upload" class="one">

        <div class="container">
            <a href="http://www.gre.ac.uk/‎" class="image featured"><img src="../images/greenwich_uni.jpg" alt=""/></a>

            <table id="mytable" class="tablesorter">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>File Path</th>
                    <th>Student Id</th>
                    <th>Upload date</th>
                    <th>Comment</th>
                    <th>Comment By</th>
                    <th>Comment date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_array($result_upload))
                {
                    echo "<tr>";
                    echo "<td>". $row['file_id'] ."</td>";
                    echo "<td>". $row['file_name'] ."</td>";
                    echo "<td>". $row['file_path'] ."</td>";
                    echo "<td>". $row['student_id'] ."</td>";
                    echo "<td>". $row['upload_date'] ."</td>";
                    echo "<td>". $row['comment'] ."</td>";
                    echo "<td>". $row['comment_by'] ."</td>";
                    echo "<td>". $row['comment_date'] ."</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
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
<script>
    $(document).ready(function() {
        $("#mytable").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
    });
</script>
</body>
</html>