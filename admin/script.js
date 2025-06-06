$(document).ready(function () {
  $("#btn").click(function (e) {
    e.preventDefault();

    // Clear error on change or keyup
    $("input").on("keyup change", function () {
      $(this).parent().find(".error").text("");
    });

    // Get values
    var productName = $("#productName").val().trim();
    var fileInput = $("#myFile")[0];
    var file = fileInput.files[0];
    var model = $("#model").val().trim();
    var colour = $("#colour").val().trim();
    var priceInput = $("#price").val().trim();
    // var qtyInput = $("#qty").val().trim();

    var price = parseInt(priceInput);
    // var qty = parseInt(qtyInput);

    var flag = false;

    // Validation
    if (productName === "") {
      $("#productNameError").text("Product name is required");
      flag = true;
    }

    if (!file) {
      $("#myFileError").text("Please select an image file");
      flag = true;
    }

    if (model === "") {
      $("#modelError").text("Model name is required");
      flag = true;
    }

    if (colour === "") {
      $("#colourError").text("Color is required");
      flag = true;
    }

    if (priceInput === "") {
      $("#priceError").text("Price is required");
      flag = true;
    } else if (isNaN(price) || price <= 0) {
      $("#priceError").text("Please enter a valid positive number for price");
      flag = true;
    }

    /* if (qtyInput === "") {
      $("#qtyError").text("Quantity is required");
      flag = true;
    } else if (isNaN(qty) || qty < 1 || qty > 5) {
      $("#qtyError").text("Please enter quantity between 1 and 5");
      flag = true;
    } */

    if (!flag) {
      var formData = new FormData();
      formData.append("productName", productName);
      formData.append("model", model);
      formData.append("colour", colour);
      formData.append("price", price);
      formData.append("myFile", file);
      //formData.append("qty", qty);
      formData.append("action", "upload");

      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.code === 200) {
            $("#responseMsg")
              .text(response.message)
              .css("color", "green");

            setTimeout(function () {
              location.reload();
            }, 2500);
          } else if(response.code === 500) {
            $("#responseMsg")
              .text(response.message)
              .css("color", "red");
          }
        },
        error: function () {
          $("#responseMsg")
            .html("Error while submitting")
            .css("color", "red");
        },
      });
    }
  });
});
