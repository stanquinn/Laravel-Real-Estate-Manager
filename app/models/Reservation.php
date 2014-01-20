<?php

class Reservation extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'firstname'         => 'required|max:50',
        'lastname'          => 'required|max:50',
        'home_address'      => 'required|max:500',
        'work_address'      => 'max:500',
        'phone'             => 'max:12|min:7',
        'mobile'            => 'max:13|min:11',
        'email'             => 'email|required',
        'work'              => 'max:100|min:2',
        'tin_number'        => 'max:25|min:5',
        'company'           => 'max:100|min:2',
        'terms'             => 'max:100|min:2|required',
        'unit_type'         => 'max:100|min:2|required'
	);

    public function property()
    {
        return $this->belongsTo('Property');
    }

    public static function dropdown()
    {
        $properties = Reservation::orderBy('created_at','desc')->get();
        $nodes = array();

        foreach($properties as $p)
        {
            $nodes[$p->id] = $p->id.' | '.$p->firstname.' '.$p->lastname;
        }

        return $nodes;
    }
}
