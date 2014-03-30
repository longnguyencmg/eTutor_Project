<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    //$sql_query_blog = "SELECT * FROM cms_message WHERE type_id = '1'";
    $sql_query_blog = "SELECT cms_message.message_id as message_id, cms_message.content as content, cms_message.created_date as created_date, cms_message.title as title, cms_message.tutor_id as tutor_id, cms_message.type_id as type_id, cms_message.student_id as student_id, cms_student.firstname as firstname, cms_student.surname as surname
                       FROM cms_message
                       LEFT JOIN cms_student
                       ON cms_message.student_id=cms_student.student_id
                       WHERE cms_message.tutor_id = '$id' and type_id = '1'";
    $result_blog = mysqli_query($con,$sql_query_blog);

    mysqli_close($con);
?>
<html>
<head>
    <title>Blog</title>
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
        .inWeek{
            background: rgb(153, 255, 153);
        }

        .overWeek{
            background: rgb(255, 255, 204);
        }

        .overMonth{
            background: rgb(255, 204, 255);
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
                <li><a href="#blog" id="blog-link" class="skel-panels-ignoreHref active"><span
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

    <!-- Blog -->
    <section id="blog" class="one">
        <header><h2 style="margin-top: 30px;">Blog</h2></header>
        <div class="container">
            <div class="row">
                <div class="12u">
                    <table id="mytable" class="tablesorter">
                        <thead>
                        <tr>
                            <th style="display: none;">Id</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Created Date</th>
                            <th>Student Name</th>
                            <th style="display: none;">Tutor Id</th>
                            <th style="display: none;">Type Id</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result_blog))
                        {
                            echo "<tr>";
                            echo "<td style=\"display: none;\">". $row['message_id'] ."</td>";
                            echo "<td>". $row['title'] ."</td>";
                            echo "<td>". $row['content'] ."</td>";
                            echo "<td>". $row['created_date'] ."</td>";
                            echo "<td studentId='".$row['student_id']."'>". $row['firstname'] . $row['surname'] ."</td>";
                            echo "<td style=\"display: none;\">". $row['tutor_id'] ."</td>";
                            echo "<td style=\"display: none;\">". $row['type_id'] ."</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="2u"></div>
                <div class="8u">
                    <table style="font-size: 15px;">
                        <tr style="text-align: center;color: black">
                            <td class="overMonth">Over 1 Month</td>
                            <td class="overWeek">Over 1 Week</td>
                            <td class="inWeek">With a week</td>
                        </tr>
                    </table>
                </div>
                <div class="2u"></div>
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
        $("#mytable").tablesorter({theme:'ice',widthFixed: false, sortList:[[3,1]]});

        $('#mytable > tbody > tr').each(function() {
            var created_date = new Date($(this).find('td:eq(3)').text());
            var one_day = 1000*60*60*24;

            var nDifference = Math.round((Math.abs(new Date() - created_date))/one_day);
            console.log(nDifference);
            if(nDifference <= 7){
                $(this).addClass("inWeek");
            }else if(nDifference > 7 && nDifference <= 31){
                $(this).addClass("overWeek");
            }else if(nDifference > 31){
                $(this).addClass("overMonth");
            }
        });
    });
</script>
</body>
</html>