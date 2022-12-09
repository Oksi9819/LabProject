import $ from 'jquery';
import * as mainScript from './script.js';

$(document).ready(() => {
  // Function of sendig a contact-form
  $('#submit_contact_form').on('click', () => {
    const $el = $('#contact_form');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          mainScript.openModal(`${responseMsg}\n ${response.name}\n ${response.mail}\n ${response.text}`);
        } else {
          mainScript.openModal(responseMsg);
        }
        $('.contact-input').val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });
});
