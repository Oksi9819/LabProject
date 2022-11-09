const productCart = document.querySelectorAll('.catalog product-card');
const cartContent = document.getElementById('cart_content');
let cartData;

// Function cross-browser installation of the event handler
function addEvent(elem, type, handler) {
  if (elem.addEventListener) {
    elem.addEventListener(type, handler, false);
  } else {
    elem.attachEvent(`on${type}`, () => { handler.call(elem); });
  }
  return false;
}

// Function of Writting data to LocalStorage
function setCartData(o) {
  localStorage.setItem('cart', JSON.stringify(o));
  return false;
}

// Function of Getting data from LocalStorage
function getCartData() {
  return JSON.parse(localStorage.getItem('cart'));
}

// Function of Addition a product to the cart
function addToCart() {
  this.disabled = true;
  cartData = getCartData() || {};
  const parentBox = ((this.parentNode).parentNode).parentNode;
  const itemId = this.getAttribute('data-id');
  const itemAmount = this.parentNode.querySelector('.catalog product-card amount').innerHTML;
  const itemTitle = parentBox.querySelector('a.catalog product-card text').innerHTML;
  const itemPrice = parentBox.querySelector('.catalog product-card price').innerHTML;
  if (Object.prototype.hasOwnProperty.call(cartData, itemId)) {
    cartData[itemId][2] += itemAmount;
  } else {
    cartData[itemId] = [itemTitle, itemPrice, itemAmount];
  }
  if (!setCartData(cartData)) {
    this.disabled = false;
  }
  return false;
}

// Set an event handler for each Add-Product button
for (let i = 0; i < productCart.length; i++) {
  addEvent(productCart[i].querySelector('.add-product'), 'click', addToCart);
}

// Function of Openning the cart with a list of added products
function openCart() {
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
    cartContent.innerHTML = totalItems;
  } else {
    cartContent.innerHTML = 'В корзине пусто!';
  }
  return false;
}

// Open cart
addEvent(document.getElementById('open_cart'), 'click', openCart);

// Clear cart
addEvent(document.getElementById('clear_cart'), 'click', () => {
  localStorage.removeItem('cart');
  cartContent.innerHTML = 'Корзина очищена.';
});
