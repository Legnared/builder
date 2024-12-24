<?php

class AdminsController{

/*========================================================
=               Login de Administradores                 =
=========================================================*/

    public function login(){

        if (isset($_POST["email_admin"])){

            $url = "admins?login=true&suffix=admin";
            $method = "POST";
            $fields = array(
                "email_admin" => $_POST["email_admin"],
                "password_admin" => $_POST["password_admin"]
            );
             
            $login = CurlController::request($url,$method,$fields);
            //echo '<pre>'; print_r($login); echo '</pre>';
           
            if ($login->status == 200) {
               $_SESSION["admin"] = $login->results[0];

               echo '<script>

               window.location = "/";
               
               </script>';

               //echo '<pre>'; print_r($_SESSION["admin"]); echo '</pre>';
            } else {

                $error = null;
                
                if ($login->results == "Wrong email") {

                    $error = "Correo mal escrito";

                } else {

                    $error = "Contraseña mal escrita";

                }
                
                echo '<div class="alert alert-danger mt-3">Errror al ingresar: ' .$error. '</div>';

            }



        }
       
    }

}
