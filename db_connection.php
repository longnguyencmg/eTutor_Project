<?php
define ('HOSTNAME', 'localhost');//'mysql.cms.gre.ac.uk');
define ('USERNAME', 'root');//'nd307');
define ('PASSWORD', 'root');//'amahtc6W');
define ('DATABASE_NAME', 'e_tutor');//'mdb_nd307');

$con=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE_NAME);
// Check connection
if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>