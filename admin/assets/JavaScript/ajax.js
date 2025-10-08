$().ready(function () {
  $("#btn_add").click(function () {
    let name = $("#inp").val().trim();
    if (name !== "") {
      $.ajax({
        url: "../controller/add_cat.php",
        method: "post",
        dataType: "html",
        data: {
          name,
          action: "add",
        },
        success: function () {
          location.reload();
        },
      });
    } else {
      $("#p_mess").html("Field to add category");
    }
  });
  $(".btn_upd").click(function () {
    let id = $(this).closest("tr").attr("id");
    let new_text = $(this)
      .parents("tr")
      .find("td[contenteditable]")
      .text()
      .trim();
    if (new_text != "") {
      $.ajax({
        url: "../controller/add_cat.php",
        method: "post",
        dataType: "html",
        data: {
          id,
          new_text,
          action: "update",
        },
        success: function () {
          location.reload();
        },
      });
    } else {
      $("#p_mess").html("Field to update category");
    }
  });
  $(".btn_del").click(function () {
    let id = $(this).closest("tr").attr("id");
    $.ajax({
      url: "../controller/add_cat.php",
      method: "post",
      dataType: "html",
      data: {
        id,
        action: "delete",
      },
      success: function () {
        location.reload();
      },
    });
  });
});
