<?php

class Transaction extends Eloquent {
	protected $guarded = array();

	protected $appends = array('status_text');

	public static $rules = array(
		'reference_number' => 'required',
		'property_id' => 'required|numeric',
		'reservation_id' => 'numeric',
		'status' => 'required',
		'firstname'=>'required',
		'lastname'=>'required',
		'contact_number' => 'required',
		'email' => 'required|email',
		'address' => 'required|max:1000',
	);

	public function getStatusTextAttribute()
	{
		if(strtolower($this->status) == 'paid')
		{
			return '<span class="label label-success">Paid</span>';
		}

		if(strtolower($this->status) == 'pending')
		{
			return '<span class="label label-default">Pending</span>';
		}

		if(strtolower($this->status) == 'cancelled')
		{
			return '<span class="label label-danger">Cancelled</span>';
		}
	}
}
