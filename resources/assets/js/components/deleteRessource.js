import { notification } from '../components/alerts';

export function ajaxDelete(el) {
  const $el   = $(el);
  const $form = $el.parents('form');
  const $card = $el.parents('.card');
  const ressourceName = $card.find('.card__title');

  $.ajax({
    method: $form.attr('method'),
    url:    $form.attr('action'),
    data:   $form.serialize(),
    success: function (response) {
      // TODO: If last item in category remove all section div
      
      $card.remove();
      let message = `Ressource ${ressourceName} supprimé.`
      
      notification(message, 'warning', 'makeNotif', 6000);
    }
  });
}