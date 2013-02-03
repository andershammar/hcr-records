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

    public function getLeaderboardScores()
    {
        $players = null;

        $stages = DB::table('stages')->orderBy('id')->get();
        foreach ($stages as $stage)
        {
            // Get records for each stage
            $records = $this->appendMedals($this->getRecords($stage->id));

            // Summarize records for each player for current stage
            foreach ($records as $record) {
                $player = $record->name;

                if (!isset($players[$player])) {
                    $result = [
                        'name' => $player,
                        'score' => $this->getScore($record->position),
                        'gold' => ($record->position == 1) ? 1 : 0,
                        'silver' => ($record->position == 2) ? 1 : 0,
                        'bronze' => ($record->position == 3) ? 1 : 0,
                    ];
                } else {
                    $old = $players[$player];
                    $result = [
                        'name' => $player,
                        'score' => $old['score'] + $this->getScore($record->position),
                        'gold' => $old['gold'] + (($record->position == 1) ? 1 : 0),
                        'silver' => $old['silver'] + (($record->position == 2) ? 1 : 0),
                        'bronze' => $old['bronze'] + (($record->position == 3) ? 1 : 0),
                    ];
                }

                $players[$player] = $result;
            }
        }

        // Sort leaderboard ascending on score
        uasort($players, [$this, 'sortLeaderboard']);
        return $players;
    }

    public function storeRecord($input)
    {
        $name = strtolower($input['player']);

        // Get player (or create a new player if needed)
        $player = DB::table('players')->where('name', $name)->first();
        if (empty($player)) {
            $player_id = DB::table('players')->insertGetId(['name' => $name]);
        } else {
            $player_id = $player->id;
        }

        // Check if a record already exist for current player before
        // adding a new record
        $record = DB::table('records')->where('player_id', $player->id)
            ->where('stage_id', $input['stage'])
            ->where('meters', $input['meters'])
            ->first();

        if (empty($record)) {
            DB::table('records')->insert([
                'stage_id' => $input['stage'],
                'vehicle_id' => $input['vehicle'],
                'player_id' => $player_id,
                'meters' => $input['meters']
            ]);
        }
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
                $player->medal = $this->getMedal($position);
                $player->position = $position;
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

    private function getMedal($position) {
        if ($position == 1) {
            return 'img/medal-gold.png';
        } else if ($position == 2) {
            return 'img/medal-silver.png';
        } else if ($position == 3) {
            return 'img/medal-bronze.png';
        }
    }

    private function getScore($position) {
        if ($position == 1) {
            return 3;
        } else if ($position == 2) {
            return 2;
        } else if ($position == 3) {
            return 1;
        }
    }

    private function sortLeaderboard($a, $b)
    {
        if ($a['score'] == $b['score']) {
            return 0;
        }
        return ($a['score'] < $b['score']) ? 1 : -1;
    }

}