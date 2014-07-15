<?php
    include "API.php";
    session_start();

    $contactID = $_GET['contactID'];
    echo loadConversations($contactID);
?>