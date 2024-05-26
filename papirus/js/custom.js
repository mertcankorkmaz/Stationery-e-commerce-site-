$(document).ready(function(){

    $(".addToCartBtn").click(function(){
        var url= "http://localhost/shop/sepet_db.php";
        var data={
            p:"addToCart",
            ürün_id:$(this).attr("ürün-id")
        }
        $.post(url,data,function(response){
            
            $(".cart-count").text(response);
           //console.log(response);
           
        })
    })

    $(".removeFromCartbtn").click(function(){
        var url= "http://localhost/shop/sepet_db.php";
        var data={
            p:"removeFromCart",
            ürün_id:$(this).attr("ürün-id")
        }
        $.post(url,data,function(response){
            
        // window.location.reload(); 
        console.log(response);
        })
    }) 

    var url= "http://localhost/shop/sepet_db.php";
    var data={
        p:"getCart",
    }
    $.post(url,data,function(response){
        
        $(".cart-count").text(response);
       
    })
})


