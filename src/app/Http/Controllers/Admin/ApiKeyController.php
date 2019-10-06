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
            'keys' => $keys
        ]);
    }

    public function create()
    {
        return view('admin.apikeys.create');
    }

    public function store(ApiKeyRequest $request)
    {
        $key = new ApiKey;
        $this->update($request, $key);
    }

    public function edit(ApiKey $key)
    {
        return view('admin.apikeys.edit', [
            'key' => $key
        ]);
    }

    public function update(ApiKeyRequest $request, ApiKey $key)
    {
        $key->description = $request->input('description');
        $key->save();
        return response()->redirectToRoute('admin.apikeys.index');
    }

    public function delete(ApiKey $key)
    {
        $key->delete();
        return response()->redirectToRoute('admin.apikeys.index')->with('successMessage', 'The key has been deleted');
    }
}
