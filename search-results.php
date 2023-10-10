<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
require_once './includes/songs-helper.php';

$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
$searcher = new songSearcher($connection);

if(isset($_GET['searchBy'])){
    if($_GET['searchBy'] == 'genre'){
            $data = $searcher->genreSearch($_GET['genre']);
    }
    elseif($_GET['searchBy'] == 'title'){
        $data = $searcher->titleSearch($_GET['titleText']);
    }
    elseif($_GET['searchBy'] == 'artist'){
        $data = $searcher->artistSearch($_GET['artist']);
    }
    elseif($_GET['searchBy'] == 'year'){
        if($_GET['year'] == 'less')
            $data = $searcher->lessYearSearch($_GET['lessYearText']);
        else
            $data = $searcher->greaterYearSearch($_GET['greaterYearText']);
    }
}else{
    $criteria = false;
}

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
        <link rel="stylesheet" href="styles\global-styles.css"/> 
    </head>

    <body>
        <header> 
            header
        </header>

        <div class="purple-box">

            <h1>Browse / Search Results</h1>
            <h2>Search Criteria</h2>

            <?=generateSearchList($data)?>
        

        </div>

        <footer> Footer </footer>


    </body>




</html>
