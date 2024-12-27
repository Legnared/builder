/*========================================================
=      Formatear envío de formulario lado servidor          
=========================================================*/

function fncFormatInputs(){
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
}

/*========================================================
=                Alerta SweetAlert           
=========================================================*/

function fncSweetAlert(type, text, url){

    switch(type){
        case "success":
            if (url == "") {
                Swal.fire({
                    title: "Correcto!",
                    text: text,
                    icon: "success"
                  });
            } else {
                Swal.fire({
                    title: "Correcto!",
                    text: text,
                    icon: "success"
                  }).then((result)=>{
                    if (result.value) {
                        window.open(url, "_top");
                    }
                  });
            }
           
        break;

        case "error":
            if (url == "") {
                Swal.fire({
                    title: "Error!",
                    text: text,
                    icon: "error"
                  });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: text,
                    icon: "error"
                  }).then((result)=>{
                    if (result.value) {
                        window.open(url, "_top");
                    }
                  });
            }
           
        break;

        case "loading":
            Swal.fire({
                allowOutsideClick: false,
                text: text,
                icon: 'info'
              })
              Swal.showLoading();
    }

}

/*========================================================
=                Alerta Toastr           
=========================================================*/

function fncToastr(type, text){

    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        time: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: type,
        title: text
    })
}

/*========================================================
=                Alerta Línea Precarga           
=========================================================*/

function fncMatPreloader(type){

    var preloader = new $.materialPreloader({
        position: 'top',
        height: '5px',
        col_1: '#159756',
        col_2: '#da4733',
        col_3: '#f1c40f',
        col_4: '#3b78e7',
        fadeIn: 200,
        fadeOut: 200

    })
    
    if (type == "on") {

        preloader.on();
        
    }

    if (type == "off") {

        $(".load-bar-container").remove();

    }

}