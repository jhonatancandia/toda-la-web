    
    /** Filtadro y eventos*/
    /*Register y login */
    $(document).ready(function () {
        $("#search").on("keyup", function () {
            var value = $("#search").val().toLowerCase();
            $(".ui.card").filter(function () {
                $(".ui.card").toggle($(".ui.card").text().toLowerCase().indexOf(value) > -1)
            });
        });

        $("#login_button").click(inicializar);

        $("#register_button").click(registrarse);
        
        $("#create_button_not").click(inicializar);
        
        $("#create_button_yes").click(create_post);

        $("#registrar_usuario").click(function (){
            if(!noHayDatos($("#nombre").val()) && !noHayDatos($("#correo").val()) && !noHayDatos($("#username").val()) && !noHayDatos($("#password").val())){
                if(emailValido($("#correo").val())){
                    registrarUsuario();
                }else{
                    $("#verificate").addClass("ui red message transition").html("<p>Debe insertar un correo valido</p>");
                }
            }
        });

        $("#registrar_usuario_i").click(function (){
            if(!noHayDatos($("#nombre").val()) && !noHayDatos($("#correo").val()) && !noHayDatos($("#username").val()) && !noHayDatos($("#password").val())){
                if(emailValido($("#correo").val())){
                    registrarUsuarioI();
                }else{
                    $("#verificate").addClass("ui red message transition").html("<p>Debe insertar un correo valido</p>");
                }
            }
        });

        $("#nombre").blur(function () { 
            if(noHayDatos($("#nombre").val())){
                marcarDOM("nombre");
            }
        });
        
        $("#correo").blur(function () { 
            if(noHayDatos($("#correo").val())){
                marcarDOM("correo");
            }else{
                if(!emailValido($("#correo").val())){
                    $("#verificate").addClass("ui red message transition").html("<p>Debe insertar un correo valido</p>");
                }
            }
        });
        
        $("#username").blur(function () { 
            if(noHayDatos($("#username").val())){
                marcarDOM("nombre de usuario");
            }
        });
        
        $("#password").blur(function () { 
            if(noHayDatos($("#password").val())){
                marcarDOM("contraseña");
            }
        });
        
        /** Activado de popup de las reacciones*/
        $(".activating.element").popup();
    });

    /** Funciones que ejecutan los escuchadores */
    function inicializar() {
        $("#login").modal("show");
    }

    function registrarse() {
        $("#login").modal("hide");
        $("#registrarse").modal("show");
    }

    function create_post(){
        $("#new_post").modal("show");
    }    
    //Registrar usuario para la pagina post
    function registrarUsuario(){
        var usuario = $("#form").serialize();
        $.ajax({
            url: "../controllers/User.php?registrar=ok",
            type: "POST",
            data: usuario,
            success: function (response){
                $("#verificate").addClass("ui green message transition").html(response);
            }
        });
    }    
    //Registrar usuario para la pagina index
    function registrarUsuarioI(){
        var usuario = $("#form_i").serialize();
        $.ajax({
            type: "POST",
            url: "controllers/User.php?registrar=ok",
            data: usuario,
            success: function (response) {
                $("#verificate").addClass("ui green message transition").html(response);
            }
        });
    }
    //Compara si es que existe datos en el input
    function noHayDatos(valor){
        return valor === "";
    }
    //Muestra los mensajes cuando no se escribe nada en los input
    function marcarDOM(valor){
        $("#verificate").addClass("ui red message transition").html("<p>Debe ingresar su "+ valor + "</p>");
    }
    //Verifica si el email es valido
    function emailValido(valor){
        var posArroba = obtenerTipoCorreo(valor, 0);
        return encontrarTipo(valor, posArroba);
    }
    //Obtiene el tipo de correo que se ingresa en la caja, ya sea gmail o hotmail
    function obtenerTipoCorreo(valor, aux){
        if(aux < valor.length){
            if(valor.charAt(aux) == "@"){
                return aux;
            }else{
                return obtenerTipoCorreo(valor, aux + 1);
            }
        }else{
            return -1;
        }
    }
    //Busca si es que existe el correo ingresado en el arreglo de correo validos
    function encontrarTipo(valor, posArroba) {
        var tipos = ["@hotmail.com", "@gmail.com", "@outlook.es", "@yahoo.es", "@yahoo.com"];
        var tipoEmail = valor.substring(posArroba, valor.length);
        return encontrado(tipos, tipoEmail);
    }
    //Si encuentra es TRUE
    function encontrado(tipos, valor) {
        for (let index = 0; index < tipos.length; index++) {
            if(tipos[index] === valor){
                return true;
            }
        }
    }


