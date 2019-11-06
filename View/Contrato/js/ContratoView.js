$(function(){        
    nicEditors.allTextAreas();
    $("#btnNovo").click(function(){  
        var posi = $("#tdListaBairro div.nicEdit-main");
        var texto = $(this).val();
        var pos =pegar(posi);        
        alert(pos);
        var text = $('#txtContrato').val();  
        $('#txtContrato').val(function() {
            return text.substr(0,pos) + ' ' + texto + text.substr(pos, text.length);
        });            
    });
});
function doGetCaretPosition (ctrl) {
    var CaretPos = 0;  
    // IE Support
    if (document.selection) {
        ctrl.focus ();
        var Sel = document.selection.createRange ();
        Sel.moveStart ('character', -ctrl.value.length);
        CaretPos = Sel.text.length;
    }
    // Firefox support
    else if (ctrl.selectionStart || ctrl.selectionStart == '0')
        CaretPos = ctrl.selectionStart;
    return (CaretPos);
}

function pegar(obj){
// marca lugar para posicionar o cursor em `editor`
var marker = '{|}';

// cria intervalo
var range = document.createRange();
var index = obj.innerText ? obj.innerText.indexOf(marker) : obj.textContent.indexOf(marker);
range.setStart(obj.childNodes[0], index);
range.setEnd(obj.childNodes[0], index + marker.length);

// faz seleção
var selection = window.getSelection();
return selection;
}