<?php

namespace Repositories;

interface VehicleRepository
{
    /**
     * Get vehicle
     *
     * @param  int    $vehicle_id  The vehicle database id
     * @return object              The requested vehicle object
     */
    public function getVehicle($vehicle_id);

    /**
     * Get all vehicles
     *
     * @return array|null  Array of vehicles, or null if no vehicles exist
     */
    public function getAllVehicles();

}
