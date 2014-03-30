<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    $sql_query_count_blog = "SELECT COUNT(*) AS total_blog FROM cms_message WHERE type_id = '1' and tutor_id = '$id'";
    $sql_query_count_request = "SELECT COUNT(*) AS total_request FROM cms_message WHERE type_id = '2' and tutor_id = '$id'";
    $sql_query_count_m2t = "SELECT COUNT(*) AS total_m2t FROM cms_message WHERE type_id = '3' and tutor_id = '$id'";
    $sql_query_count_mft = "SELECT COUNT(*) AS total_mft FROM cms_message WHERE type_id = '4' and tutor_id = '$id'";

    $result_blog = mysqli_query($con,$sql_query_count_blog);
    $result_request = mysqli_query($con,$sql_query_count_request);
    $result_m2t = mysqli_query($con,$sql_query_count_m2t);
    $result_mft = mysqli_query($con,$sql_query_count_mft);

    $sql_query_list_student = "SELECT * FROM cms_student WHERE cms_student.tutor_id = '$id'";
    $result_list_student = mysqli_query($con,$sql_query_list_student);

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

        .first{
            margin-left: -96px;
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

        .button{
            width: 220px;
            height: 60px;
            font-size: 16px;
            display: inherit;
        }

        #addMessageDiv{
            height: 250px;
            width: 403px;
            background-image: url("../css/images/userBoxAdd.png");
            position: absolute;
            display: none;
        }

        #tblAddMessage{
            font-size: 15px;
            width: 370px;
            margin-left: 14px;
            margin-top: 30px;
        }

        #tblAddMessage input,textarea{
            font-size: 14px;
            width: 100%;
        }

        #tblAddMessage textarea{
            vertical-align: top;
        }

        #btnSend{
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -20px;
            margin-left: 270px;
        }

        #btnCheckAll{
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -38px;
            margin-left: 160px;
        }

        #btnCancel{
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -38px;
            margin-left: 50px;
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
            <input type="text" id="txtTutorId" value="<?php echo $id ?>" style="display: none;">
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
                        <a href="blog_tutor.php"><img src="../images/blog.png"></a>
                    </div>
                    <p style="color: cadetblue;">Blog</p>
                </div>
                <div class="3u">
                    <div class="content">
                        <div class="circle"><label style="color: white"><?php
                                if($row = mysqli_fetch_array($result_request)){
                                    echo $row['total_request'];
                                }
                                ?>
                            </label></div>
                        <a href="meeting_tutor.php"><img src="../images/Meeting.png"></a>
                    </div>
                    <p style="color: cadetblue;">Meeting Requests</p>
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
                        <a href="message_tutor.php"><img src="../images/message.jpg"></a>
                    </div>
                    <p style="color: cadetblue;">Messages from student</p>
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
                        <a href="message_tutor.php"><img src="../images/message.jpg"></a>
                    </div>
                    <p style="color: cadetblue;">Messages to student</p>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <div><a id="sendMessage" class="button">Send Message</a></div>
                    <table id="mytable" class="tablesorter">
                        <thead>
                        <tr>
                            <th>Student Id</th>
                            <th>First name</th>
                            <th>Surname</th>
                            <th>DoB</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Home_Std</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result_list_student))
                        {
                            echo "<tr id='row".$row['student_id']."'>";
                                echo "<td><a href='student_detail_tutor.php?student_id=".$row['student_id']."'>". $row['student_id'] ."</td>";
                                echo "<td>". $row['firstname'] ."</td>";
                                echo "<td>". $row['surname'] ."</td>";
                                echo "<td>". $row['dob'] ."</td>";
                                echo "<td>". $row['email'] ."</td>";
                                echo "<td>". $row['Course'] ."</td>";
                                if($row['isHomeStudent'] == "true"){
                                    echo "<td style='vertical-align: middle;text-align: center;'><img src='../images/appcheckicon.png' style='width: 23px;height: 23px;'/>
                                                <label style='display: none;'>true</label>
                                          </td>";
                                }else{
                                    echo "<td><label style='display: none;'>false</label></td>";
                                }
                                //echo "<td>". $row['isHomeStudent'] == "true" ? "<img src='../images/appcheckicon.png'/>" : "<img style='display:none;' src='../images/appcheckicon.png'/>"."</td>";
                                echo "<td style='vertical-align: middle;text-align: center;'><input type='checkbox' id='".$row['student_id']."' name='".$row['student_id']."' value='". $row['student_id'] ."'></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="12u">
                    <div id="pager" class="pager" style="position: absolute;">
                        <form>
                            <img src="../images/first.png" class="first">
                            <img src="../images/prev.png" class="prev">
                            <input type="text" class="pagedisplay">
                            <img src="../images/next.png" class="next">
                            <img src="../images/last.png" class="last">
                            <select class="pagesize">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="30">30</option>
                                <option value="40">40</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div id="addMessageDiv">
                <table id="tblAddMessage">
                    <tbody>
                    <tr>
                        <td style="color: #659492">Title</td>
                        <td><input type="text" id="txtTitle" value="Title"></td>
                    </tr>
                    <tr>
                        <td style="color: #659492; vertical-align: top;">Message</td>
                        <td><textarea rows="4" id="txtContent">Message...</textarea></td>
                    </tr>
                    </tbody>
                </table>
                <a id="btnSend" class="button">Send</a>
                <a id="btnCheckAll" class="button">Check all</a>
                <a id="btnCancel" class="button">Cancel</a>
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
        $("#mytable").tablesorter({theme:'ice',widthFixed: false, sortList:[[1,0]], widgets: ['zebra']})
            .tablesorterPager({container: $("#pager")});

        var isShowAddRequest = false;
        var fullDate = new Date();
        var twoDigitMonth = fullDate.getMonth()+1+"";
        if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
        var twoDigitDate = fullDate.getDate()+"";
        if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
        var currentDate = fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + twoDigitDate ;
        console.log(currentDate);
        var isCheckAll = false;
        var arrayEmail = [];

        $("#btnSend").click(function(){
            var message_id = 1;
            var content = $("#txtContent").val();
            var title = $("#txtTitle").val();
            var date = currentDate;
            var studentId;
            var tutorId = $("#txtTutorId").val();
            var typeId = 4; //message from tutor

            $('#mytable > tbody > tr').each(function() {
                studentId = $(this).find('td:eq(7)').find('input[type=\'checkbox\']:checked').attr('name');

                if(studentId != undefined){
                    //console.log(studentId);
                    sendMessage2Student(message_id, title, content, date, studentId, tutorId, typeId);
                    arrayEmail.push(studentId+"@gre.ac.uk");
                }

            });
            //for(var i=0; i<arrayEmail.length; i++){
            //    console.log(arrayEmail[i]);
            //}
            sendEmail2Student(title, content, arrayEmail);
            arrayEmail.slice(0, arrayEmail.length);

            $("#addMessageDiv").slideUp("slow",
                function() {
                    isShowAddRequest = false;
                });

            $('#mytable > tbody > tr').each(function() {
                $(this).find('td:eq(7)').find('input[type=\'checkbox\']').prop('checked', false);
            });
            return false;
        });

        $("#btnCheckAll").click(function(){
            if(!isCheckAll){
                $("#btnCheckAll").text("Uncheck All");
                $('#mytable > tbody > tr').each(function() {
                    $(this).find('td:eq(7)').find('input[type=\'checkbox\']').prop('checked', true);
                });

                isCheckAll = true;
            }else{
                $("#btnCheckAll").text("Check All");
                $('#mytable > tbody > tr').each(function() {
                    $(this).find('td:eq(7)').find('input[type=\'checkbox\']').prop('checked', false);
                });

                isCheckAll = false;
            }
        });

        $("#sendMessage").click(
            function() {
                id = this.id;
                setAddformPosition(id);
                if (!isShowAddRequest) {
                    $("#addMessageDiv").slideDown("slow",
                        function() {
                            isShowAddRequest = true;
                        });
                } else {
                    $("#addMessageDiv").slideUp("fast",
                        function() {
                            isShowAddRequest = false;
                        });
                }
            });

        function setAddformPosition(ele) {
            var pos = $("#" + ele).position();
            $("#addMessageDiv").css({
                position : "absolute",
                top : pos.top + 60 + "px"
            });
        }

        $("#txtContent").focus(function(){
            $('#txtContent').val("");
        });

        $("#txtTitle").focus(function(){
            $('#txtTitle').val("");
        });

        $("#btnCancel").click(function(){
            $("#addMessageDiv").slideUp("fast",
                function() {
                    isShowAddRequest = false;
                });
        });

        function sendMessage2Student(id, title, content, date, studentId, tutorId, typeId)
        {
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var data = "id=" + id + "&title=" + title + "&content=" + content + "&date=" + date + "&studentId=" + studentId + "&tutorId=" + tutorId + "&typeId=" + typeId;
            xhr.open("POST", "../handler/SendMessage2Tutor.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send(data);
            xhr.onreadystatechange = display_data;
            function display_data() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        console.log(xhr.responseText);
                        //document.getElementById("suggestion").innerHTML = xhr.responseText;
                    } else {
                        alert('There was a problem with the request.');
                    }
                }
            }
        }

        function sendEmail2Student(title, content, receiver)
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
    });
</script>
</html>