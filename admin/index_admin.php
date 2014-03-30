<?php  session_start(); ?>
<?php
include '../db_connection.php';
if(!isset($_SESSION['id'])){
    echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
}

$id = $_SESSION['id'];
$sql_query_student = "SELECT cms_student.student_id as student_id, cms_student.firstname as firstname,
                             cms_student.surname as surname, cms_student.dob as dob, cms_student.email as email,
                             cms_student.Course as course, cms_student.tutor_id as tutor_id,
                             cms_tutor.firstname as tutor_firstname, cms_tutor.surname as tutor_surname
                      FROM cms_student
                      LEFT JOIN cms_tutor
                      ON cms_student.tutor_id = cms_tutor.tutor_id";

$result_student = mysqli_query($con,$sql_query_student);

$sql_query_tutor = "SELECT tutor_id, firstname, surname FROM cms_tutor ORDER BY firstname";
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
    <style>
        #backgroundPopup {
            background: rgb(0, 0, 0);
            display: none;
            height: 100%;
            left: 0px;
            position: fixed;
            top: 0px;
            width: 100%;
            z-index: 1;
            opacity: 0.7;
        }

        #popupTutor{
            background-color: transparent;
            background-image: url(../images/list_form.png);
            display: none;
            font-size: 13px;
            height: 270px;
            width: 200px;
            position: fixed;
            z-index: 2;
            padding: 12px;
        }

        #listTutors{
            font: initial;
            color: black;
        }

        .inputAllocate{
            height: 24px;
            width: 24px;
            background-image: url(../images/links-icon.jpg);
            float: right;
            background-color: transparent;
            background-repeat: no-repeat;
            border: none;
            cursor: pointer;
            padding: 0px;
            margin-top: 8px;
        }

        #btnAdd{
            width: 75px;
            height: 38px;
            padding: 0px;
            margin-top: 4px;
            margin-left: 103px;
        }

        #btnCancel{
            width: 75px;
            height: 38px;
            padding: 0px;
            margin-top: -38px;
            margin-left: -100px;
        }

        .row-highlight{
            background: #659492;
            color: #ffffff;
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
    <section id="home" class="one">
        <div class="container">

            <a href="http://www.gre.ac.uk/‎" class="image featured"><img src="../images/greenwich_uni.jpg" alt=""/></a>
            <header><h2 style="margin-top: 30px;">Tutor Allocation</h2></header>
            <div class="row">
                <div class="12u">
                    <table id="mytable" class="tablesorter">
                        <thead>
                        <tr>
                            <th>Student Id</th>
                            <th>Student Name</th>
                            <th style="display: none;">DOB</th>
                            <th style="display: none;">Email</th>
                            <th>Course</th>
                            <th>Tutor</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result_student))
                        {
                            echo "<tr id='".$row['student_id']."'>";
                                echo "<td><a href='student_detail_admin.php?student_id=".$row['student_id']."'>". $row['student_id'] ."</td>";
                                echo "<td>". $row['firstname'] . " " . $row['surname'] ."</td>";
                                echo "<td style=\"display: none;\">". $row['dob'] ."</td>";
                                echo "<td style=\"display: none;\">". $row['email'] ."</td>";
                                echo "<td>". $row['course'] ."</td>";
                                echo "<td><span id='T".$row['student_id']."'>".$row['tutor_firstname']. " ".$row['tutor_surname']."</span><input type='button' id='".$row['student_id']."'class='inputAllocate' title='Allocate Tutor'/></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>

                    <div id="popupTutor" style="display: none;">
                        <h3 id="" style="color:#659492;">Allocate </h3>
                        <div style="margin-top: -10px;">
                            <label style="margin-left:-100px; padding-bottom: 5px; color: black;font-size:14px;"> List of Tutors </label>
                        </div>

                        <div id="tableAllocate" style="overflow:auto; height: 165px; width: 164px;margin-left:10px;margin-top: -10px;">
                            <table border="0" id="listTutors" style=" width: 147px; height: 164px;">
                                <?php
                                while($row = mysqli_fetch_array($result_tutor)){
                                    echo "<tr>";
                                    echo "<td id='".$row['tutor_id']."' style=\"cursor:pointer;\"><span>".$row['firstname']. " ".$row['surname']."</span></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>

                        </div>
                        <div>
                            <a id="btnAdd" class="button">Submit</a>
                            <a id="btnCancel" class="button">Cancel</a>
                        </div>
                    </div>
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
        $("#mytable").tablesorter({theme:'ice',widthFixed: false, sortList:[[0,0]]});
        var popupStatus = 0;
        var editText="";
        var rowid="";
        var tutorID="";
        var studentID="";
        var valueChoose="";

        $(".inputAllocate").click(function(){
            rowid = $(this).parent().parent().attr('id');
            studentID = rowid;
            editText = $("#T"+rowid).text();
            centerPopup(this.id);
            loadPopup();
            findEditValue()
        });

        $("#listTutors td").click(function() {
            var value = $.trim($(this).attr('id'));
            var chooseTD = $.trim($(this).text());
            valueChoose= chooseTD;
            tutorID = value;
        });

        $("#btnAdd").click(function(){
           if(valueChoose==""){
               alert("You haven't choose an user!");
           }else{
               $("#T"+rowid).text("" + valueChoose + "");
               disablePopup();
               allocateTutors(studentID, tutorID);
           }
           $("#listTutors tr").each(function(){
                var tr = $('#listTutors').find('tr');
                tr.removeClass('row-highlight');
           });
        });

        function centerPopup(id){
            var windowWidth = document.documentElement.clientWidth;
            var windowHeight = document.documentElement.clientHeight;
            var popupHeight = $("#popupTutor").height();
            var popupWidth = $("#popupTutor").width();
            var offSet = $("#"+id).offset().top;

            $("#popupTutor").css({
                "position" : "absolute",
                "top" : offSet - 130,
                "left" : (windowWidth/2 - popupWidth/2)
            });

            $(window).scrollTop(offSet - 300);

            $("#backgroundPopup").css({
                "height": windowHeight
            });
        }

        function loadPopup(){
            if(popupStatus==0){
                $("#backgroundPopup").css({
                    "opacity" : "0.7"
                });
                $("#backgroundPopup").fadeIn("slow");
                $("#popupTutor").fadeIn("slow");
                $("#mytable").scrollTop(0);
                popupStatus = 1;
            }
        }

        function findEditValue(){
            $('#listTutors tr').each(function(){
                //alert(jQuery(this).find('td:eq(0) span').text());
                if($(this).find('td:eq(0) span').text().trim() == editText){
                    //alert(tr.find('td:eq(0)').find('span').text());
                    $(this).addClass("row-highlight");
                    var index = $(this).index();
                    //alert(index);
                    $("#listTutors").scrollTop(index*20);
                    return false;
                }
            });
        }

        function allocateTutors(student_id, tutor_id)
        {
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var data = "student_id=" + student_id + "&tutor_id=" + tutor_id;
            xhr.open("POST", "../handler/AllocateTutor.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(data);
            xhr.onreadystatechange = display_data;
            function display_data() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        //alert(xhr.responseText);
                        //document.getElementById("suggestion").innerHTML = xhr.responseText;
                        sendMailNotification(student_id, tutor_id);
                    } else {
                        alert('There was a problem with the request.');
                    }
                }
            }
        }

        function sendMailNotification(student_id, tutor_id){
            var tutorId = tutor_id;
            var objTitle = "Allocation Notification";
            var objStudentId = student_id;
            var objContent = "You have been allocated into group of Tutor -" + tutorId;
            var objTutor_email  = "long.nd144@gmail.com";

            sendEmail2Tutor(objTitle, objContent, objTutor_email);
            sendEmail2Tutor(objTitle, objContent, student_id+"@gre.ac.uk");
        }

        function sendEmail2Tutor(title, content, receiver)
        {
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var data = "title=" + title + "&content=" + content + "&receiver=" + receiver;
            xhr.open("POST", "../handler/MailHandler.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(data);
            xhr.onreadystatechange = display_data;
            function display_data() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        //alert(xhr.responseText);
                        //document.getElementById("suggestion").innerHTML = xhr.responseText;
                    } else {
                        alert('There was a problem with the request.');
                    }
                }
            }
        }

        /*$(document).scroll(function(e){
            //$('#status').html($(window).scrollTop());
            var windowHeight = (document.documentElement.clientHeight)/2;
            var popupHeight = (jQuery("#popupTutor").height())/2;
            var topScroll = jQuery(window).scrollTop();
            var value = windowHeight - popupHeight + topScroll;
            if(popupStatus==1){
                $("#popupTutor").animate({
                    "position" : "absolute",
                    "top" : value
                    //scrollTop: (windowHeight/2 - popupHeight/2)+jQuery(window).scrollTop()
                },"fast");
            }
        });*/
        function disablePopup(){
            if(popupStatus==1){
                $("#backgroundPopup").css({
                    "opacity" : "0.0"
                });
                $("#backgroundPopup").fadeOut("slow");
                $("#popupTutor").fadeOut("slow");
                popupStatus = 0;

                $("#listTutors tr").each(function(){
                    var tr = $('#listTutors').find('tr');
                    tr.removeClass('row-highlight');
                });
            }
        }

        $("#btnCancel").click(function(){
            disablePopup();
        });

        $(function() {
            var tr = $('#listTutors').find('tr');
            tr.bind('click', function(event) {
                tr.removeClass('row-highlight');
                $(this).addClass('row-highlight').find('td');
            });
        });
    });
</script>
</html>