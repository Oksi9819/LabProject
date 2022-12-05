import $ from 'jquery';
import * as mainScript from './script.js';

$(document).ready(() => {
  // Function of getting registered
  $('#submit_reg_user').on('click', () => {
    $.ajax({
      type: 'POST',
      data: $('#registration_form').serialize(),
      success: (result) => {
        console.log('Data was sent.');
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          window.location.href = response.location;
        } else if (response.result === 'Error') {
          mainScript.openModal(mainScript.translateMsg(response));
        }
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    return false;
  });

  // Function of getting authorized
  $('#submit_auth_user').on('click', () => {
    $.ajax({
      type: 'POST',
      data: $('#auth_form').serialize(),
      success: (result) => {
        console.log('Data was sent.');
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          window.location.href = response.location;
        } else if (response.result === 'Error') {
          mainScript.openModal(mainScript.translateMsg(response));
        }
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    return false;
  });

  // Function of editting profile info
  $('#submit_update_user').on('click', () => {
    const $el = $('#update_user');
    // alert($('#update_user'));
    // alert($('#update_user').attr('action'));
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          mainScript.openModal(`Ура! ${mainScript.translateMsg(response)}`);
          const { fields } = response.fields;
          console.log(fields);
          const { values } = response.values;
          console.log(values);
          for (let i = 0; i < fields.length; i++) {
            console.log(fields[i]);
            $(`#updated_info_${fields[i]}`).text(values[i]);
          }
        } else if (response.result === 'Error') {
          if (response.location !== null) {
            console.log(response.location);
            window.location.href = response.location;
          } else {
            console.log(response.msg);
            mainScript.openModal(mainScript.translateMsg(response));
          }
        }
        $('.update_user').val('');
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    return false;
  });

  // Function of changing password
  $('#submit_update_pass').on('click', () => {
    // alert($('#update_user_pass').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#update_user_pass').attr('action'),
      data: $('#update_user_pass').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          mainScript.openModal(`Ура! ${mainScript.translateMsg(response)}`);
        } else if (response.result === 'Error') {
          console.log(response.result);
          mainScript.openModal(mainScript.translateMsg(response));
        }
        $('.update_pass').val('');
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    return false;
  });

  // Function of adding new admin
  $('#submit_reg_admin').on('click', () => {
    // alert($('#add_admin').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#add_admin').attr('action'),
      data: $('#add_admin').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          mainScript.openModal(`Ура! ${mainScript.translateMsg(response)}`);
        } else if (response.result === 'Error') {
          console.log(response.result);
          mainScript.openModal(mainScript.translateMsg(response));
        }
        $('.add_admin').val('');
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    return false;
  });
});
