<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\BeatSaberReportRequest;
use App\Jobs\ProcessBeatSaberScore;
use App\Models\Competition;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function beatsaber(BeatSaberReportRequest $request, Competition $competition)
    {
        $key = $request->input('key');
        $lbName = $key;
        $metadata = $request->input('metadata');

        if ($metadata) {
            $lbName = $metadata['beatmap']['name'];
            if ($metadata['beatmap']['key'] != $key) {
                $lbName .= ' - ' . $metadata['difficulty'];
            }
        }
        $payload = (object) [
            'key' => $key,
            'name' => $request->input('name'),
            'score' => $request->input('score'),
            'leaderboardName' => $lbName,
        ];

        ProcessBeatSaberScore::dispatch($competition, $payload);
        return response(null, 202);
    }
}
