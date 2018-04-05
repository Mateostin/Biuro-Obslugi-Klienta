<?php
session_start();
require __DIR__ . '/../src/Template.php';
require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/User.php';
require __DIR__ . '/../src/Alert.php';

//Tutaj dodaj kod
function checkLogin()
{
    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        if (isset($_GET['action']) == "logout") {
            unset($_SESSION['userID']);
        }
    }

    if (isset($_SESSION['userID'])) {
        if ($_SESSION['userRole'] == "Client") {
            header("Location: ClientController.php");
        } else {
            header("Location: SupportController.php");
        }
    } else {
        if ('POST' === $_SERVER['REQUEST_METHOD']) {
            if (isset($_POST['login']) && isset($_POST['password'])) {

                $database = Database::getInstance();
                $conn = $database->getConnection();

                $login = filter_input(INPUT_POST, 'login');
                $password = filter_input(INPUT_POST, 'password');
                $user = User::loadUserByLogin($conn, $login);
                if (isset($user) && password_verify($password, $user->getPassword())) {
                    $_SESSION['userID'] = $user->getId();
                    $_SESSION['userLogin'] = $user->getLogin();
                    $_SESSION['userRole'] = $user->getRole();

                    if ($_SESSION['userRole'] == "Client") {
                        header("Location: ClientController.php");
                    } else {
                        header("Location: SupportController.php");
                    }
                } else {
                    Alert::dangerAlert('Błędny Login lub Hasło!');
                }
            }
        }
    }
}

$index = new Template(__DIR__ . '/../templates/index.tpl');

$content = new Template(__DIR__ . '/../templates/login.tpl');

$index->add('content', $content->parse());

echo $index->parse();

checkLogin();