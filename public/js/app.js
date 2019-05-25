    
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
        //Seccion formulario NEW USER
        $("#nombre").blur(function () { 
            if(noHayDatos($("#nombre").val())){
                marcarDOMRegister("nombre");
            }
        });
        
        $("#correo").blur(function () { 
            if(noHayDatos($("#correo").val())){
                marcarDOMRegister("correo");
            }else{
                if(!emailValido($("#correo").val())){
                    $("#verificate_register").addClass("ui red message transition").html("<p>Debe insertar un correo valido</p>");
                }
            }
        });
        
        $("#username").blur(function () { 
            if(noHayDatos($("#username").val())){
                marcarDOMRegister("nombre de usuario");
            }
        });
        
        $("#password").blur(function () { 
            if(noHayDatos($("#password").val())){
                marcarDOMRegister("contraseña");
            }
        });
        //Seccion formulario LOGIN
        $("#user").blur(function () {
           if(noHayDatos($("#user").val())){
               marcarDOMLogin("nombre de usuario");
           } 
        });

        $("#pass").blur(function () { 
            if(noHayDatos($("#pass").val())){
                marcarDOMLogin("contraseña")
            }
        });
        //Seccion formulario POST
        $("#title").blur(function () {
            if(noHayDatos($("#title").val())){
                marcarDOMPost("titulo")
            }
        });

        $("#description").blur(function () { 
            if(noHayDatos($("#description").val())){
                marcarDOMPost("descripcion")
            }
        });

        $("#link").blur(function () { 
            if(noHayDatos($("#link").val())){
                marcarDOMPost("enlace a la pagina")
            }
        });

        $(".activating.element").popup();
        //Seccion de verificacion y peticion AJAX
        $("#registrar_usuario").click(function (){
            if(!noHayDatos($("#nombre").val()) && !noHayDatos($("#correo").val()) && !noHayDatos($("#username").val()) && !noHayDatos($("#password").val())){
                if(emailValido($("#correo").val())){
                    registrarUsuario();
                }else{
                    $("#verificate_register").addClass("ui red message transition").html("<p>Debe insertar un correo valido</p>");
                }
            }
        });

        $("#login_in").click(function () {
            if(!noHayDatos($("#user").val()) && !noHayDatos($("#pass").val())){
                loguearse();
            }
        });

        $("#create_post").click(function () {
            if(!noHayDatos($("#title").val()) && !noHayDatos($("#description").val()) && !noHayDatos($("#link").val())){
                registrarPost();
            }
        });

        $(".need-register").click(function (e) { 
            bulmaToast.toast({ 
                message: "Porfavor ingrese con su cuenta",
                type: "is-danger",
                animate: { in: "fadeIn", out: "fadeOut" }
            });
        });
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
            url: "controllers/User.php?peticion=register",
            type: "POST",
            data: usuario,
            success: function (response){
                if(response === "correcto"){
                    $("#verificate_register").addClass("ui green message transition").html("Cuenta creada correctamente");
                }else{
                    $("#verificate_register").addClass("ui green message transition").html(response);
                }
            }
        });
    }
    //Logeo de usuario para la pagina post
    function loguearse() {
        var usuario = $("#login-form").serialize();
        $.ajax({
            type: "POST",
            url: "controllers/User.php?peticion=login",
            data: usuario,
            success: function (response) {
                if(response === "correcto"){
                    $("#login").modal("hide");
                    location.reload();
                }else{
                    $("#verificate_login").addClass("ui red message transition").html(response);
                }
            }
        });
    }
    //Registro del POST
    function registrarPost(){
        var post = $("#form-post").serialize();
        $.ajax({
            type: "POST",
            url: "controllers/Post.php?peticion=registrar",
            data: post,
            success: function (response) {
                if(response === "correcto"){
                    $("#new_post").modal("hide");
                    location.reload();
                }else{
                    $("#verificate_post").addClass("ui red message transition").html(response);
                }
            }
        });
    }
    //Compara si es que existe datos en el input
    function noHayDatos(valor){
        return valor === "";
    }
    //Muestra los mensajes cuando no se escribe nada en los input registrarse
    function marcarDOMRegister(valor){
        $("#verificate_register").addClass("ui red message transition").html("<p>Debe ingresar su "+ valor + "</p>");
    }
    //Muestra los mensajes cuando no se escribe nada en los input login
    function marcarDOMLogin(valor){
        $("#verificate_login").addClass("ui red message transition").html("<p>Debe ingresar su "+ valor + "</p>");
    }
    //Muestra los mensajes cuando no se escribe nada en los input del post
    function marcarDOMPost(valor){
        $("#verificate_post").addClass("ui red message transition").html("<p>Debe ingresar un(a) "+ valor + "</p>");
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


