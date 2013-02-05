<?php
namespace Repositories;

use \DB;

class DbStageRepository implements StageRepository
{
    public function getStage($stage_id)
    {
        return DB::table('stages')->where('id', $stage_id)->first();
    }

    public function getNextStage($id)
    {
        $next = $id + 1;
        return DB::table('stages')->where('id', $next)->first();
    }

    public function getPreviousStage($id)
    {
        $prev = $id - 1;
        return DB::table('stages')->where('id', $prev)->first();
    }

    public function getAllStages()
    {
        $stages = null;

        foreach (DB::table('stages')->orderBy('id')->get() as $stage) {
            $stages[$stage->id] = $stage->name;
        }
        return $stages;
    }
}
