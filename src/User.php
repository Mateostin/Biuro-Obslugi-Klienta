<?php

class User
{
    private $id;
    private $login;
    private $hashPass;
    private $role;

    public function __construct()
    {
        $this->id = -1;
        $this->login = '';
        $this->hashPass = '';
        $this->role = 'Client';

        // SETTERY
    }
    public function setLogin($newLogin)
    {
        $this->login = $newLogin;
    }
    public function setPassword($newPassword)
    {
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $this->hashPass = $newHashedPassword;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }

        // GETTERY
    public function getId()
    {
        return $this->id;
    }
    public function getLogin()
    {
        return $this->login;
    }
    public function getPassword()
    {
        return $this->hashPass;
    }
    public function getRole()
    {
        return $this->role;
    }


    public function saveToDB(PDO $conn)
    {
        if ($this->id == -1) {
            $sql = 'INSERT INTO Users(login, hash_pass, role) VALUES(:login, :pass, :role)';
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(['login' => $this->login, 'pass' => $this->hashPass, 'role' => $this->role]);
            if ($result !== false) {
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $stmt = $conn->prepare('UPDATE Users SET login=:login, hash_pass=:hash_pass, role=:role WHERE  id=:id ');
            $result = $stmt->execute(['login' => $this->login, 'hash_pass' => $this->hashPass, 'id' => $this->id, 'role' => $this->role]);
            if ($result === true) {
                return true;
            }
        }
        return false;
    }
    static public function loadUserById(PDO $conn, $id)
    {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE id=:id');
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->login = $row['login'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->role = $row['role'];
            return $loadedUser;
        }
        return null;
    }
    static public function loadUserByLogin(PDO $conn, $login)
    {
        $stmt = $conn->prepare('SELECT * FROM Users WHERE login=:login');
        $result = $stmt->execute(['login' => $login]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->login = $row['login'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->role = $row['role'];
            return $loadedUser;
        }
        return null;
    }
    public function delete(PDO $conn)
    {
        if ($this->id != -1) {
            $stmt = $conn->prepare('DELETE FROM Users WHERE id=:id');
            $result = $stmt->execute(['id' => $this->id]);
            if ($result === true) {
                return true;
            }
            return false;
        }
        return true;
    }
    static public function login(PDO $conn, $login, $passFromUser)
    {
        $user = User::loadUserByLogin($conn, $login);
        if ($user !== null && password_verify($passFromUser, $user->getPassword()) == $passFromUser) {
            return $user;
        } else {
            return false;
        }
    }
    static public function passVerification(PDO $conn, $id, $passFromUser)
    {
        $user = User::loadUserById($conn, $id);
        if ($user !== null && password_verify($passFromUser, $user->getPassword()) == $passFromUser) {
            return $user;
        } else {
            return false;
        }
    }
}