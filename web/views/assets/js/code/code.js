/*========================================================
=                Reziser                                 =
=========================================================*/

$("table.tableReziser td:first-child,table.tableReziser td:nth-child(2)")
.css({"position":"relative"})
.prepend("<div class='resizer'></div>")
.resizable({
    resizeHeight: false,
    handleSelector: "",
    onDragStart: function(e, $el, opt){

        if(!$(e.target).hasClass("resizer"))
            return false;
        return true;

    }
})

/*=============================================================================  
                            Codemirror  
=============================================================================*/

if ($(".codemirror").length > 0) {  

    var classCodemirror = $(".codemirror");

    classCodemirror.each((i, element) => {  

        // Obtener el atributo "code" del elemento actual
        var codeAttr = $(element).attr("code");

        // Determinar el tipo de código para CodeMirror
        var typeCode = "text/plain"; // Valor predeterminado
        if (codeAttr === "html") {
            typeCode = "text/html";
        }

        // Inicializar CodeMirror
        var editor = CodeMirror.fromTextArea(element, {
            lineNumbers: true, // Corrección: debería ser "lineNumbers"
            lineWrapping: true,
            tabSize: 3,
            styleActiveLine: true,
            theme: "udb-dark",
            matchBrackets: true,
            autoRefresh: true,
            mode: typeCode
        });
    });
}
