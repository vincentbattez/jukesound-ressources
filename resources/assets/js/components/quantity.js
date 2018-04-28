import { notification } from '../components/alerts';
/*------------------------------------*\
    $ increment
\*------------------------------------*/
/**
 * Execute la function php agissant sur le BDD et change le DOM en conséquent
 * 
 * @param {String} el Element trigger
 * 
 * @example 
 * $('#buttonTrigger').on('click', function(e) {
 *    ajaxAction(this);
 * }
 * 
 */
export function ajaxAction(el) {
  // VARIABLES
  let $el                = $(el);
  let elOldText          = $el.text();
  let $form              = $el.parents('form');
  let $card              = $el.parents('.card');
  let idCard             = $card.attr('id');
  let $stockValue        = $card.find('.stock__value');
  let quantityJukebox    = parseInt($card.find('.stock__quantity-jukebox').text());
  let $nbJukebox         = $('.display-1');
  let $maxMake           = $('#nbMakeJukebox');
  let oldMakeValue       = $maxMake.val();
  let $submitMaxMake     = $('#productionForm [type=submit]');
  let $decrementSubmit   = $card.find('#decrementForm [type=submit]');
  let $decrementNumber   = $card.find('#decrementForm [type=number]');
  let oldDecrementNumber = parseInt($decrementNumber.attr('value'));
  let nameRessource      = $card.find('.card__title').text();
  let IdRessource        = $card.attr('id');
  let numberInputValue   = $el.closest('.form-group').find('[type=number]').val();
  
  let $priceDecimal      = $card.find('.price__decimal');
  let $priceCentime      = $card.find('.price__centime');

  let $statRestDecimal   = $el.parents('main').find('.stat--rest .price__decimal');
  let $statRestCentime   = $el.parents('main').find('.stat--rest .price__centime');
  
  let $statMakeDecimal   = $el.parents('main').find('.stat--make .price__decimal');
  let $statMakeCentime   = $el.parents('main').find('.stat--make .price__centime');

  console.log($statRestCentime);

  /* - - - - - - - - - - - - - - - - -*\
      $ LANCER LA FABRICATION CLICK
  \* - - - - - - - - - - - - - - - - -*/
  if ($el.attr('id') == 'launchProduction') {
    $stockValue = $el.parents('body').find('.stock__value');
  }
  
  $.ajax({
      method: $form.attr('method'),
      url: $form.attr('action'),
      data: $form.serialize(),
      /*------------------------------------*\
          $ BEFORE SEND
      \*------------------------------------*/
      beforeSend: function () {
        /**** REMPLACEMENTS  */
        /**/ $el.attr('disabled', 'true');   // Disabled trigger click
        /**/ $el.text('Chargement');         // replace text trigger click
      },
      /*------------------------------------*\
          $ COMPLETE
      \*------------------------------------*/
      complete: function(data) {
        /* - - - - - - - - - - - - *\
            $ COMMUN
        \* - - - - - - - - - - - - */
        // VARIABLES
        data              = data.responseText;
        let newStockValue = parseInt($(data).find('#'+ idCard + ' .stock__value').text());
        let newNbJukebox  = parseInt($(data).find('.display-1').text());
        let newMaxMake    = parseInt($(data).find('#nbMakeJukebox').attr('max'));
        let $allNewStock  = $(data).find('.stock__value');
        let allNewStock   = parseInt($(data).find('.stock__value'));
        let message       = ($el.attr('id') == 'incrementSubmit') ? 'Ajout': 'Suppression';
            message       += ' de <strong>' + numberInputValue +'</strong> <a href="#'+IdRessource+'">'+ nameRessource + '</a>';
        let priceDecimal  = $(data).find('#'+ idCard + ' .price__decimal').text();
        let priceCentime  = $(data).find('#'+ idCard + ' .price__centime').text();

        let statRestDecimal  = $(data).find('.stat--rest .price__decimal').text();
        let statRestCentime  = $(data).find('.stat--rest .price__centime').text();

        let statMakeDecimal  = $(data).find('.stat--make .price__decimal').text();
        let statMakeCentime  = $(data).find('.stat--make .price__centime').text();

        /**** REMPLACEMENTS  */
        /**/ $maxMake.attr('value', (newMaxMake == 0) ? 0 : 1);                  // Nombre jukebox réalisable value
        /**/ $maxMake.attr('max', newMaxMake);                                   // max value of "lancer la fabrication"
        /**/ $maxMake.attr('disabled', (newMaxMake == 0) ? true : false);        // Disabled or not input "lancer la fabrication" when maxMake = 0
        /**/ $submitMaxMake.attr('disabled', (newMaxMake == 0) ? true : false);  // Disabled or not btn "lancer la fabrication" when maxMake = 0
        /**/ $nbJukebox.text(newNbJukebox);                                      // value of "lancer la fabrication"
        /**/ $el.removeAttr('disabled');                                         // Disabled trigger click
        /**/ $el.text(elOldText);                                                // replace text trigger click
        /**/ $priceDecimal.text(priceDecimal);                                   // replace price decimal card
        /**/ $priceCentime.text(priceCentime);                                   // replace price centime card

        /**/ $statRestDecimal.text(statRestDecimal);                                   // replace price decimal card
        /**/ $statRestCentime.text(statRestCentime);                                   // replace price centime card
        
        /**/ $statMakeDecimal.text(statMakeDecimal);                                   // replace price decimal card
        /**/ $statMakeCentime.text(statMakeCentime);                                   // replace price centime card
        /* - - - - - - - - - - - - - - - - -*\
            $ LANCER LA FABRICATION CLICK
        \* - - - - - - - - - - - - - - - - -*/
        if ($el.attr('id') == 'launchProduction') {
          let message = 'Suppression de <strong>toutes les ressources</strong> permettant de fabriquer <strong>'+ oldMakeValue +'</strong> Jukebox';
          $($allNewStock).each(function (i, stock) {
            // VARIABLES
            newStockValue     = parseInt($(stock).text());
            quantityJukebox   = parseInt($($el.parents('body').find('.stock__quantity-jukebox')[i]).text());
            $card             = $($el.parents('body').find('.card')[i]);
            $decrementSubmit  = $($el.parents('body').find('#decrementForm [type=submit]')[i]);
            $decrementNumber  = $($el.parents('body').find('#decrementForm [type=number]')[i]);
            
            /**** REMPLACEMENTS  */
            /**/ if (newStockValue < quantityJukebox) {                     // --if-- nouveau stock est inférieur à la quantité actuelle
            /**/   $card.removeClass('card--success').addClass('card--danger');  // add class "danger" remove "success" on card
            /**/   $decrementSubmit.attr('disabled', true);                      // disabled submit input
            /**/   $decrementNumber.attr('disabled', true);                      // disabled number input
            /**/ }else{
            /**/   $decrementSubmit.removeAttr('disabled');                      // enable submit input
            /**/   $decrementNumber.removeAttr('disabled');                      // enable number input
            /**/ }
            /**/ $($('.stock__value')[i]).text(newStockValue);                   // Stock value
            /**/ $decrementNumber.attr('max', newStockValue);                    // change max value of decrement input for decrement input
          }); // Fin each
          notification(message, 'warning', 'makeNotif', 6000);                   // Notification
        }else {
          /* - - - - - - - - - - - - - - - - -*\
              $ OTHER TRIGGER CLICK
          \* - - - - - - - - - - - - - - - - -*/
          /**** REMPLACEMENTS  */
          /**/ if (newStockValue < quantityJukebox) {                     // --if-- nouveau stock est inférieur à la quantité actuelle
          /**/   $card.removeClass('card--success').addClass('card--danger');  // add class "danger" remove "success" on card
          /**/   $decrementSubmit.attr('disabled', true);                      // disabled submit input
          /**/   $decrementNumber.attr('disabled', true);                      // disabled number input
          /**/   $decrementNumber.attr('value', 0);                            // value to 0 to number input
          /**/ }else { 
          /**/   $card.addClass('card--success').removeClass('card--danger');  // add class "success" remove "danger" on card
          /**/   $decrementSubmit.removeAttr('disabled');                      // enable submit input
          /**/   $decrementNumber.removeAttr('disabled');                      // enable number input
          /**/   $decrementNumber.attr('value', oldDecrementNumber);           // value to old value to number input
          /**/ }
          /**/ $stockValue.text(newStockValue);                                // Stock value to new Stock Value
          /**/ $decrementNumber.attr('max', newStockValue);                    // change max decrement to newStockValue
          
          notification(message, 'success', 'addRemoveNotif', 4000);            // Notification
        }
      },

      /*------------------------------------*\
          $ ERROR
      \*------------------------------------*/
      error: function(){
        alert('La mise à jours de la quantité de la ressource à échoué')
      }
  });
  
}