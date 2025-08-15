<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminHomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\StaticPageController;
use App\Http\Controllers\admin\TempImagesController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\DiscountCouponController;
use App\Http\Controllers\admin\UserListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ShopPageController;
use App\Http\Controllers\UserEndController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes for user
// For homepage and common components
Route::get("/", [UserEndController::class, "index"])->name("userend_home");
Route::post("/add-to-wishlist", [UserEndController::class, "add_to_wishlist"])->name("product_add_to_wishlist");
Route::delete("/remove-from-wishlist", [UserEndController::class, "remove_from_wishlist"])->name("product_remove_from_wishlist");
Route::get("/page/{pageSlug}", [UserEndController::class, "static_page"])->name("userend_static_page");
Route::post("/page/contact-us", [UserEndController::class, "send_contact_mail"])->name("userend_send_contact_mail");

// For shop-page
Route::get("/shop/{categorySlug?}/{subCategorySlug?}", [ShopPageController::class, "index"])->name("userend_shoppage");

// For product details page
Route::group(['prefix' => 'product'], function () {
    Route::get("/{productSlug}", [ShopPageController::class, "product_details"])->name("userend_product_details_page");
    Route::post("/submit-rating/{productID}", [ShopPageController::class, "save_rating"])->name("userend_save_rating");
    Route::post("/add-to-cart", [CartController::class, "add_to_cart"])->name("product_add_to_cart");
});

// For cart page
Route::group(['prefix' => 'cart'], function () {
    Route::get("/", [CartController::class, "cart"])->name("userend_cartpage");
    Route::post("/update-cart-quantity", [CartController::class, "update_cart_qty"])->name("userend_update_cart_qty");
    Route::post("/delete-cart-item", [CartController::class, "delete_cart_item"])->name("userend_delete_cart_item");
});

// For user account related
Route::group(['prefix' => 'account'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get("/sign-up", [AuthController::class, "sign_up"])->name("userend_signup_page");
        Route::post("/register", [AuthController::class, "register"])->name("userend_user_register");
        Route::get("/login", [AuthController::class, "login"])->name("userend_login_page");
        Route::post("/authenticate", [AuthController::class, "authenticate"])->name("userend_user_authenticate");
        Route::get("/forgot-password", [AuthController::class, "forgot_password_page"])->name("user_forgot_password_page");
        Route::post("/forgot-password", [AuthController::class, "forgot_password"])->name("user_forgot_password");
        Route::get("/reset-password/{token}", [AuthController::class, "reset_password_page"])->name("user_reset_password_page");
        Route::post("/reset-password", [AuthController::class, "reset_password"])->name("user_reset_password");
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::post("/sign-out", [AuthController::class, "sign_out"])->name("user_sign_out");
        Route::get("/dashboard", [AuthController::class, "dashboard"])->name("user_dashboard");
        Route::put("/update-profile", [AuthController::class, "update_profile"])->name("user_update_profile");
        Route::post("/save-billing-address", [AuthController::class, "save_billing_address"])->name("user_save_billing_address");
        Route::get("/my-orders", [AuthController::class, "orders"])->name("user_orders");
        Route::get("/order-details/{uniqueOrderID}", [AuthController::class, "order_details"])->name("user_order_details");
        Route::get("/my-wishlist", [AuthController::class, "wishlist"])->name("user_wishlist");
        Route::get("/change-password", [AuthController::class, "change_password_page"])->name("user_change_password_page");
        Route::post("/change-password", [AuthController::class, "change_password"])->name("user_change_password");
        Route::post("/delete-profile-picture/{userID}", [AuthController::class, "delete_profile_picture"])->name("user_profile_picture_delete");
    });
});

// For checkout page
Route::group(['middleware' => 'auth'], function () {
    Route::get("/checkout", [CheckoutController::class, "checkout"])->name("userend_checkout_page");
    Route::post("/process-checkout", [CheckoutController::class, "process_checkout"])->name("userend_process_checkout");
    Route::get("/thank-you/{uniqueOrderID}", [CheckoutController::class, "thank_you"])->name("userend_order_successful_page");
    Route::post("/get-order-summary", [CheckoutController::class, "get_order_summary"])->name("userend_get_order_summary");
    Route::post("/apply-discount", [CheckoutController::class, "apply_discount"])->name("userend_apply_discount");
    Route::post("/remove-discount", [CheckoutController::class, "remove_discount"])->name("userend_remove_discount");

    // For Razorpay payment related
    // Route::get("/razorpay-callback", [CheckoutController::class, "razorpay_callback"])->name("userend_razorpay_callback");
});



// Routes for admin
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin_login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin_authenticate');
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        // Routes for dashboard and settings
        Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin_dashboard');
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');
        Route::get('/settings', [SettingsController::class, 'index'])->name('admin_settings');
        Route::post('/settings', [SettingsController::class, 'save_settings'])->name('admin_save_settings');
        Route::get('/change-password', [SettingsController::class, 'change_password_page'])->name('admin_change_password_page');
        Route::post('/change-password', [SettingsController::class, 'change_password'])->name('admin_change_password');

        // Routes for categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin_view_categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin_create_category_page');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin_create_category');
        Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('admin_edit_category');
        Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin_update_category');
        Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('admin_destroy_category');

        // Routes for temporary images
        Route::post('/upload-temp-image', [TempImagesController::class, 'create'])->name('temp_images_create');
        Route::post('/delete-temp-image', [TempImagesController::class, 'delete'])->name('temp_images_delete');

        // Routes for sub-categories
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('admin_view_sub_categories');
        Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('admin_create_sub_category_page');
        Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('admin_create_sub_category');
        Route::get('/sub-categories/edit/{id}', [SubCategoryController::class, 'edit'])->name('admin_edit_sub_category');
        Route::put('/sub-categories/{id}', [SubCategoryController::class, 'update'])->name('admin_update_sub_category');
        Route::delete('/sub-categories/{id}', [SubCategoryController::class, 'destroy'])->name('admin_destroy_sub_category');

        // Routes for brands
        Route::get('/brands', [BrandController::class, 'index'])->name('admin_view_brands');
        Route::get('/brands/create', [BrandController::class, 'create'])->name('admin_create_brand_page');
        Route::post('/brands', [BrandController::class, 'store'])->name('admin_create_brand');
        Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('admin_edit_brand');
        Route::put('/brands/{id}', [BrandController::class, 'update'])->name('admin_update_brand');
        Route::delete('/brands/{id}', [BrandController::class, 'destroy'])->name('admin_destroy_brand');

        // Routes for products
        Route::get('/products', [ProductController::class, 'index'])->name('admin_view_products');
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin_create_product_page');
        Route::post('/products', [ProductController::class, 'store'])->name('admin_create_product');
        Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin_edit_product');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin_update_product');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin_destroy_product');
        Route::post('/products/get-specific-sub-categories', [ProductController::class, 'get_sub_categories_of_category'])->name('get_sub_categories_of_category');
        Route::post('/products/product-image-delete', [ProductController::class, 'delete_product_image'])->name('product_image_delete');
        Route::get('/products/get-products-for-related-products', [ProductController::class, 'get_products_for_related_products'])->name('get_products_for_related_products');
        Route::get('/products/ratings', [ProductController::class, 'product_ratings'])->name('admin_view_product_ratings');
        Route::put('/products/ratings/manage/{ratingID}', [ProductController::class, 'approve_product_rating'])->name('admin_approve_product_rating');
        Route::delete('/products/ratings/delete/{ratingID}', [ProductController::class, 'delete_product_rating'])->name('admin_delete_product_rating');

        // Routes for shipping management
        Route::get('/shippings', [ShippingController::class, 'index'])->name('admin_view_shippings');
        Route::get('/shippings/create', [ShippingController::class, 'create'])->name('admin_create_shipping_page');
        Route::post('/shippings', [ShippingController::class, 'store'])->name('admin_create_shipping');
        Route::get('/shippings/edit/{id}', [ShippingController::class, 'edit'])->name('admin_edit_shipping');
        Route::put('/shippings/{id}', [ShippingController::class, 'update'])->name('admin_update_shipping');
        Route::delete('/shippings/{id}', [ShippingController::class, 'destroy'])->name('admin_destroy_shipping');

        // Routes for discount coupon
        Route::get('/discount-coupons', [DiscountCouponController::class, 'index'])->name('admin_view_discount_coupons');
        Route::get('/discount-coupons/create', [DiscountCouponController::class, 'create'])->name('admin_create_discount_coupon_page');
        Route::post('/discount-coupons', [DiscountCouponController::class, 'store'])->name('admin_create_discount_coupon');
        Route::get('/discount-coupons/edit/{id}', [DiscountCouponController::class, 'edit'])->name('admin_edit_discount_coupon');
        Route::put('/discount-coupons/{id}', [DiscountCouponController::class, 'update'])->name('admin_update_discount_coupon');
        Route::delete('/discount-coupons/{id}', [DiscountCouponController::class, 'destroy'])->name('admin_destroy_discount_coupon');

        // Routes for orders
        Route::get('/orders/list/{startDate?}/{endDate?}', [OrderController::class, 'index'])->name('admin_view_orders');
        Route::get('/orders/{uniqueOrderID}', [OrderController::class, 'order_details'])->name('admin_order_details_page');
        Route::put('/orders/change-order-status/{uniqueOrderID}', [OrderController::class, 'change_order_status'])->name('admin_change_order_status');
        Route::post('/orders/send-invoice-email/{uniqueOrderID}', [OrderController::class, 'send_invoice_email'])->name('admin_send_invoice_email');

        // Routes for user listing
        Route::get('/users/list/{userType?}', [UserListingController::class, 'index'])->name('admin_view_users');
        Route::get('/users/create', [UserListingController::class, 'create'])->name('admin_create_user_page');
        Route::post('/users', [UserListingController::class, 'store'])->name('admin_create_user');
        Route::get('/users/edit/{id}', [UserListingController::class, 'edit'])->name('admin_edit_user');
        Route::put('/users/{id}', [UserListingController::class, 'update'])->name('admin_update_user');
        Route::delete('/users/{id}', [UserListingController::class, 'remove'])->name('admin_remove_user');

        // Routes for static page
        Route::get('/static-pages', [StaticPageController::class, 'index'])->name('admin_view_static_pages');
        Route::get('/static-pages/create', [StaticPageController::class, 'create'])->name('admin_create_static_page_blade');
        Route::post('/static-pages', [StaticPageController::class, 'store'])->name('admin_create_static_page');
        Route::get('/static-pages/edit/{id}', [StaticPageController::class, 'edit'])->name('admin_edit_static_page');
        Route::put('/static-pages/{id}', [StaticPageController::class, 'update'])->name('admin_update_static_page');
        Route::delete('/static-pages/{id}', [StaticPageController::class, 'destroy'])->name('admin_remove_static_page');
    });
});
