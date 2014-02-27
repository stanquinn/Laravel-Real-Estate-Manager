<?php

class Monitoring extends Eloquent
{
	protected $softDelete = true;

	protected $appends = array('status');

	public static $rules = array(
		'lot' => 'required|numeric',
		'block' => 'required|numeric'
	);

	public function property()
	{
		$this->belongsTo('Property');
	}

	public function getStatusAttribute()
	{
		if(isset($this->attributes['status']))
			return ($this->attributes['status'])?'available':'unavailable';
	}

	public function setStatusAttribute($value)
	{
		$this->attributes['status'] = (strtolower($value) == 'available')?true:false;
	}
}