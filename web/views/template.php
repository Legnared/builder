<?php 

/*=============================================
Iniciar variables de sesión
=============================================*/

ob_start();
session_start();


/*=============================================
Capturar las rutas de la URL
=============================================*/ 

$routesArray = explode("/",$_SERVER["REQUEST_URI"]);
array_shift($routesArray);

foreach ($routesArray as $key => $value) {	
	$routesArray[$key] = explode("?",$value)[0];
}


if(isset($routesArray[0])){

	/*=============================================
	Validar si viene Página Web
	=============================================*/ 
	$select = "*";
	$url = "relations?rel=codes,landings&type=code,landing&linkTo=url_landing&equalTo=".$routesArray[0]."&select=".$select;
	$method = "GET";
	$fields = array();

	$page = CurlController::request($url, $method, $fields);
	
	if($page->status == 200){

		$page = $page->results[0];
		
	
	}else{

		$page = null;

		/*=============================================
		Validar si viene Landing con códigos
		=============================================*/ 

		if($routesArray[0] == "code" && isset($routesArray[1])){

			$select = "*";

			$url = "relations?rel=codes,landings&type=code,landing&linkTo=url_landing&equalTo=".$routesArray[1]."&select=".$select;
			$method = "GET";
			$fields = array();

			$code = CurlController::request($url, $method, $fields);

			if($code->status == 200){

				$code = $code->results[0];

			}else{

				echo '<script>

				window.location = "/";

				</script>';

				return;
			}

		}

	}

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php if(!empty($page)):?>
        <title> <?php echo $page->title_landing; ?></title>
        <link rel="icon" href="<?php echo $page->icon_landing; ?>">
        <meta name="description" content="<?php echo $page->descripcion_landing; ?>">
    <?php else: ?>
        <title>Landing Page Builder | AngelDev</title>
    <?php endif ?>

	<link href="/views/assets/plugins/bootstrap5/bootstrap.min.css" rel="stylesheet" >
	<!-- https://fontawesome.com/v5/search -->
	<link rel="stylesheet" href="/views/assets/plugins/fontawesome-free/css/all.min.css"> 

	<?php if (empty($page)): ?>
		<link rel="stylesheet" href="/views/assets/plugins/toastr/toastr.min.css">
		<link rel="stylesheet" href="/views/assets/plugins/material-preloader/material-preloader.css">
		<link rel="stylesheet" href="/views/assets/css/dashboard/dashboard.css">
		<link rel="stylesheet" href="/views/assets/plugins/jquery-ui/jquery-ui.css">
		<link rel="stylesheet" href="/views/assets/plugins/codemirror/codemirror.min.css"/>
		<link rel="stylesheet" href="/views/assets/plugins/codemirror/custom-codemirror.css"/>
	<?php endif ?>

	<link rel="stylesheet" href="/views/assets/css/template/template.css">

	<!-- jQuery library -->
	<script src="/views/assets/plugins/jquery/jquery.min.js"></script>

	<!-- https://www.w3schools.com/bootstrap5 -->
	<script src="/views/assets/plugins/bootstrap5/bootstrap.bundle.min.js"></script>
	
	<!-- https://feathericons.com/ -->
	<script src="/views/assets/plugins/feathericons/feather.min.js"></script>

	<?php if (empty($page)): ?>
		<script src="/views/assets/js/alerts/alerts.js"></script>

		<!-- https://jqueryui.com/ -->
		<script src="/views/assets/plugins/jquery-ui/jquery-ui.js"></script>

		<!-- https://sweetalert2.github.io/ -->
		<script src="/views/assets/plugins/sweetalert/sweetalert.min.js"></script>

		<!-- https://codeseven.github.io/toastr/demo.html -->
		<script src="/views/assets/plugins/toastr/toastr.min.js"></script>

		<!-- https://materializecss.com/preloader.html -->
		<script src="/views/assets/plugins/material-preloader/material-preloader.js"></script>

		<!-- https://codemirror.net/ -->
		<script src="/views/assets/plugins/codemirror/codemirror.min.js"></script>
		<script src="/views/assets/plugins/codemirror/javascript.min.js"></script>
		<script src="/views/assets/plugins/codemirror/css.min.js"></script>
		<script src="/views/assets/plugins/codemirror/xml.min.js"></script>
		<script src="/views/assets/plugins/codemirror/active-line.js"></script>
		<script src="/views/assets/plugins/codemirror/matchbrackets.min.js"></script>
		<script src="/views/assets/plugins/codemirror/autorefresh.js"></script>

		<!-- https://html2canvas.hertzen.com/ -->
		<script src="/views/assets/plugins/html2canvas/html2canvas.min.js"></script>

	<?php else: ?>

		<?php foreach (json_decode($page->plugins_landing) as $key => $value): ?>

			<?php echo urldecode($value); ?>
			
		<?php endforeach ?>

	<?php endif ?>
</head>

<body>


    <?php if(!empty($page)):?>

        <style> <?php echo $page->css_code;  ?></style>
        <div> <?php echo $page->html_code;  ?></div>
        <script> <?php echo $page->javascript_code;  ?></script>

    <?php else: ?>

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
        
    <?php endif ?>

   
</body>

</html>