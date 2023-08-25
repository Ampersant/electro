<?php 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/electro/services/user-service/users.php';

    if (isset($_POST)) {
       $email = $_POST['email'];
        $pass = $_POST['password'];
        
        $user = get_user_by_email($email);
        if (password_verify($pass, $user[0]['password_hash'])) {
            
            if (isset($_POST['remember_me'])) {
                session_start();
                setcookie('auth', true, time() + (86400 * 30), "/");
                $_SESSION['is_admin'] = $user[0]['is_admin'];
            header("Location: ../../index.php");

                
            }else {
                session_start();
                $_SESSION['auth'] = true;
                $_SESSION['is_admin'] = $user[0]['is_admin'];
            header("Location: ../../index.php");

            }
            
        }else{
            header("Location: ../../login.php");
            exit;
        }
    }