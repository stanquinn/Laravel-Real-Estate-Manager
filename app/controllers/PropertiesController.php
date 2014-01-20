
<?php

class PropertiesController extends BaseController {

	/**
	 * Property Repository
	 *
	 * @var Property
	 */
	protected $property;

	public function __construct(Property $property)
	{
		$this->property = $property;

        View::share('page_title','Properties');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$properties = $this->property->all();
		return View::make('admin.properties.index', compact('properties'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.properties.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Property::$rules);

		if ($validation->passes())
		{
			$this->property->create($input);

			return Redirect::route('admin.properties.index');
		}

		return Redirect::route('admin.properties.create')
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
		$property = $this->property->findOrFail($id);

		return View::make('admin.properties.show', compact('property'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$property = $this->property->find($id);

		if (is_null($property))
		{
			return Redirect::route('admin.properties.index');
		}

		return View::make('admin.properties.edit', compact('property'));
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
		$validation = Validator::make($input, Property::$rules);

		if ($validation->passes())
		{
			$property = $this->property->find($id);
			$property->update($input);

			return Redirect::route('admin.properties.show', $id);
		}

		return Redirect::route('admin.properties.edit', $id)
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
		$this->property->find($id)->delete();

		return Redirect::route('admin.properties.index');
	}

	public function computation($id)
	{
        $property = $this->property->find($id);
        if(is_null($property)){ return Redirect::to('admin/properties'); }
        return View::make('admin.properties.computation',array('property_id' => $id));		
	}

    public function computation_post($id)
    {
         
        $property = $this->property->find($id);
        if(is_null($property)){ return Redirect::to('admin/properties'); }

		$rules = array(
		 'photo' => 'required|image|max:20000|mimes:jpeg,bmp,png',
		);

        $validator = Validator::make(Input::all(),$rules);

        if($validator->fails())
        {
            return Redirect::to('admin/properties/'.$id.'/computation')->withErrors($validator);
        }else{
            $destination = Property::photos_path('computations');
            $file = Input::file('photo');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = Input::file('photo')->move($destination, $filename);
            if($uploadSuccess) 
            {
            	$property->computation = $filename;
            	$property->save();
                return Redirect::to('admin/properties/'.$id.'/computation')->with('success','Successfully Uploaded.');
            } else {
                return Redirect::to('admin/properties/'.$id.'/computation')->with('warning','pload Error.');
            }
        }
    }

    public function photos($id)
    {
        $property = $this->property->find($id);
        if(is_null($property)){ return Redirect::to('admin/properties'); }
        return View::make('admin.properties.photos',array('property_id' => $id));
    }

    public function photos_post($id)
    {
         $rules = array(
             'photo' => 'required|image|max:20000|mimes:jpeg,bmp,png',
         );
        $validator = Validator::make(Input::all(),$rules);
        if($validator->fails())
        {
            return Redirect::to('admin/properties/'.$id.'/photos')->withErrors($validator);
        }else{
            $destination = Property::photos_path($id);
            $file = Input::file('photo');
            $filename = $file->getClientOriginalName();
            $uploadSuccess = Input::file('photo')->move($destination, $filename);
            if( $uploadSuccess ) {
                return Redirect::to('admin/properties/'.$id.'/photos')->with('success','Successfully Uploaded.');
            } else {
                return Redirect::to('admin/properties/'.$id.'/photos')->with('warning','pload Error.');
            }
        }
    }

    public function photos_delete()
    {
        //admin/properties/photos/delete?property_id=57&photo=Koala.jpg
        $destination = public_path().'/photos/'.Input::get('property_id').'/'.Input::get('photo');
        if(!file_exists($destination)){ return App::abort('500');}
        File::delete($destination);
        return Redirect::to('admin/properties/'.Input::get('property_id').'/photos');
    }

}
