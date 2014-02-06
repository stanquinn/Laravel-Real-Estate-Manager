<?php

class Commission extends Eloquent
{
	protected $softDelete = true;

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function agent()
	{
		return $this->belongsTo('Agent');
	}

	public function property()
	{
		return $this->belongsTo('Property');
	}
}