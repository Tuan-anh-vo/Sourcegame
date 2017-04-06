<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
define('SHOW_DEBUG_BACKTRACE', TRUE);

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
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/* EXTENSION BY ENGINE DIESEL */
define('META_DESC','Tái hiện huyền thoại kiếm hiệp Trung Nguyên. Quần hùng hội tụ - bảo đao Đồ Long -  Hiệu lệnh thiên hạ. Chỉ có tại Đồ Long Ký! Web Game có sự đầu tư về hình ảnh đồ họa của nhân vật, hệ thống Boss đa dạng, Phụ Bản nhiều chưa từng thấy, cuộc chiến giữa các bộ lạc ngày càng lên tới đỉnh cao, cần người lãnh đạo cõi tiên nhân, cùng tham gia thế giới Đồ Long PK để có những khoảng thời gian thư giãn tốt nhất. Và nhận được sự phục vụ tận tình chu đáo nhất từ Nhà Phát hành');
define('META_KEY','đồ long ký, do long ky, minh chủ võ lâm, minh chu vo lam, webgame kiếm hiệp, webgame kiem hiep, webgame võ hiệp, webgame vo hiep, game online moi, y thien do long ky');

//DIR
define('DIR_UPLOAD', 'static/uploads/');
define('DIR_GALLERY', 'static/uploads/gallery/');
define('DIR_GALLERY_CATEGORY', 'static/uploads/gallery/category/');
define('DIR_SHOP', 'static/uploads/shop/');
define('DIR_GALLERY_TMP', 'static/uploads/gallery_tmp/');
define('DIR_UPLOAD_CLASSES', 'static/uploads/classes/');
define('DIR_UPLOAD_EVENTS', 'static/uploads/events/');

define('SERVICE_USER_NAP_TIEN', '12naptien#$');
define('SERVICE_PASS_NAP_TIEN', '!@naptien34');