<?php session_start(); ?>
<?php
include '../db_connection.php';
if(!isset($_SESSION['id'])){
    echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
}

$id = $_SESSION['id'];

$sql_query_tutor = "SELECT * FROM cms_tutor";
$result_tutor = mysqli_query($con,$sql_query_tutor);

mysqli_close($con);
?>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600" rel="stylesheet"
          type="text/css"/>
    <!--[if lte IE 8]>
    <script src="../js/html5shiv.js"></script><![endif]-->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery.tablesorter.min.js"></script>
    <script src="../js/jquery.tablesorter.pager.js"></script>
    <script src="../js/skel.min.js"></script>
    <script src="../js/skel-panels.min.js"></script>
    <script src="../js/init.js"></script>
    <script src="../js/jquery.tablesorter.widgets.js"></script>

    <link rel="stylesheet" href="../css/theme.ice.css"/>
    <noscript>
        <link rel="stylesheet" href="../css/skel-noscript.css"/>
        <link rel="stylesheet" href="../css/style.css"/>
        <link rel="stylesheet" href="../css/style-wide.css"/>
    </noscript>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="../css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="../css/ie8.css"/><![endif]-->
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
                <li><a href="index_admin.php" id="home-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-home">Dashboard</span></a></li>
                <li><a href="#tutor" id="tutor-link" class="skel-panels-ignoreHref active"><span
                            class="fa fa-user">Tutors</span></a></li>
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
    <section id="tutor" class="one">
        <div class="container">

            <header><h2 style="margin-top: 30px;">List of Tutors</h2></header>

            <div class="row">
                <div class="12u">
                    <table id="mytable" class="tablesorter">
                        <thead>
                        <tr>
                            <th>Tutor Id</th>
                            <th>Tutor Name</th>
                            <th>Position</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result_tutor))
                        {
                            echo "<tr id='".$row['tutor_id']."'>";
                                echo "<td><a href='tutor_detail_admin.php?tutor_id=".$row['tutor_id']."'>". $row['tutor_id'] ."</td>";
                                echo "<td>". $row['firstname'] . " " . $row['surname'] ."</td>";
                                echo "<td>". $row['position'] ."</td>";
                                echo "<td>". $row['email'] ."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="backgroundPopup" style="opacity: 0.7; display: none;"></div>
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
<script>
    $(document).ready(function() {
        $("#mytable").tablesorter({theme:'ice',widthFixed: false, sortList:[[0,0]], widgets: ['zebra']});
    });
</script>
</html>