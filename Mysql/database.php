<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Displaying</title>
    <style>
        td{
            padding:15px 20px;
            font-size:20px;
        }
    </style>
</head>
<body>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$connect = mysqli_connect($servername,$username,$password);

//-----------------------------------------------  DATABASE CREATION  -------------------------------

$sql = "CREATE DATABASE publications";
$x = mysqli_query($connect,$sql);
// if(!($x)){
//   echo "Database was not created successfully because of this error: ".mysqli_error($connect);
// }
$db='publications';
$conn =mysqli_connect($servername,$username,$password,$db);



//-----------------------------------------------  AUTHORS TABLE CREATION  -------------------------------  

$y="CREATE TABLE `authors` ( `author` VARCHAR(120) NULL DEFAULT 'NOT NULL', `publisher` VARCHAR(30) NULL DEFAULT NULL )";
$result = mysqli_query($conn, $y);

// // Check for the table creation

// if(!$result){
//   echo "The authors table was not created successfully because of this error ---> ". mysqli_error($conn);
// }

//-----------------------------------------------  TITLES TABLE CREATION  -------------------------------  

$z = "CREATE TABLE `titles` ( `title` VARCHAR(120) NULL DEFAULT 'NOT NULL' ,  `author` VARCHAR(120) NULL DEFAULT NULL ,  `year` SMALLINT(6) NULL DEFAULT NULL )";
$result2 = mysqli_query($conn, $z);

// Check for the table creation 

// if(!$result2){
//   echo "The table was not created successfully because of this error ---> ". mysqli_error($conn);
// }

@$authors_show = $_POST["authors_show"];

// Sthis part will display  table authors
if($authors_show){
  $sql = "SELECT * FROM authors";
  $extract_authors = mysqli_query($conn,$sql);
  echo"<table border='1'>";
  echo"<tr><td>Author</td><td>Publisher</td></tr>";
  while($row = mysqli_fetch_assoc($extract_authors))
  {
    $author = $row["author"];
    $publisher = $row["publisher"];
    echo "<tr><td>$author</td><td>$publisher</td></tr>";
  }
  echo"</table>";
  mysqli_free_result($extract_authors);
}

// this part will display  table titles
@$show_titles = $_POST["show_titles"];
if($show_titles){
  $sql = "SELECT * FROM titles";
  $extract_titles = mysqli_query($conn,$sql);
  echo"<table border='1'>";
  echo"<tr><td>Title</td><td>Author</td><td>Year</td></tr>";
  while($row = mysqli_fetch_assoc($extract_titles))
  {
    $title = $row["title"];
    $author = $row["author"];
    $year = $row["year"];
    echo "<tr><td>$title</td><td>$author</td><td>$year</td></tr>";
  }
  echo"</table>";
  mysqli_free_result($extract_titles);
}

//this part will add  authors and publishers to the table authors
@$add_authors = $_POST["add_authors"];
if($add_authors){
  $author = $_POST['input_author1'];
  $publisher = $_POST['publisher1'];
  if($author)
  {
    $sql = "INSERT INTO authors (author,publisher) VALUES('$author','$publisher')";
    if(mysqli_query($conn,$sql))
      echo"New record is created successfully!";
    else
      echo"Error: $sql";
  }
  else
    echo"Author should not be blank!";
}

//this part will add  title and author and year to the table titles
@$add_titles = $_POST["add_titles"];
if($add_titles){
  $title = $_POST['title_1'];
  $author = $_POST['input_author2'];
  $year = $_POST['year1'];
  if(!(int)$year)
  {
    echo "Year should contain integer values only!";
    return;
  }
  if($title)
  {
    $sql = "INSERT INTO titles (title,author,year) VALUES('$title','$author','$year')";
    if(mysqli_query($conn,$sql))
      echo"New record is created successfully!";
    else
      echo"Error: $sql";
  }
  else
    echo"Title should not be blank!";
}

// this part will delete a record from table authors
@$delete_author = $_POST["delete_author"];
if($delete_author){
  $author = $_POST['input_author1_delete'];
  $sql = "DELETE FROM authors WHERE author='$author'";
  if($author)
  {
    if (mysqli_query($conn, $sql))
      echo "Record deleted successfully";
    else 
      echo "Error deleting record: " . mysqli_error($conn);
  }
  else
    echo "Author should not be blank!";
}

//this part will delete a record from table titles
@$delete_title = $_POST["delete_title"];
if($delete_title){
  $title = $_POST['title_1_delete'];
  if($title)
  {
    $sql = "DELETE FROM titles WHERE title='$title'";
    if (mysqli_query($conn, $sql))
      echo "Record deleted successfully!";
    else 
      echo "Error deleting the record: " . mysqli_error($conn);
  }
  else
    echo"Title should not be blank!";
}

//this part will update year of the book in table titles
@$update_title = $_POST["update_title"];
if($update_title){
  $title = $_POST['title2'];
  $new_year = $_POST['year2'];
  if(!(int)$new_year)
  {
    echo "Year should contain integer values only!";
    return;
  }
  if($title && $new_year)
  {
    $sql = "UPDATE titles SET year='$new_year' WHERE title LIKE '%$title%'";
    if (mysqli_query($conn, $sql))
      echo "Year updated successfully !";
    else 
      echo "Error updating record: " . mysqli_error($conn);
  }
  else
    echo"Title and Year should not be blank!";
}

// this part will display author and year of a book
@$show_book = $_POST["show_book"];
if($show_book){
  $title = $_POST['book_title'];
  if($title)
  {
    $sql = "SELECT author,year FROM titles WHERE title LIKE '%$title%'";
    $display = mysqli_query($conn,$sql);
    echo"<table border='1'>";
    echo"<tr><td>Author</td><td>Year</td></tr>";
    while($row = mysqli_fetch_assoc($display))
    {
      $author = $row["author"];
      $year = $row["year"]; 
      echo "<tr><td>$author</td><td>$year</td></tr>";
    }
    echo"</table>";
  }
  else
    echo"The Book Title should not be blank!";
}

// display details of the book of the given publisher
@$show_details = $_POST["show_details"];
if($show_details){
  $publisher = $_POST['publisher_details'];
  if($publisher)
  {
    $sql = "SELECT * FROM authors a,titles b WHERE a.author=b.author AND a.publisher LIKE '%$publisher%'";
    $display = mysqli_query($conn,$sql);

    echo"<table border='1'>";
    echo"<tr><td>Title</td><td>Author</td><td>Year</td></tr>";
    
    while($row = mysqli_fetch_assoc($display))
    {
      $title = $row["title"];
      $author = $row["author"];
      $year = $row["year"];
      
      echo "<tr><td>$title</td><td>$author</td><td>$year</td></tr>";
    }
    echo"</table>";
  }
  else
    echo"The Publisher should not be blank!";
}

?>
