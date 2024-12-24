<?php

/*========================================================
=                Iniciando variables de sesión            =
=========================================================*/
ob_start();
session_start();


/*========================================================
=                Captura las rutas de la URL             =
=========================================================*/

$routesArray = explode('/', $_SERVER['REQUEST_URI']);
array_shift($routesArray);



foreach ($routesArray as $key => $value){
    $routesArray[$key] = explode ("?",$value)[0];
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page | Builder</title>
    <link href="/views/assets/plugins/bootstrap5/bootstrap.min.css" rel="stylesheet">
    <link href="/views/assets/css/dashboard/dashboard.css" rel="stylesheet">
    <link href="/views/assets/css/template/template.css" rel="stylesheet">
    
    <!-- jQuery library -->
    <script src="/views/assets/plugins/jquery/jquery.slim.min.js"></script>
    <!-- Bootstrap library -->
    <script src="/views/assets/plugins/bootstrap5/bootstrap.bundle.min.js"></script>
    <!-- https://feathericons.com/ -->
    <script src="/views/assets/plugins/feathericons/feather.min.js"></script>

</head>

<body>

    <!--Header Section-->
    <?php include "modules/header.php";?>
    <!--Sidebar-left Section-->
    <?php include "modules/sidebar-left.php";?>


    <div class="container-fluid">
        <div class="row">


            <main class="col-12 px-md-4">
                <?php 

                   if (!empty($routesArray[0])){


                    if($routesArray[0] == "login" || $routesArray[0] == "logout"){

                        include "pages/".$routesArray[0]."/".$routesArray[0].".php";

                    } else {

                       include "pages/home/home.php";

                    }

                   } else {

                    include "pages/home/home.php";

                   }


                ?>

            </main>

        </div>

    </div>

      <!--Header Section-->
      <?php include "modules/modal-Landing.php";?>
    
    <script src="/views/assets/js/dashboard/dashboard.js"></script>
    <script src="/views/assets/js/forms/forms.js"></script>
</body>

</html>