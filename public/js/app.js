    
    /** Escuchadores de los botones */
    var login = document.getElementById("login_button");
    if(login !=null){
        login.addEventListener("click", inicializar);
    }        

    var register = document.getElementById("register_button");
    register.addEventListener("click", registrarse);

    var not_post = document.getElementById("create_button_not");
    if(not_post != null){
        not_post.addEventListener("click", inicializar);
    }

    var post = document.getElementById("create_button_yes");
    if (post != null) {
        post.addEventListener("click", create_post);
    }

    /** Fin de escuchadores de los botones */
    
    /** Funciones que ejecutan los escuchadores */
    function inicializar() {
        $('#login').modal('show');
    }

    function registrarse() {
        $('#login').modal('hide');
        $('#registrarse').modal('show');
    }

    function loader() {
        var principal = document.getElementById("principal");
        var loader = document.getElementById("loader");
        $("#loader").fadeOut("slow");
        $("#principal").fadeIn("slow");
    }

    function create_post(){
        $('#new_post').modal('show');
    }
    /** Fin funciones que ejecutan los escuchadores*/
    
    /** Filtrado de contenido a traves del buscador*/
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $(".ui.card").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
    /** Fin filtrado de contenido a traves del buscador*/
    
    /** Activado de popup de las reacciones*/
    $('.activating.element').popup();
    /** Fin activado de popup de las reacciones*/
    

