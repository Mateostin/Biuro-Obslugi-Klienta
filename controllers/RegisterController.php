<?php

require __DIR__ . '/../src/Template.php';
require __DIR__ . '/../src/User.php';
require __DIR__ . '/../src/Database.php';
require __DIR__ . '/../src/Alert.php';

//Tutaj dodaj kod
?>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<?php
function checkRegistration()
{
    if ('POST' === $_SERVER['REQUEST_METHOD']) {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $role = $_POST['role'];
            if (strlen($password) < '8') {
                Alert::dangerAlert('Hasło musi zawierać minimum 8 znaków');
            } elseif (!preg_match("#[0-9]+#", $password)) {
                Alert::dangerAlert('Hasło musi zawierać minimum jedną cyfrę');
            } elseif (!preg_match("#[A-Z]+#", $password)) {
                Alert::dangerAlert('Hasło musi zawierać minimum jedną duzą literę');
            } elseif (!preg_match("#[a-z]+#", $password)) {
                Alert::dangerAlert('Hasło musi zawierać minimum jedną małą literę');
            } else {
                $user = new User();
                $user->setLogin($login);
                $user->setPassword($password);
                $user->setRole($role);
                $database = Database::getInstance();
                $conn = $database->getConnection();
                if (null !== $user->loadUserByLogin($conn, $login)) {
                    Alert::dangerAlert('Nazwa użytkownika jest zajęta');
                } else {
                    $user->saveToDB($conn);
                    header('Location: LoginController.php');
                }
            }
        } else {
            Alert::infoAlert('Wszystkie pola są wymagane!');
        }
    } else {
        Alert::infoAlert('Hasło musi zawierać minimum 8 znaków, jedna cyfre oraz jedna duzą i małą litere');
    }
}


$index = new Template(__DIR__ . '/../templates/index.tpl');

$content = new Template(__DIR__ . '/../templates/register.tpl');

$index->add('content', $content->parse());

echo $index->parse();

checkRegistration();





