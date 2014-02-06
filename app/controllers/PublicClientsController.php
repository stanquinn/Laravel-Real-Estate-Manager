<?php
class PublicClientsController extends BaseController
{
	public function __construct()
	{
		View::share('page_title','Client');
        View::share('locations',Location::orderBy('name','asc')->get());
        View::share('types',Type::orderBy('name','asc')->get());
        View::share('news',Post::where('post_type','news')->orderBy('created_at','desc')->limit(4)->get());
        if(Sentry::check())
        {
        	View::share('user',Sentry::getUser());
        	$this->user = Sentry::getUser();
        }
        
	}

	public function main()
	{
		View::share('page_title','Client Account');
		$reservations = Reservation::where('user_id',$this->user->id)->orderBy('created_at','desc')->paginate(10);
		$transactions = Transaction::where('user_id',$this->user->id)->orderBy('created_at','desc')->paginate(10);
		return View::make('public.clients.main',compact('transactions','reservations'));		
	}

	public function reservation($id)
	{
		$reservation = Reservation::findOrFail($id);
		if($this->user->id == $reservation->user_id)
		{
			$transaction = Transaction::where('reservation_id',$reservation->id)->first();
			$pdf = storage_path().'/reservations/reservation-'.$transaction->reference_number.'.pdf';
			if(file_exists($pdf)){
				return Response::download($pdf);
			}else{ return Redirect::to('clients')->with('error','PDF was not found.');}
			
		}else{ return App::abort(404);}
	}
	public function invoice($id)
	{
		$transaction = Transaction::findOrFail($id);
		if($this->user->id == $transaction->user_id)
		{
			$pdf = storage_path().'/invoices/'.$transaction->reference_number.'.pdf';
			if(file_exists($pdf)){
				return Response::download($pdf);
			}else{ return Redirect::to('clients')->with('error','PDF was not found.');}
			
		}else{ return App::abort(404);}
	}
	public function reserve($id)
	{
		$property = Property::find($id);
		if(is_null($property)){ return Redirect::to('properties'); }
		View::share('page_title','Reserve');
		return View::make('public.clients.reserve',compact('property'));
	}

	public function reserve_post($id)
	{
		if(is_null(Property::find($id))){ return Redirect::to('properties'); }
		$rules = array(
			'total_contract_price' 	=> 'required',
			'reservation_fee'		=> 'required',
			'downpayment'			=> 'required',
			'equity'				=> 'required',
			'total_months' 			=> 'required',
			'monthly_fee'			=> 'required',
			'agent_id'				=> 'required',
			'unit_type'				=> 'required',
			'terms'					=> 'required'

		);
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::to('clients/reserve/'.$id)->withInput()->withErrors($validator);
		}else{
			$property = Property::find($id);
			$user = $this->user;
			// 0. CHANGE PROPERTY STATUS TO 0
			$property->status = 0;
			$property->save();
			$downpayment = (intval(Input::get('downpayment')) / 100) * $property->price;
			$equity = $property->price - $downpayment - $property->reservation_fee;
			$total_months = intval(Input::get('total_months'));
			// 1. SAVE TO THE DATABASE
			$reservation = new Reservation;
			$reservation->property_id = $id;
			$reservation->user_id = $this->user->id;
			$reservation->agent_id = Input::get('agent_id');
			$reservation->total_contract_price = intval(Input::get('total_contract_price'));
			$reservation->downpayment = $downpayment;
			$reservation->reservation_fee = $property->reservation_fee;
			$reservation->equity = $equity;
			$reservation->total_months = $total_months;
			$reservation->monthly_fee = $equity / $total_months;
			$reservation->terms = Input::get('terms');
			$reservation->unit_type = Input::get('unit_type');
			$reservation->save();
			// 2. NEW TRANSACTION
			$transaction = new Transaction;
			$transaction->reference_number = date('Ymd').'-'.strtoupper(str_random(5));
			$transaction->property_id = $id;
			$transaction->user_id = $this->user->id;
			$transaction->reservation_id = $reservation->id;
			$transaction->status = 'Pending';
			$transaction->amount = $property->reservation_fee;
			$transaction->remarks = "Property Reservation";
			$transaction->save();
			// 3. NEW AGENT COMMISSION
			$commission = new Commission;
			$commission->user_id = $this->user->id;
			$commission->agent_id = $reservation->agent_id;
			$commission->property_id = $property->id;
			$commission->amount = 0;
			$commission->save();
			
			// 3.GENERATE INVOICE
			$x =  View::make('admin.transactions.show', compact('transaction','user','property'));
			$pdf = storage_path().'/invoices/'.$transaction->reference_number.'.pdf';
			$dompdf = new DOMPDF();
			$dompdf->load_html($x);
			$dompdf->render();
			$output = $dompdf->output();
			@file_put_contents($pdf, $output);

			// 3.1 GENERATE RESERVATION INFORMATION PDF
			$y =  View::make('admin.reservations.pdf', compact('transaction','user','reservation','property'));
			$res = storage_path().'/reservations/reservation-'.$transaction->reference_number.'.pdf';
			$dompdf = new DOMPDF();
			$dompdf->load_html($y);
			$dompdf->render();
			$output = $dompdf->output();
			@file_put_contents($res, $output);

			// 4. EMAIL DEVELOPER,ADMIN AND BUYER
			$admin = User::find(1);
			$developer = $property->developer;
			$data['transaction'] = $transaction;
			Mail::send('mails.default', $data, function($message) use($transaction,$pdf,$developer,$admin,$res)
			{
			    $message->to($this->user->email)->subject("Property Reservation Notification");
			    $message->to($developer->email)->subject("Property Reservation Notification");
			    $message->to($admin->email)->subject("Property Reservation Notification");
			    $message->attach($pdf);
			    $message->attach($res);
			});
			return Redirect::to('clients/reserve/'.$id)->with('success','Your reservation has been sent to administrator for approval.');
		}


	}

	public function login()
	{
		View::share('page_title','Client Login');
		return View::make('public.clients.login');
	}

	public function login_post()
	{
		$rules = array(
		    'email' => 'required|email',
		    'password'=> 'required'
		);
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails()){
            return Redirect::to('clients/login')->withErrors($validator);
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
                return Redirect::to('clients');
            }
            catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
            {
                return Redirect::to('clients/login')->with('warning','Login field is required.');
            }
            catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
            {
                return Redirect::to('clients/login')->with('warning','Password field is required.');
            }
            catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
            {
                return Redirect::to('clients/login')->with('warning','Wrong password, try again.');
            }
            catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
            {
                return Redirect::to('clients/login')->with('warning','User was not found.');
            }
            catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
            {
                return Redirect::to('clients/login')->with('warning','User is not activated.');
            }
        }
	}

	public function logout()
	{
		Sentry::logout();
		Session::flush();
		return Redirect::to('/');
	}

	public function register()
	{
		View::share('page_title', 'Register');
		return View::make('public.clients.register');
	}

	public function register_post()
	{
		$rules = User::$rules;
		$rules['password'] = 'confirmed|required|min:8';
		$rules['mobile'] = 'required|numeric';
		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::to('clients/register')->withErrors($validator)->withInput();
		}else{

			// Let's register a user.
			$user = Sentry::register(array(
		    	'first_name'	=> Input::get('first_name'),
		    	'last_name'		=> Input::get('last_name'),
		    	'tin_number'	=> Input::get('tin_number'),
		    	'landline'		=> Input::get('landline'),
		    	'mobile'		=> Input::get('mobile'),
		    	'work_address'	=> Input::get('work_address'),
		    	'home_address'	=> Input::get('home_address'),
		    	'company'		=> Input::get('company'),
		    	'occupation'	=> Input::get('occupation'),
		        'email'       	=> Input::get('email'),
		        'password'    	=> Input::get('password')
			));

			// Let's get the activation code
			$activationCode = $user->getActivationCode();

            $data['user'] = $user;
            $data['password'] = $user->password;
            // Send activation code to the user so he can activate the account
            Mail::send('mails.activation', $data, function($message) use ($user,$password)
            {
                $message->from('no-reply@liveandlove.com', 'Live and Love');
                $message->to($user->email)->subject("Account Activation Notice");
            });

		}
	}


    public function activate($id = null,$activation_code = null)
    {
        try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($id);

            // Attempt to activate the user
            if ($user->attemptActivation($activation_code))
            {
                
                return Redirect::to('clients/login')->with('success','User activation passed.');
            }
            else
            {
                // User activation failed
                return Redirect::to('clients/login')->with('error','User activation failed.');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::to('clients/login')->with('error','User was not found.');
        }
        catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
        {
            return Redirect::to('clients/login')->with('error','User is already activated.');
        }
    }

	public function forgot()
	{
		View::share('page_title', 'Forgot Password');
		return View::make('public.clients.forgot');
	}

	public function forgot_post()
	{
		$validator = Validator::make(Input::all(),array('email' => 'required|email'));
		if($validator->passes()){
			try
			{
			    // Find the user using the user email address
			    $user = Sentry::findUserByLogin(Input::get('email'));

			    // Get the password reset code
			    $resetCode = $user->getResetPasswordCode();
			    $data['user'] = $user;
			    $data['code'] = $resetCode;
	            Mail::send('mails.forgotpwd', $data, function($message) use ($user)
	            {
	                $message->from('no-reply@liveandlove.com', 'Live and Love');
	                $message->to($user->email)->subject("Password Reset Instruction");
	            });
			    // Now you can send this code to your user via email for example.
                return Redirect::to('clients/login')->with('success','Password reset instruction has been sent to your email.');
			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
			    return Redirect::to('clients/forgot-password')->with('error','User was not found.');
			}
		}else{
			return Redirect::to('clients/forgot-password')->withErrors($validator)->withInput();
		}
	}

	public function password_reset($id,$code)
	{
       try
        {
            // Find the user using the user id
            $user = Sentry::findUserById($id);

            // Check if the reset password code is valid
            if ($user->checkResetPasswordCode($code))
            {
                // Attempt to reset the user password
                $password = str_random(8);
                if ($user->attemptResetPassword($code,$password))
                {
                    // Password reset passed
				    $data['user'] = $user;
				    $data['password'] = $password;
		            Mail::send('mails.newpassword', $data, function($message) use ($user)
		            {
		                $message->from('no-reply@liveandlove.com', 'Live and Love');
		                $message->to($user->email)->subject("New Password has been received.");
		            });
                    return Redirect::to('auth/login')->with('success','Your new password has been sent to your email.');
                }
                else
                {
                    return Redirect::to('auth/forgot-password')->with('error','Password reset failed.');
                }
            }
            else
            {
                // The provided password reset code is Invalid
                return Redirect::to('auth/login')->with('error','The provided password reset code is Invalid.');
            }
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            return Redirect::to('auth/login')->with('error','User was not found.');
        }
	}

	public function profile()
	{
		View::share('page_title','My Profile');
		$client = $this->user;
		return View::make('public.clients.profile',compact('client'));		
	}

	public function profile_post()
	{
		$rules = User::$rules;
		// CHECKS IF PASSWORD IS SET.
		unset($rules['password']);
		if(Input::get('password'))
		{
			$rules['password'] = 'confirmed|required|min:8';
		}
		// NEW RULES
		$rules['tin_number'] = 'required|numeric|unique:users,tin_number,'.$this->user->id;
		$rules['email'] 	 = 'email|required|unique:users,email,'.$this->user->id;
		$rules['mobile'] = 'required|numeric';

		$validator = Validator::make(Input::all(),$rules);
		if($validator->fails())
		{
			return Redirect::to('clients/profile')->withErrors($validator)->withInput();
		}else{

			// Let's register a user.
			$this->user->first_name		= Input::get('first_name');
			$this->user->last_name		= Input::get('last_name');
			$this->user->tin_number		= Input::get('tin_number');
			$this->user->landline		= Input::get('landline');
			$this->user->mobile			= Input::get('mobile');
			$this->user->work_address	= Input::get('work_address');
			$this->user->home_address	= Input::get('home_address');
			$this->user->company		= Input::get('company');
			$this->user->occupation		= Input::get('occupation');
			$this->user->email       	= Input::get('email');
			if(Input::get('password'))
			{
				$this->user->password  = Input::get('password');
			}
			$this->user->save();
			return Redirect::to('clients/profile')->with('success','Profile has been successfully updated.');
		}		
	}
}