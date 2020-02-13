myFavorite = {
    init: function () {

        // $('.show-favorite').click(function () {
        //     favoriteProductId = $(this).attr("favoriteProduct-id")
        //     myFavorite.getFavoriteProducts(favoriteProductId)
        //
        // })

        $('.unLike-product').click(function () {
            homePage.unLikeProduct(productId)
            $(this).closest("div").remove();
        });



    },
    getFavoriteProducts: function (favoriteProduct_id) {
        $.ajax('/favoriteProducts/favorites', {
            type: "GET",
            data: {
                favoriteProduct_id:favoriteProduct_id
            },
            success: function (data, status) {
                favoriteProducts = data.favoriteProducts;

                html = "<div><table><thead>\n" +
                    "    <tr>\n" +
                    "        <th>id</th>\n" +
                    "        <th>name</th>\n" +
                    "    </tr>\n" +
                    "    </thead>\n" +
                    "    <tbody>";


                favoriteProducts.forEach(function (favoriteProduct) {
                    console.log(favoriteProduct)
                    html += "<tr>";
                    html += "<td>" + favoriteProduct.id + "</td>";
                    html += "<td>" + favoriteProduct.name + "</td>";
                    html += "</tr>"
                })


                html += "</tbody></table>" +
                    "</div>";

                $("button[favoriteProduct-id=" + favoriteProduct_id + "]").after(html);
            },
            error: function () {
                alert('error')
            }

        })
    },

}
