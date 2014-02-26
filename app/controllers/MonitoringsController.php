<?php

class MonitoringsController extends BaseController
{
	public function __construct()
	{
		View::share('page_title','Monitoring');
	}

	public function main($property_id)
	{
		if(is_null(Property::find($property_id)))
		{
			return Redirect::to('admin/properties')->with('error','Property was not found.');
		}
		Session::put('redirect_url',URL::current());
		$monitorings = Monitoring::orderBy('block','desc')->get();
		$property = Property::find($property_id);
		return View::make('admin.monitorings.main',compact('monitorings','property'));
	}
	public function create($property_id)
	{
		if(is_null(Property::find($property_id)))
		{
			return Redirect::to('admin/properties')->with('error','Property was not found.');
		}
		$property = Property::find($property_id);
		return View::make('admin.monitorings.create',compact('property'));
	}
	public function create_post($property_id)
	{
		if(is_null(Property::find($property_id)))
		{
			return Redirect::to('admin/properties')->with('error','Property was not found.');
		}
		$property = Property::find($property_id);
		$validator = Validator::make(Input::all(),Monitoring::$rules);
		if($validator->fails())
		{
			return Redirect::to(URL::current())->withErrors($validator)->withInput();
		}else{
			$monitoring = new Monitoring;
			$monitoring->property_id = $property_id;
			$monitoring->block = Input::get('block');
			$monitoring->lot = Input::get('lot');
			$monitoring->save();
			return Redirect::to(URL::current())->with('success','Block has been added');
		}
	}
	public function update($property_id,$id)
	{
		if(is_null(Property::find($property_id)) && is_null(Monitoring::find($id)))
		{
			return Redirect::to('admin/properties')->with('error','Property was not found.');
		}

		$monitoring = Monitoring::find($id);
		$property = Property::find($property_id);

		return View::make('admin.monitorings.update',compact('property','monitoring'));
	}
	public function update_post($property_id,$id)
	{
		if(is_null(Property::find($property_id)) && is_null(Monitoring::find($id)))
		{
			return Redirect::to('admin/properties')->with('error','Property was not found.');
		}

		$monitoring = Monitoring::find($id);
		$property = Property::find($property_id);
		$validator = Validator::make(Input::all(),Monitoring::$rules);
		if($validator->fails())
		{
			return Redirect::to(URL::current())->withErrors($validator)->withInput();
		}else{
			$monitoring->property_id = $property_id;
			$monitoring->block = Input::get('block');
			$monitoring->lot = Input::get('lot');
			$monitoring->save();
			return Redirect::to(URL::current())->with('success','Block has been saved');
		}
	}
	public function delete($id)
	{
		$monitoring = Monitoring::find($id);
		$monitoring->delete();
		return Redirect::to(Session::get('redirect_url'))->with('success','Block has deleted.');
	}
}