<?
session_start();
include 'functions/functions.php';
$conn = mysqli_connect('localhost','root','','blog') or die('Database connection failed: '.mysqli_error());


$root = $_SERVER['DOCUMENT_ROOT'];

 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Blog</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
     <link rel="stylesheet" href="style.css">
     <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
   </head>
     <script
  src="https://code.jquery.com/jquery-3.4.1.js"
  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
  crossorigin="anonymous"></script>
   <script type="text/javascript" src="functions/functions.js"></script>

   </head>
   <body>

   </body>
 </html>
