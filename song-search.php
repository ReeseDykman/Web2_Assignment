<?php 
    require_once './includes/songs-helper.php';
    require_once './includes/db-connection-classes.inc.php';
    require_once './includes/config.inc.php'; 

    $db = new database();
    $connection = $db->createConnection(DBCONNSTRING, DBUSER, DBPASS);
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
            <div class= "purple-box">
                <h1>Song Search</h1>
                <form method="get" action="search-results.php">
                    <fieldset>
                        <div id ="titleDiv">
                            <input type="radio" id="titleRadio" name="searchBy" value="title" required>
                            <label for="titleTxt">Title:</label>
                            <input type="text" name="titleText" placeholder="Enter Title" id="titleTxt">
                        </div>
                        <div id="artistGenreDiv">
                            <input type="radio" id="artistRadio" name="searchBy" value="artist" required>
                            <label for="artist">Artist:</label>
                            <select name="artist">
                                <option value="" disabled selected>Select Artist </option>
                                <?=generateArtistOptions($connection, $db)?>
                            </select>
            
                            <input type="radio" id="genreRadio" name="searchBy" value="genre" required>
                            <label for="genre">Genre:</label>
                            <select name="genre">
                                <option value="" disabled selected>Select Genre </option>
                                <?=generateGenreOptions($connection, $db)?>
                            </select>
                        </div>
                            <div id= "yearDiv">
                            <input type="radio" id="yearRadio" name="searchBy" value="year" required>
                            <label for="genre">Year:</label>

                            <input type="radio" id="lessYearRadio" name="year" value="less">
                            <label for="lessYearRadio">Less</label>
                            <input type="number" name="lessYearText" placeholder="YearL" id="lessYearTxt" maxlength=4 minlength=4 max=2020>

                            <input type="radio" id="greaterYearRadio" name="year" value="greater">
                            <label for="greaterYearRadio">Greater</label>
                            <input type="number" name="greaterYearText" placeholder="YearG" id="greaterYearTxt" maxlength=4 minlength=4 min=2015>
                        </div>
                        <button type="submit" id="submit">Search </button>

                    </fieldset>
                </form>
            <div>
        </section>

        <footer> Footer </footer>


    </body>




</html>