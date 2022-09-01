var button = null;

$(document).ready(function() {
    //args de function = d->data, s->status, x->xml http request. const de x= responseText
    //funcao init do jquery
    $('.edit_btn').click(openEditForm);
    $('.pay_btn').click(changeStatus); //retorna tudo que for da classe pay_btn e chama funcao changeStatus on click

});

function openEditForm() {
    console.log('btn funfa');
    data = {id: this.id};
    url = 'http://localhost/lp2/api/contasRest/get_conta';
    $.post(url, data, loadForm);

}

function loadForm (d,s,x) {

    console.log(x.responseText);

}

function changeStatus() {

    button = this;
    data = {id: this.id};
    url = 'http://localhost/lp2/api/contasRest/status_conta';
    $.post(url, data, changeColor);

}

function changeColor(d,s,x) {
    
    //console.log(x.responseText);
    if (d == 1) {
        $(button).removeClass('red-text');
        $(button).addClass('blue-text');
    } else if (d == 0) {
        $(button).removeClass('blue-text');
        $(button).addClass('red-text');
    }

}