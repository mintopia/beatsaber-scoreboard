<div class="form-group">
    <label class="form-label" for="name">Name</label>
    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" placeholder="A public name for the competition" value="{{ old('name', isset($competition) ? $competition->name : '') }}" />
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="form-label" for="description">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="A short description for the competition">{{ old('description', isset($competition) ? $competition->description : '') }}</textarea>
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="form-label" for="name">Style</label>
    <select class="form-control custom-select @error('style') is-invalid @enderror" name="style">
        <option value="beatsaber" @if(old('style', isset($competition) ? $competition->style : '') == 'beatsaber') selected="selected"@endif>Beat Saber</option>
    </select>
    @error('style')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="custom-switch">
        <input type="checkbox" name="follow_scores" class="custom-switch-input" @if(old('active', isset($competition) ? $competition->follow_scores : false)) checked="checked"@endif value="1">
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">Follow Scores</span>
    </label>
    @error('follow_scores')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="custom-switch">
        <input type="checkbox" name="active" class="custom-switch-input" @if(old('active', isset($competition) ? $competition->active : false)) checked="checked"@endif value="1">
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">Active</span>
    </label>
    @error('active')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
