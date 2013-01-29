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
            $this->appendMedals($records[$stage->id]['records']);
        }

        return $records;
    }

    public function getAllRecordsForStage($stage_id)
    {
        return $this->appendMedals($this->getRecords($stage_id));
    }

    public function getFiveLatestRecords()
    {
        return DB::select('SELECT r.id, s.name AS stage, p.name AS name, v.name AS vehicle, meters
            FROM records r, stages s, players p, vehicles v
            WHERE stage_id = s.id AND vehicle_id = v.id AND player_id = p.id
            ORDER BY id DESC LIMIT 5');
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

    private function appendMedals($records) {
        $position = 1;
        $current_max = $records[0]->meters;

        for ($i = 0; $i < count($records); $i++) {
            $player = $records[$i];
            if ($player->meters >= $current_max) {
                $player->medal = $this->getMedalForPosition($position);
            }

            if ($i + 1 < count($records)) {
                $nextPlayer = $records[$i + 1];
                if ($nextPlayer->meters < $current_max) {
                    $position++;
                    $current_max = $nextPlayer->meters;
                }
            }
        }

        return $records;
    }

    private function getMedalForPosition($position) {
        if ($position == 1) {
            return 'img/medal-gold.png';
        } else if ($position == 2) {
            return 'img/medal-silver.png';
        } else if ($position == 3) {
            return 'img/medal-bronze.png';
        }
    }
}