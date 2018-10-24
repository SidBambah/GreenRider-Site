<?php
$root = $_SERVER['DOCUMENT_ROOT'];

if(isset($_POST['register'])){
    session_start();
    include_once("$root/components/scripts/server.php");
    include_once("$root/components/scripts/functions.php");
    
    //Variables for response to JavaScript Handler
    $data = array();
    $error = "";

    //Get all of the data from the form
    $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);

    //Error Handlers
    //Check if for empty fields
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password)
    || empty($password2) || empty($phonenumber)){
        $error = "Please fill all fields!";
    } else{
        //Check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $firstname) || !preg_match("/^[a-zA-Z]*$/", $lastname) ){
            $error = "Please enter letters only for name fields";
        } else{
            //Check if phone number is valid
            $phoneNum = validatePhone($phonenumber);
            if(empty($phoneNum)){
                $error = "Phone number is invalid. Please enter 10 digits only";
            } else{
                //Check if email is valid
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $error = "The email address entered is invalid";
                } else{
                    //Check if email is taken
                    $sql = "SELECT * FROM users WHERE email='$email'";
                    $result = mysqli_query($db, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if($resultCheck > 0){
                        $error = "An account with this email address already exists";
                    } else{
                        //Check if passwords are the same
                        if($password != $password2){
                            $error = "The passwords do not match";
                        } else{
                            //Hashing the passwords
                            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                            //Creating an account verification hash
                            $activationHash = sha1($email . 'dopeHash');
                            //Send activation email and check if email is valid
                            if(!sendActivationMail($email, $activationHash)){
                                $error = "There was an error sending the activation email.
                                Please try again with a valid address";
                            } else{
                                //Insert the user into the database
                                $sql = "INSERT INTO users (email, pass, firstname, lastname, telephone, activationHash) VALUES ('$email', '$hashedPwd',
                                '$firstname', '$lastname', '$phoneNum', '$activationHash')";
                                mysqli_query($db, $sql);
                                sendWelcomeMail($email, $firstname);
                                $data['success'] = true;
                            }
                        }
                    }
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
    //If the user reached accidentally, send back
    header("Location: $root/index.php");
    exit();
}