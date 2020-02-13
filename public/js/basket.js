basket = {
    init: function () {
        $(".delete").click(function (el) {
            productId = $(this).attr('product-id')
            basket.delete(productId)
        });

        $('.update').change(function () {
            productId = $(this).attr('product-id')
            number = $(this).val()
            basket.update(productId,number)
        });

        $("#finish").click(function (el) {
            basket.finish()
        });

    },

    delete:function (productId) {
        $.ajax('/basket/delete', {
            type: 'POST',  // http method
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data, status, xhr) {
                location.reload();
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert('error')
            }
        });
    },



    update:function (productId,number) {
        $.ajax('/basket/update', {
            type: 'POST',  // http method
            data: {
                product_id: productId,
                number: number,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data, status, xhr) {
                alert('success')
            },
            error: function (jqXhr, textStatus, errorMessage) {
                alert('error')
            }
        });
    },


    finish:function () {
        $.ajax('/order/finish', {
            type: 'POST',  // http method
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
        });
    },


}

