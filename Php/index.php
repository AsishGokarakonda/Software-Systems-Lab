<?php require 'login.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Album Login</title>
    <style>
        body {
            background-color: black;
            color: white;
            background-image: url('http://getwallpapers.com/wallpaper/full/a/5/d/544750.jpg');
            font-family: 'Numans', sans-serif;
            font-size: 19px;
        }

        header {
            padding: 1px;
            color: yellow;
        }

        .container {
            text-align: center;
            border: 4px solid red;
            width: 24%;
            margin: auto;
            border-radius: 25px;
        }

        .inputs {
            padding: 10px 10px;
            margin: 29px 10px;
        }

        .button {
            padding: 10px 20px;
            margin: 14px;
            margin-left: 70%;
            width: 25%;
            text-align: center;
        }
        .button:hover{
            background-color: #02bca2;    
        }
    </style>
</head>

<body>
    <header>
        <h1 style="text-align: center;">
            <i>
            Welcome to our photo album
        </i>
        </h1>
    </header>
    <h2 style="text-align: center;color: #00c3ff;">
        Login Details 
    </h2>
    <div class="container">
        <form method="POST">
            <div class="inputs">
                <label for="Username">Username : </label>
                <input type="text" name="Username" placeholder="Username" style="padding: 5px;">
            </div> 
            <div class="inputs">
                <label for="Password">Password : </label>
                <input type="Password" name="Password" placeholder="Password" style="padding: 5px;">
            </div>
            <input type="submit" name="Submit" value="Login" class="button">
        </form>
    </div>
    <div>
    <?php if(isset($msg)){?>
      <p align="center"><?php echo $msg;?></p>
    <?php } ?>
    </div>

</body>

</html>