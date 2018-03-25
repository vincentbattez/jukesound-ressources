/*------------------------------------*\
    $ IMPORTS
\*------------------------------------*/
import * as quantity from '../components/quantity';

export default {
  init() {
    console.log('dashboard page');
    $('#incrementForm, #decrementForm').on('click', '[type=submit]', function(e) {
      e.preventDefault();
      quantity.ajaxAction(this);
    });
  },
  finalize() {
  },
};