<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
require_once './includes/songs-helper.php';

$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
$searcher = new songSearcher($connection);
$searchCriteria = "Search criteria: " ;

if(isset($_GET['searchBy'])){
    $searchCriteria .= "Search by " . $_GET['searchBy'];

    if($_GET['searchBy'] == 'genre'){
            if(isset($_GET['genre'])){
                $data = $searcher->genreSearch($_GET['genre']);
                $searchCriteria .= " : " . $searcher->getGenreName($_GET['genre']) . ".";
            }else{
                $searchCriteria .= " : No genre selected, showing all.";
                $data = $searcher->orderByGenre();
            }
    }
    elseif($_GET['searchBy'] == 'title'){
        if($_GET['titleText'] != "" && isset($_GET['titleText'])){
            $data = $searcher->titleSearch($_GET['titleText']);
            $searchCriteria .= " : " .$_GET['titleText'];
        }else{
            $searchCriteria .= " : No title selected, showing all.";
            $data = $searcher->orderByTitle();
        }
    }
    elseif($_GET['searchBy'] == 'artist'){
        if(isset($_GET['artist'])){
            $data = $searcher->artistSearch($_GET['artist']);
            $searchCriteria .= " : " . $searcher->getArtistName($_GET['artist']) . ".";
        }else{
            $searchCriteria .= " : No artist selected, showing all.";
            $data = $searcher->orderByArtist();
        }
    }
    elseif($_GET['searchBy'] == 'year'){
        if(isset($_GET['year']) && (!empty($_GET['lessYearText']) || !empty($_GET['greaterYearText']))){
            if($_GET['year'] == 'less'){
                $searchCriteria .= " : Less than " . $_GET['lessYearText'] . ".";
                $data = $searcher->lessYearSearch($_GET['lessYearText']);
            }elseif($_GET['year'] == 'greater'){
                $searchCriteria .= " : Greater than " . $_GET['greaterYearText'] . ".";
                $data = $searcher->greaterYearSearch($_GET['greaterYearText']);
            }
        }else{
            $data = $searcher->orderByYear();
            $searchCriteria .= " : Failed to select or fill less/greater options, showing all.";
        }
    }
}else{
    $searchCriteria = "Browse Mode";
    $data = $searcher->orderByArtist();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Assignment 1</title>
        <meta name="author" content="Reese Dykman">
        <meta name="description" content="Song search page">
        <meta name="keywords" content="song, song search, song search results page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles\global-styles.css"/> 
        <link rel="stylesheet" href="styles\results.css"/>
    </head>

    <body>
        <header> 
            <?=generateHeader();?>
        </header>

        <div class="purple-box">
            <div id = 'top'>
                <h1>Browse / Search Results</h1>
                <a href= "search-results.php" class="abutton">Clear Search</a>
            </div>

            <h2><?=$searchCriteria?></h2>

            <div class="table-wrapper">
                <table>
                    <?=generateSearchTable($data)?>
                </table>
            </div>
    
        </div>

        <footer><?=generateFooter()?></footer>


    </body>
</html>
