myOrder = {
    init: function () {

        $('.show-order').click(function () {
            orderId = $(this).attr("order-id")
            myOrder.getOrderProducts(orderId)

        })
    },
    getOrderProducts: function (order_id) {
        $.ajax('/order/products', {
            type: "GET",
            data: {
                order_id: order_id
            },
            success: function (data, status) {
                orderProducts = data.orderProducts;

                html = "<div><table><thead>\n" +
                    "    <tr>\n" +
                    "        <th>id</th>\n" +
                    "        <th>number</th>\n" +
                    "        <th>name</th>\n" +
                    "    </tr>\n" +
                    "    </thead>\n" +
                    "    <tbody>";


                orderProducts.forEach(function (orderProduct) {
                    console.log(orderProduct)
                    html += "<tr>";
                    html += "<td>" + orderProduct.product_id + "</td>";
                    html += "<td>" + orderProduct.number + "</td>";
                    html += "<td>" + orderProduct.name + "</td>";
                    html += "</tr>"
                })


                html += "</tbody></table>" +
                    "</div>";

                $("button[order-id=" + order_id + "]").after(html);
            },
            error: function () {
                alert('error')
            }

        })
    }
}
