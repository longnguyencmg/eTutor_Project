
<?php  session_start(); ?>
<?php
    include '../db_connection.php';
    if(!isset($_SESSION['id'])){
        echo '<script type="text/javascript"> window.open("../login.php","_self");</script>';
    }

    $id = $_SESSION['id'];
    $tutorId = $_SESSION['tutor'];
    $sql_query_blog = "SELECT * FROM cms_message WHERE type_id = '1' and student_id = '$id'";

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
        .button{
            width: 220px;
            height: 60px;
            font-size: 16px;
            display: inherit;
        }

        #addRequestMeeting{
            height: 250px;
            width: 403px;
            background-image: url("../css/images/userBoxAdd.png");
            position: absolute;
            display: none;
        }

        #tblAddRequest{
            font-size: 15px;
            width: 350px;
            margin-left: 20px;
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
                <li><a href="#blog" id="blog-link" class="skel-panels-ignoreHref active"><span
                            class="fa fa-pencil-square">Blog</span></a></li>
                <li><a href="upload_student.php" id="upload-link" class="skel-panels-ignoreHref"><span
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
    <section id="blog" class="one">

        <div class="container">
            <a href="http://www.gre.ac.uk/‎" class="image featured"><img src="../images/greenwich_uni.jpg" alt=""/></a>
            <input type="text" id="txtTutorId" value="<?php echo $tutorId ?>" style="display: none;">
            <input type="text" id="txtStudentId" value="<?php echo $id ?>" style="display: none;">
            <div><a id="makeBlog" class="button">Add Blog</a></div>
            <table id="mytable" class="tablesorter">
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
                while($row = mysqli_fetch_array($result_blog))
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

            <div id="addRequestMeeting">
                <table id="tblAddRequest">
                    <tbody>
                    <tr>
                        <td style="color: #659492">Title</td>
                        <td><input type="text" id="txtAgenda" value="Title"></td>
                    </tr>
                    <tr>
                        <td style="color: #659492">Content</td>
                        <td><textarea rows="4" id="txtContent">Blog</textarea></td>
                    </tr>
                    </tbody>
                </table>
                <a id="btnAdd" class="button">Add</a>
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
<script>
    $(document).ready(function() {
        $("#mytable").tablesorter({theme:'ice',widthFixed: false, sortList:[[0,0]], widgets: ['zebra']});
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
        // add two rows
        var objId = 1;
        var objTitle = $("#txtAgenda").val();
        var objContent = $("#txtContent").val();
        var objDate = currentDate;
        var objStudentId = $("#txtStudentId").val();
        var objTutor = $("#txtTutorId").val();
        var objTypeId = 1;

        var row = '<tr><td>'+objId+'</td><td>'+objTitle+'</td><td>'+objContent+'</td><td>'+objDate+'</td><td>'+objStudentId+'</td><td>'+objTutor+'</td><td>'+objTypeId+'</td></tr>',
            $row = $(row),
        // resort table using the current sort; set to false to prevent resort, otherwise
        // any other value in resort will automatically trigger the table resort.
            resort = true;
        $("#mytable")
            .find('tbody').append($row)
            .trigger('addRows', [$row, resort]);

        count ++;
        addBlog(objId, objTitle, objContent, objDate, objStudentId, objTutor, objTypeId);
        $("#addRequestMeeting").slideUp("slow",
            function() {
                isShowAddRequest = false;
            });
        return false;
    });

    $("#makeBlog").click(
        function() {
            id = this.id;
            setAddformPosition(id);
            if (!isShowAddRequest) {
                $("#addRequestMeeting").slideDown("slow",
                    function() {
                        isShowAddRequest = true;
                    });
            } else {
                $("#addRequestMeeting").slideUp("fast",
                    function() {
                        isShowAddRequest = false;
                    });
            }
        });

    function setAddformPosition(ele) {
        var pos = $("#" + ele).position();
        $("#addRequestMeeting").css({
            position : "absolute",
            top : pos.top + 60 + "px"
        });
    }

    $("#txtAgenda").focus(function(){
        $('#txtAgenda').val("");
    });
    $("#txtContent").focus(function(){
        $('#txtContent').text("");
    });

    $("#btnCancel").click(function(){
        $("#addRequestMeeting").slideUp("fast",
            function() {
                isShowAddRequest = false;
            });
    });

    function addBlog(id, title, content, date, studentId, tutorId, typeId)
    {
        var xhr;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else if (window.ActiveXObject) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
        var data = "id=" + id + "&title=" + title + "&content=" + content + "&date=" + date + "&studentId=" + studentId + "&tutorId=" + tutorId + "&typeId=" + typeId;
        xhr.open("POST", "../handler/AddMeetingRequest.php", true);
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