<?php

class Developer extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'name' => 'required|unique:developers,name',
        'email'=> 'required|email|unique:developers,email'
	);
    public function properties()
    {
        return $this->hasMany('Property');
    }
    public static function update_rules($id)
    {
        return array(
            'name' => 'required|unique:developers,name,'.$id,
            'email'=> 'required|email|unique:developers,email,'.$id
        );
    }

    public static function got_property($id)
    {
        $property = Property::where('developer_id','=',$id);
        if($property->count() > 0){ return true; }else{ return false;}
    }

    public static function dropdown()
    {
        $locations = Developer::orderBy('name')->get();
        $array = [];
        foreach($locations as $l)
        {
            $key = $l->id;
            $array[$key] = ucwords($l->name);
        }
        return $array;
    }
}
