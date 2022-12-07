import $ from 'jquery';

// Functions of modal
// Function of openning the modal
function openModal(s) {
  $('.modal').addClass('active');
  $('#modal_title').html(s);
}

// Function of closing the modal
$(document).ready(() => {
  $('.modal__close-button').on('click', () => {
    $('.modal').removeClass('active');
  });
});

// Localization
async function translateMsg(msg) {
  const translationsJSON = await fetch('/front_src/src/lang/ru.json');
  const translations = await translationsJSON.json();
  return translations[msg] ? translations[msg] : msg;
}

export { translateMsg, openModal };
