import $ from 'jquery';
import * as mainScript from './script.js';

$(document).ready(() => {
  // Function of adding new product
  $('#submit_add_product').on('click', () => {
    const $el = $('#add_product');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          const { product } = response;
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
          $('#catalog').append(newProduct);
          mainScript.openModal(`${responseMsg}: ${product.product_name}`);
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
        $('.add_product').val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });

  // Function of editting product info
  $('#submit_update_product').on('click', () => {
    const $el = $('#update_product_form');
    $.ajax({
      type: 'POST',
      url: $el.attr('action'),
      data: $el.serialize(),
      success: async (result) => {
        const response = JSON.parse(result);
        const responseMsg = await mainScript.translateMsg(response.msg);
        if (response.result === 'Success') {
          mainScript.openModal(`${response.product}: ${responseMsg}`);
          for (let i = 0; i < response.fields.length; i++) {
            $(`#${response.fields[i]}`).text(`${response.values[i]}`);
          }
        } else if (response.result === 'Error') {
          mainScript.openModal(responseMsg);
        }
        $('.update_product').val('');
      },
      error: async () => {
        mainScript.openModal('Проверьте подключение к сети');
      },
    });
    return false;
  });
});
