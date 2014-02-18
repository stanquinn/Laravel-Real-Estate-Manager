<?php

class AgentsController extends BaseController {

	/**
	 * Agent Repository
	 *
	 * @var Agent
	 */
	protected $agent;

	public function __construct(Agent $agent)
	{
		$this->agent = $agent;

		View::share('page_title','Manage Agents');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$agents = $this->agent->all();

		return View::make('admin.agents.index', compact('agents'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.agents.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Agent::$rules);

		if ($validation->passes())
		{
			$this->agent->create($input);

			return Redirect::route('admin.agents.index');
		}

		return Redirect::route('admin.agents.create')
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
		$agent = $this->agent->findOrFail($id);

		return View::make('admin.agents.show', compact('agent'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$agent = $this->agent->find($id);

		if (is_null($agent))
		{
			return Redirect::route('admin.agents.index');
		}

		return View::make('admin.agents.edit', compact('agent'));
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
		$validation = Validator::make($input, Agent::$rules);

		if ($validation->passes())
		{
			$agent = $this->agent->find($id);
			$agent->update($input);

			return Redirect::route('admin.agents.show', $id);
		}

		return Redirect::route('admin.agents.edit', $id)
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
	public function delete($id)
	{
		$this->agent->find($id)->delete();

		return Redirect::route('admin.agents.index');
	}

	public function commissions($id)
	{
		if(is_null(Agent::find($id))){ return Redirect::to('admin');}

		$commissions = Commission::where('agent_id',$id)->orderBy('created_at','desc')->get();
		$agent = Agent::find($id);
		return View::make('admin.commissions.list',compact('commissions','agent'));
	}

	public function give_commission($id)
	{
		if(is_null(Agent::find($id))){ return Redirect::to('admin');}

		$agent = Agent::find($id);

		return View::make('admin.commissions.give',compact('agent'));
	}

	public function give_commission_post($id)
	{
		if(is_null(Agent::find($id))){ return Redirect::to('admin');}

		$agent = Agent::find($id);

		$action = Input::get('action');

		if($action == 'deduct')
		{
			$rules = array(
				'action'  => 'required',
				'remarks' => 'required',
				'amount' => 'required|numeric'
			);

			$validator = Validator::make(Input::all(),$rules);

			if($validator->passes())
			{
				$commissions = new Commission;
				$commissions->user_id = Input::get('user_id');
				$commissions->property_id = Input::get('property_id');
				$commissions->agent_id = $agent->id;
				$commissions->action = 'deduct';
				$commissions->remarks = Input::get('remarks');
				$commissions->amount = Input::get('amount');
				$commissions->save();

				// AGENT COMMISSION
				if($agent->earnings > 0)
				{
					$agent->earnings = $agent->earnings - Input::get('amount');
					$agent->save();
				}
				return Redirect::to('admin/agents/commissions/'.$id)->with('success','Commission has been added.');
			}else{
				return Redirect::to('admin/give_commission/'.$id)->withErrors($validator)->withInput();
			}
		}
		elseif($action == 'add')
		{
			$rules = array(
				'user_id' => 'required|numeric|exists:users,id',
				'property_id' => 'required|numeric|exists:properties,id',
				'action'  => 'required',
				'remarks' => 'required',
				'amount' => 'required|numeric'
			);

			$validator = Validator::make(Input::all(),$rules);

			if($validator->passes())
			{
				$commissions = new Commission;
				$commissions->user_id = Input::get('user_id');
				$commissions->property_id = Input::get('property_id');
				$commissions->agent_id = $agent->id;
				$commissions->action = 'add';
				$commissions->remarks = Input::get('remarks');
				$commissions->amount = Input::get('amount');
				$commissions->save();

				// AGENT COMMISSION
				$agent->earnings = $agent->earnings + Input::get('amount');
				$agent->save();

				return Redirect::to('admin/agents/commissions/'.$id)->with('success','Commission has been added.');
			}else{
				return Redirect::to('admin/give_commission/'.$id)->withErrors($validator)->withInput();
			}
		}
	}
}
