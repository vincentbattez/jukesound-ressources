/*------------------------------------*\
    $ IMPORTS
\*------------------------------------*/
import * as quantity from '../components/quantity';
import * as ressource from '../components/deleteRessource';

export default {
  init() {
    $('#productionForm [type=submit]').attr('disabled', ($('#productionForm input[type=number]').attr('max') == 0) ? true : false); // Disabled or not btn "lancer la fabrication" when maxMake = 0
    $('#productionForm [type=number]').attr('disabled', ($('#productionForm input[type=number]').attr('max') == 0) ? true : false); // Disabled or not btn "lancer la fabrication" when maxMake = 0
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
      let stockValue       = parseInt($(this).parents('.card').find('.stock__value').text());
      let inputNumberValue = parseInt($(this).parents('.form-inline').find('[type=number]').val());
      
      if ($(this).attr('id') == 'decrementSubmit') {
        if (stockValue >= inputNumberValue) {
          e.preventDefault(); 
          quantity.ajaxAction(this);
        }
      }else{
        e.preventDefault(); 
        quantity.ajaxAction(this);
      }
    });

    $('#deleteRessource').on('click', function (e) { 
      e.preventDefault();
      ressource.ajaxDelete(this);
    });
  },
};