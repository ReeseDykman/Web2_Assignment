<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
require_once './includes/songs-helper.php';

$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);

if(isset($_GET['']))

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Assignment 1</title>
        <meta name="author" content="Reese Dykman">
        <meta name="description" content="Song search page">
        <meta name="keywords" content="song, song search, song search page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/global-styles.css" /> 
        <link rel="stylesheet" href="./styles/search.css" />
    </head>

    <body>
        <header> 
            header
        </header>

        <section>

            <h1>Browse / Search Results</h1>
            <h2>Search Criteria</h2>

            <!-- <?=generateSearchList()?> -->
        

        </section>

        <footer> Footer </footer>


    </body>




</html>
