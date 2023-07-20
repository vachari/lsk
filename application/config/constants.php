<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/****************************************************************************************************/
$url_details = $_SERVER['HTTP_HOST'];
$url_details .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);/*For Getting the project(Hosting Name)*/
$final_url = 'http://' . $url_details;
/*--------------------------------------------------------------------------
 *  Project Realted Constants defining here
 ----------------------------------------------------------------------------*/
define('FAVICON_PATH', '');
/*
|--------------------------------------------------------------------------
| RESPONSE Codes(for Developer Purpose)
|--------------------------------------------------------------------------
 */
define('DATE', date('Y-m-d H:i:s'));
define('QUERY_DEBUG', 1);
define('QUERY_MESSAGE', 'query_show');
define('QUERY_DEBUG_MESSAGE', 'query_debug');
define('CODE', 'code');
define('MESSAGE', 'message');
define('DESCRIPTION', 'description');
define('EMAIL_EXISTS', 'emailexists');
define('MOBILE_EXISTS', 'mobileexists');
define('INSERTED_ID', 'inserted_id');
define('DB_ERROR', 'dberror');
define('SUCCESS_CODE', 200);
define('FAIL_CODE', 204);
define('VALIDATION_CODE', 301);
define('EXISTS_CODE', 422);
define('INTERNAL_SERVER_ERROR_CODE', 500);
define('DB_ERROR_CODE', 575);

define('SITE_TITLE', 'LSK & GLOBAL ENTERPRISES');
define('SITE_DOMAIN', $final_url);
define('SITE_EMAIL', "info@lsk.com");

define('APP_EXT', 'api/');
/*
|--------------------------------------------------------------------------
| Super admin Module Code 
|--------------------------------------------------------------------------
 */

define('MASTER_ASSETS', $final_url . 'master_assets/');
define('MASTER_CSS_PATH', MASTER_ASSETS . 'css/');
define('MASTER_JS_PATH', MASTER_ASSETS . 'js/');
define('MASTER_IMAGES_PATH', MASTER_ASSETS . 'images/');
define('MASTER_PATH', $final_url . 'master/');

define('MASTER_HEADER_PATH', 'includes/master_header');
define('MASTER_FOOTER_PATH', 'includes/master_footer');
define('MASTER_SIDEBAR_PATH', 'includes/master_sidebar');
define('MASTER_CSS_INCLUDE_PATH', 'includes/master_css');
define('MASTER_JS_INCLUDE_PATH', 'includes/master_js');
define('MASTER_LOGO', MASTER_IMAGES_PATH . 'logo.png');
define('COMMON_JS_FILE', MASTER_JS_PATH . 'common.js');
/*
|--------------------------------------------------------------------------
| Super admin Module Code   END
|--------------------------------------------------------------------------
 */
/* SUper admin session codes start */
define('MASTER_SESS_CODE', 'LSKGE');


/* my custom defines starts from hear */


define('CSS_PATH', $final_url . 'assets/css/'); //custom css 
define('JS_PATH', $final_url . 'assets/js/'); //custom Js 
define('IMG_PATH', $final_url . 'assets/images/'); //custom Js 
define('SUPER_CSS_PATH', $final_url . 'superadmin_assets/css/'); //custom css 
define('SUPER_JS_PATH', $final_url . 'superadmin_assets/js/'); //custom Js 
define('SUPER_IMG_PATH', $final_url . 'superadmin_assets/images/'); //custom Js 

define('SUPER_ADMIN_FOLDER_PATH', $final_url . 'superadmin/');
define('PRODCUCT_IMAGE_PATH', $final_url . 'uploads/products/');
define('UPLOADS_PATH', $final_url . 'uploads/');

define('EMAIL_TEMPLATE_FOLDER', 'front/templates/');
define('NEW_EMAIL_TEMPLATE_FOLDER', 'front/templates/new_temp/');
define('EMAIL_TEMPLATE_FOLDER_SUPER', 'superadmin/templates/');
define('SITE_MODE', 0);/*1 : LIVE & 0 : LOCALHOST*/
define('SMTP_FROM_EMAIL', 'info@lskoffers.com');
define('SMTP_FROM_NAME', SITE_DOMAIN);
define('BCC_EMAIL', 'achariphp@gmail.com');
define('SMTP_PORT', 465);
define('SMTP_USER', 'info@lskoffers.com');
define('SMTP_PASSWORD', 'LSKOffers@info#2023');
define('SMTP_HOST', 'smtp.hostinger.com');
define('SMTP_PROTOCAL', 'smtp');
define('logo_theme', 'blue');
define('SITE_NAME', 'LSK Enterprises');

define('SUPER_IMG_PATH_LOGO', $final_url . 'superadmin_assets/images/logo.png'); //URL for Logo
define('PROJECT_NAME', 'LSK & GLOBAL ENTERPRISES');
define('PROJECT_SLOGAN', '');
define('PROJECT_TITLE', 'LSK & GLOBAL ENTERPRISES');
define('PROJECT_URL', $final_url);
define('PROJECT_PHONE', '+91-9182900940');
define('PROJECT_UI_TITLE', 'VAV');
define('PROJECT_DEVELOPED_BY', 'CircleTech');
define('PROJECT_DEVELOPED_LINK', 'http://www.circletech.cloud');
define('SUPPORT_EMAIL', 'vachari010@gmail.com');
define('BCC_MAIL', 'achariphp@gmail.com');
define('CC_MAIL', 'achariphp@gmail.com');
define('DEVELOPER_MAIL', 'achariphp@gmail.com');
define('SOCIAL_LINK_FB', 'facebook.com/');
define('SOCIAL_LINK_twitter', 'twitter.com/');
define('ADMIN_HEADER_PATH', '');
define('ADMIN_FOOTER_PATH', '');
define('SUPER_ADMIN_PATH', $final_url . 'Admin/');
define('SLIDER_IMG_PATH', $final_url . 'uploads/slider');

define('ADMIN_MAIL', 'vachari010@gmail.com');

// Superadmin manage views perpage to load records 
define('PER_PAGE', 20);
define('CURRENCY', '₹');
define('ORDER_EXT', 'LSK');
define('RAZORPAY_API_KEY', 'rzp_test_hxaOwRZK5P1vCs');
define('RAZORPAY_API_SECRET_KEY', 'uO9fOhcPrslqRTpXeL9yX8Vm');
define('RAZORPAY_BRAND_NAME', 'LSK Enterprises');
define('RAZORPAY_MODE', 'TEST');
define('PROJECT_LOGO', IMG_PATH . 'lsk-logo.svg');
define('USER_SECURE_CODE', 'LSKUSER');
define('SHIPPING_SECURE_CODE', 'LSKTRANSPORT');
define('PROJECT_SHORT_CODE', 'LSK');
/*CC Avenue Payment Details */
define('CC_AVENUE_MERCHANT_ID', '2576880');
define('CC_AVENUE_ACCESS_CODE', 'AVNH78KF79BJ52HNJB');
define('CC_AVENUE_WORKING_KEY', '523FEAAF52FED812AB333978971AC194');
define('CC_AVENUE_MODE', 'LIVE');
/*CC Avenue Payment Details End*/
