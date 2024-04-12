$(document).ready(function () {
  $(".increment-btn").click(function (e) {
    e.preventDefault();
    var qty = $("input-qty").val();
    alert(qty);
  });
});
console.log("hello");
