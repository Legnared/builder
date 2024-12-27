<?php


class LandingsController{

/*========================================================
=               Gestion de Landings                 =
=========================================================*/

    public function landingsManage(){

        if (isset($_POST["title_landing"])) {

             /*========================================================
            =  Disparamos una alerta para que se dispare un
             loading de carga para visualizar que se se esta creando  =
            =========================================================*/
             echo '<script>
                 //fncMatPreloader("om");
                 //fncSweetAlert("loading", "Gestionando registro...", "");
             </script>';

             return;
            /*========================================================
            =               Agrupar varios Item para BD                 =
            =========================================================*/

            $pluginsList = json_decode($_POST["pluginsList"]);

            $plugins_landing = array();

            foreach($pluginsList as $key => $value){


                if(!empty($_POST["plugins_landing".$value])){

                    $plugins_landing[$key] = urlencode($_POST["plugins_landing".$value]);

                }
                
            }


            /*========================================================
            =            Solicitud a la API para guardar registros P01ith0_0zer*   =
            =========================================================*/

            $url = "landings?token=".$_SESSION["admin"]->token_admin."&table=admins&suffix=admin";
            $method = "POST";
            $fields = array(

                "title_landing" => trim($_POST["title_landing"]),
                "url_landing" => $_POST["url_landing"],
                "plugins_landing" => json_encode($plugins_landing),
                "icon_landing" => trim($_POST["icon_landing"]),
                "cover_landing" => trim($_POST["cover_landing"]),
                "descripcion_landing" => trim($_POST["descripcion_landing"]),
                "date_created_landing" => date("Y-m-d")
            );

            $save = CurlController::request($url,$method,$fields);
            if ($save->status == 200) {
                
                echo '<script>

                    
                    fncFormatInputs();
                    fncSweetAlert("success", "Registro Guardado con éxito", "/");
                       // fncMatPreloader("off");
                    //fncToastr("success", "Registro Guardado con éxito");
                
                </script>';

            } else {
                echo '<script>

                    //fncMatPreloader("off");
                    fncFormatInputs();
                    fncSweetAlert("error", "Error al Guardar el registro", "/")
                
                </script>';
            }

        }
        
    }


}
