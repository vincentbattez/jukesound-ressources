/*------------------------------------*\
    $ ADD RESSOURCE
\*------------------------------------*/
/**
 * Ajouter le necessaire dans le DOM pour ajouter une nouvelle ressource
 * 
 * @param {Number} count ID de la nouvelle ressource
 * 
 * @example
 * let count = 2;
 * $('@buttonTrigger').on('click', function (e) {
 *  addRessource(count++);
 * }
 */
export function addRessource(count) {
  const ressource = $('.js-ressource:first-child').clone();

  $(ressource).attr('id', 'ressource'+count);
  // SET LABEL
  $(ressource).find('label[for="image1"]').attr('for', 'image'+count);
  $(ressource).find('label[for="name1"]').attr( 'for', 'name' +count);
  $(ressource).find('label[for="make1"]').attr( 'for', 'make' +count);
  $(ressource).find('label[for="buy1"]').attr(  'for', 'buy'  +count);
  $(ressource).find('label[for="link1"]').attr( 'for', 'link' +count);
  
  // SET ID
  $(ressource).find('#image1').attr(   'id', 'image'+count);
  $(ressource).find('.outputImg').attr('src', '').removeClass('active');
  $(ressource).find('#name1').attr(    'id', 'name' +count).val('');
  $(ressource).find('#make1').attr(    'id', 'make' +count).val('');
  $(ressource).find('#buy1').attr(     'id', 'buy'  +count).val('');
  $(ressource).find('#link1').attr(    'id', 'link' +count).val('');
  
  // RESET VALUES
  $(ressource).find('#image1').attr('src', '').removeClass('active');
  // $(ressource).find('#name1').attr( 'id', 'name' +count);
  // $(ressource).find('#make1').attr( 'id', 'make' +count);
  // $(ressource).find('#buy1').attr(  'id', 'buy'  +count);
  // $(ressource).find('#link1').attr( 'id', 'link' +count);
  
  // DATA TARGET BTN REMOVE
  $(ressource).find('.js-removeForm').data('target', 'ressource'+count);
  
  // INSERT
  $(ressource).insertBefore('.js-addForm');
}

/*------------------------------------*\
    $ ADD CATEGORY
\*------------------------------------*/
export function addCategory() {

}
/*------------------------------------*\
    $ REMOVE
\*------------------------------------*/
/**
 * Supprime du DOM une ligne pour ajouter une nouvelle ressource
 * 
 * @param {String} el Trigger element
 * 
 * @example
 * $('@buttonTrigger').on('click', function (e) {
 *  removeForm(this);
 * }
 */
export function removeForm(el) {
  if ($('#ressource-container .ressource').length > 1) {
    let target = $(el).data('target');
    $('#'+ target).remove();
  }
}


/*------------------------------------*\
    $ INPUT FILE PREVIEW
\*------------------------------------*/
/**
 * Prévisualise l'image upload
 * 
 * 
 * @example
 * $('@buttonTrigger').on('click', function (e) {
 *  removeForm(this);
 * }
 */
export function previewImage(el, event) {
  const $this = $(el)
  const $ressource = $this.parents('.ressource');
  const $output = $ressource.find('.outputImg');
  const reader = new FileReader();

  reader.onload = function(){
    $output.attr('src', reader.result).addClass('active');
  };

  reader.readAsDataURL(event.target.files[0]);
}

/*------------------------------------*\
    $ HTML BTN REMOVE
\*------------------------------------*/
/**
 * Génère le boutton pour pouvoir supprimer du DOM une ligne pour ajouter une nouvelle ressource
 */
export function htmlBtnRemove() {
  /* - - - - - - - - - - - - *\
      $ RESSOURCE
  \* - - - - - - - - - - - - */
  $('.js-ressource').each(function (i, el) {
    let idTarget = $(el).attr('id');
    $(this).prepend('<button class="btn-circle remove js-removeForm" data-target="'+ idTarget +'"></button>');
  });

  /* - - - - - - - - - - - - *\
      $ CATEGORY
  \* - - - - - - - - - - - - */
  // $('.js-category').each(function (i, el) {
  //   let idTarget = $(el).attr('id');
  //   console.log(idTarget);
  //   $('#'+ idTarget + '> #category-container').prepend('<button class="remove btn-circle js-removeForm" data-target="'+ idTarget +'"></button>');
  // });
}