<?php require "inc/session_start.php"; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <!--Para incluir el Head-->
  <?php include "inc/head.php"; ?>
</head>
<body>
    
  <?php

  //En Caso de que la variable no este definida, nos cargara el login
  if(!isset($_GET['vista']) || ($_GET['vista']=="")){
    $_GET['vista']="login";
  }

  //PARA CARGAR UNA VISTA U OTRA DEPENDIENDO DEL VALOR DEL IF DE ANTES
  if(is_file("./vistas/".$_GET['vista'].".php") && $_GET["vista"]
  !="login" && $_GET["vista"]!="404"){//Si la variable GET es igual a "vista" y existe, y no es igual a "404" ni a "login", cargara la barra de navegacion y los script con normalidad

    //Para incluir la navegacion
    include "./inc/navbar.php";

    include "./vistas/".$_GET["vista"].".php";

    //Para incluir los script
    include "inc/script.php"; 

  }else{
    if($_GET["vista"]=="login"){
      include "./vistas/login.php";
    }else{
      include "./vistas/404.php";
    }
  }
  ?>

</body>
</html>