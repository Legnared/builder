<?php

require_once "../controllers/curl.controller.php";

class FormsController{

    /*========================================================
    =              VALIDAR TÍTULOS REPETIDOS                 
    =========================================================*/

    public $table;
    public $equalTo;
    public $linkTo;

    public function ajaxForms(){
        $url = $this->table."?linkTo=".$this->linkTo."&equalTo=".urlencode($this->equalTo)."&select=".$this->linkTo;
        $method = "GET";
        $fields = array();
    
        $data = CurlController::request($url, $method, $fields);
    
        // Verifica si la solicitud devuelve datos válidos
        if ($data->status == 200 && !empty($data->results)) {
            echo json_encode(["status" => 200, "message" => "Registro existente"]);
        } else {
            echo json_encode(["status" => 404, "message" => "No encontrado"]);
        }
    }
    
}

if (isset($_POST["table"])) {
    
    $ajax = new FormsController();
    $ajax->table = $_POST["table"];
    $ajax->equalTo = $_POST["equalTo"];
    $ajax->linkTo = $_POST["linkTo"];
    $ajax-> ajaxForms();
}

?>