<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Input;
use App\Product;


Route::any('/search', function () {
    $q = Input::get('q');
   
    if($q != ""){
    
      $producut =Product::where('name','Like', "%" . $q . "%")
                     ->orwhere('description','Like', "%" . $q . "%")
                     ->get();
     
                     if(count($producut)>0){
                               
                         return view('shopping')->withDetails($producut)->withQuery($q);
                     }
                    
                    
    }
    return view('shopping')->withMessage("no user data");
 });
 
Route::get('/', function () {
    return view('welcome');
});

Route::any('dashboard','Signin@dashboard');

Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add');
//->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index');

Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy');
Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout');
Route::resource('orders', 'OrderController');

Route::get('paypal/checkout/{order}', 'PayPalController@getExpressCheckout')->name('paypal.checkout');
Route::get('paypal/checkout-success/{order}', 'PayPalController@getExpressCheckoutSuccess')->name('paypal.success');
Route::get('paypal/checkout-cancel', 'PayPalController@cancelPage')->name('paypal.cancel');

/////////

Route::any('wel', 'PayPalController@wel')->name('wel');
Route::get('payment', 'PayPalController@payment')->name('payment');
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
Route::get('payment/success', 'PayPalController@success')->name('payment.success');


/////////
/*
Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/contact', 'HomeController@contact')->name('contact');


Route::get('/products/search', 'ProductController@search')->name('products.search');
Route::resource('products', 'ProductController');

Route::get('/add-to-cart/{product}', 'CartController@add')->name('cart.add')->middleware('auth');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('/cart/destroy/{itemId}', 'CartController@destroy')->name('cart.destroy')->middleware('auth');
Route::get('/cart/update/{itemId}', 'CartController@update')->name('cart.update')->middleware('auth');
Route::get('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
Route::get('/cart/apply-coupon', 'CartController@applyCoupon')->name('cart.coupon')->middleware('auth');

Route::resource('orders', 'OrderController')->middleware('auth');

Route::resource('shops','ShopController')->middleware('auth');


Route::get('paypal/checkout/{order}', 'PayPalController@getExpressCheckout')->name('paypal.checkout');
Route::get('paypal/checkout-success/{order}', 'PayPalController@getExpressCheckoutSuccess')->name('paypal.success');
Route::get('paypal/checkout-cancel', 'PayPalController@cancelPage')->name('paypal.cancel');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});*/
