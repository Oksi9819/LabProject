// Set order
$('#set_order').on('click', () => {
    cartData = getCartData();
    const orderAddress = $('#order_addr').val();
    // alert(orderAddress);
    console.log(cartData);
    if (cartData === null) {
      openModal('В корзине пусто!');
    } else if (orderAddress === null) {
      openModal('Input order address please.');
    } else {
      $.ajax({
        type: 'POST',
        url: '/order',
        data: {
          itemsArr: cartData,
          orderAddress,
        },
        success: (data) => {
          const response = JSON.parse(data);
          if (response.result === 'Success') {
            $('#clear_cart').trigger('click');
            $('#order_addr').val('');
            $(cartContent).text('В корзине пусто!');
            openModal('Order was successfully sent.');
          } else {
            console.log(response.result);
            openModal(response.result);
          }
        },
      });
    }
    return false;
  });

  // Function of changing order address
$('#submit_new_order_address').on('click', () => {
    // alert($('#change_order_address').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#change_order_address').attr('action'),
      data: $('#change_order_address').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          const parentBox = ($('#change_order_address').parent()).parent();
          $(parentBox).find('.order-address').val(response.value);
          openModal('Order address was changed.');
        } else {
          console.log(response.result);
          openModal(response.result);
        }
        $('#new_order_address').val('');
      },
    });
    return false;
  });
  
  // Function to cancel order
  $('#submit_cancel_order').on('click', () => {
    // alert($('#cancel_order').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#cancel_order').attr('action'),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          const parentBox = ($('#cancel_order').parent()).parent();
          $(parentBox).find('.order-status').val(3);
          openModal('Order was canceled');
        }
      },
    });
    return false;
  });
  
  // Function of changing order status
  $('#submit_new_order_status').on('click', () => {
    // alert($('#change_order_status').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#change_order_status').attr('action'),
      data: $('#change_order_status').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          const parentBox = ($('#change_order_status').parent()).parent();
          console.log($(parentBox).attr('class'));
          console.log($(parentBox).find('.order_status').text());
          $(parentBox).find('.order_status').text(response.value);
          openModal(`Status of order ${response.order_id} was changed.`);
        }
      },
    });
    return false;
  });
  