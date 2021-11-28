let checkbox = document.querySelectorAll('.check');
let btnCheckTrue = document.querySelector('.btnMarcar');
let btnCheckFalse = document.querySelector('.btnDesmarcar');



btnCheckTrue.addEventListener('click', marcarTudo);


btnCheckFalse.addEventListener('click', desmarcar);


document.getElementById("btnCopiar").addEventListener("click", copiar);


function marcarTudo(){

    for(let current of checkbox){
        current.checked = true;
    }

    }

function desmarcar(){

    for(let current of checkbox){
        current.checked = false;
    }

}

function copiar(){

    var selecionados = []

    
    i=0;
    for(let current of checkbox){
        if(current.checked == true){
            
            selecionados[i] = current.value;
            i = i + 1;

        }
    }


    if(selecionados.length > 0){


        let selecionadoConteudo = selecionados.toString();

        let texto = selecionadoConteudo.replace(/,/g, ', ');

        let inputTest = document.createElement("input");

        inputTest.value = texto;

        document.body.appendChild(inputTest);
    
        inputTest.select();

        document.execCommand('copy');
    
        document.body.removeChild(inputTest);

        
        for(current of selecionados){
            selecionados.pop();
        }
    }

}






$(function(){
    
    lang = navigator.language;

        
    if(lang.match(/pt/)){

        $('.idioma-portugues').css('display', 'block');
        $('.idioma-ingles').css('display', 'none');
        $('.idioma-espanhol').css('display', 'none');

    } else if(lang.match(/en/)){

        $('.idioma-portugues').css('display', 'none');
        $('.idioma-ingles').css('display', 'block');
        $('.idioma-espanhol').css('display', 'none');

    } else if(lang.match(/es/)){

        $('.idioma-portugues').css('display', 'none');
        $('.idioma-ingles').css('display', 'none');
        $('.idioma-espanhol').css('display', 'block');

    } else{

        $('.idioma-portugues').css('display', 'block');
        $('.idioma-ingles').css('display', 'none');
        $('.idioma-espanhol').css('display', 'none');
    }


});


$(document).ready(function() {
  
    $('.load').hide();
 
});