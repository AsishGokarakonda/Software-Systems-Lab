<?php  session_start();/* Starts the session */

if(!(isset($_SESSION['Username']) && isset($_SESSION['Password']))){
	header("location:login.php");
	exit;
}
$folder = 'images'; 
$imgarray = scandir($folder); 
$firstfile= 2;
//$lastfile=$dirsize-1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photos</title>
    <style>
        body {
            background-color: black;
            color: white;
            font-size: 19px;

        }

        .button {
            font-size: 20px;
            padding: 5px 20px;
            border-radius: 5px;
            color: yellow;
            background-color: #4c0000;
        }
        .button:hover{
            color: wheat;
        }
    </style>
</head>


<body>
    <header style="text-align: center; font-size: 26px; color:blue;">
       <i> Here you can browse through the photos!!</i>
    </header>
    <p align="center">

	<?php
$totalimages = count($imgarray);
if($totalimages > 2) {

    if(isset($_POST['first']) || (isset($_POST['previous']) && $_SESSION['index'] === 2)) {
        $_SESSION['index'] = 2;
        echo "<img style='max-height: 500px;width: auto;' src='images/$imgarray[2]' alt='albums_images'>";
    }
    else if(isset($_POST['last']) || (isset($_POST['next']) && $_SESSION['index'] === ($totalimages-1))) {
        $last = $totalimages - 1;
        echo "<img style='max-height: 500px;width: auto;' src='images/$imgarray[$last]' alt='albums_images'>";
        $_SESSION['index'] = $last;
    }
    else if(isset($_POST['previous'])) {
        $_SESSION['index']--;
        $imagetodisplay = $_SESSION['index'];
        echo "<img style='max-height: 500px;width: auto;' src='images/$imgarray[$imagetodisplay]' alt='albums_images'>";
    }
    else if(isset($_POST['next'])) {
        $_SESSION['index']++;
        $imagetodisplay = $_SESSION['index'];
        echo "<img style='max-height: 500px;width: auto;'src='images/$imgarray[$imagetodisplay]' alt='albums_images'>";
    }
    else{
    	echo "<img style='max-height: 500px;width: auto;' src='images/$imgarray[2]' alt='albums_images'>";
    }
} 
else {
    echo "Directory Empty, Please add more images with the given button to continue.";
}
?>

</p>

<form method="post">
    <div class="options" align="center">
        <div>

            <input type="submit" name="first" style="margin-right: 600px;" class="button" value="first" />
            <input type="submit" name="last" class="button" value="last" />

        </div>
        <div>

            <input type="submit" name="previous" class="button" value="previous" />
            <input type="submit" name="next" class="button" style="padding-right: 38px;
padding-left: 38px;" value="next" />
        </div>
        


    </div>
</form>
    <br />
    <br />
    <div align="center">
        <form method="post" action="newupload.php">
            <input type="submit" class="button" value="Upload/Delete images!" />
        </form>
    </div>

</body>

</html>