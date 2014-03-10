<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    $sql_query_m2t = "SELECT * FROM cms_message WHERE type_id = '3'";
    $sql_query_mft = "SELECT * FROM cms_message WHERE type_id = '4'";

    $result_m2t = mysqli_query($con,$sql_query_m2t);
    $result_mft = mysqli_query($con,$sql_query_mft);

mysqli_close($con);
?>
<html>
<head>
    <title>Meeting</title>
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
        #tableM2t th:nth-child(1), th:nth-child(5), th:nth-child(6), th:nth-child(7){
            display: none;
        }
        #tableM2t td:nth-child(1), td:nth-child(5), td:nth-child(6), td:nth-child(7){
            display: none;
        }

        #tableMft th:nth-child(1), th:nth-child(5), th:nth-child(6), th:nth-child(7){
            display: none;
        }
        #tableMft td:nth-child(1), td:nth-child(5), td:nth-child(6), td:nth-child(7){
            display: none;
        }

        p {
            margin-bottom: 0px;
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
                <li><a href="upload_tutor.php" id="upload-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-upload">Upload</span></a></li>
                <li><a href="meeting_tutor.php" id="meeting-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-user">Meeting</span></a></li>
                <li><a href="#message" id="contact-link" class="skel-panels-ignoreHref active"><span
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
    <section id="message" class="one">

        <div class="container">
            <a href="http://www.gre.ac.uk/‎" class="image featured"><img src="../images/greenwich_uni.jpg" alt=""/></a>

            <div class="row">
                <div class="6u">
                    <p>Messages from student</p>
                    <table id="tableM2t" class="tablesorter">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Created Date</th>
                            <th>Student Id</th>
                            <th>Tutor Id</th>
                            <th>Type Id</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result_m2t))
                        {
                            echo "<tr>";
                            echo "<td>". $row['message_id'] ."</td>";
                            echo "<td>". $row['title'] ."</td>";
                            echo "<td>". $row['content'] ."</td>";
                            echo "<td>". $row['created_date'] ."</td>";
                            echo "<td>". $row['student_id'] ."</td>";
                            echo "<td>". $row['tutor_id'] ."</td>";
                            echo "<td>". $row['type_id'] ."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="6u">
                    <p>Messages to student</p>
                    <table id="tableMft" class="tablesorter">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Created Date</th>
                            <th>Student Id</th>
                            <th>Tutor Id</th>
                            <th>Type Id</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result_mft))
                        {
                            echo "<tr>";
                            echo "<td>". $row['message_id'] ."</td>";
                            echo "<td>". $row['title'] ."</td>";
                            echo "<td>". $row['content'] ."</td>";
                            echo "<td>". $row['created_date'] ."</td>";
                            echo "<td>". $row['student_id'] ."</td>";
                            echo "<td>". $row['tutor_id'] ."</td>";
                            echo "<td>". $row['type_id'] ."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
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
<script>
    $(document).ready(function() {
        $("#tableM2t").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
        $("#tableMft").tablesorter({sortList:[[0,0]], widgets: ['zebra']});
    });
</script>
</body>
</html>