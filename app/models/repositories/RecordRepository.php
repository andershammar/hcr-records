<?php

namespace Repositories;

interface RecordRepository
{
    /**
     * Get top five records for each stage. Only one record per
     * player is returned.
     *
     * @return array|null  Array of records, or null if no record exist
     */
    public function getTopFiveRecords();

    /**
     * Get all records for specified stage. Only one record per
     * player is returned.
     *
     * @param  int    $stage_id  The stage database id
     * @return array|null        Array of records, or null if no record exist
     */
    public function getAllRecordsForStage($stage_id);

    /**
     * Get five latest records that has been added for any stage.
     *
     * @return array|null  Array of records, or null if no record exist
     */
    public function getFiveLatestRecords();

    /**
     * Store a new record
     */
    public function storeRecord($input);

}