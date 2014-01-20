<?php

class ReservationsController extends BaseController {

	/**
	 * Reservation Repository
	 *
	 * @var Reservation
	 */
	protected $reservation;

	public function __construct(Reservation $reservation)
	{
		$this->reservation = $reservation;
		View::share('page_title','Reservation Management');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$reservations = $this->reservation->all();

		return View::make('admin.reservations.index', compact('reservations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('admin.reservations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Reservation::$rules);

		if ($validation->passes())
		{
			$this->reservation->create($input);

			return Redirect::route('admin.reservations.index');
		}

		return Redirect::route('admin.reservations.create')
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
		$reservation = $this->reservation->findOrFail($id);
		$property = Property::findOrFail($reservation->property_id);

		return View::make('admin.reservations.show', compact('reservation','property'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reservation = $this->reservation->find($id);

		if (is_null($reservation))
		{
			return Redirect::route('admin.reservations.index');
		}

		return View::make('admin.reservations.edit', compact('reservation'));
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
		$validation = Validator::make($input, Reservation::$rules);

		if ($validation->passes())
		{
			$reservation = $this->reservation->find($id);
			$reservation->update($input);

			return Redirect::to('admin/reservations')->with('success','Reservation has been successfully updated.');
		}

		return Redirect::route('admin.reservations.edit', $id)
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
		$this->reservation->find($id)->delete();

		return Redirect::route('admin.reservations.index');
	}

}
