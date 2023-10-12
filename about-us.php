<?php
require_once './includes/songs-helper.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Assignment 1</title>
        <meta name="author" content="Reese Dykman">
        <meta name="description" content="About us page">
        <meta name="keywords" content="Aboutus, about the author, song info website">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./styles/about-us.css" /> 
        <link rel="stylesheet" href="./styles/global-styles.css" /> 
    </head>

    <body>
        <header> 
            <?=generateHeader();?>
        </header>



        <div class="black-box">
            <div class=purple-box>
                <section id = "songInfoContainer">
                    <h1>Hello there!</h1>
                    <p>My name is Reese Dykman and i made this website as an assignment
                        for the Web Application Development class at Mount Royal University.
                    </p>
            </div>
            <div class=purple-box>
                <h1>Web2 Assignment 1</h1>
                <p>This assignment was to demonstrate using PHP 
                    to generate a data-based website. You can find the github repo
                    <a href=https://github.com/ReeseDykman/Web2_Assignment>Here</a>
                </p>
            </div>
        </div>
    </body>

    <footer><?=generateFooter()?></footer>



</html>