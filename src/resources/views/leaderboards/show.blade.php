@extends('layouts.' . $leaderboard->competition->style)

@section('leaderboard')
    <script type="text/javascript">
        var scores = @json($scores, JSON_PRETTY_PRINT);
        Leaderboard.updateScores(scores);
        Leaderboard.updateName('{{ $leaderboard->name }}');
    </script>
@endsection
