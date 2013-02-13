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
     * Get leaderboard scores.
     *
     * @return array|null  Array of player scores, or null if no scores exist
     */
    public function getLeaderboardScores();

    /**
     * Get leaderboard distance scores.
     *
     * @return array|null  Array of player distance scores, or null if no distance scores exist
     */
    public function getLeaderboardDistanceScores();

    /**
     * Store a new record
     *
     * @return int|null  The record database id, or null if no record was added
     */
    public function storeRecord($input);

    /**
     * Delete a record
     */
    public function destroyRecord($id);
}
