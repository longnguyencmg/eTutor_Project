<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    //$sql_query_meeting = "SELECT * FROM cms_message WHERE type_id = '2'";
    $sql_query_meeting = "SELECT cms_message.message_id as message_id, cms_message.content as content, cms_message.created_date as created_date, cms_message.title as title, cms_message.tutor_id as tutor_id, cms_message.type_id as type_id, cms_message.student_id as student_id, cms_student.firstname as firstname, cms_student.surname as surname, cms_student.email as email
                          FROM cms_message
                          LEFT JOIN cms_student
                          ON cms_message.student_id=cms_student.student_id
                          WHERE cms_message.tutor_id = '$id' and type_id = '2'";
    $result_meeting = mysqli_query($con,$sql_query_meeting);

    $sql_query_list_request = "SELECT * FROM cms_message WHERE cms_message.tutor_id = '$id' and type_id = '2'";
    $result_list_request = mysqli_query($con,$sql_query_list_request);
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

        #addReplyDiv{
            height: 250px;
            width: 403px;
            background-image: url("../css/images/userBoxAdd.png");
            position: absolute;
            display: none;
        }

        .requestTitle{
            width: 260px;
        }

        #tblAddReply{
            font-size: 15px;
            width: 364px;
            margin-left: 14px;
            margin-top: 40px;
        }

        #tblAddRequest input,textarea{
            font-size: 14px;
            width: 100%;
        }

        #tblAddRequest textarea{
            vertical-align: top;
        }

        #btnAdd{
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -20px;
            margin-left: 270px;
        }

        #btnCancel{
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -38px;
            margin-left: 160px;
        }

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
                <li><a href="blog_tutor.php" id="blog-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-pencil-square">Blog</span></a></li>
                <li><a href="upload_tutor.php" id="upload-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-upload">Upload</span></a></li>
                <li><a href="#meeting" id="meeting-link" class="skel-panels-ignoreHref active"><span
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
    <section id="meeting" class="one">

        <div class="container">
            <header><h2 style="margin-top: 30px;">Meeting</h2></header>
            <input type="text" id="txtTutorId" value="<?php echo $id ?>" style="display: none;">
            <div class="row">
                <div class="12u">
                    <div><a id="makeReply" class="button">Reply</a></div>
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
                            <th style="display: none;">Student Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while($row = mysqli_fetch_array($result_meeting))
                        {
                            echo "<tr id='row".$row['message_id']."'>";
                                echo "<td style=\"display: none;\">". $row['message_id'] ."</td>";
                                echo "<td>". $row['title'] ."</td>";
                                echo "<td>". $row['content'] ."</td>";
                                echo "<td>". $row['created_date'] ."</td>";
                                echo "<td studentId='".$row['student_id']."'>". $row['firstname'] . $row['surname']."</td>";
                                echo "<td style=\"display: none;\">". $row['tutor_id'] ."</td>";
                                echo "<td style=\"display: none;\">". $row['type_id'] ."</td>";
                                echo "<td style=\"display: none;\">". $row['email'] ."</td>";
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

            <div id="addReplyDiv">
                <table id="tblAddReply">
                    <tbody>
                    <tr>
                        <td style="color: #659492">Message</td>
                        <td><select id="requestList" class="requestTitle">
                            <?php
                            while($row = mysqli_fetch_array($result_list_request)){
                                echo "<option value='".$row['message_id']."'>".$row['title']."</option>";
                            }
                            ?>
                        </select></td>
                    </tr>
                    <tr>
                        <td style="color: #659492; vertical-align: top;">Content</td>
                        <td><textarea rows="3" id="txtContent">Reply</textarea></td>
                    </tr>
                    </tbody>
                </table>
                <div style="margin-top: -40px;height: 60px;"><p id="status" style="font-size: 14px;margin-left: -60px;width: 380px;"></p></div>
                <div>
                    <a id="btnAdd" class="button">Submit</a>
                    <a id="btnCancel" class="button">Cancel</a>
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
        $("#mytable").tablesorter({theme:'ice',widthFixed: false, sortList:[[3,1]]}).tablesorterPager({container: $("#pager")});
        var isShowAddRequest = false;
        var fullDate = new Date();
        var twoDigitMonth = fullDate.getMonth()+1+"";
        if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
        var twoDigitDate = fullDate.getDate()+"";
        if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
        var currentDate = fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + twoDigitDate ;
        console.log(currentDate);

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


        $("#btnAdd").click(function(){
            var message_id = $("#requestList").val();
            var content = $("#txtContent").val();
            var title = $("#row"+message_id).find('td:eq(1)').text();
            var date = currentDate;
            var studentId = $("#row"+message_id).find('td:eq(4)').attr('studentId');
            var tutorId = $("#txtTutorId").val();
            var typeId = 4;

            if(content != null && content.length > 0){
                sendMessage2Tutor(message_id, title, content, date, studentId, tutorId, typeId);

                $("#addReplyDiv").slideUp("slow",
                    function() {
                        isShowAddRequest = false;
                    });
                return false;
            } else {
                document.getElementById("status").innerHTML = "Please add Content";
                document.getElementById("status").style.color = "#ff0000";
            }


        });

        $("#makeReply").click(
            function() {
                id = this.id;
                setAddformPosition(id);
                if (!isShowAddRequest) {
                    $("#addReplyDiv").slideDown("slow",
                        function() {
                            isShowAddRequest = true;
                        });
                } else {
                    $("#addReplyDiv").slideUp("fast",
                        function() {
                            isShowAddRequest = false;
                        });
                }
            });

        function setAddformPosition(ele) {
            var pos = $("#" + ele).position();
            $("#addReplyDiv").css({
                position : "absolute",
                top : pos.top + 60 + "px"
            });
        }

        $("#txtContent").focus(function(){
            $('#txtContent').val("");
        });

        $("#btnCancel").click(function(){
            $("#addReplyDiv").slideUp("fast",
                function() {
                    isShowAddRequest = false;
                    document.getElementById("status").innerHTML = "";
                });
        });

        function sendMessage2Tutor(id, title, content, date, studentId, tutorId, typeId)
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
</body>
</html>