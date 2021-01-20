<?php 

   echo("<div class='form-group'>Shipping address" . 
      "<input class='form-control' type=text placeholder='Address Line 1 *' id=addressLine1>" . 
      "<input class='form-control' type=text placeholder='Address Line 2' id=addressLine2>" . 
      "<input class='form-control' type=text placeholder='City *' id=city>" . 
      "<input class='form-control' type=text placeholder='State *' id=state>" .
      "<input class='form-control' type=text placeholder='Zip Code *' id=zip>" .
      "<h5>Items denoted with a * are required</h5>" .
      "<h5 id='invalid-message' class='bg-danger text-white border rounded d-none'>Please fill in all required fields</h5>" .
      "<button class='btn btn-danger' type=button onclick='goToCart()'>Return to Cart</button>" . 
      "<button class='btn btn-success' type=button onclick='confirmPurchase()'>Confirm Purchase</button>" .
      "</div>"); 

?>