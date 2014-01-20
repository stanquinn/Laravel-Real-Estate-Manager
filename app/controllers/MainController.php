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
        return View::make('public.home',$data);
    }

    public function about(){
        $article = Post::find(9);
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

        $article = Post::find(5);
        if(is_null($article)){ return App::abort('404'); }
        View::share('page_title',$article->title);
        View::share('article',$article);
        return View::make('public.contact'); 
    }
    public function contact_post(){
        
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