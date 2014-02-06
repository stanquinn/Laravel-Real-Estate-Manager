<?php

class Transaction extends Eloquent {
	protected $guarded = array();

	protected $softDelete = true;

	protected $appends = array('status_text');

	public static $rules = array(
		'status' => 'required',
	);

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function property()
	{
		return $this->belongsTo('Property');
	}

	public function reservation()
	{
		return $this->belongsTo('Reservation');
	}

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
