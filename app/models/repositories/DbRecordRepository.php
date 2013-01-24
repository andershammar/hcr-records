<?php
namespace Repositories;

use \DB;

class DbRecordRepository implements RecordRepository
{
    public function getLongestDrive()
    {
        $stages = DB::table('stages')->orderBy('id')->get();

        foreach ($stages as $stage) {
            $records[$stage->id]['stage'] = $stage;
            $records[$stage->id]['records'] =
                    DB::select('SELECT r.id, p.name AS name, v.name AS vehicle, meters
                    FROM records r, players p, vehicles v
                    WHERE meters = (SELECT MAX(meters) FROM records WHERE player_id = r.player_id AND stage_id = ?)
                    AND vehicle_id = v.id AND player_id = p.id
                    ORDER BY meters DESC LIMIT 5', [$stage->id]);
        }

        return $records;
    }

    public function storeRecord($input)
    {
        $player = DB::table('players')->where('name', $input['player'])->first();
        if (empty($player)) {
            $player_id = DB::table('players')->insertGetId(['name' => $input['player']]);
        } else {
            $player_id = $player->id;
        }

        DB::table('records')->insert(['stage_id' => $input['stage'],
                'vehicle_id' => $input['vehicle'], 'player_id' => $player_id,
                'meters' => $input['meters']]);
    }

    public function getStages()
    {
        foreach (DB::table('stages')->orderBy('id')->get() as $stage) {
            $stages[$stage->id] = $stage->name;
        }
        return $stages;
    }

    public function getVehicles()
    {
        foreach (DB::table('vehicles')->orderBy('id')->get() as $vehicle) {
            $vehicles[$vehicle->id] = $vehicle->name;
        }
        return $vehicles;

    }

}