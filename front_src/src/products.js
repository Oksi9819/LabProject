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
          openModal(`${product.product_name} was added to catalog.`);
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
          // window.location.reload(true);
        } else {
          openModal(response.result);
        }
        $('.add_product').val('');
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
          openModal(`Information of ${response.product} was eddited`);
          console.log(response.fields);
          console.log(response.values);
          for (let i = 0; i < response.fields.length; i++) {
            $(`#${response.fields[i]}`).text(`${response.values[i]}`);
          }
        } else {
          openModal(response.result);
        }
        $('.update_product').val('');
      },
    });
    return false;
  });