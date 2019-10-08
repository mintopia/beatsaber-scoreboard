@extends('layouts.application', [
    'title' => [
        'Players'
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            Players
        </h1>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-3">
            <form class="card" method="post" action="{{ route('admin.players.store') }}">
                {{ csrf_field() }}
                <div class="card-header">
                    <h3 class="card-title">Add Player</h3>
                </div>
                <div class="card-body">
                    @include('admin.players._form')
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
                            <th class="w-1">ID</th>
                            <th>Name</th>
                            <th class="w-25">Added</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($players as $player)
                            <tr>
                                <td class="text-muted">{{ $player->id }}</td>
                                <td>
                                    <a href="{{ route('admin.players.show', $player) }}">{{ $player->name }}</a>
                                </td>
                                <td>
                                    <span title="{{ $player->created_at->format('Y-m-d H:i:s') }}">{{ $player->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($players->hasMorePages())
                    <div class="card-footer">
                        {{ $players->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
