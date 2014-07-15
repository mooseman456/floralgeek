<?php
    include "API.php";
    session_start();

    $contactID = $_POST['contactID'];
    $conversationDate = $_POST['conversationDate'];
    $conversationSP = $_POST['conversationSP'];
    $conversation = $_POST['conversation'];
    $followUp = $_POST['followUp'];
    $interestLvl = $_POST['interestLvl'];
    if (isset($_POST['conversationID']))
        $conversationID =$_POST['conversationID'];
    else
        $conversationID = -1;

    addConversation($contactID, $conversationDate, $conversationSP, $conversation, $followUp, $interestLvl, $conversationID);

?>