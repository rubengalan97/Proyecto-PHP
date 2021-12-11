window.onload = inicio;


function inicio() {

    document.getElementById("genero").addEventListener('change', function() {

    let otroGen = document.getElementById("genero").value;

        if(otroGen === "otroGen") {
            document.getElementById("nuevoGenero").type="text";
        } else {
            document.getElementById("nuevoGenero").type="hidden";
        }
    });



}