<?php
session_start();


require __DIR__ . '/../src/Template.php';
require __DIR__ . '/../src/Conversation.php';
require __DIR__ . '/../src/Message.php';
require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/Alert.php';

function validateConversationAndMessage()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['conversationSubject']) && isset($_POST['conversationText'])) {
            $subject = filter_input(INPUT_POST, 'conversationSubject');
            $text = filter_input(INPUT_POST, 'conversationText');

            $database = Database::getInstance();
            $conn = $database->getConnection();

            // ADD CONVERSATION
            $conversation = new Conversation();
            $conversation->setClientId($_SESSION['userID']);
            $conversation->setSubject($subject);
            $conversation->saveToDB($conn);

            //ADD MESSAGE
            $message = new Message();
            $message->setConversationId($conversation->getId());
            $message->setSenderId($_SESSION['userID']);
            $message->setText($text);
            $message->saveToDB($conn);

            if($message->getId() != null && $conversation->getId() != null) {
                Alert::successAlert("Dodano nową konwersację!");
            } else {
                Alert::dangerAlert('Ups... coś poszło nie tak!');
            }
        } else {
            Alert::dangerAlert('Pole Temat oraz Wiadomość jest wymagane, nastąpi automatyczne przekierowanie!');
            header( "refresh:5;url=../controllers/ClientController.php" );
        }
    }
}

$index = new Template(__DIR__ . '/../templates/index.tpl');
$content = "";

$index->add('content', $content);


echo $index->parse();
validateConversationAndMessage();