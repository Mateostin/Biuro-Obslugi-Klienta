<?php
session_start();

require __DIR__ . '/../src/Template.php';
require __DIR__ . '/../src/Conversation.php';
require __DIR__ . '/../src/Message.php';
require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/User.php';

$database = Database::getInstance();
$conn = $database->getConnection();

if (!isset($_SESSION['userID']) || empty($_SESSION['userID'])) {
    header('Location: LoginController.php');
}

//Tutaj dodaj kod

// <<-- Loading Support Conversations -->>
$modelsConversations = Conversation::loadMySupportConversation($conn, $_SESSION['userID']);

if($modelsConversations) {
    foreach ($modelsConversations as $model) {
        $row = new Template(__DIR__ . '/../templates/support_conversation.tpl');
        $row->add('conversationSubject', $model->getSubject());
        $row->add('idConversation', $model->getId());
        $rowsTemplate[] = $row;
    }
    $rowsContent = Template::joinTemplates($rowsTemplate);
    $conversation = new Template(__DIR__ . '/../templates/support_conversation.tpl');
    $conversation->add('conversationSubject', $rowsContent);
} else {
    $conversation = new Template(__DIR__ . '/../templates/support_conversation.tpl');
    $conversation->add('conversationSubject', 'Brak Konwersacji!');
    $conversation->add('idConversation', 'NULL');
}

// <<-- Loading Open Support Conversations -->>
$modelsConversations = Conversation::loadOpenSupportConversation($conn);

if($modelsConversations) {
    foreach ($modelsConversations as $model) {
        $rowOpen = new Template(__DIR__ . '/../templates/open_conversation.tpl');
        $rowOpen->add('conversationSubject', $model->getSubject());
        $rowOpen->add('idConversation', $model->getId());
        $rowOpen->add('supportId', $_SESSION['userID']);
        $rowsTemplateOpen[] = $rowOpen;
    }
    $rowsContentOpen = Template::joinTemplates($rowsTemplateOpen);
    $conversationOpen = new Template(__DIR__ . '/../templates/open_conversation.tpl');
    $conversationOpen->add('conversationSubject', $rowsContentOpen);
} else {
    $conversationOpen = new Template(__DIR__ . '/../templates/open_conversation.tpl');
    $conversationOpen->add('conversationSubject', '');
}

// << -- Loading messages -->>

if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $conversationId = $_GET['id'];
// <<-- Loading Custom (newest)Message -->>
    $modelsMessages = Message::loadMessageByConversationId($conn, $conversationId);

    foreach ($modelsMessages as $model) {
        $row = new Template(__DIR__ . '/../templates/message.tpl');
        $row->add('messageSender', User::loadUserById($conn, $model->getSenderId())->getLogin());
        $row->add('messageText', $model->getText());
        $rowsTemplateMessage[] = $row;
    }
    $rowsContentMessages = Template::joinTemplates($rowsTemplateMessage);
    $messages = new Template(__DIR__ . '/../templates/message.tpl');
    $messages->add('messageSender', $rowsContentMessages);
    $messages->add('messageText', ' ');
} else {
    $conversationId = null;
    $messages = new Template(__DIR__ . '/../templates/message.tpl');
    $messages->add('messageSender', '');
    $messages->add('messageText', 'Proszę Wybrać Konwersację');

}

$index = new Template(__DIR__ . '/../templates/index.tpl');

$content = new Template(__DIR__ . '/../templates/support_content.tpl');

$content->add('conversations', $conversation->parse());
$content->add('openConversations', $conversationOpen->parse());
$content->add('messages', $messages->parse());
$content->add('conversationID', $conversationId);
$index->add('content', $content->parse());

echo $index->parse();



