'use strict';

(function() {

  document.addEventListener('DOMContentLoaded', function() {

    var inputs = document.querySelectorAll('.field input');

    // add / remove 'focus' class to highlight form field user is currently interacting with
    // also add 'interacted' class to highlight validation issues on only "touched" inputs
    for (var i = 0; i < inputs.length; i ++) {
      inputs[i].addEventListener('focus', function() {
        var div = this.parentNode;
        div.classList.add('focus');
      });
      inputs[i].addEventListener('blur', function() {
        var div = this.parentNode;
        div.classList.remove('focus');
        div.classList.add('interacted');
      });
    }

    // add 'interacted' class to all input elements after user tries to submit form
    document.getElementById('submit').addEventListener('click', function() {
      for (var i = 0; i < inputs.length; i ++) {
        var div = inputs[i].parentNode;
        div.classList.add('interacted');
      }
    });

  }, false);

})();
