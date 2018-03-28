import { notification } from '../components/alerts';
/*------------------------------------*\
    $ increment
\*------------------------------------*/
export function ajaxAction(el) {
  let $el              = $(el);
  let elOldText        = $el.text();
  let $form            = $el.parents('form');
  let $card            = $el.parents('.card');
  let idCard           = $card.attr('id');
  let $stockValue      = $card.find('.stock__value');
  let quantityJukebox  = parseInt($card.find('.stock__quantity-jukebox').text());
  let $nbJukebox       = $('.display-1');
  let $maxMake         = $('#nbMakeJukebox');
  let $submitMaxMake   = $('#productionForm [type=submit]');
  let $decrementSubmit = $card.find('#decrementForm [type=submit]');
  let $decrementNumber = $card.find('#decrementForm [type=number]');
  let decrementNumber  = parseInt($decrementNumber.attr('value'));
  let nameRessource    = $card.find('.card__title').text();
  let IdRessource      = $card.attr('id');
  let numberInputValue = $el.closest('.form-group').find('[type=number]').val();

  /* - - - - - - - - - - - - - - - - -*\
      $ LANCER LA FABRICATION CLICK
  \* - - - - - - - - - - - - - - - - -*/
  if ($el.attr('id') == 'launchProduction') {
    $stockValue     = $el.parents('body').find('.stock__value');
  }
  
  $.ajax({
      method: $form.attr('method'),
      url: $form.attr('action'),
      data: $form.serialize(),
      /*------------------------------------*\
          $ BEFORE SEND
      \*------------------------------------*/
      beforeSend: function () {
        // REMPLACEMENTS
        $el.attr('disabled', 'true');   // Disabled trigger click
        $el.text('Chargement');         // replace text trigger click
      },
      /*------------------------------------*\
          $ COMPLETE
      \*------------------------------------*/
      complete: function(data) {
        data = data.responseText;
        let newStockValue = parseInt($(data).find('#'+ idCard + ' .stock__value').text());
        let newNbJukebox  = parseInt($(data).find('.display-1').text());
        let newMaxMake    = parseInt($(data).find('#nbMakeJukebox').attr('max'));
        let $allNewStock  = $(data).find('.stock__value');
        let allNewStock   = parseInt($(data).find('.stock__value'));
        let message       = 'Ajout de <strong>' + numberInputValue +'</strong> <a href="#'+IdRessource+'">'+ nameRessource + '</a>';
        
        /* - - - - - - - - - - - - - - - - -*\
            $ LANCER LA FABRICATION CLICK
        \* - - - - - - - - - - - - - - - - -*/
        if ($el.attr('id') == 'launchProduction') {
          $($allNewStock).each(function (i, stock) {
            newStockValue     = parseInt($(stock).text());
            quantityJukebox   = parseInt($($el.parents('body').find('.stock__quantity-jukebox')[i]).text());
            $card             = $($el.parents('body').find('.card')[i]);
            $decrementSubmit  = $($el.parents('body').find('#decrementForm [type=submit]')[i]);
            $decrementNumber  = $($el.parents('body').find('#decrementForm [type=number]')[i]);
            
            // REMPLACEMENTS
            $($('.stock__value')[i]).text(newStockValue);                                         // Stock value
            $decrementSubmit.attr('disabled', (newStockValue < quantityJukebox) ? true : false);  // Disabled to true or false for decrement submit
            $decrementNumber.attr('disabled', (newStockValue < quantityJukebox) ? true : false);  // Disabled to true or false for decrement input
            $decrementNumber.attr('max', newStockValue);                                          // change max value of decrement input for decrement input
            if (newStockValue < quantityJukebox) {
              $card.removeClass('card--success').addClass('card--danger');                        // remove card--success + add card--danger for card container
            }
          });
        }else {
          /* - - - - - - - - - - - - - - - - -*\
              $ OTHER TRIGGER CLICK
          \* - - - - - - - - - - - - - - - - -*/
          // REMPLACEMENTS
          if (newStockValue < quantityJukebox) {
            $card.removeClass('card--success').addClass('card--danger');                                         // remove card--success + add card--danger
          }else {
            $card.addClass(($card.hasClass('card--danger')) ? 'card--success' : '').removeClass('card--danger'); // remove card--success + add card--danger
          }
          $stockValue.text(newStockValue);                                                                       // Stock value
          $decrementSubmit.attr('disabled', (newStockValue < quantityJukebox) ? true : false);                   // Disabled or not btn "Supprimer" when newStockValue < quantityJukebox
          $decrementNumber.attr('disabled', (newStockValue < quantityJukebox) ? true : false);                   // Disabled or not btn "Supprimer" when newStockValue < quantityJukebox
          $decrementNumber.attr('max', newStockValue);                                                           // Disabled or not btn "Supprimer" when newStockValue < quantityJukebox
          $decrementNumber.attr('value', (newStockValue < quantityJukebox) ? 0 : decrementNumber);               // Disabled or not btn "Supprimer" when newStockValue < quantityJukebox
        }
        /* - - - - - - - - - - - - *\
            $ COMMUN
        \* - - - - - - - - - - - - */
        // REMPLACEMENTS
        $maxMake.attr('value', (newMaxMake == 0) ? 0 : 1);                  // Nombre jukebox réalisable value
        $maxMake.attr('max', newMaxMake);                                   // max value of "lancer la fabrication"
        $maxMake.attr('disabled', (newMaxMake == 0) ? true : false);        // Disabled or not input "lancer la fabrication" when maxMake = 0
        $submitMaxMake.attr('disabled', (newMaxMake == 0) ? true : false);  // Disabled or not btn "lancer la fabrication" when maxMake = 0
        $nbJukebox.text(newNbJukebox);                                      // value of "lancer la fabrication"
        $el.removeAttr('disabled');                                         // Disabled trigger click
        $el.text(elOldText);                                                // replace text trigger click
        notification(message, 'success', 'addRemoveNotif', 2000);        // notification
      },

      /*------------------------------------*\
          $ ERROR
      \*------------------------------------*/
      error: function(){
        alert('La mise à jours de la quantité de la ressource à échoué')
      }
  });
  
}