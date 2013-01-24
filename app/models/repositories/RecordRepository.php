<?php

namespace Repositories;

interface RecordRepository
{
    /**
     * Get top 5 longest drive records for each stage (only one record per player)
     * @return array
     */
    public function getLongestDrive();

    /**
     * Store a new record
     */
    public function storeRecord($input);

}