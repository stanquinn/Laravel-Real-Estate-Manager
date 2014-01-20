<?php

class DevelopersController extends BaseController {

	/**
	 * Developer Repository
	 *
	 * @var Developer
	 */
	protected $developer;

	public function __construct(Developer $developer)
	{
		$this->developer = $developer;

        View::share('page_title','Developers');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$developers = $this->developer->all();

		return View::make('admin.developers.index', compact('developers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.developers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Developer::$rules);

		if ($validation->passes())
		{
			$this->developer->create($input);

			return Redirect::route('admin.developers.index');
		}

		return Redirect::route('admin.developers.create')
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
		$developer = $this->developer->findOrFail($id);

		return View::make('admin.developers.show', compact('developer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$developer = $this->developer->find($id);

		if (is_null($developer))
		{
			return Redirect::route('admin.developers.index');
		}

		return View::make('admin.developers.edit', compact('developer'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$rules = array(
            'name' => 'required',
            'email'=> 'required|email'
        );
		$validation = Validator::make($input,$rules);

		if ($validation->passes())
		{
			$developer = $this->developer->find($id);
			$developer->update($input);

			return Redirect::route('admin.developers.show', $id);
		}

		return Redirect::route('admin.developers.edit', $id)
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
        if(Developer::got_property($id) == false)
        {
            $this->developer->find($id)->delete();
        }
		return Redirect::route('admin.developers.index');
	}

}
