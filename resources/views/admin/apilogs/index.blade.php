@extends('layouts.application', [
    'title' => [
        'API Logs'
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            API Logs
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th class="w-1">Timestamp</th>
                                <th class="w-1">Method</th>
                                <th>Request URI</th>
                                <th class="w-1">Response Code</th>
                                <th class="w-1">Duration</th>
                                <th>API Key</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($apilogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $log->method }}</td>
                                    <td>
                                        <a href="{{ route('admin.apilogs.show', $log) }}">{{ $log->uri }}</a>
                                    </td>
                                    <td>{{ $log->response_code }}</td>
                                    <td>{{ $log->duration }} ms</td>
                                    <td>
                                        @if ($log->apikey)
                                            {{ $log->apikey->description }}
                                        @else
                                            <span class="text-muted">Not Provided</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('partials._pagination', [
                    'page' => $apilogs
                ])
            </div>
        </div>
    </div>
@endsection
