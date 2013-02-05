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
     * Get next stage for the specified stage id.
     *
     * @param int     $id  The stage id
     * @param object       The next stage, or null if not found
     */
    public function getNextStage($id);

    /**
     * Get previous stage for the specified stage id.
     *
     * @param int     $id  The stage id
     * @param object       The previous stage, or null if not found
     */
    public function getPreviousStage($id);

    /**
     * Get all stages
     *
     * @return array|null  Array of stages, or null if no stages exist
     */
    public function getAllStages();

}
