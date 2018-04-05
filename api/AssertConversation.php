<?php

$conn=mysqli_connect("localhost","root","coderslab","bok");
// Check connection
if (mysqli_connect_errno())
{
    echo "Nie mozna połączyć z baza danych: " . mysqli_connect_error();
}
$conversationId = $_POST['id'];
$supportId = $_POST['supportId'];

$query = "UPDATE Conversation SET supportId = $supportId WHERE id = $conversationId";
$result = mysqli_query($conn, $query) or die(mysqli_query());

echo "refresh";
