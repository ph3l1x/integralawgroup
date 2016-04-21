// $Id: uc_free_order.js,v 1.1.4.1 2009/05/28 07:43:10 rszrama Exp $

var using_free_order = -1;

// Adds a click function to the total so we can check its updated values.
$(document).ready(
  function() {
    $('#edit-panes-payment-current-total').click(function() { free_order_check_total(this.value); });
  }
);

/**
 * Checks the current total and updates the available/selected payment methods
 * accordingly.
 */
function free_order_check_total(total) {
  total = parseFloat(total);

  if (total >= .01) {
    // Disable the free order option and select the first available method.
    if (using_free_order == 0) {
      // Show the other payment method radios.
      $("#payment-pane .form-radios input:radio").removeAttr('disabled').parent().show(0);

      // Hide the free order radio.
      $("input:radio[@value=free_order]").attr('disabled', 'disabled').parent().hide(0);

      // Find the first available payment method.
      var uc_free_order_next_method = $(':radio[name="panes[payment][payment_method]"]:enabled:first').val();

      // Select the first payment method.
      $("input:radio[@value=" + uc_free_order_next_method + "]").attr('checked', 'checked');

      // Refresh the payment details section.
      get_payment_details('cart/checkout/payment_details/' + uc_free_order_next_method);
    }
    else {
      using_free_order = 0;
    }
  }
  else {
    // Disable the CC option and select the gift card option.
    if (using_free_order != 1) {
      // Hide the fallback payment method radio.
      $("#payment-pane .form-radios input:radio").attr('disabled', 'disabled').parent().hide(0);

      // Show and select the gift card.
      $("input:radio[@value=free_order]").removeAttr('disabled').attr('checked', 'checked').parent().show(0);

      // Refresh the payment details section.
      get_payment_details('cart/checkout/payment_details/free_order');

      using_free_order = 1;
    }
  }
}

