<?php 
// echo $cartList;
 //echo $cartList;  
 //echo $result;
?>
  <div >
        <table class="table table-striped" >
          <thead>
          <tr> 
                  <th colspan="2"> <h3><i class="glyphicon glyphicon-shopping-cart"></i> My Cart </h3> 
                  </th>
                  <th colspan="3 " class="">
                  <small class="pull-right" >Total Items : <span class="badge lebel-success" style="background-color: #4a9744;">2</span> </small>
                  </th>
              </tr>
            <tr> 
              <th>Image</th>
              <th>Name</th>
              <th>Qty</th>
              <th>Amount</th>
              <th>Total</th>
            </tr>
            </thead>
            <tbody >
           <?php
         $items=json_decode($cartList);
          //print_r($items);
            foreach ($items->cart_result as $cart ) { ?>
          
              <tr>
                  <td>
                  <img src="<?php echo $cart->product_image;?>"
                   style="height:50px;width:50px;" >
                   </td>
                   <td>
                     <?php echo $cart->prod_name;?>
                   </td>
                   <td>
                     <?php echo $cart->qty;?>
                   </td>
                   <td>
                     <?php echo $cart->selling_price;?>
                   </td>
                    <td>
                     <?php
                      $sell_amount= $cart->selling_price;
                      $sell_qty= $cart->qty;
                      echo $sell_qty*$sell_amount;
                     ?>
                   </td>
                </tr>

              <?php }
               ?>
            </tbody>
            <tfoot>
            <tr> 
            <td colspan="10"><button class="btn btn-block btn-info"> View Cart </button></td> 
            </tr>
            </tfoot>
        </table>
  </div>
                            