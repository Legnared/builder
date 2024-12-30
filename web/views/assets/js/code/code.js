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

    classCodemirror.each((i) => {  
        var typeCode = "text/plain"; // Valor predeterminado
       
        if ($(classCodemirror[i]).attr("code") == "html") {
            typeCode = "text/html";
        }
        if ($(classCodemirror[i]).attr("code") == "css") {
            typeCode = "css";
        }
        if ($(classCodemirror[i]).attr("code") == "js") {
            typeCode = "javascript";
        }

        // Inicializar CodeMirror
        var code = $(classCodemirror[i])[0];
        var editor = CodeMirror.fromTextArea(code, {
            lineNumbers: true,
            lineWrapping: true,
            tabSize: 3,
            styleActiveLine: true,
            theme: "udb-dark",
            matchBrackets: true,
            autoRefresh: true,
            mode: typeCode
        });

        // Solución para eventos no pasivos
        const scroller = editor.getScrollerElement();
        scroller.addEventListener('mousewheel', function(event) {
            // Manejo opcional del evento, si es necesario
        }, { passive: true }); // Marca el evento como pasivo

        // Agregar también el evento 'touchstart' y 'touchmove'
        scroller.addEventListener('touchstart', function(event) {
            // Manejo opcional del evento, si es necesario
        }, { passive: true }); // Marca el evento como pasivo

        scroller.addEventListener('touchmove', function(event) {
            // Manejo opcional del evento, si es necesario
        }, { passive: true }); // Marca el evento como pasivo


        // Evento para detectar cambios en el editor
        editor.on("change", function(event) {
            $(".saveLanding").html(`<span class="spinner-border spinner-border-sm text-muted"></span> Guardando`);

            var codeEditor = editor.getValue(); // Obtén el valor del editor

            updateCode($(classCodemirror[i]).attr("idCode"), codeEditor, $(classCodemirror[i]).attr("column"));

            //console.log("codeEditor:", codeEditor);
        });
    });
}


/*=============================================================================  
                            AUTOGUARDADO AUTOMÁTICO  
=============================================================================*/

function updateCode(idCode, codeEditor, column) {
    var data = new FormData();
    data.append("idCode", idCode);
    data.append("codeEditor", codeEditor);
    data.append("column", column);
    data.append("token", localStorage.getItem("token-admin"));

    $.ajax({
        url: "/ajax/code.ajax.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
            try {
                var res = JSON.parse(response); // Parsear la respuesta como JSON
                if (res.status === 200) { 
                    $(".saveLanding").html(`<i class="fas fa-save"></i> Autoguardado <i class="fas fa-check"></i>`);
        
                    setTimeout(function() {
                        $(".saveLanding").html(`<i class="fas fa-save"></i> Guardar`);
                    }, 2000);
                } else {
                    $(".saveLanding").html(`<i class="fas fa-exclamation-circle"></i> Error al guardar`);
                }
            } catch (error) {
                console.error("Error al parsear la respuesta:", error, response);
                $(".saveLanding").html(`<i class="fas fa-exclamation-circle"></i> Error al guardar`);
            }
        },
        error: function(xhr, status, error) {
            console.log("Error: " + status + ", " + error);
            $(".saveLanding").html(`<i class="fas fa-exclamation-circle"></i> Error al guardar`);
        }
    });
}



/*=============================================================================  
                            NAVEGAR ENTRE CÓDIGOS  
=============================================================================*/

$(document).on("click",".changeCode", function(){

    var mode = $(this).attr("mode");
    var modulesCode = $(".modulesCode");
    var countModules = 0;

    modulesCode.each((i)=> {

        $(modulesCode[i]).hide();
        countModules++;

        if (countModules == modulesCode.length) {

            $(".module"+mode).show();
            
        }
    })

})