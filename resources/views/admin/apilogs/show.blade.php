@extends('layouts.application', [
    'title' => [
        'API Logs',
        $log->id
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
                            <th class="w-1">API Key</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $log->method }}</td>
                                <td>{{ $log->uri }}</td>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <ul class="nav nav-tabs m-0" data-toggle="tabs">
                    <li class="nav-item m-0 p-0">
                        <a class="nav-link active pl-3 pr-3" href="#tab-request-headers" data-toggle="tab">Request Headers</a>
                    </li>
                    <li class="nav-item m-0 p-0">
                        <a class="nav-link pl-3 pr-3" href="#tab-request-body" data-toggle="tab">Request Body</a>
                    </li>
                    <li class="nav-item m-0 p-0">
                        <a class="nav-link pl-3 pr-3" href="#tab-response-headers" data-toggle="tab">Response Headers</a>
                    </li>
                    <li class="nav-item m-0 p-0">
                        <a class="nav-link pl-3 pr-3" href="#tab-response-body" data-toggle="tab">Response Body</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show table-responsive" id="tab-request-headers">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <tbody>
                                @foreach ($log->request_headers as $name => $value)
                                    <tr>
                                        <th class="w-1">{{ $name }}</th>
                                        <td>
                                            @foreach ($value as $entry)
                                                {{ $entry }}<br />
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-request-body">
                        @if (json_decode($log->request_body))
                            <pre class="m-0"><code class="language-json">{{ json_encode(json_decode($log->request_body), JSON_PRETTY_PRINT) }}</code></pre>
                        @else
                            <pre class="m-0"><code class="language-html5">{{ $log->request_body }}</code></pre>
                        @endif
                    </div>
                    <div class="tab-pane" id="tab-response-headers">
                        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                            <tbody>
                            @foreach ($log->response_headers as $name => $value)
                                <tr>
                                    <th class="w-1">{{ $name }}</th>
                                    <td>
                                        @foreach ($value as $entry)
                                            {{ $entry }}<br />
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-response-body">
                        @if (json_decode($log->response_body))
                            <pre class="m-0"><code class="language-json">{{ json_encode(json_decode($log->response_body), JSON_PRETTY_PRINT) }}</code></pre>
                        @else
                            <pre class="m-0"><code class="language-html5">{{ $log->response_body }}</code></pre>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
