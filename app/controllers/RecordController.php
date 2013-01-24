<?php

use Repositories\RecordRepository;

class RecordController extends BaseController {

    protected $records;

    public function __construct(RecordRepository $records)
    {
        parent::__construct();
        $this->records = $records;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('records.index')
                ->with('records', $this->records->getLongestDrive());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('records.create')
                ->with('stages', $this->records->getStages())
                ->with('vehicles', $this->records->getVehicles());
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::all();
        $rules = [
            'player' => ['required'],
            'meters' => ['required', 'integer']
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return Redirect::back()->withInput()->withErrors($validation);
        }

		$this->records->storeRecord($input);
        return Redirect::to('records');
	}

}