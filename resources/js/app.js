/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


//Script per mostrare prompt quando si manda il form delete di un appartamento.
window.addEventListener("DOMContentLoaded", function () {
  if (document.getElementById("formDelete")) {
    const formDelete = document.getElementById("formDelete");
    formDelete.addEventListener("submit", function (e) {
      if (!confirm("Sicuro di voler procedere?")) {
        e.preventDefault();
      }
    })
  }
})