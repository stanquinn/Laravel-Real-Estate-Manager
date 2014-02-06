<?php

class Reservation extends Eloquent {
	protected $guarded = array();

    protected $softDelete = true;

	public static $rules = array(
        'terms'             => 'max:100|min:2|required',
        'unit_type'         => 'max:100|min:2|required'
	);

    public function property()
    {
        return $this->belongsTo('Property');
    }

    public function agent()
    {
        return $this->belongsTo('Agent');
    }

    public function user()
    {
        return $this->belongsTo('User');
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
