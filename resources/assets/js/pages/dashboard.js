/*------------------------------------*\
    $ IMPORTS
\*------------------------------------*/
import * as quantity from '../components/quantity';

export default {
  init() {
    $('#productionForm [type=submit]').attr('disabled', ($('#productionForm input[type=number]').attr('max') == 0) ? true : false); // Disabled or not btn "lancer la fabrication" when maxMake = 0
    $('#productionForm [type=number]').attr('disabled', ($('#productionForm input[type=number]').attr('max') == 0) ? true : false); // Disabled or not btn "lancer la fabrication" when maxMake = 0
    // $decrementSubmit.attr('disabled', (newStockValue < quantityJukebox) ? true : false);      // Disabled or not btn "Supprimer" when newStockValue < quantityJukebox
    // $decrementNumber.attr('disabled', (newStockValue < quantityJukebox) ? true : false);      // Disabled or not btn "Supprimer" when newStockValue < quantityJukebox
    $('[id=decrementForm]').each(function (i, e) {
      let $decrementNumber = $(e).find('[type=number]');
      let $decrementSubmit = $(e).find('[type=submit]');
      let $card = $(e).parents('.card');

      $decrementNumber.attr('disabled', ($card.hasClass('card--danger')) ? true : false)
      $decrementSubmit.attr('disabled', ($card.hasClass('card--danger')) ? true : false)

    });

  },
  finalize() {
    $('#incrementForm, #decrementForm, #productionForm').on('click', '[type=submit]', function(e) {
      // let currentRemoveValue = parseInt($(this).siblings('[type=number]').val());
      // let stockValue         = parseInt($(this).parents('.card').find('.stock__value').text());
      
      e.preventDefault(); 
      quantity.ajaxAction(this);

    });
  },
};