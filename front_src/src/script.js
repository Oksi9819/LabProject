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

  // Set an event handler for each Add-Product button
  $(buttons).on('click', function addToCart() {
    this.disabled = true;
    if (getCartData()) {
      cartData = getCartData();
      // console.log('Cart was not empty');
    } else {
      cartData = {};
      // console.log('Cart was empty');
    }
    const itemId = $(this).attr('data-id');
    let parentBox = $(this).parent();
    const itemAmount = Number($(parentBox).find('.catalog.product-card.amount').val());
    parentBox = $(parentBox).parent();
    // const a = $(parentBox).attr('class');
    parentBox = $(parentBox).parent();
    // const b = $(parentBox).attr('class');
    const itemTitle = $(parentBox).find('.catalog.product-card.text').text();
    const itemPrice = Number.parseFloat($(parentBox).find('.product-card.price').text());
    if (Object.prototype.hasOwnProperty.call(cartData, itemId)) {
      cartData[itemId][2] += itemAmount;
      // console.log('Added item to already added product.');
    } else {
      cartData[itemId] = [itemTitle, itemPrice, itemAmount];
      // console.log('New product added to cart!');
    }
    if (!setCartData(cartData)) {
      this.disabled = false;
    } else {
      alert('Товар добавлен в корзину.');
    }
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
      totalItems += `<div class="sl_col fourth">${cartData[e][2]}</div>`;
      totalItems += '</div>';
    });
    totalItems += '</div>';
    $(cartContent).empty();
    $(cartContent).append(totalItems);
  } else {
    $(cartContent).text('В корзине пусто!');
  }

  // Clear cart
  $('#clear_cart').on('click', () => {
    localStorage.removeItem('cart');
    $(cartContent).text('Корзина очищена.');
  });

  // Set order
  $('#set_order').on('click', () => {
    const orderAddress = $('#order_addr').val();
    console.log(orderAddress);
    console.log(cartData);
    if (cartData === null) {
      alert('В корзине пусто!');
    } else if (orderAddress === null) {
      alert('Input order address please.');
    } else {
      $.ajax({
        type: 'POST',
        url: './order',
        data: {
          itemsArr: cartData,
          orderAddress,
        },
        success: (data) => {
          if (data.result === 'Success') {
            $('#clear_cart').trigger('click');
            $(cartContent).text('В корзине пусто!');
            alert('Order was successfully sent.');
          } else {
            console.log(data.result);
            alert(data.result);
          }
        },
      });
    }
    return false;
  });
});
