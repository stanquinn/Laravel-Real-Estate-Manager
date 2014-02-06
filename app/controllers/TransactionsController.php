<?php
class TransactionsController extends BaseController {

	/**
	 * Transaction Repository
	 *
	 * @var Transaction
	 */
	protected $transaction;

	public function __construct(Transaction $transaction)
	{
		$this->transaction = $transaction;
		View::share('page_title','Transactions');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$transactions = $this->transaction->all();

		return View::make('admin.transactions.index', compact('transactions'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		View::share('properties',Property::orderBy('model_number')->get());
		return View::make('admin.transactions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$input['reference_number'] = date('Ymd').'-'.str_random(5);
		$validation = Validator::make($input, Transaction::$rules);

		if ($validation->passes())
		{
			
			// CREATE NEW TRANSACTION
			$transaction = new Transaction;
			$transaction->reference_number = date('Ymd').'-'.str_random(5);
			$transaction->property_id = Input::get('property_id');
			$transaction->reservation_id = Input::get('reservation_id');
			$transaction->status = Input::get('status');
			$transaction->amount = Input::get('amount');
			$transaction->firstname = Input::get('firstname');
			$transaction->lastname = Input::get('lastname');
			$transaction->contact_number = Input::get('contact_number');
			$transaction->address = Input::get('address');
			$transaction->email = Input::get('email');
			$transaction->remarks = Input::get('remarks');
			$transaction->save();
			// GENERATE INVOICE
			$html =  View::make('admin.transactions.show', compact('transaction'));
			$pdf = storage_path().'/invoices/'.$transaction->reference_number.'.pdf';
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->render();
			$output = $dompdf->output();
			file_put_contents($pdf, $output);

			// EMAIL THE INVOICE
			$data['transaction'] = $transaction;
			Mail::send('mails.default', $data, function($message) use($transaction,$pdf)
			{
			    $message->to($transaction->email)->subject("Your Invoice");
			    $message->attach($pdf);
			});

			return Redirect::route('admin.transactions.index')->with('success','An invoice has been sent to the client.');
		}

		return Redirect::route('admin.transactions.create')
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
	public function invoice($id)
	{
		$transaction = $this->transaction->findOrFail($id);
		$pdf = storage_path().'/invoices/'.$transaction->reference_number.'.pdf';
		return Response::download($pdf);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$transaction = $this->transaction->find($id);

		if (is_null($transaction))
		{
			return Redirect::route('admin.transactions.index');
		}

		return View::make('admin.transactions.edit', compact('transaction'));
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
		$validation = Validator::make($input, Transaction::$rules);

		if ($validation->passes())
		{
			$transaction = $this->transaction->find($id);
			$transaction->update($input);

			return Redirect::route('admin.transactions.edit', $id)->with('success','Transaction has been updated');
		}

		return Redirect::route('admin.transactions.edit', $id)
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
		$this->transaction->find($id)->delete();

		return Redirect::route('admin.transactions.index');
	}

}
