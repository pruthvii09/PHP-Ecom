$(document).ready(function () {
  $(".increment-btn").click(function (e) {
    console.log("hello");
    e.preventDefault();
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;
    if (value < 10) {
      value++;
      $(this).closest(".product_data").find(".input-qty").val(value);
    }
  });
  $(".decrement-btn").click(function (e) {
    console.log("hello");
    e.preventDefault();
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 0) {
      value--;
      $(this).closest(".product_data").find(".input-qty").val(value);
    }
  });
  $(".addToCart").click(function (e) {
    console.log("hello");
    e.preventDefault();
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var prod_id = $(this).val();
    $.ajax({
      method: "POST",
      url: "functions/handlecart.php",
      data: {
        prod_id: prod_id,
        prod_qty: qty,
        scope: "add",
      },
      success: function (response) {
        console.log("Hi");
        if (response === 201) {
          alert("Prodcut added to cart");
          alertify.success("Prodcut added to cart");
        } else if (response == 401) {
          alert("Login to continue");
          alert("Login to continue");
        } else if (response == 500) {
          console.log("jii");
          alertify.success("something went wrong");
        } else if (response == "Exisiting") {
          alert("Product already in cart..");
        }
      },
    });
  });

  $(document).on("click", ".updateQty", function () {
    var qty = $(this).closest(".product_data").find(".input-qty").val();
    var prod_id = $(this).closest(".product_data").find(".prodId").val();
    $.ajax({
      method: "POST",
      url: "functions/handlecart.php",
      data: {
        prod_id: prod_id,
        prod_qty: qty,
        scope: "update",
      },
      success: function (response) {
        alert(response);
      },
    });
  });
  $(document).on("click", ".deleteItem", function () {
    var cart_id = $(this).val();
    alert(cart_id);
    $.ajax({
      method: "POST",
      url: "functions/handlecart.php",
      data: {
        cart_id: cart_id,
        scope: "delete",
      },
      success: function (response) {
        if (response == 200) {
          alert("Item Deleted Success");
        } else {
          alert("Something went wrong!!");
        }
      },
    });
  });
});
