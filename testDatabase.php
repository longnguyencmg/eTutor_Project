<?php
define ('HOSTNAME', 'localhost');//'mysql.cms.gre.ac.uk');
define ('USERNAME', 'root');//'nd307');
define ('PASSWORD', 'root');//'amahtc6W');
define ('DATABASE_NAME', 'e_tutor');//'mdb_nd307');

$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE_NAME);
// Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql_query = "SELECT * FROM cms_student";

$result = mysqli_query($con,$sql_query);

while($row = mysqli_fetch_array($result))
{
    echo $row['student_id'] . "-" . $row['username'] . "-" . $row['password'] . "-
  " . $row['firstname'] . "-" . $row['surname'] . "-" . $row['dob'] . "-" . $row['email'] . "-" . $row['address'] . "-" . $row['isHomeStudent'];
    echo "<br>";
}

mysqli_close($con);
?>;
