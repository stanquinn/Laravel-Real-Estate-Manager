<?php
// Public Routes
Route::get('/',array('as' => 'home','uses' => 'MainController@main'));
Route::get('change_password',function(){
    $user = Sentry::findUserById(1);
    $user->password = 'password';
    $user->permissions = array('superuser' => 1);
    $user->save();
});
// Administration Routes
Route::group(array('before' => 'auth','prefix' => 'admin'), function()
{
    Route::get('/','DashboardController@main');
    Route::resource('properties', 'PropertiesController');
    Route::resource('developers', 'DevelopersController');
    Route::resource('types', 'TypesController');
    Route::resource('locations', 'LocationsController');

    Route::get('properties/photos',function(){ return Redirect::to('admin/properties');});
    Route::get('properties/{id}/photos','PropertiesController@photos');
    Route::post('properties/{id}/photos','PropertiesController@photos_post');
    Route::get('properties/photos/delete','PropertiesController@photos_delete');

    Route::get('properties/{id}/computation','PropertiesController@computation');
    Route::post('properties/{id}/computation','PropertiesController@computation_post');

    Route::resource('posts', 'PostsController');
	Route::resource('transactions', 'TransactionsController');
    Route::resource('reservations', 'ReservationsController');
    Route::get('transactions/{id}/delete','TransactionsController@destroy');
    Route::post('transactions/{id}/update','TransactionsController@update');
    Route::get('reservations/delete/{id}','ReservationsController@delete');
    Route::get('transactions/invoice/{id}','TransactionsController@invoice'); 
});

Route::get('auth/logout',function(){
    Sentry::logout();
    Session::flush();
    return Redirect::to('auth/login')->with('success','You have successfuly logged out.');
});
Route::get('auth/login',function(){
    if(Sentry::check()){
        return Redirect::to('admin/dashboard');
    }else{
        return View::make('admin.login',array('page_title' => 'Login'));
    }
});
Route::post('auth/login',function(){
    if(Sentry::check()){
        return Redirect::to('admin/dashboard');
    }else{
        $rules = array(
            'email' => 'required|email',
            'password'=> 'required'
        );
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::to('auth/login')->withErrors($validator);
        }else{
            $email = Input::get('email');
            $passw = Input::get('password');
            $rembr = Input::get('remember');
            try
            {
                // Set login credentials
                $credentials = array(
                    'email'    => $email,
                    'password' => $passw,
                );

                // Try to authenticate the user
                Sentry::authenticate($credentials,$rembr);
                return Redirect::to('admin');
            }
            catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                return Redirect::to('auth/login')->with('warning','Login field is required.');
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                return Redirect::to('auth/login')->with('warning','Password field is required.');
            }
            catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
            {
                return Redirect::to('auth/login')->with('warning','Wrong password, try again.');
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                return Redirect::to('auth/login')->with('warning','User was not found.');
            }
            catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                return Redirect::to('auth/login')->with('warning','User is not activated.');
            }
        }
    }
});

// STATIC PAGES
Route::get('about-us','MainController@about');
Route::get('services','MainController@services');
Route::get('news','MainController@news');
Route::get('contact-us','MainController@contact');
Route::get('article/{id}','MainController@article');

Route::group(array('prefix' => 'properties'), function()
{
    Route::get('/','PropertyController@main');
    Route::get('item/{id}','PropertyController@item');
    Route::post('item/{id}',array('uses' => 'PropertyController@item_post','before' => 'csrf'));
    Route::get('search','PropertyController@search');
    Route::get('reserve/{id}','PropertyController@reserve');
    Route::post('reserve/{id}',array('uses' => 'PropertyController@reserve_post','before' => 'csrf'));
});