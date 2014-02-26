<?php

class Monitoring extends Eloquent
{
	protected $softDelete = true;

	public static $rules = array(
		'lot' => 'required|numeric',
		'block' => 'required|numeric'
	);

	public function property()
	{
		$this->belongsTo('Property');
	}
}