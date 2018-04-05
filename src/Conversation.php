<?php

class Conversation
{
    private $id;
    private $clientId;
    private $supportId;
    private $subject;


    public function getId()
    {
        return $this->id;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getSupportId()
    {
        return $this->supportId;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    static public function loadAllConversation(PDO $conn)
    {
        $ret = [];
        $sql = "SELECT * FROM Conversation";
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() > 0) {
            foreach ($result as $row) {
                $loadedConversation = new Conversation();
                $loadedConversation->id = $row['id'];
                $loadedConversation->clientId = $row['clientId'];
                $loadedConversation->supportId = $row['supportId'];
                $loadedConversation->subject = $row['subject'];
                $ret[] = $loadedConversation;
            }
        }
        return $ret;
    }

    static public function loadMySupportConversation(PDO $conn, $id)
    {
        $ret = [];
        $sql = "SELECT * FROM Conversation WHERE supportId=$id";
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() > 0) {
            foreach ($result as $row) {
                $loadedConversation = new Conversation();
                $loadedConversation->id = $row['id'];
                $loadedConversation->clientId = $row['clientId'];
                $loadedConversation->supportId = $row['supportId'];
                $loadedConversation->subject = $row['subject'];
                $ret[] = $loadedConversation;
            }
        }
        return $ret;
    }

    static public function loadOpenSupportConversation(PDO $conn)
    {
        $ret = [];
        $sql = "SELECT * FROM Conversation WHERE supportId is NULL ";
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() > 0) {
            foreach ($result as $row) {
                $loadedConversation = new Conversation();
                $loadedConversation->id = $row['id'];
                $loadedConversation->clientId = $row['clientId'];
                $loadedConversation->supportId = $row['supportId'];
                $loadedConversation->subject = $row['subject'];
                $ret[] = $loadedConversation;
            }
        }
        return $ret;
    }

    public function saveToDB(PDO $conn)
    {
        $sql = 'INSERT INTO Conversation(clientId, subject) VALUES(:clientId, :subject)';
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['clientId' => $this->clientId, 'subject' => $this->subject]);
        if ($result !== false) {
            $this->id = $conn->lastInsertId();
            return true;
        }
        return false;
    }

}