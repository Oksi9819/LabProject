import $ from 'jquery';
import * as mainScript from './script.js';

const buttons = $('.add-product');
const cartContent = $('#cart_content');
let cartData;
const changeAmountBtn = $('.change-amount');

// Function of Getting data from LocalStorage
function getCartData() {
  return JSON.parse(localStorage.getItem('cart'));
}

$(document).ready(() => {
  // Function of Writting data to LocalStorage
  function setCartData(o) {
    localStorage.setItem('cart', JSON.stringify(o));
    console.log('Added to cart!');
    return false;
  }

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
    // const a = $(parentBox).attr('class');
    // console.log(a);
    parentBox = $(parentBox).parent();
    // const b = $(parentBox).attr('class');
    // console.log(b);
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
      mainScript.openModal('Товар добавлен в корзину.');
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
      totalItems += `<div class="sl_col fourth"><input class="change-amount" type="number" min="0" step="1" value="${cartData[e][2]}"> шт.</div>`;
      totalItems += '</div>';
    });
    totalItems += '</div>';
    $(cartContent).empty();
    $(cartContent).append(totalItems);
  } else {
    $(cartContent).text('В корзине пусто!');
  }

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
});

export { cartContent, getCartData };
