<?php
session_start();
file_put_contents('availablepetinformation.txt', "", FILE_APPEND);


if (isset($_POST['submit'])) {

    // Get the entered username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the entered username and password satisfy the format criteria
    if (preg_match('/^[a-zA-Z0-9]+$/', $username) && strlen($password) >= 4 && preg_match('/[a-zA-Z]/', $password) && preg_match('/[0-9]/', $password)) {
        // Check if the login/password pair exists in the login file
        $login_file = file_get_contents('login.txt');
        if (strpos($login_file, "$username:$password") !== false) {
            // Start a new session and load the form for creating a new pet entry
            $_SESSION['username'] = $username;

            header('Location: ' . $_SERVER['REQUEST_URI']);

            exit;
        } else {
            // Send back a message saying that the login failed
            echo "login failed";
            $login_error = "no account found";
        }
    }
}
if (isset($_SESSION['username'])) {
    if (isset($_POST['submitgiveaway'])) {

        // Get the submitted form data
        $type = $_POST['pet'];
        $breed = $_POST['breed'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $friendly = isset($_POST['friendly']) ? $_POST['friendly'] : "No";
        $childFriendly = isset($_POST['childFriendly']) ? $_POST['childFriendly'] : "No";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];

        // Validate the email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // The email address is invalid
            $email_error = "Invalid email address. Please enter a valid email address.";
        } else {
            // The email address is valid
            // Create an array to store the pet information
            $pet = [
                'type' => $type,
                'breed' => $breed,
                'age' => $age,
                'gender' => $gender,
                'friendly' => $friendly,
                'childFriendly' => $childFriendly,
                'name' => $name,
                'email' => $email,
                'comment' => $comment
            ];
            $username = $_SESSION['username'];
            $pet =  "";
            $pet_content = file_get_contents('availablepetinformation.txt');
            $pet_count = substr_count($pet_content, "\n");
            $pet_id = $pet_count + 1;
            $pet = "$pet_id:$username:$type:$breed:$age:$gender:$friendly:$childFriendly:$name:$email:$comment\n";
            file_put_contents('availablepetinformation.txt', $pet, FILE_APPEND);
        }
    }
}

// Set the session time limit (in seconds)
$session_time_limit = 3600 * 12;

// Check if the last activity time is set
if (isset($_SESSION['last_activity'])) {
    // Calculate the time since the last activity
    $time_since_last_activity = time() - $_SESSION['last_activity'];

    // Check if the time limit has been exceeded
    if ($time_since_last_activity > $session_time_limit) {
        // Destroy the session data
        session_destroy();

        // Reload the page to update the displayed content
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit;
    }
}

// Update the last activity time
$_SESSION['last_activity'] = time();

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
            <?php if (isset($_SESSION['username'])) { ?>
                <button class="btn log-out" onclick="logout_confirm();" value="logout">Log Out</button>
            <?php } ?>
            <a href="home.html"> <img src="logo.png" alt="logo"></a>
            <div class="date_time"></div>

        </logo>
    </header>
    <div class="main">

        <div class="container ">
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




                    <a href="giveaway.php" class="selected">
                        <button class="sidebut">

                            <li refer="knowledges">

                                <p>
                                    <span class="icon"><i class="fa-solid fa-gifts"></i></span>
                                    <span class="title">pet giveaway</span>
                                </p>
                            </li>
                        </button>
                    </a>
                    <a href="createaccount.php">
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
        <div class="main-container giveaway">
            <div class="card-container">
                <div class="outer-card">
                    <div class="outer-card2">
                        <form method="post" id="login-form" class=" card">
                            <a class="signup">Log In</a>
                            <div class="inputBox">
                                <input class="username" type="text" required="required" name="username">
                                <span>Username</span>
                                <div class="popover">
                                    <div class="popover-content username_pop">
                                        <p>Username can contain both upper case and digits </p>
                                    </div>
                                </div>
                            </div>
                            <div class="popover_error" id="username-error">
                                <div class="popover-content_error" style="display: none;">
                                    <div class="error"></div>
                                </div>
                            </div>

                            <div class="inputBox">
                                <input class="password" type="password" required="required" name="password">
                                <span>Password</span>
                                <div class="popover">
                                    <div class="popover-content  password_pop">
                                        <p>Your password must be at least 4 characters long. <br> include both letters and digits.<br> Make sure it contains at least one of each.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="popover_error" id="password-error" style="display: none;">
                                <div class="popover-content_error">
                                    <div class="error"></div>
                                </div>
                            </div>
                            <div>
                                <?php if (isset($login_error)) { ?>
                                    <div class="loginerror"><?php echo $login_error; ?></div>
                                    <button class="enter_create" value="create account" name="submit" type="submit"><a href='createaccount.php'>create account</a></button>
                                <?php } ?>
                                <button class="enter" value="create account" name="submit" type="submit">Enter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <?php if (isset($_SESSION['username'])) {
            echo "<style>.card-container { display: none; }</style>"; ?>
            <?php if (isset($pet_id)) {
                echo "<style>.giveaway-form { display: none; }</style>";
                echo "<style>#end-message { display: flex; }</style>";
            } ?>
            <div class="giveaway-form">
                <h1 class="browse choose  donates">Donate pet</h1>


                <form method="post" class="donate-form choose-pet choose-form" id="form_submit_giveaway">
                    <label for="pet">Choose a pet:</label>
                    <select name="pet" id="pet">
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                    </select>
                    <div>
                        <label for="breed">Choose a breed:</label>
                        <select name="breed" id="breed">
                            <option value="labrador">Labrador</option>
                            <option value="poodle">Poodle</option>
                            <option value="bulldog">Bulldog</option>
                            <option value="beagle">Beagle</option>
                            <option value="german-shepherd">German Shepherd</option>
                            <option value="golden-retriever">Golden Retriever</option>
                            <option value="french-bulldog">French Bulldog</option>
                            <option value="husky">Husky</option>
                            <option value="boxer">Boxer</option>
                            <option value="pug">Pug</option>
                            <option value="rottweiler">Rottweiler</option>
                            <option value="chihuahua">Chihuahua</option>
                            <option value="doberman">Doberman</option>
                            <option value="cat">cat</option>



                            <option value="doesn't matter">mixed</option>
                        </select>
                    </div>
                    <label for="age">Choose an age:</label>
                    <select name="age" id="age">
                        <option value="puppy">Puppy</option>
                        <option value="young">Young</option>
                        <option value="adult">Adult</option>
                        <option value="senior">Senior</option>
                        <option value="doesn't matter">doesn't matter</option>
                    </select>
                    <br>
                    <label for="gender">gender:</label>

                    <label for="inputs"> <input class="radio" type="radio" value="female" name="gender" required>
                        <span class="text">female</span>
                    </label>

                    <label for="inputs"> <input type="radio" value="male" name="gender" required>
                        <span class="text">male</span>
                    </label>
                    <br>

                    can go along with other dogs and cats:
                    <br>
                    <label class=" rocker rocker-small">
                        <input name="friendly" type="checkbox" value="yes">
                        <span class="switch-left">Yes</span>
                        <span class="switch-right">No</span>

                    </label>
                    <br>
                    suitable for small Children:
                    <br>
                    <label class="rocker rocker-small">
                        <input name="childFriendly" type="checkbox" value="yes">
                        <span class="switch-left">Yes</span>
                        <span class="switch-right">No</span>
                    </label>
                    <div class="form-control">
                        <input name="name" type="value" required="">
                        <label>
                            <span style="transition-delay:0ms">G</span><span style="transition-delay:50ms">i</span><span style="transition-delay:100ms">v</span><span style="transition-delay:150ms">e</span><span style="transition-delay:200ms">n
                                &nbsp</span><span style="transition-delay:250ms">n</span><span style="transition-delay:300ms">a</span><span style="transition-delay:350ms">m</span><span style="transition-delay:400ms">e</span>
                        </label>

                    </div>
                    <div class="form-control">
                        <input name="email" type="value" required="">
                        <label>
                            <span style="transition-delay:0ms">E</span><span style="transition-delay:50ms">m</span><span style="transition-delay:100ms">a</span><span style="transition-delay:150ms">i</span><span style="transition-delay:200ms">l </span>
                        </label>
                        <span id="email-error">not a valid mail</span>
                    </div>
                    <div class="form-control">
                        <input name="comment" type="value">
                        <label>
                            <span style="transition-delay:0ms">C</span><span style="transition-delay:50ms">o</span><span style="transition-delay:100ms">m</span><span style="transition-delay:150ms">m</span><span style="transition-delay:200ms">e</span><span style="transition-delay:250ms">n</span><span style="transition-delay:350ms">t</span>
                        </label>
                    </div>
                    <div class="submit">
                        <button type="submit" name="submitgiveaway" value="submit"><span class="button_top">Submit</span></button>
                        <button type="reset"><span class="button_top">Reset</span></button>
                    </div>

                </form>


            </div>
            <span id="end-message">Thank you for submission</span>
        <?php } ?>
    </div>
    </div>
    </div>
    <footer>
        <a href="disclaimer.html">
            <p> © 2023 Pup Storm</p>
        </a>
    </footer>
    <script src="app.js"></script>

</body>

</html>