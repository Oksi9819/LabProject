import $ from 'jquery';
import * as mainScript from './script.js';

$(document).ready(() => {
  // Function of getting registered
  $('#submit_reg_user').on('click', () => {
    $.ajax({
      type: 'POST',
      data: $('#registration_form').serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          window.location.href = response.location;
        } else if (response.result === 'Error') {
          mainScript.openModal(await mainScript.translateMsg(response.msg));
        }
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });

  // Function of getting authorized
  $('#submit_auth_user').on('click', () => {
    $.ajax({
      type: 'POST',
      data: $('#auth_form').serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          window.location.href = response.location;
        } else if (response.result === 'Error') {
          mainScript.openModal(await mainScript.translateMsg(response.msg));
        }
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });

  // Function of editting profile info
  $('#submit_update_user').on('click', () => {
    const $el = $('#update_user');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        console.log(response);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          mainScript.openModal(responseMsg);
          const { fields } = response;
          const { values } = response;
          const { length } = Array.from(response.fields);
          for (let i = 0; i < length; i++) {
            $(`#updated_info_${fields[i]}`).text(values[i]);
          }
        } else if (response.result === 'Error') {
          if (response.location !== null) {
            window.location.href = response.location;
          } else {
            mainScript.openModal(responseMsg);
          }
        }
        $('.update_user').val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });

  // Function of changing password
  $('#submit_update_pass').on('click', () => {
    const $el = $('#update_user_pass');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        mainScript.openModal(responseMsg);
        $('.update_pass').val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });

  // Function of adding new admin
  $('#submit_reg_admin').on('click', () => {
    const $el = $('#add_admin');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        mainScript.openModal(responseMsg);
        $('.add_admin').val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });
});
