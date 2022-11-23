import $ from 'jquery';

$(document).ready(() => {
  const buttons = $('.add-product');
  const cartContent = $('#cart_content');
  let cartData;

  // Function of Writting data to LocalStorage
  function setCartData(o) {
    localStorage.setItem('cart', JSON.stringify(o));
    console.log('Added to cart!');
    return false;
  }

  // Function of Getting data from LocalStorage
  function getCartData() {
    return JSON.parse(localStorage.getItem('cart'));
  }

  // Function of getting registered
  $('#submit_reg_user').on('click', () => {
    $.ajax({
      type: 'POST',
      data: $('#registration_form').serialize(),
      success: (result) => {
        console.log('Data was sent.');
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          console.log(response.location);
          window.location.href = response.location;
        } else {
          console.log(response.result);
          alert(response.result);
        }
      },
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
          console.log(response.location);
          window.location.href = response.location;
        } else {
          console.log(response.result);
          alert(response.result);
        }
      },
    });
    return false;
  });

  // Function of sendig a contact-form
  /* $('#submit_contact_form').on('click', () => {
    $.ajax({
      type: 'POST',
      url: '/contacts/contact-form',
      data: $('#contact_form').serialize(),
      success: (result) => {
        console.log('Data was sent.');
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          console.log(response.location);
          window.location.href = response.location;
        } else {
          console.log(response.result);
          alert(response.result);
        }
      },
    });
    return false;
  }); */

  // Function of editting profile info
  $('#submit_update_user').on('click', () => {
    // alert($('#update_user'));
    alert($('#update_user').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#update_user').attr('action'),
      data: $('#update_user').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          const { fields } = response;
          console.log(fields);
          const { values } = response;
          console.log(values);
          for (let i = 0; i < fields.length; i++) {
            console.log(fields[i]);
            $(`#updated_info_${fields[i]}`).text(values[i]);
          }
        } else if (response.result === 'Fail') {
          if (response.location !== null) {
            console.log(response.location);
            window.location.href = response.location;
          } else {
            console.log(response.msg);
            alert(response.msg);
          }
        } else {
          console.log(response.result);
          alert(response.result);
        }
        $('.update_user').val('');
      },
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
          alert('Password was successfully changed.');
        } else {
          console.log(response.result);
          alert(response.result);
        }
        $('.update_pass').val('');
      },
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
          alert('New admin was successfully added.');
        } else {
          console.log(response.result);
          alert(response.result);
        }
        $('.add_admin').val('');
      },
    });
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
          alert('Order address was changed.');
        } else {
          console.log(response.result);
          alert(response.result);
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
          alert('Order was canceled');
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
          const parentBox = ($('#cancel_order').parent()).parent();
          $(parentBox).find('.order-status').val(response.value);
          alert(`Status of order ${response.order_id} was changed.`);
        }
      },
    });
    return false;
  });

  // Set an event handler for each Add-Product button
  $(buttons).on('click', function addToCart() {
    this.disabled = true;
    if (getCartData()) {
      cartData = getCartData();
      console.log('Cart was not empty');
    } else {
      cartData = {};
      console.log('Cart was empty');
    }
    const itemId = $(this).attr('data-id');
    let parentBox = $(this).parent();
    const itemAmount = Number($(parentBox).find('.catalog.product-card.amount').val());
    parentBox = $(parentBox).parent();
    const a = $(parentBox).attr('class');
    console.log(a);
    parentBox = $(parentBox).parent();
    const b = $(parentBox).attr('class');
    console.log(b);
    const itemTitle = $(parentBox).find('.catalog.product-card.text').text();
    const itemPrice = Number.parseFloat($(parentBox).find('.product-card.price').text());
    if (Object.prototype.hasOwnProperty.call(cartData, itemId)) {
      cartData[itemId][2] += itemAmount;
      console.log('Added item to already added product.');
    } else {
      cartData[itemId] = [itemTitle, itemPrice, itemAmount];
      console.log('New product added to cart!');
    }
    if (!setCartData(cartData)) {
      this.disabled = false;
      alert('Товар добавлен в корзину.');
    }
    return false;
  });

  // Function of adding new product
  $('#submit_add_product').on('click', () => {
    // alert($('#add_product').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#add_product').attr('action'),
      data: $('#add_product').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          const { product } = response;
          alert(`${product.product_name} was added to catalog.`);
          let newProduct = '<div class="catalog product-card">';
          newProduct += `<div class="inner">${product.product_id}</div>`;
          newProduct += '<div class="inner">';
          newProduct += '<a href="{{BASEPATH}}catalog/category/VacuumCleaners';
          newProduct += `/id${product.product_id}">`;
          newProduct += `<img src="{{BASEPATH}}src/pics/${product.product_image}.jpg"`;
          newProduct += ` alt="${product.product_name}"></a>`;
          newProduct += '</div><div class="inner">';
          newProduct += '<a class="catalog product-card text"';
          newProduct += ' href="{{BASEPATH}}catalog/category/VacuumCleaners/';
          newProduct += `id${product.product_id}">${product.product_name}</a>`;
          newProduct += '</div><div class="inner"><p class="product-card price">';
          newProduct += `${product.product_price} BYN</p>`;
          newProduct += '</div><div class="add-to-cart catalog inner">';
          newProduct += '<div name="add_product_to_cart_form">';
          newProduct += '<input class="catalog product-card amount" type="number"';
          newProduct += ' min="1" name="product_price" step="1" value="1"> шт.';
          newProduct += '<button class="add-product" data-id=';
          newProduct += `"${product.product_id}">В КОРЗИНУ</button>`;
          newProduct += '</div></div></div>';
          console.log(newProduct);
          $('#catalog').append(newProduct);
          window.location.reload(true);
        } else {
          alert(response.result);
        }
        $('.add_product').val('');
      },
    });
    return false;
  });

  // Function of adding new product category
  $('#submit_add_category').on('click', () => {
    // alert($('#add_category').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#add_category').attr('action'),
      data: $('#add_category').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          alert(`New category ${response.category_name} was added to catalog.`);
          $('#id_new_prod_category').append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
          $('#update_id_category').append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
          $('#id_del_category').append(`<option value=${response.category_id}>${response.category_id} - ${response.category_name}</option>`);
        } else {
          alert(response.result);
        }
        const fields = $('#add_category').find('.add_category');
        fields.val('');
      },
    });
    return false;
  });

  // Function of changing product category

  // Function of deleting product category
  $('#submit_delete_category').on('click', () => {
    // alert($('#delete_category').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#delete_category').attr('action'),
      data: $('#delete_category').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          alert(`${response.category_id} was deleted.`);
          // console.log(`#id_del_category option[value=${response.category_id}]`);
          $(`#id_del_category option[value=${response.category_id}]`).remove();
          $(`#id_new_prod_category option[value=${response.category_id}]`).remove();
          $(`#update_id_category option[value=${response.category_id}]`).remove();
        } else {
          alert(response.result);
        }
      },
    });
    return false;
  });

  // Function of editting product info
  $('#submit_update_product').on('click', () => {
    // alert($('#update_product_form').attr('action'));
    $.ajax({
      type: 'POST',
      url: $('#update_product_form').attr('action'),
      data: $('#update_product_form').serialize(),
      success: (result) => {
        const response = JSON.parse(result);
        if (response.result === 'Success') {
          alert(`Information of ${response.product} was eddited`);
          console.log(response.fields);
          console.log(response.values);
          for (let i = 0; i < response.fields.length; i++) {
            $(`#${response.fields[i]}`).text(`${response.values[i]}`);
          }
        } else {
          alert(response.result);
        }
        $('.update_product').val('');
      },
    });
    return false;
  });

  // Open cart
  cartData = getCartData();
  console.log(cartData);
  let totalItems = '';
  if (cartData !== null) {
    totalItems = '<div class="shopping_list"><div class="sl_row"><div class="sl_col"><p class="bold">Артикул</p></div><div class="sl_col"><p class="bold">Наименование</p></div><div class="sl_col"><p class="bold">Цена</p></div><div class="sl_col"><p class="bold">Кол-во</p></div></div>';
    Object.keys(cartData).forEach((e) => {
      totalItems += '<div class="sl_row">';
      totalItems += `<div class="sl_col first">${e}</div>`;
      totalItems += `<div class="sl_col second">${cartData[e][0]}</div>`;
      totalItems += `<div class="sl_col third">${cartData[e][1]}</div>`;
      totalItems += `<div class="sl_col fourth"><input class="change-amount" type="number" min="0" step="1" value="${cartData[e][2]}"> шт.</div>`;
      totalItems += '</div>';
    });
    totalItems += '</div>';
    $(cartContent).empty();
    $(cartContent).append(totalItems);
  } else {
    $(cartContent).text('В корзине пусто!');
  }

  const changeAmountBtn = $('.change-amount');

  // Change amount of products in cart
  $(changeAmountBtn).on('change', function changeAmount() {
    // console.log(changeAmountBtn);
    // console.log(localStorage.cart);
    let parentBox = $(this).parent();
    // console.log($(parentBox).attr('class'));
    parentBox = $(parentBox).parent();
    // console.log($(parentBox).attr('class'));
    const newAmount = Number.parseFloat($(this).val());
    // console.log(newAmount);
    const itemId = $(parentBox).find('.sl_col.first').text();
    // console.log(itemId);
    cartData = getCartData();
    if (newAmount > 0) {
      cartData[itemId][2] = newAmount;
      setCartData(cartData);
    } else {
      delete cartData[itemId];
      setCartData(cartData);
      window.location.reload(true);
    }
    return false;
  });

  // Clear cart
  $('#clear_cart').on('click', () => {
    localStorage.removeItem('cart');
    $(cartContent).text('Корзина очищена.');
  });

  // Set order
  $('#set_order').on('click', () => {
    cartData = getCartData();
    const orderAddress = $('#order_addr').val();
    // alert(orderAddress);
    console.log(cartData);
    if (cartData === null) {
      alert('В корзине пусто!');
    } else if (orderAddress === null) {
      alert('Input order address please.');
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
            alert('Order was successfully sent.');
          } else {
            console.log(response.result);
            alert(response.result);
          }
        },
      });
    }
    return false;
  });
});
