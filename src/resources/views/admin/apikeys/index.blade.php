@extends('layouts.application', [
    'title' => [
        'API Keys',
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
        <div class="col-md-12 col-lg-3">
            <form class="card" method="post" action="{{ route('admin.apikeys.store') }}">
                {{ csrf_field() }}
                <div class="card-header">
                    <h3 class="card-title">Add Key</h3>
                </div>
                <div class="card-body">
                    @include('admin.apikeys._form')
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-success ml-auto" type="submit">Add</button>
                </div>
            </form>
        </div>

        <div class="col-lg-9 col-md-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Description</th>
                                <th>Key</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($apikeys as $key)
                            <tr>
                                <td class="text-muted">{{ $key->id }}</td>
                                <td>{{ $key->description }}</td>
                                <td>{{ $key->key }}</td>
                                <td>
                                    @if ($key->active)
                                        <span class="status-icon bg-success"></span>
                                        Active
                                    @else<span class="status-icon bg-warning"></span>
                                        Not Active
                                    @endif
                                </td>
                                <td class="w-2">
                                    <a href="{{ route('admin.apikeys.edit', $key) }}" class="btn btn-outline-primary btn-sm"><i class="fe fe-edit-2"></i></a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteApiKeyModal{{ $key->id }}"><i class="fe fe-trash"></i></button>


                                    <div class="modal fade" id="deleteApiKeyModal{{$key->id}}" tabindex="-1" role="dialog" aria-labelledby="delete-link" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete API Key</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete <strong>{{ $key->description }}</strong>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('admin.apikeys.destroy', $key) }}" method="post">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-danger ml-auto" type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('partials._pagination', [
                    'page' => $apikeys
                ])
            </div>
        </div>
    </div>
@endsection
