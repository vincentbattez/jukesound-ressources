/*------------------------------------*\
    $ increment
\*------------------------------------*/
export function ajaxAction(el) {
  let $form           = $(el).parents('form');
  let $stockValue     = $(el).parents('.card').find('.stock__value');
  let quantityJukebox = parseInt($(el).parents('.card').find('.stock__quantity-jukebox').text());
  let $card           = $(el).parents('.card');
  let idCard          = $card.attr('id');
  let $nbJukebox      = $('.display-1');
  let $maxMake        = $('#nbMakeJukebox');

  $.ajax({
      method: $form.attr('method'),
      url: $form.attr('action'),
      data: $form.serialize(),
      success: function (data) {
        let newStockValue = $(data).find('#'+ idCard + ' .stock__value').text();
        let newNbJukebox  = $(data).find('.display-1').text();
        let newMaxMake    = $(data).find('#nbMakeJukebox').attr('max');

        if (newStockValue < quantityJukebox) {
          $card.removeClass('card--success').addClass('card--danger');
        }else{
          $card.addClass(($card.hasClass('card--danger')) ? 'card--success' : '').removeClass('card--danger');
        }
        // REMPLACEMENTS
        $stockValue.text(newStockValue);    // Stock value
        $nbJukebox.text(newNbJukebox);      // Nombre jukebox réalisable value
        $maxMake.attr('max', newMaxMake);   // max value of "lancer la fabrication"
        $maxMake.attr('value', newMaxMake); // value of "lancer la fabrication"

      },
      error: function(){
        alert('La mise à jours de la quantité de la ressource à échoué')
      }
  });

}
/*------------------------------------*\
    $ decrement
\*------------------------------------*/
export function decrement() {

}