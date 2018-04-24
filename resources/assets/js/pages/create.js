/*------------------------------------*\
    $ IMPORTS
\*------------------------------------*/
import * as forms from '../components/forms';

export default {
  init() { // JS déclanché en premier
    console.log('create page');
    forms.htmlBtnRemove();
  },
  finalize() {
    /* - - - - - - - - - - - - *\
        $ REMOVE FORM
    \* - - - - - - - - - - - - */
    $('#ressource-container').on('click', '.js-removeForm' ,function (e) {
      e.preventDefault();      
      forms.removeForm(this);
    });
    /* - - - - - - - - - - - - *\
        $ ADD FORM
    \* - - - - - - - - - - - - */
    let count = 2;
    $('#ressource-container').on('click', '.js-addForm' ,function (e) {
      e.preventDefault();
      forms.addRessource(count++);
    });
    /* - - - - - - - - - - - - *\
        $ PREVIEW IMAGE
    \* - - - - - - - - - - - - */
    $('#ressource-container').on('change', 'input[type=file]', function (event) {      
      forms.previewImage(this, event);
    });
  },
};
