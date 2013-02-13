<?php

use Repositories\RecordRepository;
use Repositories\StageRepository;
use Repositories\VehicleRepository;

class RecordController extends BaseController {

    protected $records;
    protected $stages;
    protected $vehicles;

    public function __construct(RecordRepository $records, StageRepository $stages,
        VehicleRepository $vehicles)
    {
        $this->records = $records;
        $this->stages = $stages;
        $this->vehicles = $vehicles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return View::make('records.index')
            ->with('records', $this->records->getTopFiveRecords())
            ->with('latest_records', $this->records->getFiveLatestRecords());
    }

    /**
     * Display one resource
     *
     * @return Response
     */
    public function show($id)
    {
        return View::make('records.show')
            ->with('stage', $this->stages->getStage($id))
            ->with('next', $this->stages->getNextStage($id))
            ->with('prev', $this->stages->getPreviousStage($id))
            ->with('records', $this->records->getAllRecordsForStage($id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('records.create')
            ->with('stages', $this->stages->getAllStages())
            ->with('vehicles', $this->vehicles->getAllVehicles());
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
