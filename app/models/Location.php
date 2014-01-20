<?php

class Location extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required|unique:locations,name'
	);

    public function properties()
    {
        return $this->hasMany('Property');
    }

    public static function update_rules($id)
    {
        return array('name' => 'required|unique:locations,name,'.$id);
    }
    public static function got_property($id)
    {
        $property = Property::where('location_id','=',$id);
        if($property->count() > 0){ return true; }else{ return false;}
    }

    public static function dropdown()
    {
        $locations = Location::orderBy('name')->get();
        $array = [];
        foreach($locations as $l)
        {
            $key = $l->id;
            $array[$key] = ucwords($l->name);
        }
        return $array;
    }
}