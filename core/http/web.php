<?php

use kapcco\core\Route;

//Routes for the auth contoller
Route::post('/kapcco/', 'kapcco\controller\AuthController@index');
Route::post('/kapcco/auth/register/', 'kapcco\controller\AuthController@render_register_view');
Route::post('/kapcco/auth/login/', 'kapcco\controller\AuthController@index');
Route::post('/kapcco/auth/create-profile/', 'kapcco\controller\AuthController@render_create_profile_view');
Route::post('/kapcco/auth/login/sign-in/', 'kapcco\controller\AuthController@sign_in_user');
Route::post('/kapcco/auth/create-account/', 'kapcco\controller\AuthController@create_account');
Route::post('/kapcco/image-upload/', 'kapcco\controller\AuthController@upload_photo');
Route::post('/kapcco/auth/check-nin/', 'kapcco\controller\AuthController@check_nin');
Route::post('/kapcco/auth/check-email/', 'kapcco\controller\AuthController@check_email');
Route::post('/kapcco/auth/check-password/', 'kapcco\controller\AuthController@check_password');
Route::post('/kapcco/auth/change-password/', 'kapcco\controller\AuthController@change_password');
Route::post('/kapcco/auth/save-profile/', 'kapcco\controller\AuthController@save_profile');
Route::post('/kapcco/auth/update-profile/', 'kapcco\controller\AuthController@update_profile');
Route::post('/kapcco/auth/user/profile/update-photo/', 'kapcco\controller\AuthController@update_photo');
Route::post('/kapcco/auth/sign-out/', 'kapcco\controller\AuthController@sign_out');
Route::post('/kapcco/auth/user/profile/', 'kapcco\controller\AuthController@render_show_profile_view');

//routes for DashboardController
Route::post('/kapcco/dashboard/', 'kapcco\controller\DashboardController@index');
Route::post('/kapcco/dashboard/add-collection/', 'kapcco\controller\DashboardController@render_add_collection_view');
Route::post('/kapcco/dashboard/collections/', 'kapcco\controller\DashboardController@render_collections_view');
Route::post('/kapcco/dashboard/branches/', 'kapcco\controller\DashboardController@render_branches_view');
Route::post('/kapcco/dashboard/zones/', 'kapcco\controller\DashboardController@render_zones_view');
Route::post('/kapcco/dashboard/reports/branch-store/', 'kapcco\controller\DashboardController@render_branch_stores_reports_view');
Route::post('/kapcco/dashboard/farmers/', 'kapcco\controller\DashboardController@get_all_farmers_view');
Route::post('/kapcco/dashboard/farmers/u/', 'kapcco\controller\DashboardController@render_farmers_view');
Route::post('/kapcco/dashboard/farmers/approve/', 'kapcco\controller\DashboardController@approve_all');
Route::post('/kapcco/dashboard/farmers/assign/', 'kapcco\controller\DashboardController@assign_all');
Route::post('/kapcco/dashboard/farmers/drop-assignments/', 'kapcco\controller\DashboardController@drop_all_assignments');
Route::post('/kapcco/collections/u/my-collections/', 'kapcco\controller\DashboardController@render_my_collections_view');
Route::post('/kapcco/collections/info/', 'kapcco\controller\DashboardController@render_my_collections_info_view');

//routes for BranchController
Route::post('/kapcco/dashboard/branches/add/', 'kapcco\controller\BranchController@add_branch');
Route::post('/kapcco/dashboard/branches/edit/', 'kapcco\controller\BranchController@edit_branch');
Route::post('/kapcco/dashboard/branches/delete/', 'kapcco\controller\BranchController@delete_branch');

//routes for ZonesController
Route::post('/kapcco/dashboard/zones/add/', 'kapcco\controller\ZonesController@add_zone');
Route::post('/kapcco/dashboard/zones/edit/', 'kapcco\controller\ZonesController@edit_zone');
Route::post('/kapcco/dashboard/zones/delete/', 'kapcco\controller\ZonesController@delete_zone');
Route::post('/kapcco/dashboard/zones/get-zones-by-id/', 'kapcco\controller\ZonesController@get_zones_by_id');
Route::post('/kapcco/dashboard/zones/get-farmers-by-store-id/', 'kapcco\controller\ZonesController@get_farmers_by_store_id');
Route::post('/kapcco/dashboard/zones/get-farmers-collections/', 'kapcco\controller\ZonesController@get_farmer_collections');
Route::post('/kapcco/dashboard/zones/get-farmers-collections-only/', 'kapcco\controller\ZonesController@get_farmer_collections_only');

//routes for CollectionsController
Route::post('/kapcco/dashboard/colllections/add-season/', 'kapcco\controller\CollectionsController@save_season');
Route::post('/kapcco/dashboard/colllections/set-price-scale/', 'kapcco\controller\CollectionsController@set_price_scale');
Route::post('/kapcco/dashboard/colllections/get-product-unit-price/', 'kapcco\controller\CollectionsController@get_product_unit_price');
Route::post('/kapcco/dashboard/colllections/add/', 'kapcco\controller\CollectionsController@add_collection');

?>