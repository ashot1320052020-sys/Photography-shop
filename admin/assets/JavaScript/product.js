$().ready(function () {
  $(".btn_update").click(function () {
    let id = $(this).closest("tr").attr("id");
    let name = $(this).closest("tr").find(".td_name").text().trim();
    let desc = $(this).closest("tr").find(".td_desc").text().trim();
    let price = $(this).closest("tr").find(".td_price").text().trim();
    $.ajax({
      url: "../controller/add_products.php",
      method: "post",
      dataType: "html",
      data: {
        id,
        name,
        desc,
        price,
        action: "update_product",
      },
      success: function () {
        location.reload();
      },
    });
  });
  $(".btn_delete").click(function () {
    let id = $(this).closest("tr").attr("id");
    $.ajax({
      url: "../controller/add_products.php",
      method: "post",
      dataType: "html",
      data: {
        id,
        action: "delete_product",
      },
      success: function () {
        location.reload();
      },
    });
  });
});
