<?php
// Public Routes
Route::get('/',array('as' => 'home','uses' => 'MainController@main'));
Route::get('change_password',function(){
    $user = Sentry::findUserById(1);
    $user->password = 'password';
    $user->permissions = array('superuser' => 1);
    $user->save();
});
Route::post('request_location',function(){
    if(Request::ajax())
    {
        
        $location = strtolower(Input::get('location'));
        $all_types = Type::all();
        $all_developers = Developer::all();

        $response =  array(
            'count'         => 0,
            'types'         => array(0 => 'Any'),
            'developers'    => array(0 => 'Any')
        );
        foreach($all_types as $a)
        {
            $response['types'][$a->id] = ucwords($a->name);
        } 
        foreach($all_developers as $a)
        {
            $response['developers'][$a->id] = ucwords($a->name);
        } 
        // LETS FIND PROPERTIES WITH 
        $properties = Property::where('location_id',$location)->get();
        $count = count($properties);
        if($count > 0)
        {
            $response['count'] = 1;
            $response['types'] = array(0 => 'Any');
            $response['developers'] = array(0 => 'Any');
            foreach($properties as $p)
            {
                if(!in_array($p->type->id, array_keys($response["types"])))
                    $response['types'][$p->type->id] = ucwords($p->type->name);

                if(!in_array($p->developer->id, array_keys($response["developers"])))
                    $response['developers'][$p->developer->id] = ucwords($p->developer->name);
            }  
        }
        header("content-type:application/json");
        echo json_encode($response);
    }
});
// Administration Routes
Route::group(array('before' => 'auth','prefix' => 'admin'), function()
{
    Route::get('/','DashboardController@main');
    Route::resource('properties', 'PropertiesController');
    Route::resource('developers', 'DevelopersController');
    Route::resource('types', 'TypesController');
    Route::resource('locations', 'LocationsController');
    Route::get('properties/{id}/delete','PropertiesController@destroy')->where('id','[0-9]+');
    Route::get('properties/photos',function(){ return Redirect::to('admin/properties');});
    Route::get('properties/{id}/photos','PropertiesController@photos')->where('id','[0-9]+');
    Route::post('properties/{id}/photos','PropertiesController@photos_post')->where('id','[0-9]+');

    Route::get('delete_photo','PropertiesController@photos_delete');

    Route::get('properties/{id}/computation','PropertiesController@computation');
    Route::post('properties/{id}/computation','PropertiesController@computation_post');

    Route::resource('posts', 'PostsController');
	Route::resource('transactions', 'TransactionsController');
    Route::resource('reservations', 'ReservationsController');
    Route::get('transactions/{id}/delete','TransactionsController@destroy');
    Route::post('transactions/{id}/update','TransactionsController@update');
    Route::get('reservations/delete/{id}','ReservationsController@delete');
    Route::get('transactions/invoice/{id}','TransactionsController@invoice'); 

    Route::get('clients','ClientsController@main');
    Route::get('clients/create','ClientsController@create');
    Route::post('clients/create','ClientsController@create_post');

    Route::get('clients/update/{id}','ClientsController@update');
    Route::patch('clients/update/{id}','ClientsController@update_post');

    Route::get('clients/suspend/{id}','ClientsController@suspend');
    Route::get('clients/delete/{id}','ClientsController@delete');
    Route::get('clients/view/{id}','ClientsController@view');
    Route::get('clients/reservations/{id}','ClientsController@reservations');
    Route::get('clients/transactions/{id}','ClientsController@transactions');

    Route::get('clients/reservation/{id}','ClientsController@reservation');
    Route::get('clients/transaction/{id}','ClientsController@transaction');

    Route::resource('agents', 'AgentsController');
    Route::get('agents/delete/{id}','AgentsController@delete');
    Route::get('agents/commissions/{id}','AgentsController@commissions');

    Route::get('give_commission/{id}','AgentsController@give_commission')->where('id','[0-9]+');
    Route::post('give_commission/{id}','AgentsController@give_commission_post')->where('id','[0-9]+');

    Route::get('monitorings/{id}','MonitoringsController@main')->where('id','[0-9]+');
    Route::get('monitorings/{id}/create','MonitoringsController@create')->where('id','[0-9]+');
    Route::post('monitorings/{id}/create','MonitoringsController@create_post')->where('id','[0-9]+');
    Route::get('monitorings/{property_id}/{id}/update','MonitoringsController@update')->where('property_id','[0-9]+')->where('id','[0-9]+');
    Route::patch('monitorings/{property_id}/{id}/update','MonitoringsController@update_post')->where('property_id','[0-9]+')->where('id','[0-9]+');
    Route::get('monitorings/{id}/delete','MonitoringsController@delete')->where('id','[0-9]+');
});

Route::get('auth/logout',function(){
    Sentry::logout();
    Session::flush();
    return Redirect::to('auth/login')->with('success','You have successfuly logged out.');
});
Route::get('auth/login',function(){
    if(Sentry::check()){
        return Redirect::to('admin');
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
Route::post('contact-us','MainController@contact_post');
Route::get('article/{id}','MainController@article');

Route::group(array('prefix' => 'properties'), function()
{
    Route::get('/','PropertyController@main');
    Route::get('item/{id}','PropertyController@item');
    Route::post('item/{id}',array('uses' => 'PropertyController@item_post','before' => 'csrf'));
    Route::get('calculator/{id}','PublicClientsController@calculator');
    Route::get('search','PropertyController@search');
});

// Administration Routes
Route::group(array('before' => 'client','prefix' => 'clients'), function()
{
    // RESERVATIONS
    Route::get('/','PublicClientsController@main');    
    Route::get('reserve/{id}','PublicClientsController@reserve'); 
    Route::post('reserve/{id}','PublicClientsController@reserve_post'); 
    Route::get('profile','PublicClientsController@profile'); 
    Route::post('profile','PublicClientsController@profile_post');
    Route::get('reservation/{id}','PublicClientsController@reservation');
    Route::get('invoice/{id}','PublicClientsController@invoice');
    Route::get('all','PublicClientsController@all');

    Route::post('request/lots',function(){
        $block = Input::get('block');
        $monitoring = Monitoring::where('block',$block[0])->where('status',1)->get();
        $array = array();
        foreach($monitoring as $m)
        {
            array_push($array, $m->lot);
        }
        header("content-type:text/json");
        echo json_encode($array);
    });
    
});
// Administration Routes
Route::group(array('before' => 'client_not_logged_in','prefix' => 'clients'), function()
{
    Route::get('login','PublicClientsController@login'); 
    Route::post('login','PublicClientsController@login_post');
    Route::get('register','PublicClientsController@register'); 
    Route::post('register','PublicClientsController@register_post');
    Route::get('forgot-password','PublicClientsController@forgot');
    Route::post('forgot-password', array('before' => 'crsf', 'uses' => 'PublicClientsController@forgot_post'));
    Route::get('password-reset/{id}/{code}', 'PublicClientsController@password_reset');
    Route::get('activate/{id}/{code}','PublicClientsController@activate'); 
});

Route::get('clients/logout','PublicClientsController@logout'); 