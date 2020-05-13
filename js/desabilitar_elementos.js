
function Habilitar()
{
    var camp1 = document.getElementById("campo1");
    var camp2 = document.getElementById("campo2");
    var boton = document.getElementById("boton");

    if(camp1.value != camp2.value)
    {
        boton.disable = true;
    }
    else
    {
        boton.disable = false;
    }
}