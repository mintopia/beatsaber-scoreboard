<?php

namespace App\Http\Controllers\Admin;

use App\ApiKey;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiKeyRequest;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    public function index(Request $request)
    {
        $params = [];
        $query = ApiKey::query();

        $params['per_page'] = $request->input('per_page', 10);
        $keys = $query->paginate($params['per_page'])->appends($params);
        return view('admin.apikeys.index', [
            'apikeys' => $keys
        ]);
    }

    public function store(ApiKeyRequest $request)
    {
        $apikey = new ApiKey;
        return $this->update($request, $apikey);
    }

    public function edit(ApiKey $apikey)
    {
        return view('admin.apikeys.edit', [
            'apikey' => $apikey
        ]);
    }

    public function update(ApiKeyRequest $request, ApiKey $apikey)
    {
        $apikey->description = $request->input('description');
        $apikey->active = (bool) $request->input('active');
        $apikey->save();
        return response()->redirectToRoute('admin.apikeys.index');
    }

    public function destroy(ApiKey $apikey)
    {
        $apikey->delete();
        return response()->redirectToRoute('admin.apikeys.index')->with('successMessage', 'The key has been deleted');
    }
}
