<?php
    include "API.php";
    session_start();

    $searchCat = $_POST['searchCat'];
    $searchCat2 = $_POST['searchCat2'];
    
    $searchTerm = $_POST['searchTerm'];
    $searchTerm2 = $_POST['searchTerm2'];

    if (isset($_POST['GoL']))
        $GoL = $_POST['GoL'];
    else
        $GoL = "";

    if (isset($_POST['GoL2']))
        $GoL2 = $_POST['GoL2'];
    else
        $GoL2 = "";

    echo loadContacts($searchCat, $searchCat2, $searchTerm, $searchTerm2, $GoL, $GoL2);
?>