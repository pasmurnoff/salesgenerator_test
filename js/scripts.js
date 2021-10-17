$('.callPopup').on('click', function() {
    const block = $(this).data('popup'),
        elem = $('.' + block);
    $(this).toggleClass('active');
    elem.toggleClass('active');
    $( '.overlay' ).toggleClass('active');
})

$('#close').on('click', function() {
    $( '.modal' ).toggleClass('active');
    $( '.overlay' ).toggleClass('active');
    $( '.modal__result' ).removeClass('active');
})

$(function(){
    $("#phone").mask("+7 (999) 999-99-99");
});