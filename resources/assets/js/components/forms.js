/*------------------------------------*\
    $ ADD RESSOURCE
\*------------------------------------*/
export function addRessource(count) {
  let ressource = $('.js-ressource:first-child').clone();

  $(ressource).attr('id', 'ressource'+count);
  // LABEL
  $(ressource).find('label[for="image1"]').attr('for', 'image'+count);
  $(ressource).find('label[for="name1"]').attr( 'for', 'name' +count);
  $(ressource).find('label[for="make1"]').attr( 'for', 'make' +count);
  $(ressource).find('label[for="buy1"]').attr(  'for', 'buy'  +count);
  $(ressource).find('label[for="link1"]').attr( 'for', 'link' +count);
  // ID
  $(ressource).find('#image1').attr('id', 'image'+count);
  $(ressource).find('#name1').attr( 'id', 'name' +count);
  $(ressource).find('#make1').attr( 'id', 'make' +count);
  $(ressource).find('#buy1').attr(  'id', 'buy'  +count);
  $(ressource).find('#link1').attr( 'id', 'link' +count);
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
export function removeForm(el) {
  if ($('#ressource-container .ressource').length > 1) {
    let target = $(el).data('target');
    $('#'+ target).remove();
  }
}

/*------------------------------------*\
    $ HTML BTN REMOVE
\*------------------------------------*/
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