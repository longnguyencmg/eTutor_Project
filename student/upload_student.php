<?php session_start(); ?>
<?php
    include '../db_connection.php';
    if (!isset($_SESSION['id'])) {
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    $tutorId = $_SESSION['tutor'];
    $sql_query_upload = "SELECT * FROM cms_upload WHERE student_id = '$id'";

    $result_upload = mysqli_query($con, $sql_query_upload);

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
    <!--[if lte IE 9]><link rel="stylesheet" href="../css/ie9.css"/><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="../css/ie8.css"/><![endif]-->

    <style>
        .button {
            width: 220px;
            height: 60px;
            font-size: 16px;
            display: inherit;
        }

        #uploadFileDiv {
            height: 250px;
            width: 403px;
            background-image: url("../css/images/userBoxAdd.png");
            position: absolute;
            display: none;
        }

        #tblUploadFile {
            font-size: 15px;
            width: 350px;
            margin-left: 45px;
            margin-top: 40px;
        }

        #tblUploadFile input, textarea {
            font-size: 14px;
            width: 100%;
        }

        #tblUploadFile textarea {
            vertical-align: top;
        }

        #btnUpload {
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -20px;
            margin-left: 235px;
        }

        #btnCancel {
            width: 100px;
            height: 38px;
            padding: 0px;
            margin-top: -38px;
            margin-left: 96px;
        }
    </style>
    <script>

    </script>
</head>
<body>

<!-- Header -->
<div id="header" class="skel-panels-fixed">

    <div class="top">

        <!-- Logo -->
        <div id="logo">
            <span class="image avatar48"><img src="<?php echo $_SESSION['imageUrl']; ?>" alt=""/></span>

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
                <li><a href="#upload" id="upload-link" class="skel-panels-ignoreHref active"><span
                            class="fa fa-upload">Upload</span></a></li>
                <li><a href="meeting_student.php" id="meeting-link" class="skel-panels-ignoreHref"><span
                            class="fa fa-user">Meeting</span></a></li>
                <li><a href="message_student.php" id="message-link" class="skel-panels-ignoreHref"><span
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
            <header><h2 style="margin-top: 30px;">Upload</h2></header>
            <input type="text" id="txtTutorId" value="<?php echo $tutorId ?>" style="display: none;">
            <input type="text" id="txtStudentId" value="<?php echo $id ?>" style="display: none;">

            <div><a id="uploadFileBtn" class="button">Upload File</a></div>
            <table id="mytable" class="tablesorter">
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
            <div id="uploadFileDiv">
                <form id="upload_form" enctype="multipart/form-data" method="post">
                    <table id="tblUploadFile">

                        <tbody>
                        <tr style="height: 50px;">
                            <td style="color: #659492; width: 50px;">File</td>
                            <td><input type="file" name="file1" id="file1"></td>
                        </tr>
                        <tr style="height: 30px;">
                            <td style="color: #659492"></td>
                            <td><progress id="progressBar" value="0" max="100" style="width:240px;"></progress></td>
                        </tr>
                        <tr>
                            <td style="color: #659492">Date</td>
                            <td><input type="text" id="txtDate" name="date" style="width:100px;text-align: center;" disabled/></td>
                        </tr>
                        </tbody>

                    </table>
                    <div style="margin-top: -40px;height: 60px;"><p id="status" style="font-size: 14px;margin-left: 10px;width: 380px;"></p></div>
                    <div>
                        <a id="btnUpload" class="button">Upload</a>
                        <a id="btnCancel" class="button">Cancel</a>
                    </div>
                </form>

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
    $(document).ready(function () {
        $("#mytable").tablesorter({theme: 'ice', widthFixed: false, sortList: [[1, 0]], widgets: ['zebra']});

        var isShowAddRequest = false;
        var fullDate = new Date();
        var twoDigitMonth = fullDate.getMonth() + 1 + "";
        if (twoDigitMonth.length == 1)  twoDigitMonth = "0" + twoDigitMonth;
        var twoDigitDate = fullDate.getDate() + "";
        if (twoDigitDate.length == 1) twoDigitDate = "0" + twoDigitDate;
        var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + twoDigitDate;
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

        function handleUpload() {
            var fileId = randomString();
            var fileName = $("#file1").val().substring($("#file1").val().lastIndexOf("\\")+1, $("#file1").val().length);
            var filePath = "/uploads/"+ encodeURIComponent(fileName);
            var objStudentId = $("#txtStudentId").val();
            var uploadDate = currentDate;
            var comment = "";
            var commenyBy = $("#txtTutorId").val();
            var commentDate = "";
            fileName = fileName.substring(0, fileName.lastIndexOf("."));

            var row = '<tr id="'+fileId+'"><td style=\"display: none;\">' + fileId + '</td><td style="background:#B94C4C;color:#ffffff"><a href=..'+filePath+'>' + fileName + '</a></td><td style=\"display: none;\">' + filePath + '</td><td style=\"display: none;\">' + objStudentId + '</td><td style="background:#B94C4C;color:#ffffff">' + uploadDate + '</td><td style="background:#B94C4C;color:#ffffff">' + comment + '</td><td style=\"display: none;\">' + commenyBy + '</td><td style="background:#B94C4C;color:#ffffff">' + commentDate + '</td></tr>',
                $row = $(row),
            // resort table using the current sort; set to false to prevent resort, otherwise
            // any other value in resort will automatically trigger the table resort.
                resort = true;
            $("#mytable").find('tbody').append($row).trigger('addRows', [$row, resort]);
            $("#mytable").trigger('refreshWidgets');

            uploadFileServer(fileId, fileName, filePath, objStudentId, uploadDate, comment, commenyBy, commentDate);
            sendMailNotification();

            $("#uploadFileDiv").slideUp("slow",
                function () {
                    isShowAddRequest = false;
                });

            $("#" + fileId).find('td:eq(1)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            $("#" + fileId).find('td:eq(4)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            $("#" + fileId).find('td:eq(5)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            $("#" + fileId).find('td:eq(7)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            return false;
        }

        function sendMailNotification(){
            var objTitle = "Upload File Notification";
            var objStudentId = $("#txtStudentId").val();
            var fileName = $("#file1").val().substring($("#file1").val().lastIndexOf("\\")+1, $("#file1").val().length);
            var uploadDate = currentDate;
            var objContent = "Student - "+objStudentId + " uploaded file "+ fileName + " for the coursework" + "\n" + "Date: " + uploadDate;
            var objTutor_email  = "long.nd144@gmail.com";

            sendEmail2Tutor(objTitle, objContent, objTutor_email);
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

        $("#uploadFileBtn").click(
            function () {
                id = this.id;
                $("#status").text("");
                $('#file1').val("");
                setAddformPosition(id);
                if (!isShowAddRequest) {
                    $("#uploadFileDiv").slideDown("slow",
                        function () {
                            isShowAddRequest = true;
                        });
                } else {
                    $("#uploadFileDiv").slideUp("fast",
                        function () {
                            isShowAddRequest = false;
                        });
                }
            });

        function setAddformPosition(ele) {
            var pos = $("#" + ele).position();
            $("#uploadFileDiv").css({
                position: "absolute",
                top: pos.top + 60 + "px"
            });
        }

        $('#txtDate').val(currentDate);

        $("#btnCancel").click(function () {
            $("#uploadFileDiv").slideUp("fast",
                function () {
                    isShowAddRequest = false;
                });
        });

        function uploadFileServer(fileId, fileName, filePath, studentId, uploadDate, comment, commentBy, commentDate) {
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
            var data = "fileId=" + fileId + "&fileName=" + fileName + "&filePath=" + filePath + "&studentId=" + studentId + "&uploadDate=" + uploadDate + "&comment=" + comment + "&commentBy=" + commentBy + "&commentDate=" + commentDate;
            xhr.open("POST", "../handler/UploadDBHandler.php", true);
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

        function _(el){
            return document.getElementById(el);
        }

        $("#btnUpload").click(function uploadFile(){
            var file = _("file1").files[0];
            //alert(file.name+" | "+file.size+" | "+file.type);
            if(file != null){
                if(file.size > 20*1024*1024){
                    _("status").innerHTML = "ERROR: Can not upload file greater than 20MB!";
                    _("status").style.color = "#ff0000";
                }else{
                    var formdata = new FormData();
                    formdata.append("file1", file);
                    var ajax = new XMLHttpRequest();
                    ajax.upload.addEventListener("progress", progressHandler, false);
                    ajax.addEventListener("load", completeHandler, false);
                    ajax.addEventListener("error", errorHandler, false);
                    ajax.addEventListener("abort", abortHandler, false);
                    ajax.open("POST", "../handler/UploadFile.php");
                    ajax.send(formdata);
                }
            }else{
                _("status").innerHTML = "ERROR: Please choose file to upload!";
                _("status").style.color = "#ff0000";
            }
        });

        function progressHandler(event){
            //_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
            var percent = (event.loaded / event.total) * 100;
            _("progressBar").value = Math.round(percent);
            _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
        }
        function completeHandler(event){
            if(event.target.responseText.indexOf("ERROR") != -1){
                _("status").innerHTML = event.target.responseText;
                _("status").style.color = "#ff0000";
            }else{
                _("status").innerHTML = event.target.responseText;
                _("status").style.color = "#0D6B00";
                handleUpload();
            }

            _("progressBar").value = 0;
        }
        function errorHandler(event){
            _("status").innerHTML = "Upload Failed";
        }
        function abortHandler(event){
            _("status").innerHTML = "Upload Aborted";
        }
    });
</script>
</body>
</html>