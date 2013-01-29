<?php
namespace Repositories;

use \DB;

class DbRecordRepository implements RecordRepository
{
    public function getTopFiveRecords()
    {
        $records = null;
        $stages = DB::table('stages')->orderBy('id')->get();

        foreach ($stages as $stage) {
            $records[$stage->id]['stage'] = $stage;
            $records[$stage->id]['records'] = $this->getRecords($stage->id, 5);
        }

        return $records;
    }

    public function getAllRecordsForStage($stage_id)
    {
        return $this->getRecords($stage_id);
    }

    public function storeRecord($input)
    {
        $name = strtolower($input['player']);

        $player = DB::table('players')->where('name', $name)->first();
        if (empty($player)) {
            $player_id = DB::table('players')->insertGetId(['name' => $name]);
        } else {
            $player_id = $player->id;
        }

        DB::table('records')->insert(['stage_id' => $input['stage'],
                'vehicle_id' => $input['vehicle'], 'player_id' => $player_id,
                'meters' => $input['meters']]);
    }

    private function getRecords($stage_id, $limit = false)
    {
        if (empty($stage_id) || !is_numeric($stage_id)) {
            return false;
        }

        if (!empty($limit) && is_int($limit)) {
            $limit = ' LIMIT ' . $limit;
        } else {
            $limit = '';
        }

        return DB::select('SELECT r.id, p.name AS name, v.name AS vehicle, meters
            FROM records r, players p, vehicles v
            WHERE meters = (SELECT MAX(meters) FROM records WHERE player_id = r.player_id AND stage_id = ?)
            AND vehicle_id = v.id AND player_id = p.id
            ORDER BY meters DESC' . $limit, [$stage_id]);
    }
}