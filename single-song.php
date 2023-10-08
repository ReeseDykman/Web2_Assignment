<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
$songs = $db->dbquery($connection,"SELECT * FROM songs WHERE song_id = ?","1001");
$data = $songs->fetchAll();
echo $data[0]["title"];
?>
