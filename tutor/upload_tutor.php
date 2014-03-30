<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    //$sql_query_upload = "SELECT * FROM cms_upload";
    $sql_query_upload = "SELECT cms_upload.file_id as file_id, cms_upload.file_name as file_name, cms_upload.file_path as file_path, cms_upload.student_id as student_id, cms_upload.upload_date as upload_date, cms_upload.comment as comment, cms_upload.comment_by as comment_by, cms_upload.comment_date as comment_date, cms_student.firstname as firstname, cms_student.surname as surname
                         FROM cms_upload
                         LEFT JOIN cms_student
                         ON cms_upload.student_id=cms_student.student_id
                         WHERE cms_upload.comment_by = '$id'";
    $result_upload = mysqli_query($con,$sql_query_upload);

    $sql_query_list_file = "SELECT * FROM cms_upload WHERE comment_by = '$id'";
    $result_list_file = mysqli_query($con,$sql_query_list_file);
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
        .button{
            width: 220px;
            height: 60px;
            font-size: 16px;
            display: inherit;
        }

        #addCommentDiv{
            height: 250px;
            width: 403px;
            background-image: url("../css/images/userBoxAdd.png");
            position: absolute;
            display: none;
        }

        .uploadTitle{
            width: 260px;
        }

        #tblAddComment{
            font-size: 15px;
            width: 364px;
            margin-left: 14px;
            margin-top: 40px;
        }

        #tblAddComment input,textarea{
            font-size: 14px;
            width: 100%;
        }

        #tblAddComment textarea{
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

        .commentRow{
            background-color: #B94C4C;
            color:#ffffff;
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
        <input type="text" id="txtTutorId" value="<?php echo $id ?>" style="display: none;">
        <div class="container">
            <header><h2 style="margin-top: 30px;">Upload</h2></header>
            <div><a id="makeComment" class="button">Add Comment</a></div>
            <table id="mytable" class="tablesorter">
                <thead>
                <tr>
                    <th style="display: none;">Id</th>
                    <th>Name</th>
                    <th style="display: none;">File Path</th>
                    <th>Student Name</th>
                    <th>Upload date</th>
                    <th>Comment</th>
                    <th style="display: none;">Comment By</th>
                    <th>Comment date</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($row = mysqli_fetch_array($result_upload))
                {
                    echo "<tr id='row".$row['file_id']."'>";
                        echo "<td style=\"display: none;\">". $row['file_id'] ."</td>";
                        echo "<td><a href=..".(str_replace(" ","%20",$row['file_path'])).">". $row['file_name'] ."</a></td>";
                        echo "<td style=\"display: none;\">". $row['file_path'] ."</td>";
                        echo "<td studentId='".$row['student_id']."'>". $row['firstname'] . $row['surname'] ."</td>";
                        echo "<td>". $row['upload_date'] ."</td>";
                        echo "<td>". $row['comment'] ."</td>";
                        echo "<td style=\"display: none;\">". $row['comment_by'] ."</td>";
                        echo "<td>". $row['comment_date'] ."</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <div id="addCommentDiv">
                <table id="tblAddComment">
                    <tbody>
                    <tr>
                        <td style="color: #659492">Title</td>
                        <td>
                            <select id="uploadList" class="uploadTitle">
                            <?php
                            while($row = mysqli_fetch_array($result_list_file)){
                                echo "<option value='".$row['file_id']."'>".$row['file_name']."</option>";
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="color: #659492">Content</td>
                        <td><textarea rows="3" id="txtContent">comment</textarea></td>
                    </tr>
                    </tbody>
                </table>
                <div style="margin-top: -40px;height: 60px;"><p id="status" style="font-size: 14px;margin-left: -57px;width: 380px;"></p></div>
                <div>
                    <a id="btnAdd" class="button">Comment</a>
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
        $("#mytable").tablesorter({theme: 'ice', widthFixed: false, sortList: [[4, 1]], widgets: ['zebra']});
    });

    var isShowAddRequest = false;
    var count = 1;

    var fullDate = new Date();
    var twoDigitMonth = fullDate.getMonth()+1+"";
    if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
    var twoDigitDate = fullDate.getDate()+"";
    if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
    var currentDate = fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + twoDigitDate ;
    console.log(currentDate);


    $("#btnAdd").click(function(){
        var file_id = $("#uploadList").val();
        var comment = $("#txtContent").val();

        if(comment != null && comment.length > 0){
            //edit table row
            $("#row"+file_id).find('td:eq(5)').text(comment);
            $("#row"+file_id).find('td:eq(7)').text(currentDate);

            $("#mytable").trigger('update');
            $("#row"+file_id).find('td:eq(1)').css({"background":"#B94C4C", "color":"#ffffff"});
            $("#row"+file_id).find('td:eq(3)').css({"background":"#B94C4C", "color":"#ffffff"});
            $("#row"+file_id).find('td:eq(4)').css({"background":"#B94C4C", "color":"#ffffff"});
            $("#row"+file_id).find('td:eq(5)').css({"background":"#B94C4C", "color":"#ffffff"});
            $("#row"+file_id).find('td:eq(7)').css({"background":"#B94C4C", "color":"#ffffff"});
            count ++;
            addComment(file_id, comment, currentDate);
            $("#addCommentDiv").slideUp("slow",
                function() {
                    isShowAddRequest = false;
                });

            $("#row"+file_id).find('td:eq(1)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            $("#row"+file_id).find('td:eq(3)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            $("#row"+file_id).find('td:eq(4)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            $("#row"+file_id).find('td:eq(5)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            $("#row"+file_id).find('td:eq(7)').delay(3000).queue(
                function() {
                    $(this).css('background-color', '');
                    $(this).css('color', '');
                });
            return false;
        } else {
            document.getElementById("status").innerHTML = "Please add Comment";
            document.getElementById("status").style.color = "#ff0000";
        }
    });

    $("#makeComment").click(
        function() {
            id = this.id;
            setAddformPosition(id);
            if (!isShowAddRequest) {
                $("#addCommentDiv").slideDown("slow",
                    function() {
                        isShowAddRequest = true;
                    });
            } else {
                $("#addCommentDiv").slideUp("fast",
                    function() {
                        isShowAddRequest = false;
                    });
            }
        });

    function setAddformPosition(ele) {
        var pos = $("#" + ele).position();
        $("#addCommentDiv").css({
            position : "absolute",
            top : pos.top + 60 + "px"
        });
    }

    $("#txtContent").focus(function(){
        $('#txtContent').val("");
    });

    $("#btnCancel").click(function(){
        $("#addCommentDiv").slideUp("fast",
            function() {
                isShowAddRequest = false;
                document.getElementById("status").innerHTML = "";
            });
    });

    function addComment(file_id, comment, comment_date)
    {
        var xhr;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var data = "file_id=" + file_id + "&comment=" + comment + "&comment_date=" + comment_date;
        xhr.open("POST", "../handler/AddComment.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send(data);
        xhr.onreadystatechange = display_data;
        function display_data() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    //alert(xhr.responseText);
                    //document.getElementById("suggestion").innerHTML = xhr.responseText;
                    sendMailNotification();
                } else {
                    alert('There was a problem with the request.');
                }
            }
        }
    }

    function sendMailNotification(){
        var fileName = $("#uploadList option:selected").text();
        var tutorId = $("#txtTutorId").val();
        var objTitle = "Comment Notification";
        var uploadDate = currentDate;
        var objContent = "Tutor -"+ tutorId + " commented to your uploaded work" + "\nFile name: " + fileName + "\n" + "Date: " + uploadDate;
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
</script>
</body>
</html>