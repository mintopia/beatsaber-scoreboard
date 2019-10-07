@extends('layouts.' . $leaderboard->competition->style)

@section('leaderboard')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pusher/5.0.2/pusher.min.js" integrity="sha256-vOxviKM/QBcMYxoY51Rbfk1ePvAeH/PNSRLv1egfhts=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var scores = @json($scores, JSON_PRETTY_PRINT);
        Leaderboard.updateScores(scores);
        Leaderboard.updateName('{{ $leaderboard->name }}');

        Leaderboard.pusherConfig = {
            key: '{{ env('PUSHER_APP_KEY') }}',
            host: '{{ env('PUBLIC_PUSHER_HOST') }}',
            port: '{{ env('PUBLIC_PUSHER_PORT') }}',
            appId: '{{ env('PUSHER_APP_ID') }}',
            channel: 'competition.{{ $leaderboard->competition->id }}',
            @if(env('PUSHER_FORCE_TLS'))
                forceTLS: true,
            @endif
        };
        Leaderboard.connect();
    </script>
@endsection
