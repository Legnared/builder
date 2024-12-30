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


/*  
==========================================  
Validar si viene Landing con códigos  
==========================================  
*/  

if (isset($routesArray[0]) && $routesArray[0] == "code" && isset($routesArray[1])) {  

    $select = "id_code,id_landing,html_code,css_code,javascript_code";

    $url = "relations?rel=codes,landings&type=code,landing&linkTo=url_landing&equalTo=" . $routesArray[1].
    "&select=".$select;  
    $method = "GET";  
    $fields = array();  
    
    $code = CurlController::request($url, $method, $fields);  

    if ($code->status == 200) {

        $code = $code->results[0];

    } else {

        echo '<script>
             
            window.location = "/";
        
        </script>';

    }

    //echo '<pre>'; print_r($code); echo '</pre>';
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page | Builder</title>
    <link href="/views/assets/plugins/bootstrap5/bootstrap.min.css" rel="stylesheet">

    <link href="/views/assets/plugins/material-preloader/material-preloader.css" rel="stylesheet" >
    <link href="/views/assets/plugins/toastr/toastr.min.css" rel="stylesheet" >
    <link href="/views/assets/plugins/jquery-ui/jquery-ui.css" rel="stylesheet">

    <link href="/views/assets/plugins/codemirror/codemirror.min.css" rel="stylesheet">
    <link href="/views/assets/plugins/codemirror/custom-codemirror.css" rel="stylesheet">

    <!-- https://fontawesome.com/v5/search -->
	<link rel="stylesheet" href="/views/assets/plugins/fontawesome-free/css/all.min.css"> 

    <link href="/views/assets/css/dashboard/dashboard.css" rel="stylesheet">

    <link href="/views/assets/css/template/template.css" rel="stylesheet">



    <script src="/views/assets/js/alerts/alerts.js"></script>
    
    <!-- jQuery library -->
    <script src="/views/assets/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery library UI -->
    <script src="/views/assets/plugins/jquery-ui/jquery-ui.js"></script>

    <!-- Bootstrap library -->
    <script src="/views/assets/plugins/bootstrap5/bootstrap.bundle.min.js"></script>

    <!-- https://feathericons.com/ -->
    <script src="/views/assets/plugins/feathericons/feather.min.js"></script>

    <!-- https://cdn.jsdelivr.net/npm/sweetalert2@11 -->
    <script src="/views/assets/plugins/sweetalert/sweetalert.js"></script>

    <!-- https://codeseven.github.io/toastr/demo.html -->
    <script src="/views/assets/plugins/toastr/toastr.min.js"></script>

    <!-- https://materializecss.com/preloader.html -->
    <script src="/views/assets/plugins/material-preloader/material-preloader.js"></script>

    <!-- https://codemirror.net/docs/ -->
    <script src="/views/assets/plugins/codemirror/codemirror.min.js"></script>
    <script src="/views/assets/plugins/codemirror/javascript.min.js"></script>
    <script src="/views/assets/plugins/codemirror/css.min.js"></script>
    <script src="/views/assets/plugins/codemirror/xml.min.js"></script>
    <script src="/views/assets/plugins/codemirror/active-line.js"></script>
    <script src="/views/assets/plugins/codemirror/matchbrackets.min.js"></script>
    <script src="/views/assets/plugins/codemirror/autorefresh.js"></script>

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


                    if($routesArray[0] == "login" || $routesArray[0] == "logout" || $routesArray[0] == "code"){

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