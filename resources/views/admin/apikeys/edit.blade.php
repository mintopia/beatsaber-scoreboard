@extends('layouts.application', [
    'title' => [
        'API Keys',
        $apikey->description
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            API Keys
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form class="card" action="{{ route('admin.apikeys.update', $apikey) }}" method="post">
                {{ csrf_field() }}
                @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">Edit API Key</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            @include('admin.apikeys._form')
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a class="btn btn-link" href="{{ route('admin.apikeys.index') }}">Cancel</a>
                        <button class="btn btn-primary ml-auto" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
