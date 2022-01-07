<?php require 'upload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD OR DELETE IMAGES</title>
    <style>
        body {
            background-color: black;
            color: wheat;
            font-size: 19px;
            font-family: sans-serif;
        }

        .button {
            padding: 9px 20px;

        }
        .container1{
            float: left;
            border: 2px solid white;
            width: 46%;
        }
        .container2{
            float: right;
            border: 2px solid red;
        }
    </style>
</head>

<body>
    <div class="container1">
    <div style="margin:auto">
        <h1 style="text-align:center;color: chartreuse;">Add images to your album</h1>
        <div>
            <ul style="text-align: center;">
                <li>
                    You can upload an image having format jpg.
                </li>
                <li>
                    You can upload an image of less than 200 KB.
                </li>
                <li>
                    You can upload maximum of 10 images.
                </li>
                <li>
                    Images you upload are added to images directory.
                </li>
            </ul>
        </div>
    </div>
    <br>
    <div align="center">
        <form action="" method="post" enctype='multipart/form-data' name="Login_Form"
            style="margin:0 auto;width: 500px">
            <input type="file" name="file[]" id="file" multiple>
            <input name="submit" type="submit" class="button" value="Upload your photos">
        </form>
    </div>
    <?php if(isset($msg)){?>
      <p align="center"><?php echo $msg;?></p>
    <?php } ?>
    </div>
    <div class="container2">
    <div align="center">
        <h1 style="text-align:center;color: chartreuse;">Delete images from album.</h1>
        <form method="post">
            <div>
                If you want to see the names of the images present in the album,then click on the below button.
            </div>
            <div>
            <input type="submit" name="getimages"class="button" style="margin-top:19px;" value="Get the names of images">
        </div>
            <p style="text-align:center">Enter the name of a photo (include the .jpg at the end also) for deletion</p>
            <input type="text" name="namepic" id="del"style="width:20%">
            <input type="submit" name="delete" class="button" value="Delete">
        
    <?php
        if(isset($_POST['delete'])){
          echo "<br/>";
            $namepic = $_POST['namepic'];
            if(!file_exists("images/$namepic")){
                echo $namepic .' is not present in the album';
            }
            else if($namepic === "" || $namepic === "." || $namepic === "..") {
               echo 'Enter a valid image name to delete';
            }
            else
            {
                unlink("images/$namepic");
                echo  $namepic.' is deleted successfully.';
            }
        }

         if(isset($_POST['getimages'])){
           echo "<br/><br/>";
            $photos = 'images'; 
            $imgarray = scandir($photos); 
            $totalimgs = count($imgarray);
            if($totalimgs<=2)
            {
              echo "Album is empty";
            }
            else
            {
              for($i=2;$i<$totalimgs;$i++){
              echo $imgarray[$i]."<br/>";
            }
        }
      }
    ?>
        </form>
    </div> 
    
<form method="post" action="album.php">
  <br/>
      <input type="submit" class="button" name="getimages" value="Go back to the album"><br/><br/>
</form>   
    </div>

</body>

</html>