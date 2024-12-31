<?php


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
        $this->column = $this->column;
        $this->token = $this->token;

        // Construcción de la URL
        $url = "codes?id=" . $this->idCode . "&nameId=id_code&token=" . $this->token . "&table=admins&suffix=admin";

        // Método PUT
        $method = "PUT";

        // Campos a enviar
        $fields = $this->column . "=" . urlencode($this->codeEditor);

        // Solicitud cURL
        $data = CurlController::request($url, $method, $fields);

        echo $data->status;
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
