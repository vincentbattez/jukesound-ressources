/*------------------------------------*\
    $ Notification
\*------------------------------------*/
/**
 * 
 * @param {string} message 'message par defaut'
 * @param {string} color   'info'
 * @param {string} id      'defaultNotif'
 * @param {number} time    2000
 */
export function notification(message = 'message par defaut', color = 'info', id = 'defaultNotif', time = 2000) {
  let templateAlert = `
    <div class="alert alert-${color} alert-dismissible fade show fixed-top" id="${id}" role="alert">
      ${message}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  `;
  
  if ($('.alert').attr('id') == id) {
    $('#'+id).alert('close'); // remove old same alert
  }

  // AJOUT DOM
  $(templateAlert).prependTo('body');
  setTimeout(() => {
    $('#'+id).alert('close'); // remove alert after $time
  }, time);

}