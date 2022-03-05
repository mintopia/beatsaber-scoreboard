<div class="form-group">
    <label class="form-label" for="name">Name</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="Player's nickname" value="{{ old('name', isset($player) ? $player->name : '') }}" />
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
