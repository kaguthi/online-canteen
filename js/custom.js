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
                    iziToast.success({
                        title: "Success",
                        icon: "bi bi-check2-circle",
                        message: "Login First",
                        position: "topRight"
                    })
                }else if(response == 201){
                    iziToast.success({
                        title: "Success",
                        icon: "bi bi-check2-circle",
                        message: "Product added to the cart",
                        position: "topRight"
                    })
                }else if(response == 500){
                    iziToast.error({
                        title: "Error",
                        icon: 'bi bi-x-circle',
                        message: "Something Went Wrong",
                        position: "topRight"
                    })
                }else if(response == "exists"){
                    iziToast.success({
                        title: "Success",
                        icon: "bi bi-check2-circle",
                        message: "Product already in cart",
                        position: "topRight"
                    })
                }
            }
        });
    });
    
});