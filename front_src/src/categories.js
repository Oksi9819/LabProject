import $ from 'jquery';
import * as mainScript from './script.js';

$(document).ready(() => {
  // Function of adding new product category
  $('#submit_add_category').on('click', () => {
    const $el = $('#add_category');
  // alert($('#add_category').attr('action'));
    $(this).attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          mainScript.openModal(`${responseMsg}\n ${response.category_name}`);
          $('#id_new_prod_category, #update_id_category, #id_del_category')
            .append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
        const fields = $('#add_category').find('.add_category');
        fields.val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    $(this).attr('disabled', true);
    return false;
  });

  // Function of editting product category
  $('#submit_update_category').on('click', () => {
    // alert($('#update_category').attr('action'));
    const $el = $('#update_category');
    $(this).attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          mainScript.openModal(`${responseMsg}\n ${response.category_name}`);
          $('#id_new_prod_category, #update_id_category, #id_del_category')
            .append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
        ($('#update_category').find('.update_category')).val('');
        ($('#update_category').find('.new_category_eng')).val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    $(this).attr('disabled', true);
    return false;
  });

  // Function of deleting product category
  $('#submit_delete_category').on('click', () => {
    // alert($('#delete_category').attr('action'));
    const $el = $('#delete_category');
    $(this).attr('disabled', true);
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          mainScript.openModal(`${responseMsg}\n ${response.category_name}`);
          $(`#id_del_category option[value=${response.category_id}], #id_new_prod_category option[value=${response.category_id}], #update_id_category option[value=${response.category_id}]`)
            .remove();
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    $(this).attr('disabled', true);
    return false;
  });
});
