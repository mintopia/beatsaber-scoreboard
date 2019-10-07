@extends('layouts.application', [
    'title' => [
        'Competitions',
        'Add'
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            Competitions
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form class="card" action="{{ route('admin.competitions.store') }}" method="post">
                {{ csrf_field() }}
                <div class="card-header">
                    <h3 class="card-title">Add Competition</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            @include('admin.competitions._form')
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a class="btn btn-link" href="{{ route('admin.competitions.index') }}">Cancel</a>
                        <button class="btn btn-primary ml-auto" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
