(function ($) {

    "use strict";

    const Cart = {

        routes: {
            add: "/cart/add",
            update: "/cart/update",
            remove: "/cart/remove"
        },

        init() {

            this.add();

            this.plus();

            this.minus();

            this.remove();

        },

        /**
         * Common Ajax Function
         */
        request(url, data) {

            $.ajax({

                url: url,

                type: "POST",

                data: data,

                dataType: "json",

                beforeSend() {

                    $(".cart-loading").show();

                },

                success(response) {

                    if (!response.success) {

                        toastr.error(response.message);

                        return;

                    }

                    Cart.refresh(response);

                    if (response.message) {
                        toastr.success(response.message);
                    }

                },

                error(xhr) {

                    if (xhr.status == 401) {

                        window.location = "/login";

                        return;

                    }

                    if (xhr.status == 422) {

                        $.each(xhr.responseJSON.errors, function (k, v) {

                            toastr.error(v[0]);

                        });

                        return;

                    }

                    toastr.error("Something went wrong.");

                },

                complete() {

                    $(".cart-loading").hide();

                }

            });

        },

        /**
         * Refresh Mini Cart
         */
        refresh(response) {

            $(".site-cart").html(response.html);

            $(".cart-count").text(response.count);

            $(".cart-total").text("Rs " + response.subtotal);

            $(".total-amount").text("Rs " + response.subtotal);

        },

        /**
         * Add To Cart
         */
        add() {

            $(document).on("submit", ".add-to-cart-form", function (e) {

                e.preventDefault();

                Cart.request(

                    $(this).attr("action"),

                    $(this).serialize()

                );

            });

        },

        /**
         * Plus
         */
        plus() {

            $(document).on("click", ".cart-plus", function () {

                Cart.request(

                    Cart.routes.update,

                    {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        product_id: $(this).data("id"),
                        type: "increase"
                    }

                );

            });

        },

        /**
         * Minus
         */
        minus() {

            $(document).on("click", ".cart-minus", function () {

                Cart.request(

                    Cart.routes.update,

                    {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        product_id: $(this).data("id"),
                        type: "decrease"
                    }

                );

            });

        },

        /**
         * Remove
         */
        remove() {

            $(document).on("click", ".cart-remove", function (e) {

                e.preventDefault();

                if (!confirm("Remove this item?")) {

                    return;

                }

                Cart.request(

                    Cart.routes.remove,

                    {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        product_id: $(this).data("id")
                    }

                );

            });

        }

    };

    $(function () {

        Cart.init();

    });

})(jQuery);