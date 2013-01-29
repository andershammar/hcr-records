<?php
namespace Repositories;

use \DB;

class DbVehicleRepository implements VehicleRepository
{
    public function getVehicle($vehicle_id)
    {
        return DB::table('vehicles')->where('id', $vehicle_id)->first();
    }

    public function getAllVehicles()
    {
        $vehicles = null;

        foreach (DB::table('vehicles')->orderBy('id')->get() as $vehicle) {
            $vehicles[$vehicle->id] = $vehicle->name;
        }
        return $vehicles;
    }
}
