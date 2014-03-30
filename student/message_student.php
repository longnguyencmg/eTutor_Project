<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    $sql_query_m2t = "SELECT * FROM cms_message WHERE type_id = '3' and student_id = '$id'";
    $sql_query_mft = "SELECT * FROM cms_message WHERE type_id = '4' and student_id = '$id'";

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

        .button{
            width: 220px;
            height: 60px;
            font-size: 16px;
            display: inherit;
        }

        #sendMessageDiv{
            height: 250px;
            width: 403px;
            background-image: url("../css/images/userBoxAdd.png");
            position: absolute;
            display: none;
        }

        #tblSendMessage{
            font-size: 15px;
            width: 350px;
            margin-left: 20px;
            margin-top: 40px;
        }

        #tblSendMessage input,textarea{
            font-size: 14px;
            width: 100%;
        }

        #tblSendMessage textarea{
            vertical-align: top;
        }

        #btnSend{
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -20px;
            margin-left: 230px;
        }

        #btnCancel{
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -38px;
            margin-left: 120px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div id="header" class="skel-panels-fixed">

    <div class="top">

        <!-- Logo -->
        <div id="logo">
            <span class="image avatar48"><img src="<?php echo $_SESSION['imageUrl'];?>" alt=""/></span>

            <h1 id="title">
                <?php
                echo $_SESSION['user'];
                ?>
            </h1>
            <span class="byline">Software Developer</span>
        </div>

        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li><a href="index_student.php" id="home-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-home">Dashboard</span></a></li>
                <li><a href="blog_student.php" id="blog-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-pencil-square">Blog</span></a></li>
                <li><a href="upload_student.php" id="upload-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-upload">Upload</span></a></li>
                <li><a href="meeting_student.php" id="meeting-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-user">Meeting</span></a></li>
                <li><a href="#message" id="message-link" class="skel-panels-ignoreHref active"><span
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
            <header><h2 style="margin-top: 30px;">Messages</h2></header>
            <input type="text" id="txtTutorId" value="<?php echo $tutorId ?>" style="display: none;">
            <input type="text" id="txtStudentId" value="<?php echo $id ?>" style="display: none;">

            <div><a id="addMessage" class="button">Add Message</a></div>
            <div class="row">
                <div class="12u">
                    <p>Messages to Tutor</p>
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
            </div>
            <div class="row">
                <div class="12u">
                    <p>Messages from Tutor</p>
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
                <div id="sendMessageDiv">
                    <table id="tblSendMessage">
                        <tbody>
                        <tr>
                            <td style="color: #659492">Title</td>
                            <td><input type="text" id="txtTitle" value="Title"></td>
                        </tr>
                        <tr>
                            <td style="color: #659492">Content</td>
                            <td><textarea rows="3" id="txtContent">Message</textarea></td>
                        </tr>
                        </tbody>
                    </table>
                    <div style="margin-top: -40px;height: 60px;"><p id="status" style="font-size: 14px;margin-left: -3px;width: 380px;"></p></div>
                    <div>
                        <a id="btnSend" class="button">Send</a>
                        <a id="btnCancel" class="button">Cancel</a>
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
<script>
    $(document).ready(function() {
        $("#tableM2t").tablesorter({theme:'ice',widthFixed: false, sortList:[[3,1]], widgets: ['zebra']});
        $("#tableMft").tablesorter({theme:'ice',widthFixed: false, sortList:[[3,1]], widgets: ['zebra']});

        var isShowAddRequest = false;

        var fullDate = new Date();
        var twoDigitMonth = fullDate.getMonth()+1+"";
        if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
        var twoDigitDate = fullDate.getDate()+"";
        if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
        var currentDate = fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + twoDigitDate ;
        console.log(currentDate);

        function S4() {
            return (((1 + Math.random()) * 0x10000) | 0).toString(16).substring(1);
        };

        // Generate a pseudo-GUID by concatenating random hexadecimal.
        function guid() {
            return (S4() + S4() + "-" + S4() + "-" + S4() + "-" + S4() + "-" + S4()
                + S4() + S4());
        };
        function randomString() {
            return guid();
        }


        $("#btnSend").click(function(){

            var objId = randomString();
            var objTitle = $("#txtTitle").val();
            var objContent = $("#txtContent").val();
            var objDate = currentDate;
            var objStudentId = $("#txtStudentId").val();
            var objTutor = $("#txtTutorId").val();
            var objTypeId = 3;
            var objTutor_email  = "long.nd144@gmail.com";

            if((objTitle != null && objTitle.length > 0) && (objContent != null && objContent.length > 0)){
                var row = '<tr id='+objId+'><td style="display:none;">'+objId+'</td><td style="background:#B94C4C;color:#ffffff">'+objTitle+'</td><td style="background:#B94C4C;color:#ffffff">'+objContent+'</td><td style="background:#B94C4C;color:#ffffff">'+objDate+'</td><td style="display:none;">'+objStudentId+'</td><td style="display:none;">'+objTutor+'</td><td style="display:none;">'+objTypeId+'</td></tr>',
                    $row = $(row),resort = true;

                $("#tableM2t").find('tbody').append($row).trigger('addRows', [$row, resort]);
                $("#mytable").trigger('refreshWidgets');

                sendMessage2Tutor(objId, objTitle, objContent, objDate, objStudentId, objTutor, objTypeId);
                sendEmail2Tutor(objTitle, objContent, objTutor_email);
                $("#sendMessageDiv").slideUp("slow",
                    function() {
                        isShowAddRequest = false;
                    });
                $("#" + objId).find('td:eq(1)').delay(3000).queue(
                    function() {
                        $(this).css('background-color', '');
                        $(this).css('color', '');
                    });
                $("#" + objId).find('td:eq(2)').delay(3000).queue(
                    function() {
                        $(this).css('background-color', '');
                        $(this).css('color', '');
                    });
                $("#" + objId).find('td:eq(3)').delay(3000).queue(
                    function() {
                        $(this).css('background-color', '');
                        $(this).css('color', '');
                    });
                return false;
            } else {
                document.getElementById("status").innerHTML = "Please fill in field Title/Content";
                document.getElementById("status").style.color = "#ff0000";
            }


        });

        $("#addMessage").click(
            function() {
                id = this.id;
                setAddformPosition(id);
                if (!isShowAddRequest) {
                    $("#sendMessageDiv").slideDown("slow",
                        function() {
                            isShowAddRequest = true;
                        });
                } else {
                    $("#sendMessageDiv").slideUp("fast",
                        function() {
                            isShowAddRequest = false;
                        });
                }
            });

        function setAddformPosition(ele) {
            var pos = $("#" + ele).position();
            $("#sendMessageDiv").css({
                position : "absolute",
                top : pos.top + 60 + "px"
            });
        }

        $("#txtTitle").focus(function(){
            $('#txtTitle').val("");
        });
        $("#txtContent").focus(function(){
            $('#txtContent').text("");
        });

        $("#btnCancel").click(function(){
            $("#sendMessageDiv").slideUp("fast",
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
    });
</script>
</body>
</html>