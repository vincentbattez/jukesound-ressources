/*------------------------------------*\
    $ IMPORTS
\*------------------------------------*/
import * as forms from '../components/forms';
console.log('create page');

export default {
  init() { // JS déclanché en premier
    forms.htmlBtnRemove();
  },
  finalize() {
    /* - - - - - - - - - - - - *\
        $ REMOVE FORM
    \* - - - - - - - - - - - - */
    $('#ressource-container').delegate('click', '.js-removeForm' ,function (e) {
      e.preventDefault();      
      forms.removeForm(this);
    });
    /* - - - - - - - - - - - - *\
        $ ADD FORM
    \* - - - - - - - - - - - - */
    let count = 2;
    $('#ressource-container').delegate('click', '.js-addForm' ,function (e) {
      e.preventDefault();
      forms.addRessource(count++);
    });
  },
};
