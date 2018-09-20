define([
  "jquery",
  "jquery/ui"
], function ($) {
  'use strict';

  $.widget('mage.stock', {

    loading: false,

    options: {
      productId: ''
    },

    _create: function() {
      this._bind();
    },

    _bind: function () {
      var widget = this;
      this.element.on('click', function () {
        if (!widget.loading) {
          widget.checkStock();
        }
      });
    },

    checkStock: function () {
      var widget = this;

      this.loading = true;
      $.ajax({
        url: '/opsway/stock/info?productId=' + this.options.productId,
        type: 'POST',
        dataType: 'json',
        success: function (response) {
          widget.loading = false;
          $('#info-div').removeClass('no-display');
          $('#stock-qty').text(response.qty);
        }
      });
    }

  });
});