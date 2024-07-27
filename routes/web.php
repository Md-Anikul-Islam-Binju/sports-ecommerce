<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\ManufactureController;
use App\Http\Controllers\admin\OrderManageController;
use App\Http\Controllers\admin\OtherSettingController;
use App\Http\Controllers\admin\PartnerController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\UserMessageManageController;use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\ContactUsController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\OrderController;
use App\Http\Controllers\frontend\OrderInfoAndReviewController;use App\Http\Controllers\frontend\OthersController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\ProductManageController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\WishlistController;
use Illuminate\Support\Facades\Route;



//Home page
Route::get('/', [FrontendController::class, 'index']);
//Product Details Page
Route::get('/product-details/{id}', [ProductManageController::class, 'productDetails'])->name('frontend.product.details');

//All Product
Route::get('/all-product/{category?}/{subcategory?}', [ProductManageController::class, 'allProducts'])->name('frontend.all.product');


//Add to Cart & Cart Page show
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.item.remove');
Route::get('/checkout/order', [CartController::class, 'checkout'])->name('checkout.order');

//Guest Order
Route::get('/checkout-as-gust/order', [CartController::class, 'checkoutAsGust'])->name('checkout.as.gust.order');
Route::post('/checkout-as-gust', [OrderController::class, 'placeGuestOrder'])->name('order.place.as.gust');
Route::get('/order/success/gust/{order}/{password}', [OrderController::class, 'guestOrderSuccess'])->name('order.success.as.gust');



//user login
Route::get('/user/login', [UserController::class, 'userLogin'])->name('user.login');
//user login post
Route::post('/user/login', [UserController::class, 'userLoginPost'])->name('user.login.post');
//user register
Route::get('/user/register', [UserController::class, 'userRegister'])->name('user.register');
//user register post
Route::post('/user/register', [UserController::class, 'userRegisterPost'])->name('user.register.post');
//contact
Route::get('/contact-us', [ContactUsController::class, 'contactUs'])->name('user.contact.us');
//contact store
Route::post('/contact-us-store', [ContactUsController::class, 'storeMessage'])->name('user.contact.store');
//terms condition
Route::get('/terms-condition', [OthersController::class, 'termsCondition'])->name('user.terms.condition');
//privacy policy
Route::get('/privacy-policy', [OthersController::class, 'privacyPolicy'])->name('user.privacy.policy');
//return policy
Route::get('/return-policy', [OthersController::class, 'returnPolicy'])->name('user.return.policy');
//faq
Route::get('/faq', [OthersController::class, 'FAQ'])->name('user.faq');
//about
Route::get('/about-us', [OthersController::class, 'aboutUs'])->name('user.about.us');
//wishlist
Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('wishlist.toggle');
Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
//customized product
Route::get('/customize-product', [ProductManageController::class, 'customizeProduct'])->name('frontend.customize.product');



Route::middleware(['auth'])->group(function () {
    Route::middleware(['admin'])->prefix('admin')->group(function () {

        //Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        //Slider
        Route::get('/slider', [SliderController::class, 'index'])->name('admin.slider');
        Route::post('/slider-store', [SliderController::class, 'store'])->name('admin.slider.store');
        Route::put('/slider-update/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
        Route::get('/slider-delete/{id}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');

        //category
        Route::get('/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::post('/category-store', [CategoryController::class, 'store'])->name('admin.category.store');
        Route::put('/category-update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
        Route::get('/category-delete/{id}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
        Route::get('/categories/{id}/sub-categories', [CategoryController::class, 'getSubCategories'])->name('admin.categories.sub.categories');


        //category
        Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('admin.sub.category');
        Route::post('/sub-category-store', [SubCategoryController::class, 'store'])->name('admin.sub.category.store');
        Route::put('/sub-category-update/{id}', [SubCategoryController::class, 'update'])->name('admin.sub.category.update');
        Route::get('/sub-category-delete/{id}', [SubCategoryController::class, 'destroy'])->name('admin.sub.category.destroy');

        //size
        Route::get('/size', [SizeController::class, 'index'])->name('admin.size');
        Route::post('/size-store', [SizeController::class, 'store'])->name('admin.size.store');
        Route::put('/size-update/{id}', [SizeController::class, 'update'])->name('admin.size.update');
        Route::get('/size-delete/{id}', [SizeController::class, 'destroy'])->name('admin.size.destroy');

        //product
        Route::get('/product', [ProductController::class, 'index'])->name('admin.product');
        Route::post('/product-store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::put('/product-update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::get('/product-delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        //review list
        Route::get('/review-list', [ProductController::class, 'reviewList'])->name('admin.review.list');
        Route::put('/review-update/{id}', [ProductController::class, 'reviewStatusUpdate'])->name('admin.review.update');

        //manufacture
        Route::get('/manufacture', [ManufactureController::class, 'index'])->name('admin.manufacture');
        Route::post('/manufacture-store', [ManufactureController::class, 'store'])->name('admin.manufacture.store');
        Route::put('/manufacture-update/{id}', [ManufactureController::class, 'update'])->name('admin.manufacture.update');
        Route::get('/manufacture-delete/{id}', [ManufactureController::class, 'destroy'])->name('admin.manufacture.destroy');

        //manufacture
        Route::get('/partner', [PartnerController::class, 'index'])->name('admin.partner');
        Route::post('/partner-store', [PartnerController::class, 'store'])->name('admin.partner.store');
        Route::put('/partner-update/{id}', [PartnerController::class, 'update'])->name('admin.partner.update');
        Route::get('/partner-delete/{id}', [PartnerController::class, 'destroy'])->name('admin.partner.destroy');

        //manufacture
        Route::get('/other-setting', [OtherSettingController::class, 'index'])->name('admin.other.setting');
        Route::post('/other-setting-store', [OtherSettingController::class, 'store'])->name('admin.other.setting.store');
        Route::put('/other-setting-update/{id}', [OtherSettingController::class, 'update'])->name('admin.other.setting.update');
        Route::get('/other-setting-delete/{id}', [OtherSettingController::class, 'destroy'])->name('admin.other.setting.destroy');

        //Order Manage
        Route::get('/pending-order', [OrderManageController::class, 'orderPending'])->name('admin.pending.order.manage');
        Route::get('/processing-order', [OrderManageController::class, 'orderProcessing'])->name('admin.processing.order.manage');
        Route::get('/completed-order', [OrderManageController::class, 'orderCompleted'])->name('admin.completed.order.manage');
        Route::get('/decline-order', [OrderManageController::class, 'orderDecline'])->name('admin.decline.order.manage');

        //order details
        Route::get('/order-details/{id}', [OrderManageController::class, 'orderDetails'])->name('admin.order.details');
        //Order Status Update
        Route::post('/order-status-update/{id}', [OrderManageController::class, 'orderStatusUpdate'])->name('admin.order.status.update');
        //invoice
        Route::get('/order-invoice/{id}', [OrderManageController::class, 'invoice'])->name('admin.order.invoice');

        //Site Setting
        Route::get('/site-setting', [SiteSettingController::class, 'index'])->name('admin.site.setting');
        Route::post('/site-settings-store-update/{id?}', [SiteSettingController::class, 'createOrUpdate'])->name('admin.site.settings.createOrUpdate');

        //message
        Route::get('/message', [UserMessageManageController::class, 'message'])->name('admin.message');
    });

    Route::middleware(['user'])->prefix('user')->group(function () {
       //User Dashboard
       Route::get('/my-profile', [UserController::class, 'myProfile'])->name('user.my.profile');
       Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');

       //logout
       Route::post('/user-logout', [UserController::class, 'userLogout'])->name('user.logout');


       Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
       Route::get('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');

       //wishlist remove
       Route::get('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlist'])->name('wishlist.remove');
       //payment
       Route::get('/payment/{order}', [PaymentController::class, 'showPaymentPage'])->name('payment.page');

       //user invoice
         Route::get('/user-invoice/{id}', [UserController::class, 'userInvoice'])->name('user.invoice');

       //Order Info And Review
       Route::get('/order-info-and-review/{id}', [OrderInfoAndReviewController::class, 'orderInfoAndReview'])->name('order.info.review');
       Route::post('/order-review-store', [OrderInfoAndReviewController::class, 'orderReviewStore'])->name('order.review.store');





    });
});
require __DIR__.'/auth.php';
