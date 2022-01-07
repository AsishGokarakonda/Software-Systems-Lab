<?php 

if(isset($_POST['submit'])){
 $countfiles = count($_FILES['file']['name']);
 $msg="";
 if($countfiles>10)
 {
   $msg .= "Can't be uploaded as more than 10 files are selected.";
 }
 else if($countfiles==1 && $_FILES['file']['name'][0]=="" ){
 	   $msg .= "Select a file for uploading";
 }
 else{
   
 for($i=0;$i<$countfiles;$i++){
   $imagename = $_FILES['file']['name'][$i];
   $imagesize = $_FILES['file']['size'][$i];
   $imagetype = $_FILES['file']['type'][$i];

	$path = pathinfo($imagename);
	$ext = $path['extension'];
	if($imagetype !== "image/jpeg"){     
		$msg .= "$imagename will not be uploaded because only jpg format is allowed. <br/>";
		continue;
	}
	if($imagesize >200000)
	{
		$msg .= "$imagename will not be uploaded as max size is exceeded. <br/>";
		continue;
	}
   move_uploaded_file($_FILES['file']['tmp_name'][$i],'images/'.$imagename);
    $msg .= "$imagename Uploaded successfully.<br/>";
 }
}
} 
?>