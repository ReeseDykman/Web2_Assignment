<?php
require_once './includes/db-connection-classes.inc.php';
require_once './includes/config.inc.php';
require_once './includes/songs-helper.php';

$db = new database();
$connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
$searcher = new homeSearcher($connection);

$topGenres = $searcher->getTopGenres();
$topArtists = $searcher->getTopArtists();
$mostPopular = $searcher->getTopSongs();
$oneHitWonders = $searcher->getOneHitWonders();
$longestAcoustic = $searcher->getAcoustic();
$club = $searcher->getClub();
$runningSongs = $searcher->getRunning();
$studySongs = $searcher->getStudying();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Assignment 1</title>
        <meta name="author" content="Reese Dykman">
        <meta name="description" content="Single song page">
        <meta name="keywords" content="song, song info, song info home page">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/home.css" /> 
        <link rel="stylesheet" href="./styles/global-styles.css" /> 
    </head>

    <body>
        <header> 
            <?=generateHeader();?>
        </header>

        <div class=info>
            <h1 class= center>Home Page</h1>
            <h2 class= center>COMP 3521 ASSIGN1 BY REESE DYKMAN</h2>
            <h3 class= center>https:// github.com/ReeseDykman /Web2_Assignment</h3>
        </div>

        <section class=black-box>
            <?=GenerateHomeList("Top Genres", $topGenres)?>
            <?=GenerateHomeList("Top Artists", $topArtists)?>
            <?=GenerateHomeList("Most Popular", $mostPopular)?>
            <?=GenerateHomeList("One Hit Wonders", $oneHitWonders)?>
            <?=GenerateHomeList("Longest Acoustics", $longestAcoustic)?>
            <?=GenerateHomeList("At the Club", $club)?>
            <?=GenerateHomeList("Running Songs", $runningSongs)?>
            <?=GenerateHomeList("Studying", $studySongs)?>

        </section>
        

        <footer><?=generateFooter()?></footer>
    </body>

</html>