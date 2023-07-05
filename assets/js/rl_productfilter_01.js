 // alert(basepath);
$('.filters').on('click',function(){
    filters();
});
/*price Sorting Code Start*/
$('#pricesort').on('change',function(){
   filters();
});
/*price Sorting Code End*/
function filters()
{
    var sortvalue=$('#pricesort').val();
    // alert(sortvalue);
   var priceArray=new Array();
   $('input[name="price"]:checked').each(function(){priceArray.push($(this).val());});
   var pricelist=''+priceArray;
   // alert(pricelist);
   
   $.ajax({
       dataType:'html',
       type:'POST',
       data:{'price':pricelist,'sort':sortvalue,'url':location.href},
       url:basepath+'front/Products/productFilter',
       success:function(result)
       {
        console.log(result);
                $('#productslist').empty;
               $('#productslist').html(result);
       },
       error:function(error){console.log(error)}
   });
   /*Ajax code End*/
} 