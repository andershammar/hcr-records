<?php

use Repositories\RecordRepository;

class LeaderboardController extends BaseController {

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
        $view = Input::get('view', 'score');

        if ($view == 'score') {
            $players = $this->records->getLeaderboardScores();
        } else {
            $players = $this->records->getLeaderboardDistanceScores();
        }

        return View::make('leaderboard.index')
            ->with('players', $players)
            ->with('view', $view);
    }
}
