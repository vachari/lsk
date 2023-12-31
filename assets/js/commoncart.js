$("#wishlist").click(function () {
   if (user_id != '') {
      var _this = $(this);
      var current = _this.attr("src");
      var swap = _this.attr("data-swap");
      _this.attr('src', swap).attr("data-swap", current);

   } else {
      var register = basepath + "register";
      window.location = register;
   }
});


function addWishList(id) {
   alert(id);
   if (user_id != '') {
      $.ajax({
         dataType: 'json',
         type: 'POST',
         async: false,
         data: { 'prod_id': id },
         url: basepath + 'front/User/addWish',
         success: function (wish) {
            alert('Product added to wishlist');
            //alert(wish);  
            // if(u.wish=='200'){
            // $("#my_image").attr("src",basepath+'assets/images/heart-full.png');
            //}  
         },
         error: function (err) {
            console.log(err);

         }
      });
   } else {
      // alert(' Please Login before add to sharecart');
      // alert($(this).attr('href'));
      var register = basepath + "register";
      window.location = register;
      // alert(document.referrer);
   }


}


$(document).ready(function () {
   $("#search").keyup(function () {
      if ($("#search").val().length > 3) {
         $.ajax({
            type: "post",
            url: basepath + 'front/Search/',
            cache: false,
            data: 'search=' + $("#search").val(),
            success: function (response) {
               $('#finalResult').html("");
               var obj = JSON.parse(response);
               if (obj.length > 0) {
                  try {
                     var items = [];
                     $.each(obj, function (i, val) {
                        items.push($('<li/>').text(val.prod_name));
                     });
                     $('#finalResult').append.apply($('#finalResult'), items);
                  } catch (e) {
                     alert('Exception while request..');
                  }
               } else {
                  $('#finalResult').html($('<li/>').text("No Data Found"));
               }

            },
            error: function () {
               alert('Error while request..');
            }
         });
      }
      return false;
   });
});

function addToCart(id, page = null) {
   alert(id);
   var qty = 1;
   if (page == 'description') {
      qty = $('#cartQty').val();
   }

   $.ajax({
      dataType: 'json',
      type: 'POST',
      async: false,
      data: { 'id': id, 'cartType': 1, 'qty': qty },
      url: basepath + 'addtocart',
      success: function (cart) {
         alert(cart.description);
         location.reload();
      },
      error: function (error) {
         console.log(error);
         //alert('Not Added');
      }
   });




}

//This function will delete cart item values from ga_cart_tbl by cartid
function cartRemove(id) {
   $.ajax({
      dataType: 'json',
      type: 'post',
      data: { 'tablename': 'cart', 'updatelist': id, 'user_id': user_id },
      url: basepath + 'front/Cart/cartItemRemove',
      success: function (u) {
         console.log(u);
         if (u.code == '200') {
            alert('Item successfully removed from cart');
            setTimeout(function () { window.location = location.href; }, 2000);
         }
         if (u.code == '204' || u.code == '301' || u.code == '422') { alert('Product could not removed from cart'); }
      },
      error: function (er) {
         console.log(er);
      }
   });
}


