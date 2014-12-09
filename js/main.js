window.addEventListener("load", function()
{
    var borrar = document.getElementsByClassName("borrar");
    
    for (var i = 0; i < borrar.length; i++)
    {
        if (borrar[i])
        {
            borrar[i].addEventListener("click", confirmar);
        }
    }

    var editar = document.getElementsByClassName("editar");

    for (var i = 0; i < editar.length; i++)
    {
        editar[i].addEventListener("click", modificar);
    }

    function confirmar(e)
    {
        var idCasa = this.getAttribute("data-idCasa");
        var respuesta = confirm("¿Seguro que quieres borrar?");
        //var respuesta = confirm("¿Seguro que quieres borrar a  " + idCasa + "?");
        if (!respuesta)
        {
            e.preventDefault();
        }
    }

    function modificar(e)
    {
        e.preventDefault();
        var idCasa = this.getAttribute("data-idCasa");
        var f = document.getElementById("formulario");
        f.action = "phpVer.php";
        var idf = document.getElementById("idformulario");
        idf.value = id;
        f.submit();
    }
});