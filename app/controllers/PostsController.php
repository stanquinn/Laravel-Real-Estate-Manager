<?php

class PostsController extends BaseController {

	/**
	 * Post Repository
	 *
	 * @var Post
	 */
	protected $post;

	public function __construct(Post $post)
	{
		$this->post = $post;

        View::share('page_title','Manage Posts');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$posts = $this->post->all();

		return View::make('admin.posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Post::$rules);

		if ($validation->passes())
		{
            $destination = base_path('public/photos/posts');
            $file = Input::file('photo');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = Input::file('photo')->move($destination, $filename);
            if($uploadSuccess) {
                $post = new Post;
                $post->title = Input::get('title');
                $post->content = Input::get('content');
                $post->post_type = Input::get('post_type');
                $post->photo = $filename;
                $post->save();
                return Redirect::route('admin.posts.index')->with('success','Entry has been created.');
            } else {
                return Redirect::route('admin.posts.create')
                    ->withInput()
                    ->with('error', 'There was a problem uploading the photo.');
            }
		}

		return Redirect::route('admin.posts.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$post = $this->post->findOrFail($id);

		return View::make('admin.posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = $this->post->find($id);

		if (is_null($post))
		{
			return Redirect::route('admin.posts.index');
		}

		return View::make('admin.posts.edit', compact('post'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $post = $this->post->find($id);
        $filename = $post->photo;
        $input = array_except(Input::all(), '_method');
		$validation = Validator::make($input,array(
            'title' => 'required',
            'content' => 'required',
            'post_type'=> 'required',
            'photo' => 'image|max:20000|mimes:jpeg,bmp,png',
        ));

		if ($validation->passes())
		{
            if(Input::hasFile('photo'))
            {
                $destination = base_path('public/photos/posts');
                $file = Input::file('photo');
                $filename = $file->getClientOriginalName();
                $uploadSuccess = Input::file('photo')->move($destination, $filename);
                if($uploadSuccess) {

                    $post->title = Input::get('title');
                    $post->content = Input::get('content');
                    $post->post_type = Input::get('post_type');
                    $post->photo = $filename;
                    $post->save();

                    return Redirect::route('admin.posts.index')->with('success','Entry has been saved.');
                } else {
                    return Redirect::route('admin.posts.create')
                        ->withInput()
                        ->with('error', 'There was a problem uploading the photo.');
                }
            }else{

                $post->title = Input::get('title');
                $post->content = Input::get('content');
                $post->post_type = Input::get('post_type');
                $post->save();
                return Redirect::route('admin.posts.index')->with('success','Entry has been saved.');

            }

			return Redirect::route('admin.posts.show', $id);
		}

		return Redirect::route('admin.posts.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->post->find($id)->delete();

		return Redirect::route('admin.posts.index');
	}

}
