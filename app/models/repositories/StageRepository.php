<?php

namespace Repositories;

interface StageRepository
{
    /**
     * Get stage
     *
     * @param  int    $stage_id The stage database id
     * @return object           The requested stage object
     */
    public function getStage($stage_id);

    /**
     * Get all stages
     *
     * @return array|null  Array of stages, or null if no stages exist
     */
    public function getAllStages();

}