<?php

class PropertyController extends BaseController
{
	
    public function __construct(Reservation $reservation)
    {
        
        $this->reservation = $reservation;
        View::share('locations',Location::orderBy('name','asc')->get());
        View::share('types',Type::orderBy('name','asc')->get());
        View::share('news',Post::where('post_type','news')->orderBy('created_at','desc')->limit(4)->get());
    }

	public function main()
	{
		View::share('page_title','Properties');
		$data['appends'] = array_except(Input::all(),array('page','submit'));
		$data['properties'] = new Property;
		$data['properties']->where('status',1);
		$data['properties']->orderBy('created_at','desc');

		foreach($data['appends'] as $k => $v)
		{
			switch($k)
			{
				case 'location':
					$data['properties']->where('location_id',Input::get('location'));
				break;

				case 'type':
					$data['properties']->where('type_id',Input::get('type'));
				break;

				case 's':
					$data['properties']->where('name', 'LIKE','%'.Input::get('s').'%');
					$data['properties']->where('model_number', 'LIKE','%'.Input::get('s').'%');
				break;
			}
		}

		$data['properties'] = $data['properties']->paginate(24);

		return View::make('public.properties',$data);
	}
	public function search(){

		View::share('page_title','Find Properties');
		return View::make('public.search_form');
	}
	public function item($id){

		$property = Property::find($id);
		if(is_null($property)){ return App::abort(404); }
		$data['reservation_button'] = $id;
		$data['property'] = $property;
		$data['gallery'] = Property::gallery($id,array(100,100),array(800,600));
		View::share('page_title',$property->name);
		return View::make('public.item',$data);
	}

	public function item_post($id)
	{
		$rules = array(
			'email' => 'required|email',
			'name' => 'required',
			'phone' => 'required',
			'message' => 'required|max:1000'
		);

		$validator = Validator::make(Input::all(),$rules);
		if($validator->passes())
		{
			$data['message'] = Input::get('message');
			$data['from'] = Input::get('name');
			$data['phone'] = Input::get('phone');
			$data['email'] = Input::get('email');


			Mail::send('mails.contact', $data, function($message)
			{
			    $message->to('johndavedecano@gmail.com', 'Contact Form')->subject('Inquiry for Property:'. $id);
			});

			return Redirect::to('properties/item/'.$id.'#tabs1-css')->with('success','Message sent. Well get back to you as soon as possible.');
		}else{
			return Redirect::to('properties/item/'.$id.'#tabs1-css')->withInput()->withErrors($validator);
		}
	}
	public function reserve($id){

		$property = Property::find($id);
		if(is_null($property)){ return App::abort(404); }
		View::share('page_title','Reservation Form');
		View::share('property_id',$id);
		return View::make('public.reservation',array('property' => $property));

	}

	public function reserve_post($id)
	{
		$property = Property::find($id);
		$admin_email = User::find(1)->email;
		$developer_email = $property->developer->email;

		if(is_null($property)){ return App::abort(404); }
		$validator = Validator::make(Input::all(),Reservation::$rules);
		if($validator->passes())
		{			
			// REMOVE PROPERTY FROM THE LIST BECAUSE ITS ALREADY BEEN RESERVED
			$property->status = 0;
			$property->save();

			// EMAIL DEVELOPER
			$reservation = new Reservation;
			$reservation->property_id = $id;
			$reservation->firstname = Input::get('firstname');
			$reservation->lastname = Input::get('lastname');
			$reservation->phone  = Input::get('phone');
			$reservation->mobile = Input::get('mobile');
			$reservation->home_address = Input::get('home_address');
			$reservation->work_address = Input::get('work_address');
			$reservation->work = Input::get('work');
			$reservation->company = Input::get('company');
			$reservation->tin_number = Input::get('tin_number');
			$reservation->terms = Input::get('terms');
			$reservation->email = Input::get('email');
			$reservation->unit_type = Input::get('unit_type');
			$reservation->save();

			// CREATE NEW TRANSACTION
			$transaction = new Transaction;
			$transaction->reference_number = date('Ymd').'-'.str_random(5);
			$transaction->property_id = $id;
			$transaction->reservation_id = $reservation->id;
			$transaction->status = 'Pending';
			$transaction->amount = $property->reservation_fee;
			$transaction->firstname = $reservation->firstname;
			$transaction->lastname = $reservation->lastname;
			$transaction->contact_number = $reservation->mobile;
			$transaction->address = $reservation->home_address;
			$transaction->email = $reservation->email;
			$transaction->remarks = "Reservation Fee";
			$transaction->save();

			// GENERATE INVOICE
			$html =  View::make('admin.transactions.show', compact('transaction'));
			$pdf = storage_path().'/invoices/'.$transaction->reference_number.'.pdf';
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$output = $dompdf->output();
			file_put_contents($pdf, $output);

			// EMAIL THE INVOICE
			$data['transaction'] = $transaction;
			Mail::send('mails.default', $data, function($message) use($transaction,$pdf)
			{
			    $message->to($transaction->email)->subject("Your Invoice");
			    $message->attach($pdf);
			});

			// EMAIL DEVELOPER AND ADMINISTRATOR
			$data['property'] = $property;
			$data['firstname'] = Input::get('firstname');
			$data['lastname'] = Input::get('lastname');
			$data['phone'] = Input::get('phone');
			$data['mobile'] = Input::get('mobile');
			$data['tin_number'] = Input::get('tin_number');
			$data['home_address'] = Input::get('home_address');
			$data['work_address'] = Input::get('work_address');
			$data['work'] = Input::get('work');
			$data['company'] = Input::get('company');
			$data['terms'] = Input::get('terms');
			$data['email'] = Input::get('email');
			$data['unit_type'] = Input::get('unit_type');

			Mail::send('mails.reservation', $data, function($message) use($admin_email,$developer_email)
			{
			    $message->to($admin_email, 'Live and Love')->subject('Property Reservation');
			    if($developer_email)
			    {
			    	$message->to($developer_email, 'Live and Love')->subject('Property Reservation');
			    }
			});

			return Redirect::to('properties/reserve/'.$id)->with('success','Email has been sent to administrator. Well send you an invoice for billing the reservation fee.');

		}else{ return Redirect::to('properties/reserve/'.$id)->withErrors($validator)->withInput();}
	}
}