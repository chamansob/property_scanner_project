// npm package: select2
// github link: https://github.com/select2/select2

$(function() {
  'use strict'

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }
  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
	
  }
$('form').on('submit', function(e) {
		
      var $select2 = $('.js-example-basic-multiple', $(this));
      
      // Reset
      $select2.parents('.form-group').removeClass('is-invalid');
      
      if ($select2.val() === '') {
        
        // Add is-invalid class when select2 element is required
        $select2.parents('.form-group').addClass('is-invalid');
        
        // Stop submiting
        e.preventDefault();
        return false;
      }
    });
});