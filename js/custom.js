$(document).ready(function(){
    $("#searchbox").keyup(function(){
        var text = $("#searchbox").val();
        $.ajax({
            url: "search.php",
            method: "POST",
            data: {text: text},
            success:function(data){
                $(".results").html(data);
            }
        });
    });

    // add to cart logic
    $(".add-cart-btn").click(function(event){
        event.preventDefault();
        var id = $(this).val();

        $.ajax({
            url: "functions/handlecart.php",
            method: "POST",
            data:{"id": id},
            success: function(response){
                if(response == 401){
                    alertify.set('notifier','position', 'top-right');
                    alertify.success('Login first');
                }else if(response == 201){
                    alertify.set('notifier','position', 'top-right');
                    alertify.success("Product added to the cart");
                }else if(response == 500){
                    alertify.set('notifier','position', 'top-right');
                    alertify.error("Something Went Wrong");
                }else if(response == "exists"){
                    alertify.set('notifier','position', 'top-right');
                    alertify.success("Product already in cart");
                }
            }
        });
    });
    
});