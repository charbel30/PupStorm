<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Q3.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone">
        <br>
        <input type="submit" value="Submit">
    </form>
    
    <?php
    //getting undefined array key error bofore the form is submitted 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = $_POST["name"];
        $phone = $_POST["phone"];
        $pattern = "/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/";
        if(preg_match($pattern, $phone)){
            echo "Hello " . $name . " your phone number is correct";
        }else{
            echo "Hello " . $name . " your phone number is incorrect";
        }
    }
    ?>
    
    
</body>
</html>