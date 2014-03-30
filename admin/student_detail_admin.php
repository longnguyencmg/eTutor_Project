<?php session_start();?>
<?php
    /**
     * Created by PhpStorm.
     * User: longnguyen
     * Date: 3/13/14
     * Time: 1:33 PM
     */

    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];

    if (isset($_GET['student_id'])) {
        $student_id = $_GET['student_id'];
    }
    $sql_query_student = "SELECT * from cms_student WHERE student_id = '$student_id'";
    $result_student = mysqli_query($con, $sql_query_student);


    $sql_query_blog = "SELECT * from cms_message WHERE student_id = '$student_id' and type_id = '1'";
    $sql_query_meeting = "SELECT * from cms_message WHERE student_id = '$student_id' and type_id = '2'";
    $sql_query_m2t = "SELECT * from cms_message WHERE student_id = '$student_id' and type_id = '3'";
    $sql_query_mft = "SELECT * from cms_message WHERE student_id = '$student_id' and type_id = '4'";

    $result_query_blog = mysqli_query($con,$sql_query_blog);
    $result_query_meeting = mysqli_query($con,$sql_query_meeting);
    $result_query_m2t = mysqli_query($con,$sql_query_m2t);
    $result_query_mft = mysqli_query($con,$sql_query_mft);

    $sql_query_count_blog = "SELECT COUNT(*) AS total_blog FROM cms_message WHERE type_id = '1' and student_id = '$student_id'";
    $sql_query_count_request = "SELECT COUNT(*) AS total_request FROM cms_message WHERE type_id = '2' and student_id = '$student_id'";
    $sql_query_count_m2t = "SELECT COUNT(*) AS total_m2t FROM cms_message WHERE type_id = '3' and student_id = '$student_id'";
    $sql_query_count_mft = "SELECT COUNT(*) AS total_mft FROM cms_message WHERE type_id = '4' and student_id = '$student_id'";

    $result_count_blog = mysqli_query($con,$sql_query_count_blog);
    $result_count_request = mysqli_query($con,$sql_query_count_request);
    $result_count_m2t = mysqli_query($con,$sql_query_count_m2t);
    $result_count_mft = mysqli_query($con,$sql_query_count_mft);

    $sql_query_upload = "SELECT * FROM cms_upload WHERE student_id = '$student_id'";
    $sql_query_upload_count = "SELECT count(*) FROM cms_upload WHERE student_id = '$student_id'";

    $result_upload = mysqli_query($con, $sql_query_upload);
    $result_upload_count = mysqli_query($con, $sql_query_upload_count);

    mysqli_close($con);

?>
<html>
<head>
    <title>Student Detail</title>
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
    <script src="../js/slotmachine.js"></script>
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
    <style>
        .first{
            margin-left: 0px;
        }
        .pagedisplay{
            text-align: center;
            height: 30px;
            width: 147px;
            font-size: 15px;
        }
        .pagesize{
            width: 80px;
            margin-top: -30px;
            margin-left: 240px;
            font-size: 15px;
        }

        #page-wrap
        {
            width: auto;
            margin: 50px auto;
        }
        a { text-decoration: none; }
        h3 { margin: 0 0 10px 0; }

        .tabs {
            list-style: none;
            overflow: hidden;
            padding-left: 1px;
        }
        .tabs li { display: inline; }
        .tabs li a {
            display: block;
            float: left;
            padding: 4px 8px;
            color: black;
            border: 1px solid #ccc;
            background: #eee;
            margin: 0 0 0 -1px;
        }
        .tabs li a.current {
            background: white;
            border-bottom: 0;
            position: relative;
            top: 2px;
            z-index: 2;
        }

        .box-wrapper {
            -moz-box-shadow: 0 0 20px black;
            -webkit-box-shadow: 0 0 20px black;
            padding: 20px;
            background: white;
            border: 1px solid #ccc;
            margin: -1px 0 0 0;
            height: 624px;
            position: relative;
            margin-top: -47px;
        }
        .content-box {
            overflow: hidden;
            position: absolute;
            left: 20px;
            width: 98%;
            height: 585px;
        }

        .current { z-index: 100; }

        .col-one, .col-two, .col-three {
            width: 98%;
            float: left;
            position: relative;
            top: 575px;
            height: 575px;
        }
        .col-one, .col-two {
            margin-right: 3%;
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
                <li><a href="index_admin.php" id="home-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-home">Dashboard</span></a></li>
                <li><a href="tutor_admin.php" id="tutor-link" class="skel-panels-ignoreHref"><span
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

            <header><h2 style="margin-top: 30px;">Student Detail</h2></header>
            <div class="row">
                <?php
                while($row = mysqli_fetch_array($result_student))
                {

                    echo "<div class='4u' style='width: 333px; height: 333px;'>";
                        if($row['imageUrl'] != null){
                            echo "<img style='height:333px;width:333px;' src='".$row['imageUrl']."'></img>";
                        }else{
                            echo "<img style='height:333px;width:333px;' src='../images/user.png'/>";
                        }
                    echo "</div>";
                    echo "<div class='8u'>";
                        echo "<table style='margin-left: 80px; width:''>";
                            echo "<tr>";
                            echo "<td style='width: 150px;height: 50px;'>Name: </td>";
                            echo "<td>".$row['firstname']. " " .$row['surname'] ."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td style='width: 150px;height: 50px;'>Date of birth: </td>";
                            echo "<td>".$row['dob']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td style='width: 150px;height: 50px;'>Email: </td>";
                            echo "<td>".$row['email']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            echo "<td style='width: 150px;height: 50px;'>Course: </td>";
                            echo "<td>".$row['Course']."</td>";
                            echo "</tr>";
                            echo "<tr>";
                            if($row['isHomeStudent'] == "true"){
                                echo "<td style='width: 150px;height: 50px;'></td>";
                                echo "<td>Home Student</td>";
                                echo "</tr>";
                            }else{
                                echo "<td style='width: 150px;height: 50px;'></td>";
                                echo "<td>International Student</td>";
                                echo "</tr>";
                            }

                        echo "</table>";
                    echo "</div>";
                }
                ?>
            </div>
            <div class="row">
                <div class="12u">
                    <div id="slot-machine-tabs">

                        <ul class="tabs">
                            <li><a href="#one">Meeting Request</a></li>
                            <li><a href="#two">Upload</a></li>
                            <li><a href="#three">Blog</a></li>
                            <li><a href="#four">Messages</a></li>
                        </ul>

                        <div class="box-wrapper">

                            <div id="one" class="content-box">
                                <div class="col-one col">
                                    <div class="12u">
                                        <table id="table_meeting" class="tablesorter">
                                            <thead>
                                            <tr>
                                                <th style="display: none;">Id</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Created Date</th>
                                                <th style="display: none;">Student Name</th>
                                                <th>Tutor Id</th>
                                                <th style="display: none;">Type Id</th>
                                                <th style="display: none;">Student Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while($row = mysqli_fetch_array($result_query_meeting))
                                            {
                                                echo "<tr id='row".$row['message_id']."'>";
                                                echo "<td style=\"display: none;\">". $row['message_id'] ."</td>";
                                                echo "<td>". $row['title'] ."</td>";
                                                echo "<td>". $row['content'] ."</td>";
                                                echo "<td>". $row['created_date'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['firstname'] . $row['surname']."</td>";
                                                echo "<td>". $row['tutor_id'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['type_id'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['email'] ."</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <div id="pager_meeting" class="pager" style="position: absolute;">
                                            <form>
                                                <img src="../images/first.png" class="first">
                                                <img src="../images/prev.png" class="prev">
                                                <input type="text" class="pagedisplay">
                                                <img src="../images/next.png" class="next">
                                                <img src="../images/last.png" class="last">
                                                <select class="pagesize" style="display: none;">
                                                    <option selected="selected" value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="40">40</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div id="two" class="content-box">
                                <div class="col-one col">
                                    <div class="12u">
                                        <table id="table_upload" class="tablesorter">
                                            <thead>
                                            <tr>
                                                <th style="display: none;">Id</th>
                                                <th>Name</th>
                                                <th style="display: none;">File Path</th>
                                                <th style="display: none;">Student Id</th>
                                                <th>Upload date</th>
                                                <th>Comment</th>
                                                <th style="display: none;">Comment By</th>
                                                <th>Comment date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_array($result_upload)) {
                                                echo "<tr>";
                                                echo "<td style=\"display: none;\">" . $row['file_id'] . "</td>";
                                                echo "<td><a href=..".(str_replace(" ","%20",$row['file_path'])).">" . $row['file_name'] . "</a></td>";
                                                echo "<td style=\"display: none;\">" . $row['file_path'] . "</td>";
                                                echo "<td style=\"display: none;\">" . $row['student_id'] . "</td>";
                                                echo "<td>" . $row['upload_date'] . "</td>";
                                                echo "<td>" . $row['comment'] . "</td>";
                                                echo "<td style=\"display: none;\">" . $row['comment_by'] . "</td>";
                                                echo "<td>" . $row['comment_date'] . "</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <div id="pager_upload" class="pager" style="position: absolute;">
                                            <form>
                                                <img src="../images/first.png" class="first">
                                                <img src="../images/prev.png" class="prev">
                                                <input type="text" class="pagedisplay">
                                                <img src="../images/next.png" class="next">
                                                <img src="../images/last.png" class="last">
                                                <select class="pagesize" style="display: none;">
                                                    <option selected="selected" value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="40">40</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="three" class="content-box">
                                <div class="col-one col">
                                    <div class="12u">
                                        <table id="table_blog" class="tablesorter">
                                            <thead>
                                            <tr>
                                                <th style="display: none;">Id</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Created Date</th>
                                                <th style="display: none;">Student Name</th>
                                                <th style="display: none;">Tutor Id</th>
                                                <th style="display: none;">Type Id</th>
                                                <th style="display: none;">Student Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while($row = mysqli_fetch_array($result_query_blog))
                                            {
                                                echo "<tr id='row".$row['message_id']."'>";
                                                echo "<td style=\"display: none;\">". $row['message_id'] ."</td>";
                                                echo "<td>". $row['title'] ."</td>";
                                                echo "<td>". $row['content'] ."</td>";
                                                echo "<td>". $row['created_date'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['firstname'] . $row['surname']."</td>";
                                                echo "<td style=\"display: none;\">". $row['tutor_id'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['type_id'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['email'] ."</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <div id="pager_blog" class="pager" style="position: absolute;">
                                            <form>
                                                <img src="../images/first.png" class="first">
                                                <img src="../images/prev.png" class="prev">
                                                <input type="text" class="pagedisplay">
                                                <img src="../images/next.png" class="next">
                                                <img src="../images/last.png" class="last">
                                                <select class="pagesize" style="display: none;">
                                                    <option selected="selected" value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="40">40</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="four" class="content-box">
                                <div class="col-one col">
                                    <div class="12u">
                                        <table id="table_message" class="tablesorter">
                                            <thead>
                                            <tr>
                                                <th style="display: none;">Id</th>
                                                <th>Title</th>
                                                <th>Content</th>
                                                <th>Created Date</th>
                                                <th style="display: none;">Student Name</th>
                                                <th style="display: none;">Tutor Id</th>
                                                <th style="display: none;">Type Id</th>
                                                <th style="display: none;">Student Email</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            while($row = mysqli_fetch_array($result_query_mft))
                                            {
                                                echo "<tr id='row".$row['message_id']."'>";
                                                echo "<td style=\"display: none;\">". $row['message_id'] ."</td>";
                                                echo "<td>". $row['title'] ."</td>";
                                                echo "<td>". $row['content'] ."</td>";
                                                echo "<td>". $row['created_date'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['firstname'] . $row['surname']."</td>";
                                                echo "<td style=\"display: none;\">". $row['tutor_id'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['type_id'] ."</td>";
                                                echo "<td style=\"display: none;\">". $row['email'] ."</td>";
                                                echo "</tr>";
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                        <div id="pager_message" class="pager" style="position: absolute;">
                                            <form>
                                                <img src="../images/first.png" class="first">
                                                <img src="../images/prev.png" class="prev">
                                                <input type="text" class="pagedisplay">
                                                <img src="../images/next.png" class="next">
                                                <img src="../images/last.png" class="last">
                                                <select class="pagesize" style="display: none;">
                                                    <option selected="selected" value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="40">40</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
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
<script>
    $(document).ready(function() {
        $("#table_meeting").tablesorter({theme:'ice',widthFixed: false, sortList:[[3,1]], widgets:['zebra']}).tablesorterPager({container: $("#pager_meeting")});
        $("#table_upload").tablesorter({theme:'ice',widthFixed: false, sortList:[[4,1]], widgets:['zebra']}).tablesorterPager({container: $("#pager_upload")});
        $("#table_blog").tablesorter({theme:'ice',widthFixed: false, sortList:[[3,1]], widgets:['zebra']}).tablesorterPager({container: $("#pager_blog")});
        $("#table_message").tablesorter({theme:'ice',widthFixed: false, sortList:[[3,1]], widgets:['zebra']}).tablesorterPager({container: $("#pager_message")});

    });
</script>
</html>