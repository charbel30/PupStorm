<?php


session_start();
file_put_contents('login.txt', "", FILE_APPEND);
if (isset($_POST['submit'])) {


    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];


    //how to create file  login.txt in php

    if ((strlen($password) < 4 || !preg_match('/[a-zA-Z]/', $password)) && (!preg_match('/[0-9]/', $password) && !preg_match('/^[a-zA-Z0-9]+$/', $username))) {
        $error_pass = "";
        $error_pass .= "Invalid password format.";
        $error_user = "";
        $error_user .= "Invalid username format.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        $error_user = "";
        $error_user .= "Invalid username format.";
    } elseif (strlen($password) < 4 || !preg_match('/[a-zA-Z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $error_pass = "";
        $error_pass .= "Invalid password format.";
    } else {
        // Check if the requested username already exists in the login file
        $login_file = file_get_contents('login.txt');
        if (strpos($login_file, $username) !== false) {
            $accountcreated_error = "";
            $accountcreated_error .= "The username $username already exists. Please choose another username.";
        } else {
            // Write the new username/password pair to the login file
            file_put_contents('login.txt', "$username:$password\n", FILE_APPEND);
            $accountcreated = "";
            $accountcreated .= "account creation successful<br>(Hover)";
            unset($_POST['submit']);
            unset($_POST['username']);
            unset($_POST['password']);
           
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="selected.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="other.css">
    <title>Pup Storm</title>
</head>


<body>

    <header>
        <logo>

            <a href="index.html"> <img src="logo.png" alt="logo"></a>
            <div class="date_time"></div>
          
        </logo>
    </header>
    <div class="main">

        <div class="container">
            <div id="app-sidebar" class="app-sidebar showed">
                <ul>

                    <a href="browse_pets.php">
                        <button class="sidebut">
                            <li>

                                <p>
                                    <span class="icon"><i class="fa-solid fa-dog"></i></span>
                                    <span class="title">Browse Pets</span>
                                </p>
                        </button>
                        </li>
                    </a>

                    <a href="care.html">

                        <button refer="projects" class="sidebut">
                            <li>

                                <p>

                                    <span class="icon"><i class="fa-solid fa-shield-dog"></i></span>
                                    <span class="title">dog and cat care</span>
                                </p>
                            </li>
                        </button></a>




                    <a href="giveaway.php">

                        <button class="sidebut">

                            <li refer="knowledges">

                                <p>
                                    <span class="icon"><i class="fa-solid fa-gifts"></i></span>
                                    <span class="title">pet giveaway</span>
                                </p>
                            </li>
                        </button>
                    </a>
                    <a href="createaccount.php" class="selected">
                        <button class="sidebut">

                            <li refer="about-me">


                                <p>
                                    <span class="icon"><i class="fa-solid fa-right-to-bracket"></i></span>
                                    <span class="title">Sign up</span>
                                </p>
                            </li>
                        </button>
                    </a>

                    <a href="contact-us.html">
                        <button class="sidebut">

                            <li refer="contrib">

                                <p>
                                    <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                                    <span class="title">Contact us</span>
                                </p>
                            </li>
                        </button>
                    </a>
                </ul>
                <button id="toggle-sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 0 24 24" width="40px" fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="main-container ">
            <div class="card-container">
                <div class="outer-card">
                    <div class="outer-card2">
                        <form method="post" class="card">
                            <a class="signup">Sign Up</a>
                            <div class="inputBox">
                                <input class="username" type="text" required="required" name="username">
                                <span>Username</span>
                                <div class="popover">
                                    <div class="popover-content username_pop">
                                        <p>Username can contain both upper case and digits </p>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($error_user)) { ?>
                                <div class="popover_error">
                                    <div class="popover-content_error">
                                        <div class="error"><?php echo $error_user; ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="inputBox">
                                <input class="password" type="password" required="required" name="password">
                                <span>Password</span>
                                <div class="popover">
                                    <div class="popover-content  password_pop">
                                        <p>Your password must be at least 4 characters long. <br> include both letters and digits.<br> Make sure it contains at least one of each.</p>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($error_pass)) { ?>
                                <div class="popover_error">
                                    <div class="popover-content_error">
                                        <div class="error"><?php echo $error_pass; ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                            <button class="enter" value="create account" name="submit" type="submit">Enter</button>
                        </form>
                    </div>

                </div>


            </div>

        </div>

        <?php if (isset($accountcreated)) { ?>
                
            <div class="card_account">
           
                <div class="img img1">    </div>
                <div class="img img2"> <p>  <?php echo $accountcreated; ?></p></div>
                <div class="card_account__content">
                    <span class="name"> <?php echo $username; ?></span>

                </div>
            </div>
        <?php }
        if(isset($accountcreated_error)){
            ?>
            <div class="card_account">
           
                <div class="img img1">    </div>
                <div class="img img2"> <p>  <?php echo $accountcreated_error; ?></p></div>
                <div class="card_account__content">
                    <span class="name"> <?php echo " please retry" ?></span>

                </div>
            </div>
        <?php }   ?>
    </div>
    <footer>
        <a href="disclaimer.html">
            <p> © 2023 Pup Storm</p>
        </a>
    </footer>
    <script src="app.js"></script>

</body>


</html>
