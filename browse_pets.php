
<?php include("database.php"); ?>
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

            <a href="home.html"> <img src="logo.png" alt="logo"></a>
            <div class="date_time"></div>
        </logo>
    </header>
    <div class="main">

        <div class="container">
            <div id="app-sidebar" class="app-sidebar showed">
                <ul>

                    <a href="browse_pets.php" class="selected">
                        <button class="sidebut">
                            <li>

                                <p>
                                    <span class="icon"><i class="fa-solid fa-dog"></i></span>
                                    <span class="title">Browse Pets</span>
                                </p>
                        </button>
                        </li>
                    </a>



                    <a href="find_pup.html">
                        <button class="sidebut">

                            <li refer="about-me">


                                <p>
                                    <span class="icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                                    <span class="title">Find Pup and Puss</span>
                                </p>
                            </li>
                        </button>
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




                    <a href="giveaway.html">

                        <button class="sidebut">

                            <li refer="knowledges">

                                <p>
                                    <span class="icon"><i class="fa-solid fa-gifts"></i></span>
                                    <span class="title">pet giveaway</span>
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
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 0 24 24" width="40px"
                        fill="#000000">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="main-container browse_pets">
            
        <div class="find-pup">
                <h1 class="browse choose">choose the pet you want</h1>

                <p>
                <form action="database.php" method="post" class="choose-pet choose-form">
                    <label for="pet">Choose a pet:</label>
                    <select name="pet" id="pet">
                        <option value="dog">Dog</option>
                        <option value="cat">Cat</option>
                    </select>
                    <div>
                <form action="database.php" method="post" class="choose-pet choose-form">
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
                            <option value="cat">any cat</option>
    
    
    
                            <option value="doesn't matter">doesn't matter</option>
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
                    <label for="gender">prefered gender:</label>
                    <br>
                    <label for="inputs" class="rad-label"> <input class="radio" type="radio" value="female" name="gender" >
                        <span class="text">female</span>
                    </label>
    
                    <label for="inputs" class="rad-label"> <input type="radio" value="male" name="gender"  >
                        <span class="text">male</span>
                        <label for="inputs" class="rad-label"> <input type="radio" value="doesn't matter" name="gender"  >
                            <span class="text">doesn't matter</span>
                        </label>
                        <br>
                        <span id="gender-error" ">Please choose a gender</span>
                        <span id="end-message" ">Thank you for submission</span>
                        
                        
                        needs to go along with other dogs:
                        <br>
                        <label  class="rocker rocker-small" >
                            <input name="friendly" type="checkbox" value="yes">
                            <span class="switch-left" >Yes</span>
                            <span class="switch-right">No</span>
    
                        </label>
                        <br>
                        <div class="submit">
                       
                            <button type="submit"><span class="button_top">Submit</span></button>
                            <button type="reset"><span class="button_top">Reset</span></button>
                        </div>
                      
                </form>
              
                </p>  
            </div>   
            <div class="available-pets">
            <h1>Available Pets</h1>
        
            <ul class="pet-list">
                 <!--
                <li class="pet">

                    <img src="images/labrador.jpg" alt="labrador">
                    <h2>Labrador</h2>
                    <ul>
                        <li class="desc"><strong>Age: 3 years</strong></li>
                        <li class="desc"><strong>Gender: Female</strong></li>
                        <li class="desc"><strong>Suitable for small children</strong></li>
                        <li class="desc"> <strong> Can go along with other cats and dogs</strong></li>
                        <li class="desc"><strong>Description:</strong> A Labrador is a friendly and intelligent breed known for its
                            loyalty and trainability</li>
                    </ul>
                    <button class="interested-button">Interested</button>
                </li>
                <li class="pet">
                    <img src="images/poodle.png" alt="poodle">
                    <h2>Poodle</h2>
                    <ul>
                        <li class="desc"><strong>Age: 2 years</strong> </li>
                        <li class="desc"><strong>Gender: Male</strong> </li>
                        <li class="desc"><strong>Great with kids</strong></li>
                        <li class="desc"> <strong>Gets along well with other dogs</strong></li>
                        <li class="desc"><strong>Description:</strong> A Poodle is a highly intelligent and energetic breed known for
                            their hypoallergenic coat and athleticism.</li>
                    </ul>
                    <button class="interested-button">Interested</button>
                </li>
                <li class="pet">
                    <img src="images/bulldog.jpg" alt="bulldog">
                    <h2>Bulldog</h2>
                    <ul>
                        <li class="desc"><strong>Age: 5 years</strong> </li>
                        <li class="desc"><strong>Gender: Male</strong> </li>
                        <li class="desc"><strong>Not recommended for small children</strong></li>
                        <li class="desc"> <strong>May not get along well with other dogs or cats</strong></li>
                        <li class="desc"><strong>Description:</strong> A Bulldog is a courageous and friendly breed known for its
                            wrinkly
                            face and affectionate personality.</li>
                    </ul>
                    <button class="interested-button">Interested</button>
                </li>
                <li class="pet">
                    <img src="images/golden.jpg" alt="Golden Retriever">
                    <h2>Golden Retriever</h2>
                    <ul>
                        <li class="desc"><strong>Age: 4 years</strong> </li>
                        <li class="desc"><strong>Gender: Female</strong></li>
                        <li class="desc"><strong>Good with kids</strong></li>
                        <li class="desc"> <strong>Gets along well with other dogs and cats</strong></li>
                        <li class="desc"><strong>Description:</strong> A Golden Retriever is a friendly and intelligent breed known
                            for
                            its beautiful golden coat and playful personality.</li>
                    </ul>
                    <button class="interested-button">Interested</button>
                </li>
                <li class="pet">
                    <img src="images/pug.jpg" alt="pug">
                    <h2>Pug</h2>
                    <ul>
                        <li class="desc"><strong>Age: 2 years</strong> </li>
                        <li class="desc"><strong>Gender: Male</strong> </li>
                        <li class="desc"><strong>Not suitable for small children</strong></li>
                        <li class="desc"> <strong> Good with other dogs but not cats</strong></li>
                        <li class="desc"><strong>Description:</strong> A Pug is a playful and affectionate breed known for its
                            wrinkled face and curly tail</li>
                    </ul>
                    <button class="interested-button">Interested</button>
                </li>
            </ul>
            -->
        </div>
       
        
                  
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
?>

</html>
