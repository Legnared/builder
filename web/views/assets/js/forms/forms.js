// Disable form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

/*========================================================
=                FUNCION PARA VALIDAR DATOS REPETIDOS        =
=========================================================*/

function validateDataRepeat(event, type){

  if (type == "landing") {

    var table = "landings";
    var linkTo = "title_landing"

  }

  var value = event.target.value;

  var data = new FormData();
  data.append("table", table);
  data.append("equalTo", value);
  data.append("linkTo", linkTo);

  $.ajax({
      url: "/ajax/forms.ajax.php",
      method: "POST",
      data: data,
      contentType: false,
      cache: false,
      processData: false,
      success: function(response) {
          // Convierte la respuesta a JSON
          response = JSON.parse(response);

          if (response.status != 200) {
              if (type == "landing") {
                  validateJS(event, "text");
              }
          } else {
              $(event.target).parent().addClass("was-validated");
              $(event.target).parent().children(".invalid-feedback").html("Este Registro ya existe en la base de datos");

              event.target.value = "";
              return;
          }
      }
  });


}
  
/*========================================================
=                FUNCION PARA VALIDAR FORMULARIOS        =
=========================================================*/
function validateJS(event, type) {
    // Obtén el input actual y su contenedor
    var input = event.target;
    var parent = input.closest(".was-validated");
    var feedback = parent.querySelector(".invalid-feedback");

    // Asegúrate de que la clase "was-validated" se aplica al contenedor
    parent.classList.add("was-validated");

    // Valida el tipo de dato
    if (type === "text") {
        var pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}$/;

        if (!pattern.test(input.value)) {
            // Marca el campo como inválido
            input.classList.add("is-invalid");
            input.classList.remove("is-valid");

            // Actualiza el mensaje de error
            if (feedback) {
                feedback.textContent = "El campo solo debe llevar texto.";
            }

            // Limpia el valor del input
            input.value = "";

            return;
        } else {
            createURL(event, "url_landing");
        }

        // Si es válido, marca el campo como válido
        input.classList.add("is-valid");
        input.classList.remove("is-invalid");
    }
}

/*========================================================
=                FUNCION PARA CREAR URL'S                =
=========================================================*/

function createURL(event, input){

    var value = event.target.value;

    value = value.toLowerCase();
    value = value.replace(/[^\w\s\$\&\%=\(\)\!\:\-\.\"\'\/]/g, "");
    value = value.replace(/[ ]/g, "-");
    value = value.replace(/[á]/g, "a");  
    value = value.replace(/[é]/g, "e");  
    value = value.replace(/[í]/g, "i");  
    value = value.replace(/[ó]/g, "o");  
    value = value.replace(/[ú]/g, "u");  
    value = value.replace(/[ñ]/g, "n");

    $("#"+input).val(value);
}

/*========================================================
=                AGREGAR NUEVO PLUGIN               =
=========================================================*/

$(document).on("click", ".addPlugin", function() {

    var randomNum = Math.ceil(Math.random() * 10000);
    
    var itemsPlugins = $(".itemsPlugins").length+randomNum;

    var blockPlugins = $(".blockPlugins").html().replace(/plugins_landing_0/g, "plugins_landing_"+itemsPlugins);
    //console.log("blockPlugins", blockPlugins);
    
    $(this).before(blockPlugins);

    var pluginsList = JSON.parse($("#pluginsList").val());
    //console.log("pluginsList", pluginsList);

    pluginsList.push("_"+itemsPlugins);
    console.log("pluginsList", pluginsList);
    
    $("#pluginsList").val(JSON.stringify(pluginsList));
    //console.log("pluginsList", pluginsList);
  
    

})