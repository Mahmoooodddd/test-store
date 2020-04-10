    homePage = {
    init: function () {
        $(".add-to-basket").click(function (el) {
            productId = $(this).attr('product-id')
            homePage.addToBasket(productId)
        });
        $(".like-product").click(function () {
            productId = $(this).attr('product-id');
            homePage.likeProduct(productId)

        });
        $('.unLike-product').click(function () {
            productId = $(this).attr('product-id')
            homePage.unLikeProduct(productId)
        })


    },

    addToBasket: function (productId) {
        $.ajax('/basket/add', {
            type: 'POST',  // http method
            data: {
                product_id: productId,
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

    likeProduct: function (productId) {
        $.ajax('/product/like', {
            type: 'POST',  // http method
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data, status, xhr) {
                element = $("button.like-product[product-id=" + productId + "]");
                element.off('click');
                element.text('unlike');
                element.removeClass('like-product');
                element.addClass('unLike-product');
                element.on('click', function () {
                    productId = $(this).attr('product-id');
                    homePage.unLikeProduct(productId)

                })
            },
            error: function (jqXhr, textStatus, errorMessage) {

            }
        })

    },


    unLikeProduct: function (productId) {
        $.ajax('/product/unlike', {
            type: 'POST',  // http method
            data: {
                product_id: productId,
                _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (data, status, xhr) {
                element = $("button.unLike-product[product-id=" + productId + "]");
                element.off('click');
                element.text('like');
                element.removeClass('unLike-product');
                element.addClass('like-product');
                element.on('click', function () {
                    productId = $(this).attr('product-id');
                    homePage.likeProduct(productId)

                })
            },
            error: function (jqXhr, textStatus, errorMessage) {

            }
        })

    },


}
