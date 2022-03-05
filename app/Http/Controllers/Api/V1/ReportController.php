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
        $metadata = $request->input('metadata');

        $payload = (object) [
            'key' => $key,
            'score' => $request->input('score'),
            'difficulty' => $metadata['difficulty'],
            'name' => $request->input('name'),
        ];

        ProcessBeatSaberScore::dispatch($competition, $payload);
        return response(null, 202);
    }
}
