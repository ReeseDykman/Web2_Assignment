<?php

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}

    $favourites = $_SESSION["favourites"];
    $remove = $_GET['id'];

    if($remove == "all"){
        $favourites = [];
    }else{
        $position = array_search($remove,$favourites);
        unset($favourites[$position]);
        $favourites = array_values($favourites);
    }

    $_SESSION["favourites"] = $favourites;

    header("Location: ../favourites.php");

?>