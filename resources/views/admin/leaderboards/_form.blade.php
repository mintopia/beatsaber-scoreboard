<div class="form-group">
    <label class="form-label" for="competition">Competition</label>
    <div class="form-control-plaintext">
        <a href="{{ route('admin.competitions.show', isset($leaderboard) ? $leaderboard->competition : $competition) }}">
            {{ isset($leaderboard) ? $leaderboard->competition->name : $competition->name }}
        </a>
    </div>
</div>
<div class="form-group">
    <label class="form-label" for="name">Name</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="A public name for the leaderboard" value="{{ old('name', isset($leaderboard) ? $leaderboard->name : '') }}" />
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="form-label" for="key">Key</label>
    <input class="form-control @error('key') is-invalid @enderror" type="text" name="key" placeholder="A unique key for this leaderboard" value="{{ old('key', isset($leaderboard) ? $leaderboard->key : '') }}" />
    @error('key')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="form-label">Scoring Type</label>
    <div class="selectgroup w-100">
        <label class="selectgroup-item">
            <input type="radio" name="score_type" value="stPoints" class="selectgroup-input" @if(old('score_type', isset($leaderboard) ? $leaderboard->score_type : '') == 'stPoints') checked="checked"@endif>
            <span class="selectgroup-button">Points</span>
        </label>
        <label class="selectgroup-item">
            <input type="radio" name="score_type" value="stTime" class="selectgroup-input" @if(old('score_type', isset($leaderboard) ? $leaderboard->score_type : '') == 'stTime') checked="checked"@endif>
            <span class="selectgroup-button">Time</span>
        </label>
    </div>
    @error('score_type')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="custom-switch">
        <input type="checkbox" name="active" class="custom-switch-input" @if(old('active', isset($leaderboard) ? $leaderboard->active : false)) checked="checked"@endif value="1">
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">Active</span>
    </label>
    @error('active')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
