<?php

class TypesController extends BaseController {

	/**
	 * Type Repository
	 *
	 * @var Type
	 */
	protected $type;

	public function __construct(Type $type)
	{
		$this->type = $type;

        View::share('page_title','Property Types');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$types = $this->type->all();

		return View::make('admin.types.index', compact('types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.types.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Type::$rules);

		if ($validation->passes())
		{
			$this->type->create($input);

			return Redirect::route('admin.types.index');
		}

		return Redirect::route('admin.types.create')
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
		$type = $this->type->findOrFail($id);

		return View::make('admin.types.show', compact('type'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$type = $this->type->find($id);

		if (is_null($type))
		{
			return Redirect::route('types.index');
		}

		return View::make('admin.types.edit', compact('type'));
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
		$validation = Validator::make($input,Type::update_rules($id));

		if ($validation->passes())
		{
			$type = $this->type->find($id);
			$type->update($input);

			return Redirect::route('admin.types.show', $id);
		}

		return Redirect::route('admin.types.edit', $id)
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
    if(Type::got_property($id) == false)
    {
        $this->type->find($id)->delete();
    }
    return Redirect::route('admin.types.index');
}

}
