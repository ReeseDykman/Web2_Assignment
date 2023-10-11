<?php

    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }

    if (!isset($_SESSION["favourites"])){
        $_SESSION["favourites"] = [];
    }

    $favourites = $_SESSION["favourites"];

    if(isset($_GET["id"])){
        $favourites[] = $_GET["id"];
        $_SESSION["favourites"] = $favourites;
    }
    header("Location: ../favourites.php");
?>