<?php

class MainController extends BaseController {

    public function __construct()
    {
        View::share('locations',Location::orderBy('created_at')->get());
        View::share('news',Post::where('post_type','news')->orderBy('created_at','desc')->limit(4)->get());
    }

    public function main()
    {
        $data['properties'] = Property::where('status',1)->orderBy('created_at','desc')->limit(3)->get();
        View::share('page_title','Homepage');
        View::share('sliders',Property::where('status',1)->orderBy(DB::raw('RAND()'))->limit(10)->get());
        View::share('sidebar',true);
        View::share('homepage',true);
        return View::make('public.home',$data);
    }

    public function about(){
        $article = Post::find(163);
        if(is_null($article)){ return App::abort('404'); }
        View::share('page_title',$article->title);
        View::share('post',$article);
        return View::make('public.post');
    }
    public function services(){
        $article = Post::find(10);
        if(is_null($article)){ return App::abort('404'); }
        View::share('page_title',$article->title);
        View::share('post',$article);
        return View::make('public.post');
    }
    public function news(){
        $archives = Post::where('post_type','news')->orderBy('created_at','')->paginate(15);
        return View::make('public.news',array('archives' => $archives));
    }
    public function contact()
    {
        $post = Post::find(162);
        if(is_null($post)){ return App::abort('404'); }
        View::share('page_title',$post->title);
        View::share('post',$post);
        return View::make('public.contact'); 
    }
    public function contact_post()
    {
        $rules = array(
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        );
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails())
        {
            return Redirect::to('contact-us')->withInput()->withErrors($validator);
        }else{

            $admin_email = User::find(1)->email;
            $data = array(
                'from' => Input::get('name'),
                'msg' => Input::get('message'),
                'email' => Input::get('email')
            );
            Mail::send('mails.contact', $data, function($message) use($admin_email)
            {
                $message->to($admin_email, 'Live and Love')->subject('Contact Inquiry');
            });
            return Redirect::to('contact-us')->with('success','Message Sent!');
        }
    }
    public function article($id)
    {
        $article = Post::find($id);
        if(is_null($article)){ return App::abort('404'); }
        View::share('page_title',$article->title);
        View::share('post',$article);
        return View::make('public.post');
    }
}