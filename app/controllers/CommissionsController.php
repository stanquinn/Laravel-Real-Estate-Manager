<?php

class CommissionsController extends Eloquent
{
	
	public function __construct()
	{
		View::share('page_title','Agent Commission');
	}

	public function main($id)
	{
		if(is_null(Agent::find($id))){ return Redirect::to('admin');}

		$commissions = Commission::where('agent_id',$id)->orderBy('created_at','desc')->get();
		$agent = Agent::find($id);
		View::make('admin.commission.list',compact('commissions','agent'));
	}
}