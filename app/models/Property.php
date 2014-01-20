<?php

class Property extends Eloquent {
	protected $guarded = array();
    protected $appends = array('stats','cover','permalink');
	public static $rules = array(
        'location_id'   => 'numeric|required',
        'developer_id'  => 'numeric|required',
        'type_id'       => 'numeric|required',
        'name'          => 'required|min:8',
        'model_number'  => 'required',
        'agent'         => 'required',
        'beds'          => 'required|numeric',
        'baths'         => 'required|numeric',
        'lot'           => 'required|numeric',
        'block'         => 'required|numeric',
        'reservation_fee'=> 'required|numeric',
        'status'        => 'required|numeric',
	);
    public function developer()
    {
        return $this->belongsTo('Developer');
    }
    public function type()
    {
        return $this->belongsTo('Type');
    }
    public function location()
    {
        return $this->belongsTo('Location');
    }
    public function getStatsAttribute()
    {
        if($this->status == 0)
        {
            return '<span class="badge badge-warning">InActive</span>';
        }else{
            return '<span class="badge badge-success">Active</span>';
        }
    }
    public function getCoverAttribute()
    {

    }

    public function getPermalinkAttribute()
    {
        return URL::to('properties/item/'.$this->id);
    }

    public static function photos_path($id = null)
    {
        $destination = public_path().'/photos/'.$id;
        if(!file_exists($destination)){ mkdir($destination);}
        return $destination;
    }

    public static function photos($id,$size = array(100,100))
    {
        $destination = public_path().'/photos/'.$id;
        if(!file_exists($destination)){ mkdir($destination);}

        $folder = $destination.'/*';
        $images = glob($folder);
        $timthumb = URL::to('photos').'/timthumb.php?src=';
        if(is_array($images) && !empty($images))
        {
            $im = array();
            foreach($images as $i)
            {
                $im[] = $timthumb.URL::to('photos').'/'.$id.'/'.basename($i).'&w='.$size[0].'&h='.$size[1];
            }
            return $im;
        }else{
            return [];
        }
    }

    public static function gallery($id,$thumbnail = array(100,100),$fullsize = array(500,350))
    {
        $gallery = [];
        $thumbnails = Property::photos($id,$thumbnail);
        $fullsizes = Property::photos($id,$fullsize);

        foreach($thumbnails as $k => $v)
        {
            $gallery[] = array(
                'thumbnail' => $thumbnails[$k],
                'fullsize' => $fullsizes[$k]
            );
        }
        return $gallery;
    }

    public static function photos_array($id)
    {
        $destination = public_path().'/photos/'.$id;
        if(!file_exists($destination)){ mkdir($destination);}

        $folder = $destination.'/*';
        $images = glob($folder);
        if(is_array($images) && !empty($images))
        {
            $im = array();
            foreach($images as $i)
            {
                $im[] = URL::to('photos').'/'.$id.'/'.basename($i);
            }
            return $im;
        }else{
            return [];
        }
    }

    public static function primary_photo($id,$size = array(50,50))
    {
        $destination = public_path().'/photos/'.$id;
        if(!file_exists($destination)){ mkdir($destination);}

        $folder = $destination.'/*';
        $images = glob($folder);
        $timthumb = URL::to('photos').'/timthumb.php?src=';
        $im = array();
        if(is_array($images) && !empty($images))
        {
            foreach($images as $i)
            {
                $im[] = $timthumb.URL::to('photos').'/'.$id.'/'.basename($i).'&w='.$size[0].'&h='.$size[1];
            }
        }
        if(empty($im))
        {
            return $timthumb.URL::to('photos').'/default.jpg&w='.$size[0].'&h='.$size[1];
        }else{ return $im[0];}
    }

    public static function dropdown()
    {
        $properties = Property::orderBy('created_at','desc')->get();
        $nodes = array();

        foreach($properties as $p)
        {
            $nodes[$p->id] = $p->model_number.' | '.$p->name;
        }

        return $nodes;
    }

    public static function get_computation($id,$size = array(200,200))
    {
        $timthumb = URL::to('photos').'/timthumb.php?src=';
        $computation = Property::find($id);
        if(empty($computation->computation))
        {
            return $timthumb.URL::to('photos').'/default.jpg&w='.$size[0].'&h='.$size[1];
        }else{
            return $timthumb.URL::to('photos').'/computations/'.$computation->computation.'&w='.$size[0].'&h='.$size[1];
        }
    }
}
