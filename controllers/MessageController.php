<?php
session_start();


require __DIR__ . '/../src/Template.php';
require __DIR__ . '/../src/Conversation.php';
require __DIR__ . '/../src/Message.php';
require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/Alert.php';

function validateMessage()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['conversationId']) && isset($_POST['conversationReply'])) {
            $conversationId = filter_input(INPUT_POST, 'conversationId');
            $text = filter_input(INPUT_POST, 'conversationReply');

            $database = Database::getInstance();
            $conn = $database->getConnection();

            //ADD Reply
            $message = new Message();
            $message->setConversationId($conversationId);
            $message->setSenderId($_SESSION['userID']);
            $message->setText($text);
            $message->saveToDB($conn);

            if($message->getId() != null) {
                Alert::successAlert("Dodano nową wiadomość!");
            } else {
                Alert::dangerAlert('Ups... coś poszło nie tak!');
            }
        } else {
            Alert::dangerAlert('Pole Wiadomość jest wymagane, nastąpi automatyczne przekierowanie!');
            header( "refresh:5;url=../controllers/ClientController.php" );
        }
    }
}

$index = new Template(__DIR__ . '/../templates/index.tpl');
$content = "";

$index->add('content', $content);


echo $index->parse();
validateMessage();