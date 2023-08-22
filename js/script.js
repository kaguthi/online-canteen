$(document).ready(function(){
     $(".increment-btn").click(function(event){
        event.preventDefault();
        var qty = $(this).closest(".product-data").find(".input-qty").val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value < 10){
            value++;
            $(this).closest(".product-data").find(".input-qty").val(value);
        }
     })
     $(".decrement-btn").click(function(event){
        event.preventDefault();
        var qty = $(this).closest(".product-data").find(".input-qty").val();

        var value = parseInt(qty, 10);
        value = isNaN(value) ? 0 : value;
        if(value > 1){
            value--;
            $(this).closest(".product-data").find(".input-qty").val(value);
        }
     });

    //  update the quantity on the cart page
    $(document).on('click', '.updateQty', function(){
        var qty = $(this).closest(".product-data").find(".input-qty").val();
        var product_id = $(this).closest(".product-data").find(".prodId").val();

        $.ajax({
            method: "POST",
            url: "functions/update.php",
            data:{
                "qty": qty,
                "product_id": product_id
            },
            success:function(response){
                
            }
        });
    });
});