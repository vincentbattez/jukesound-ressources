/*------------------------------------*\
    $ IMPORTS
\*------------------------------------*/
import * as quantity from '../components/quantity';

export default {
  init() {
    $('#productionForm [type=submit]').attr('disabled', ($('#productionForm input[type=number]').attr('max') == 0) ? true : false); // Disabled or not btn "lancer la fabrication" when maxMake = 0
    $('#productionForm [type=number]').attr('disabled', ($('#productionForm input[type=number]').attr('max') == 0) ? true : false); // Disabled or not btn "lancer la fabrication" when maxMake = 0
    console.log('dashboard page');
  },
  finalize() {
        $('#incrementForm, #decrementForm, #productionForm').on('click', '[type=submit]', function(e) {
          e.preventDefault();
          quantity.ajaxAction(this);
        });
  },
};