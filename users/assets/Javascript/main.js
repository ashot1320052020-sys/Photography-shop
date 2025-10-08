$(document).ready(function () {
  $(".btn_add").on("click", function () {
    let id = $(this).closest(".card").attr("id");
    console.log(id);
    $.ajax({
      url: "../controller/add_to_cart.php",
      method: "post",
      dataType: "json",
      data: {
        id,
        action: "add",
      },
      success: function (res) {
        if (!res.success) {
          // location.href = "../view/login_form.php";
        } else {
          console.log(res);
        }
      },
    });
  });
  $(".btn_remove").on("click", function () {
    let id = $(this).parents("tr").attr("id");
    $.ajax({
      url: "../controller/add_to_cart.php",
      method: "post",
      dataType: "json",
      data: {
        id,
        action: "delete",
      },
      success: function () {
        location.reload();
      },
    });
  });

  $(".plus").on("click", function () {
    let price = parseInt($(this).parents("tr").find(".td_price").html());
    let quant = parseInt($(this).parents("tr").find(".quant").html());
    let id = $(this).parents("tr").attr("id");
    console.log(price, quant, id);
    quant++;
    $(this).parents("tr").find(".quant").html(quant);
    let newSum = quant * price;
    $(this).parents("tr").find(".sum").html(newSum);
    updateTotal();
    $.ajax({
      url: "../controller/add_to_cart.php",
      method: "post",
      data: {
        quant,
        id,
        action: "update",
      },
      success: function (res) {
        let response = JSON.parse(res);
        if (response.status == "success") {
          console.log(response.message);
        } else {
          console.log(response.message);
        }
      },
    });
  });
  $(".minus").on("click", function () {
    let price = parseInt($(this).parents("tr").find(".td_price").html());
    let quant = parseInt($(this).parents("tr").find(".quant").html());
    let id = $(this).parents("tr").attr("id");
    console.log(price, quant, id);
    quant--;
    $(this).parents("tr").find(".quant").html(quant);
    let newSum = quant * price;
    $(this).parents("tr").find(".sum").html(newSum);
    let element = $(this);
    updateTotal();
    $.ajax({
      url: "../controller/add_to_cart.php",
      method: "post",
      data: {
        quant,
        id,
        action: "update",
      },
      success: function (res) {
        if (quant <= 0) {
          element.parents("tr").remove();
        }
        let response = JSON.parse(res);
        if (response.status == "success") {
          console.log(response.message);
        } else {
          console.log(response.message);
        }
      },
    });
  });

  $(".order").on("click", function () {
    $.ajax({
      url: "../controller/buy.php",
      method: "post",
      dataType: "json",
      data: {
        action: "order-item",
      },
      success: function (data) {
        if (data["action"] === "1") {
          $(".success").html(data["message"]);
        } else {
          $(".error").html(data["message"]);
        }
      },
    });
  });

  function updateTotal() {
    let total_price = 0;
    $("tr")
      .find(".sum")
      .each(function () {
        let total = parseInt($(this).text());
        total_price += total;
        $(".total").text(total_price);
      });
  }
});
