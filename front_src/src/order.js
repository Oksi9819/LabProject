import $ from 'jquery';
import * as mainScript from './script.js';
import * as cartScript from './cart.js';

$(document).ready(() => {
  // Set order
  $('#set_order').on('click', () => {
    const cartData = cartScript.getCartData();
    const orderAddress = $('#order_addr').val();
    // alert(orderAddress);
    console.log(cartData);
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
            $(cartScript.cartContent).text('В корзине пусто!');
            mainScript.openModal(responseMsg);
          } else if (response.result === 'Error') {
            // console.log(response.result);
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
    // alert($('#change_order_address').attr('action'));
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
          // console.log(response.result);
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
    // alert($('#cancel_order').attr('action'));
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
          // console.log(response.result);
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
    // alert($('#change_order_status').attr('action'));
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
          // console.log($(parentBox).attr('class'));
          // console.log($(parentBox).find('.order_status').text());
          $(parentBox).find('.order_status').text(response.value);
          mainScript.openModal(`${response.order_id}:\n ${responseMsg} ${response.value}`);
        } else if (response.result === 'Error') {
          // console.log(response.result);
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
