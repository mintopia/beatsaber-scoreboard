<?php

namespace App\Http\Controllers\Admin;

use App\ApiLog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiLogController extends Controller
{
    public function index(Request $request)
    {
        $params = [];
        $query = ApiLog::query();
        $query->orderBy('created_at', 'DESC');

        $params['per_page'] = $request->input('per_page', 10);
        $apilogs = $query->paginate($params['per_page'])->appends($params);

        return view('admin.apilogs.index', [
            'apilogs' => $apilogs
        ]);
    }

    public function show(ApiLog $apilog)
    {
        return view('admin.apilogs.show', [
            'log' => $apilog,
        ]);
    }
}
