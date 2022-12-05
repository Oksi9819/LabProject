import $ from 'jquery';
import * as mainScript from './script.js';

$(document).ready(() => {
  // Function of adding new product category
  $('#submit_add_category').on('click', () => {
  // alert($('#add_category').attr('action'));
    $(this).attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: $('#add_category').attr('action'),
      data: $('#add_category').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          mainScript.openModal(`${mainScript.translateMsg(response)}\n ${response.category_name}`);
          $('#id_new_prod_category').append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
          $('#update_id_category').append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
          $('#id_del_category').append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
        } else if (response.result === 'Error') {
          mainScript.openModal(mainScript.translateMsg(response));
        }
        const fields = $('#add_category').find('.add_category');
        fields.val('');
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    $(this).attr('disabled', true);
    return false;
  });

  // Function of editting product category
  $('#submit_update_category').on('click', () => {
    // alert($('#update_category').attr('action'));
    $(this).attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: $('#update_category').attr('action'),
      data: $('#update_category').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          mainScript.openModal(`${response.category_name}: ${mainScript.translateMsg(response)}`);
          $(`#id_new_prod_category option[value=${response.category_id}]`).text(`${response.category_id} - ${response.category_name}`);
          $(`#update_id_category option[value=${response.category_id}]`).text(`${response.category_id} - ${response.category_name}`);
          $(`#id_del_category option[value=${response.category_id}]`).text(`${response.category_id} - ${response.category_name}`);
        } else if (response.result === 'Error') {
          mainScript.openModal(mainScript.translateMsg(response));
        }
        ($('#update_category').find('.update_category')).val('');
        ($('#update_category').find('.new_category_eng')).val('');
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    $(this).attr('disabled', true);
    return false;
  });

  // Function of deleting product category
  $('#submit_delete_category').on('click', () => {
    // alert($('#delete_category').attr('action'));
    $(this).attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: $('#delete_category').attr('action'),
      data: $('#delete_category').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          mainScript.openModal(`${response.category_id}: ${mainScript.translateMsg(response)}`);
          // console.log(`#id_del_category option[value=${response.category_id}]`);
          $(`#id_del_category option[value=${response.category_id}]`).remove();
          $(`#id_new_prod_category option[value=${response.category_id}]`).remove();
          $(`#update_id_category option[value=${response.category_id}]`).remove();
        } else if (response.result === 'Error') {
          mainScript.openModal(mainScript.translateMsg(response));
        }
      },
      error: mainScript.openModal('Проверьте подключение к сети'),
    });
    $(this).attr('disabled', true);
    return false;
  });
});
