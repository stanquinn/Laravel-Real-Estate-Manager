<?php

class Agent extends Eloquent {
	protected $guarded = array();

	protected $softDelete = true;

	public static $rules = array(
		'first_name' => 'required',
		'last_name' => 'required',
		'email' => 'required',
		'phone' => 'required'
	);

    public static function dropdown()
    {
        $locations = Agent::orderBy('last_name')->get();
        $array = [];
        foreach($locations as $l)
        {
            $key = $l->id;
            $array[$key] = ucwords($l->last_name.', '.$l->first_name);
        }
        return $array;
    }
}
