import $ from 'jquery';

$(document).ready(() => {
  const buttons = $('.add-product');
  const cartContent = $('#cart_content');
  let cartData;

  // Function of Writting data to LocalStorage
  function setCartData(o) {
    localStorage.setItem('cart', JSON.stringify(o));
    return false;
  }

  // Function of Getting data from LocalStorage
  function getCartData() {
    return JSON.parse(localStorage.getItem('cart'));
  }

  // Set an event handler for each Add-Product button
  $(buttons).on('click', function addToCart() {
    this.disabled = true;
    cartData = getCartData() || {};
    const itemId = $(this).attr('data-id');
    let parentBox = $(this).parent();
    const itemAmount = $(parentBox).find('.catalog.product-card.amount').val();
    parentBox = $(parentBox).parent();
    // const a = parentBox.getAttribute('class');
    parentBox = $(parentBox).parent();
    // const b = parentBox.getAttribute('class');
    const itemTitle = $(parentBox).find('.catalog.product-card.text').val();
    const itemPrice = $(parentBox).find('.product-card.price').val();
    if (Object.prototype.hasOwnProperty.call(cartData, itemId)) {
      cartData[itemId][2] += itemAmount;
    } else {
      cartData[itemId] = [itemTitle, itemPrice, itemAmount];
    }
    if (!setCartData(cartData)) {
      this.disabled = false;
    }
    return false;
  });

  // Open cart
  $('#open_cart').on('click', () => {
    cartData = getCartData();
    let totalItems = '';
    if (cartData !== null) {
      totalItems = '<table class="shopping_list"><tr><th>Наименование</th><th>Цена</th><th>Кол-во</th></tr>';
      Object.keys(cartData).forEach((e) => {
        totalItems += '<tr>';
        Object.keys(cartData[e]).forEach((el) => {
          totalItems += `<td>${cartData[e][el]}</td>`;
        });
        totalItems += '</tr>';
      });
      totalItems += '</table>';
      $(cartContent).text(totalItems);
    } else {
      $(cartContent).text('В корзине пусто!');
    }
    return false;
  });

  // Clear cart
  $('#clear_cart').on('click', () => {
    localStorage.removeItem('cart');
    $(cartContent).text('Корзина очищена.');
  });
});
