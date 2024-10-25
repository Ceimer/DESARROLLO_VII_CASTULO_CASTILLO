<?php

session_start();

//arreglo de usuarios

$users = [
  'usuario1' => '12345',
  'usuario2' => '54321'
];


if ($_SERVER['REQUEST_METHOD']=== 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    if (isset($users[$username]) && $users[$username] === $password) {

        $_SESSION['username'] = $username;
        //arreglo de traeas 
        $_SESSION['tasks'] = [];  
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: index.php?error=1");
        exit();
    }
}
?>

