<?php
$root = $_SERVER['DOCUMENT_ROOT'];

if(isset($_POST['login'])){
    session_start();
    include_once("$root/components/scripts/server.php");
    include_once("$root/components/scripts/functions.php");

    //Variables to hold response
    $data = array();
    $error = "";

    //Get login data from form
    $email = mysqli_real_escape_string($db, $_POST['loginEmail']);
    $pwd = mysqli_real_escape_string($db, $_POST['loginPassword']);

    //Error handlers
    //Check if inputs are empty
    if(empty($email)){
        $error = "Please enter an email address";
    } elseif(empty($pwd)){
        $error = "Please enter a password";
    } else{
        //Check if user exists
        $result = findUserWithEmail($email);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1){
            $error = "There is no account with that e-mail address";
        } else{
            //Check for correct password
            //Get user
            $userData = mysqli_fetch_assoc($result);
            //Check if user is active
            if($userData['active'] == 0){
                $activationHash = $userData['activationHash'];
                $error = "Please activate your account. 
                <a href='/components/scripts/activate.php?sendActivation=true&email=$email&activationHash=$activationHash'>
                Click here</a> to have the link sent to your email again.";
            } else{
                //De-hashing the password
                $hashedPwdCheck = password_verify($pwd, $userData['pass']);
                if($hashedPwdCheck == false){
                    $error = "The password is incorrect";
                } elseif($hashedPwdCheck == true){
                    //Log in the user here
                    $_SESSION['u_id'] = $userData['id'];
                    $_SESSION['u_firstname'] = $userData['firstname'];
                    $_SESSION['u_lastname'] = $userData['lastname'];
                    $_SESSION['u_phonenumber'] = $userData['telephone'];
                    $_SESSION['u_email'] = $userData['email'];
                    $_SESSION['loggedIn'] = true;
                    $data['success'] = true;
                }
            }
        }
    }
    if(!empty($error)){
        $data['success'] = false;
        $data['error'] = $error;
    }
    echo json_encode($data);
} else{
    //Send user back if they reached accidentally
    header("Location: $root/index.php");
    exit();
}