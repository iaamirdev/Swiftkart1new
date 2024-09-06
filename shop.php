<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="shop.css">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
      include 'user1.php';
    ?>
   <header>
        <nav>
            <a  style="margin-top : 5px;" href="home.php">Home</a>
            <a style="margin-top : 5px;" href="shop.php">Shop</a>
            <a style="margin-top : 5px;" href="my_orders.php">My Orders</a>
            <a style="margin-top : 5px;" href="new_arrivals.html">New Arrivals</a>
            <a style="margin-top : 5px;" href="cart.php">Cart</a>
            <a style="margin-top : 5px;" href="news.php">News</a>
            <input style="border-radius: 20px ; height: 30px; padding: 10px; margin-top: 10px; " type="search" class="search-bar"  placeholder="Search" /> 
            <div class="dropdown">
                <button style="margin-top: 0px;"><img src="image/user.png" height="30px" width="30px"></button>
                <div class="dropdown-content">
                    <?php include 'user2.php'; ?>
                    <a href="#">Learn More</a>
                </div>
            </div>
            <?php include 'user3.php'; ?>
        </nav>
    </header>
    <div class="sinput1">
        <div class="sinput2">
            <input id="shopinputid" class="sinput3" type="text" placeholder="Search your phone" name="dynamicphone">
        </div>
    </div>
 <div class="shop1">
  <div class="shop2"> 
   

  </div>
 </div>
 <script>
    $(document).ready(function(){
        $.ajax({
            url:'getshop.php',
            method:'POST',
            success:function(response){
                $('.shop2').html(response);

             
                $('.shop2').on('click','.add-to-cart',function(){
                var productId=$(this).data('id');
                $.ajax({
                         url:'add_to_cart.php',
                         method:'POST',
                        data:{id:productId},
                        success:function(response){
                           alert(response);
                }
        });
     });


            }
        });
  
      $('#shopinputid').on('input',function(){
        var shopinput1=$(this).val().trim();
        if(shopinput1.length>0){
        $.ajax({
            url:'getshopitems.php',
            method:'POST',
            data:{dynamicphone:shopinput1},
            success:function(response){
                if(response.trim()!==''){
                $('.shop2').html(response);
            }
            }
        });
    }
      });
    //
    
    });

 </script>
</body>
</html>