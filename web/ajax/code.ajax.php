<?php

header('Content-Type: application/json; charset=utf-8');
require_once "../controllers/curl.controller.php";

class CodeController {

    public $idCode;
    public $codeEditor;
    public $column;
    public $token;

    public function ajaxCode() {
        // Validación de entradas
        $this->idCode = filter_var($this->idCode, FILTER_SANITIZE_NUMBER_INT);
        $this->codeEditor = $this->codeEditor;
        $this->column = filter_var($this->column, FILTER_SANITIZE_STRING);
        $this->token = filter_var($this->token, FILTER_SANITIZE_STRING);

        // Construcción de la URL
        $url = "codes?id=" . $this->idCode . "&nameId=id_code&token=" . $this->token . "&table=admins&suffix=admin";

        // Método PUT
        $method = "PUT";

        // Campos a enviar
        $fields = $this->column . "=" . urlencode($this->codeEditor);

        // Solicitud cURL
        $data = CurlController::request($url, $method, $fields);

        // Respuesta JSON
        if ($data === null || !isset($data->status)) {
            echo json_encode([
                "status" => "error",
                "message" => "La respuesta del servidor no es válida.",
                "data" => $data
            ]);
            return;
        }

        if ($data->status !== 'success') {
            echo json_encode([
                "status" => "error",
                "message" => "El servidor devolvió un estado de error.",
                "serverStatus" => $data->status
            ]);
            return;
        }

        echo json_encode([
            "status" => "success",
            "message" => "El servidor procesó la solicitud correctamente.",
            "serverStatus" => $data->status
        ]);
    }
}

// Validación de parámetros
if (isset($_POST["idCode"], $_POST["codeEditor"], $_POST["column"], $_POST["token"])) {
    $ajax = new CodeController();
    $ajax->idCode = $_POST["idCode"];
    $ajax->codeEditor = $_POST["codeEditor"];
    $ajax->column = $_POST["column"];
    $ajax->token = $_POST["token"];
    $ajax->ajaxCode();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Faltan parámetros requeridos."
    ]);
}

?>
