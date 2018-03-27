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
  let $submitMaxMake  = $('#productionForm [type=submit]');

  /* - - - - - - - - - - - - - - - - -*\
      $ LANCER LA FABRICATION CLICK
  \* - - - - - - - - - - - - - - - - -*/
  if ($(el).attr('id') == 'launchProduction') {
    $stockValue     = $(el).parents('body').find('.stock__value');
    quantityJukebox = parseInt($(el).parents('body').find('.stock__quantity-jukebox').text());
    $card           = $(el).parents('body').find('.card');
  }
  
  $.ajax({
      method: $form.attr('method'),
      url: $form.attr('action'),
      data: $form.serialize(),
      /*------------------------------------*\
          $ SUCCESS
      \*------------------------------------*/
      success: function (data) {
        let newStockValue = $(data).find('#'+ idCard + ' .stock__value').text();
        let newNbJukebox  = $(data).find('.display-1').text();
        let newMaxMake    = $(data).find('#nbMakeJukebox').attr('max');
        let $allNewStock  = $(data).find('.stock__value');
        
        /* - - - - - - - - - - - - - - - - -*\
            $ LANCER LA FABRICATION CLICK
        \* - - - - - - - - - - - - - - - - -*/
        if ($(el).attr('id') == 'launchProduction') {
          $($allNewStock).each(function (i, stock) {
            newStockValue = $(stock).text();
            console.log($(this));
            $(this).text(newStockValue);
            console.log(this);
          });
        }else {
          /* - - - - - - - - - - - - - - - - -*\
              $ OTHER TRIGGER CLICK
          \* - - - - - - - - - - - - - - - - -*/
          if (newStockValue < quantityJukebox) {
            $card.removeClass('card--success').addClass('card--danger');
          }else{
            $card.addClass(($card.hasClass('card--danger')) ? 'card--success' : '').removeClass('card--danger');
          }
          // REMPLACEMENTS
          $stockValue.text(newStockValue);                                   // Stock value
        }
        if (newMaxMake == 0) {
          $maxMake.attr('value', 0); // Nombre jukebox réalisable value
        }else{
          $maxMake.attr('value', 1); // Nombre jukebox réalisable value
        }
        $maxMake.attr('max', newMaxMake);                                  // max value of "lancer la fabrication"
        $maxMake.attr('disabled', (newMaxMake == 0) ? true : false);       // Disabled or not input "lancer la fabrication" when maxMake = 0
        $submitMaxMake.attr('disabled', (newMaxMake == 0) ? true : false); // Disabled or not btn "lancer la fabrication" when maxMake = 0
        $nbJukebox.text(newNbJukebox);                                     // value of "lancer la fabrication"
      },

      /*------------------------------------*\
          $ ERROR
      \*------------------------------------*/
      error: function(){
        alert('La mise à jours de la quantité de la ressource à échoué')
      }
  });
  
}