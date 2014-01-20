<?php

class Post extends Eloquent {

	protected $guarded = array();

    protected $appends = array('excerpt','permalink','post_date');

	public static $rules = array(
		'title' => 'required',
		'content' => 'required',
        'post_type'=> 'required',
        'photo' => 'required|image|max:20000|mimes:jpeg,bmp,png',
	);

    public function getExcerptAttribute()
    {
        return Str::limit($this->content,400);
    }

    public function getPermalinkAttribute()
    {
        return URL::to('article/'.$this->id);
    }

    public function getPostDateAttribute()
    {
        return date("F j,Y H:i:s",strtotime($this->created_at));
    }

    public static function content($id = null)
    {
        $post = Post::find($id);
        return $post->content;
    }

    public static function get_image($id,$size = array())
    {
        $post = Post::find($id);
        if(is_null($post)){
            return false;
        }else{
            $timthumb = URL::to('photos').'/timthumb.php?src=';
            $photo = 'default.jpg';
            if($post->photo != ''){
                $photo = $post->photo;
            }
            return $timthumb.URL::to('photos').'/posts/'.$photo.'&w='.$size[0].'&h='.$size[1];
        }
    }
}
