<?php

class ClientsController extends BaseController
{
	public function __construct(User $user)
	{
		$this->user = $user;
		View::share('page_title','Clients Management');
	}
	public function main()
	{
		$clients = $this->user->orderBy('first_name')->get();
		return View::make('admin.clients.main',compact('clients'));
	}
	public function create()
	{
		return View::make('admin.clients.create');
	}
	public function create_post()
	{
		$validator = Validator::make(Input::all(),User::get_rules());
		if($validator->fails())
		{
			return Redirect::to('admin/clients/create')->withErrors($validator)->withInput();
		}else{
		    $user = Sentry::createUser(array(
		    	'first_name'	=> Input::get('first_name'),
		    	'last_name'		=> Input::get('last_name'),
		    	'tin_number'	=> Input::get('tin_number'),
		    	'landline'		=> Input::get('landline'),
		    	'mobile'		=> Input::get('mobile'),
		    	'work_address'	=> json_endcode(explode(",",Input::get('work_address'))),
		    	'home_address'	=> json_endcode(explode(",",Input::get('home_address'))),
		    	'company'		=> Input::get('company'),
		    	'occupation'	=> Input::get('occupation'),
		        'email'       	=> Input::get('email'),
		        'password'    	=> Input::get('password'),
		        'activated'   	=> true,
		    ));
			// Find the group using the group id
			$group = Sentry::findGroupById(1);

			// Assign the group to the user
			$user->addGroup($group);
		    return Redirect::to('admin/clients')->with('success','Client account has been successfully created.');
		}
	}
	public function update($id)
	{
		$this->_exists($id);
		$client = $this->user->find($id);
		return View::make('admin.clients.update',compact('client'));
	}
	public function update_post($id)
	{
		$this->_exists($id);
		$rules = User::get_rules($id);
		$validator = Validator::make(Input::all(),$rules);

		if($validator->passes())
		{
		 // Find the user using the user id
		    $user = Sentry::findUserById($id);
		    	$user->first_name	= Input::get('first_name');
		    	$user->last_name	= Input::get('last_name');
		    	$user->tin_number	= Input::get('tin_number');
		    	$user->landline		= Input::get('landline');
		    	$user->mobile		= Input::get('mobile');
		    	$user->work_address	= json_endcode(explode(",",Input::get('work_address')));
		    	$user->home_address	= json_endcode(explode(",",Input::get('home_address')));
		    	$user->company		= Input::get('company');
		    	$user->occupation	= Input::get('occupation');
		        $user->email      	= Input::get('email');
		        if(Input::get('password'))
		        {
		        	$user->password = Input::get('password');
		        }
		        if(Input::get('activated') == 1)
		        {
		        	$user->activated = true;
		        }else{ $user->activated = false; }
		        $user->save();  
			return Redirect::to('admin/clients')->with('success','Client account has been successfully updated.');
		}
		return Redirect::to('admin/clients/update/'.$id)->withErrors($validator)->withInput();
	}
	public function view($id)
	{
		$this->_exists($id);
		$client = $this->user->find($id);
		return View::make('admin.clients.view',compact('client'));
	}
	public function suspend($id)
	{
		$this->_exists($id);
		$user = $this->user->find($id);
		if($user->activated == 0)
		{
			$user->activated = 1;
		}else{ $user->activated = 0; }
		$user->save();
		return Redirect::to('admin/clients')->with('success','Client account has been successfully updated.');
	}
	public function delete($id)
	{
		$this->_exists($id);
		$user = $this->user->find($id);
		$user->deleted_at = date("Y-m-d H:i:s");
		$user->email = date("YmdHis").'@xxx.ph';
		$user->tin_number = date("YmdHis").'xxxxxxx';
		$user->save();
		return Redirect::to('admin/clients')->with('success','Client account has been successfully deleted.');
	}
	private function _exists($id)
	{
		$user = $this->user->find($id);
		if(is_null($user)){ return Redirect::to('admin/clients')->with('error','Clients was not found.');}else{ return;}
	}

	public function transactions($id)
	{
		$this->_exists($id);
		$user = User::find($id);
		$transactions = Transaction::where('user_id',$id)->get();
		return View::make('admin.transactions.index', compact('transactions','user'));
	}

	public function reservations($id)
	{
		$this->_exists($id);
		$user = User::find($id);
		$reservations = Reservation::where('user_id',$id)->get();
		return View::make('admin.reservations.index', compact('reservations','user'));
	}

	public function reservation($id)
	{
		$reservation = Reservation::findOrFail($id);
		$transaction = Transaction::where('reservation_id',$reservation->id)->first();
		$pdf = storage_path().'/reservations/reservation-'.$transaction->reference_number.'.pdf';
		if(file_exists($pdf)){
			return Response::download($pdf);
		}else{ return Redirect::to('admin/clients')->with('error','PDF was not found.');}
	}
	public function transaction($id)
	{
		$transaction = Transaction::findOrFail($id);
		$pdf = storage_path().'/invoices/'.$transaction->reference_number.'.pdf';
		if(file_exists($pdf)){
			return Response::download($pdf);
		}else{ return Redirect::to('admin/clients')->with('error','PDF was not found.');}
	}
}