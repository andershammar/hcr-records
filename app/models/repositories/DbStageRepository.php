<?php
namespace Repositories;

use \DB;

class DbStageRepository implements StageRepository
{
    public function getStage($stage_id)
    {
        return DB::table('stages')->where('id', $stage_id)->first();
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
