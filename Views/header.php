<!doctype html>
<html lang="en">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="<?php echo CSS_PATH ?>bootstrap.min.css">
     <link rel="stylesheet" href="<?php echo CSS_PATH ?>estilos.css">

     <title>Celulares UTN</title>
</head>
<body>
     <?php
          if(isset($_SESSION['technical'])){
     ?>
               <h2 class="mb-4"> <?php echo "Hola ".$_SESSION['technical']->getUserName(); ?> </h2>
     <?php
          }
     ?>
     