import $ from 'jquery';
import * as mainScript from './script.js';
import getCartData from './cart.js';

$(document).ready(() => {
  const cartContent = $('#cart_content');
  // Set order
  $('#set_order').on('click', () => {
    const cartData = getCartData();
    const orderAddress = $('#order_addr').val();
    if (cartData === null) {
      mainScript.openModal('В корзине пусто!');
    } else if (orderAddress === null) {
      mainScript.openModal('Input order address please.');
    } else {
      $.ajax({
        type: 'POST',
        url: '/order',
        data: {
          itemsArr: cartData,
          orderAddress,
        },
        success: async (data) => {
          const response = JSON.parse(data);
          const responseMsg = await mainScript.translateMsg(response.msg);
          if (response.result === 'Success') {
            $('#clear_cart').trigger('click');
            $('#order_addr').val('');
            $(cartContent).text('В корзине пусто!');
            mainScript.openModal(responseMsg);
          } else if (response.result === 'Error') {
            mainScript.openModal(responseMsg);
          }
        },
        error: async () => {
          mainScript.openModal('Проверьте подключение к сети');
        },
      });
    }
    return false;
  });

  // Function of changing order address
  $('#submit_new_order_address').on('click', () => {
    const $el = $('#change_order_address');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          const parentBox = ($el.parent()).parent();
          $(parentBox).find('.order-address').val(response.value);
          mainScript.openModal(responseMsg);
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
        $('#new_order_address').val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });

  // Function to cancel order
  $('#submit_cancel_order').on('click', () => {
    const $el = $('#cancel_order');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          const parentBox = ($el.parent()).parent();
          $(parentBox).find('.order-status').val(3);
          mainScript.openModal(responseMsg);
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });

  // Function of changing order status
  $('#submit_new_order_status').on('click', () => {
    const $el = $('#change_order_status');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          const parentBox = ($el.parent()).parent();
          $(parentBox).find('.order_status').text(response.value);
          mainScript.openModal(`${response.order_id}:\n ${responseMsg} ${response.value}`);
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });
});
