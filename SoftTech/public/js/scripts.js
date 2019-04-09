function cargarEspecialidades(){
    console.log('hola');
    $.ajax({
        type: "get",
        url: "/usuarios/crear",
        data: "",
        success: function (response) {
            $('#especial').fadeOut("slow",function () {
                $(this).html(response).fadeIn(1000);
            });
        },
        error: console.error('No salio :C')
    });
}
