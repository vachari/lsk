<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'front/Pages';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* my routes urls starts hear */
/*
 * ## Cart related code start 
 */
$route['addtocart'] = 'front/Cart/add_to_mycart';
$route['basket'] = 'front/Basket';
$route['addtobasket'] = 'front/Basket/addtobasket';
$route['addall_basket'] = 'front/basket/add_all_item';
$route['removeBasket/(:any)'] = 'front/Basket/removebasketlist';
/*
 * ## Cart related code end 
 */
#welcome controller for Front End
$route['front'] = 'front/Pages/index';
$route['about'] = 'front/Pages/about';
$route['register'] = 'front/Pages/register';
$route['signin'] = 'front/Pages/login';
$route['logout'] = 'front/Pages/logout';
$route['terms'] = 'front/Pages/terms';
$route['privacy-policy'] = 'front/Pages/privacyPolicy';
$route['refund-policy'] = 'front/Pages/refundPolicy';
$route['cancellation-policy'] = 'front/Pages/cancellationPolicy';
$route['productDetails/(:any)'] = 'front/Pages/product_view';
$route['faq'] = 'front/Pages/faq';
$route['contact'] = 'front/Pages/contact';
$route['power-user-register'] = 'front/Pages/powerUserRegister';
$route['cart'] = 'front/Cart/cartList';
$route['checkout'] = 'front/Checkout';
$route['checkout/(:any)'] = 'front/Checkout';
$route['shipping/(:any)'] = 'front/Checkout/shipping';



// $route['products-sub/(.*)']='front/Products/getSub';
// $route['products-list/(.*)']='front/Products/getlistSub';
$route['search'] = 'front/Products/product_name';
$route['products'] = 'front/Products/product_name';
$route['products/(:any)'] = 'front/Products/product_name';
$route['products/(:any)/(:any)'] = 'front/Products/getMenus';
$route['products/(:any)/(:any)/(:any)'] = 'front/Products/getSub';
$route['products/(:any)/(:any)/(:any)/(:any)'] = 'front/Products/getlistSub';
$route['share_to_cart/(:any)'] = 'front/Cart/share_to_cart'; //Updated by Zabihullah Sirat


$route['profile'] = 'front/User/profile';
$route['myorders'] = 'front/User/myorders';
$route['mywallet'] = 'front/User/mywallet';
$route['sharedcart'] = 'front/User/sharedcart';
$route['user_sharedcart'] = 'front/User/user_sharedcart';
$route['mysaving'] = 'front/User/mysaving';
$route['wishlist'] = 'front/User/wishlist';
$route['removeWish/(:any)'] = 'front/User/removewishlist';
$route['addressbook'] = 'front/User/addressbook';
$route['changepassword'] = 'front/User/changepassword';
$route['help'] = 'front/User/help';
$route['orderview/(:any)/(:any)'] = 'front/User/myorder_view';
$route['sharecart_view/(:any)'] = 'front/User/sharecart_view';
$route['user_sharecart_view/(:any)'] = 'front/User/user_sharecart_view';
$route['cancelOrder/(:any)/(:any)'] = 'front/Orders/cancelOrder';
$route['remove_item/(:any)/(:any)'] = 'front/Orders/remove_order_items'; //Zabih
$route['addFollowers'] = 'front/User/addFollower';
$route['viewFollowers'] = 'front/User/viewFollower';
$route['user/activeUserAccount/(:any)'] = 'front/User/activeUserAccount';
$route['poweruser/activeUserAccount/(:any)'] = 'front/User/activeUserAccount';
$route['poweruser/PowerUserVerify/(:any)'] = 'front/User/PowerUserVerify';

$route['follower-request-link'] = 'front/User/follower_request_verify';
$route['follower-request-link/(:any)'] = 'front/User/follower_request_verify';
$route['poweruser-request-link'] = 'front/User/poweruser_request_verify';
$route['poweruser-request-link/(:any)'] = 'front/User/poweruser_request_verify';
$route['Followers'] = 'front/User/followers';
$route['power-users'] = 'front/User/power_users';
$route['forgot-password'] = 'front/User/forgotPassword';
$route['sending-reset-password-link'] = 'front/User/sendingResetPasswordLink';
$route['reset-password/(:any)'] = 'front/User/resetPassword/';
$route['resetting-password'] = 'front/User/resettingPassword';
// $route['logout']='front/Welcome/logout';
// $route['forgot']='front/Welcome/forgot_password';

// #user controller 
// $route['changepassword']='user/change_password';
// $route['profile']='user/profile';
// $route['address']='user/address_book';
// $route['master']='user/Welcome/index';

/* super admin roots */
$route['superadmin'] = 'superadmin/Admin/index';
$route['superadmin/login'] = 'superadmin/Admin/login';
$route['superadmin/dashboard'] = 'superadmin/Admin/dashboard';
$route['superadmin/menu/'] = 'superadmin/Category/';
$route['superadmin/changePassword'] = 'superadmin/Category/changePassword/';
$route['superadmin/menu/createmenu'] = 'superadmin/Category/createmenu';
$route['superadmin/menu/managemenus'] = 'superadmin/Category/managemenu/';
$route['superadmin/submenu/createsubmenu'] = 'superadmin/Category/createsubmenu';
$route['superadmin/submenu/managesubmenus'] = 'superadmin/Category/managesubmenu/';
$route['superadmin/listmenu/createsublistmenu'] = 'superadmin/Category/createsublistmenu';
$route['superadmin/listmenu/managesublistmenus'] = 'superadmin/Category/managesublistmenu/';
$route['superadmin/slider/createslider'] = 'superadmin/Category/createslider';
$route['superadmin/slider/manageslider'] = 'superadmin/Category/manageslider/';
$route['superadmin/product/createproduct'] = 'superadmin/Category/createproduct';
$route['superadmin/product/manageproducts'] = 'superadmin/Category/manageproducts/';

$route['superadmin/standardusers'] = 'superadmin/Users/viewStandardUsers';
$route['superadmin/powerusers'] = 'superadmin/Users/viewPowerUsers';
$route['superadmin/viewfollowers/(:any)'] = 'superadmin/Users/viewFollower';
$route['superadmin/poweruser/approve/(:any)/(:any)/(:any)'] = 'superadmin/Users/powerApprovel';


$route['superadmin/guestusers'] = 'superadmin/Users/viewGuestUsers';


$route['superadmin/updatemenu/(:any)'] = 'superadmin/Category/get_menu';
$route['superadmin/deletemenu/(:any)'] = 'superadmin/Category/delete_menu';

$route['superadmin/updatesubmenu/(:any)'] = 'superadmin/Category/get_sub_menu';
$route['superadmin/deletesubmenu/(:any)'] = 'superadmin/Category/delete_sub_menu';

$route['superadmin/updatelistsubmenu/(:any)'] = 'superadmin/Category/get_listsubmenu';
$route['superadmin/deletelistsubmenu/(:any)'] = 'superadmin/Category/delete_listsubmenu';

$route['superadmin/updateslider/(:any)'] = 'superadmin/Category/';
$route['superadmin/deleteslider/(:any)'] = 'superadmin/Category/';
$route['superadmin/manage_cancelled_orders'] = 'superadmin/Orders/manage_cancelled_orders';
$route['superadmin/manage_cancelled_orders/(:any)'] = 'superadmin/Orders/manage_cancelled_orders';
$route['superadmin/Orders/(:any)'] = 'superadmin/Orders';
//Update By:Zabih
//New Updates By Zabihullah
$route['hello'] = 'front/display_message/hello';
/****** vendor routing ******/



/*=======================================================================*/
/****** shipper routing ******/

$route['shipper/verification/(:any)'] = 'front/Shipper/verification/';
$route['shipper'] = 'front/Shipper/index';
$route['shipper/login'] = 'front/Shipper/login';
$route['shipper/logging'] = 'front/Shipper/logging_in';
$route['shipper/logout'] = 'front/Shipper/logout';
$route['shipper/dashboard'] = 'front/Shipper/dashboard';
$route['shipper/change-password'] = 'front/Shipper/changePassword';
$route['shipper/changging-password'] = 'front/Shipper/changging_password';
$route['shipper/forgot-password'] = 'front/Shipper/forgotPassword';
$route['shipper/sending-reset-password-link'] = 'front/Shipper/sendingResetPasswordLink';
$route['shipper/reset-password/(:any)'] = 'front/Shipper/resetPassword/';
$route['shipper/resetting-password'] = 'front/Shipper/resettingPassword';
$route['shipper/profile'] = 'front/Shipper/profile';
$route['shipper/profile-update'] = 'front/Shipper/profileUpdate';
$route['shipper/profile-updating'] = 'front/Shipper/profileUpdating';
$route['shipper/manage-shipping-cost'] = 'front/Shipper/manage_shipping_cost';
$route['shipper/manage-shipping-cost/(:any)'] = 'front/Shipper/manage_shipping_cost/';
$route['shipper/search-shipping-cost'] = 'front/Shipper/search_shipping_cost';
$route['shipper/search-shipping-cost/(:num)'] = 'front/Shipper/search_shipping_cost/';
$route['shipper/edit-shipping-cost'] = 'front/Shipper/edit_shipping_cost';
$route['shipper/edit-shipping-cost/(:any)'] = 'front/Shipper/edit_shipping_cost/';
$route['shipper/shipping-cost-updating'] = 'front/Shipper/shippingCostUpdating';
$route['shipper/manage-shipping-orders'] = 'front/Shipper/manage_shipping_orders';
$route['shipper/manage-shipping-orders/(:any)'] = 'front/Shipper/manage_shipping_orders/';
$route['shipper/order-details/(:any)'] = 'front/Shipper/viewOrderDetails/';
$route['shipper/edit-shipping-order/(:any)'] = 'front/Shipper/edit_shipping_order/';
$route['shipper/shipping-order-updating'] = 'front/Shipper/shippingOrderUpdating';

/*User API's relted code section code start */
$route['api/professionlist'] = 'api/User/professionList';
$route['api/signup'] = 'api/User/userRegister';
$route['api/login'] = 'api/User/userLogin';
$route['api/profile'] = 'api/User/userProfile';
$route['api/forgot-password'] = 'api/User/forgotPassword';
$route['api/change-password'] = 'api/User/changePassword';
$route['api/update-profile'] = 'api/User/updateProfile';
$route['api/logout'] = 'api/User/logoutUserFromDevice';
/*User API's relted code section code End */
$route['car-deals'] = 'front/Pages/carDeals';
