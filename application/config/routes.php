<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']    = 'Home_controller';
$route['404_override']          = '';
$route['translate_uri_dashes']  = FALSE;


$route['(Welcome)/(index)']['get']  = '$1/$2';

$route['(Home)/(index)']['get']  = '$1_controller/$2';

$route['(Blog)/(test)']['get']        = '$1_controller/$2';
$route['(Blog)/(example_1)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_2)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_3)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_4)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_5)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_6)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_7)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_8)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_9)']['get']   = '$1_controller/$2';
$route['(Blog)/(example_10)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_11)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_12)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_13)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_14)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_15)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_16)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_17)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_18)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_19)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_20)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_21)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_22)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_23)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_24)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_25)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_26)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_27)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_28)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_29)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_30)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_31)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_32)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_33)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_34)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_35)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_36)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_37)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_38)']['get']  = '$1_controller/$2';
$route['(Blog)/(example_39)']['get']  = '$1_controller/$2';
