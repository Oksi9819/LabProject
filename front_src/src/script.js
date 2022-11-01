productCart = document.querySelectorAll('.catalog product-card'),
cartContent = document.getElementById('cart_content');

//Function cross-browser installation of the event handler
function addEvent(elem, type, handler){
  if(elem.addEventListener){
    elem.addEventListener(type, handler, false);
  } else {
    elem.attachEvent('on'+type, function(){ handler.call( elem ); });
  }
  return false;
}

//Function of Writting data to LocalStorage
function setCartData(o){
    localStorage.setItem('cart', JSON.stringify(o));
    return false;
  }

//Function of Getting data from LocalStorage
function getCartData(){
  return JSON.parse(localStorage.getItem('cart'));
}

//Function of Addition a product to the cart
function addToCart(e){
  this.disabled = true;
  var cartData = getCartData() || {},
      parentBox = ((this.parentNode).parentNode).parentNode,
      itemId = this.getAttribute('data-id'),
      itemAmount = this.parentNode.querySelector('.catalog product-card amount').innerHTML,
      itemTitle = parentBox.querySelector('a.catalog product-card text').innerHTML,
      itemPrice = parentBox.querySelector('.catalog product-card price').innerHTML;
  if(cartData.hasOwnProperty(itemId)){
    cartData[itemId][2] += itemAmount;
  } else {
    cartData[itemId] = [itemTitle, itemPrice, itemAmount];
  }
  if(!setCartData(cartData)){
    this.disabled = false;
  }
 return false;
}

//Set an event handler for each Add-Product button
for(var i = 0; i < productCart.length; i++){
  addEvent(productCart[i].querySelector('.add-product'), 'click', addToCart);
}

//Function of Openning the cart with a list of added products
function openCart(e){
  var cartData = getCartData(),
      totalItems = '';
  if(cartData !== null){
    totalItems = '<table class="shopping_list"><tr><th>Наименование</th><th>Цена</th><th>Кол-во</th></tr>';
    for(var items in cartData){
      totalItems += '<tr>';
      for(var i = 0; i < cartData[items].length; i++){
        totalItems += '<td>' + cartData[items][i] + '</td>';
      }
      totalItems += '</tr>';
    }
    totalItems += '</table>';
    cartContent.innerHTML = totalItems;
  } else {
    cartContent.innerHTML = 'В корзине пусто!';
  }
  return false;
}

//Open cart
addEvent(document.getElementById('open_cart'), 'click', openCart);

//Clear cart
addEvent(document.getElementById('clear_cart'), 'click', function(e){
  localStorage.removeItem('cart');
  cartContent.innerHTML = 'Корзина очищена.';
});