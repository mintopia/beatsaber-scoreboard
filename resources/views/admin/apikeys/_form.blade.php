<div class="form-group">
    <label class="form-label" for="description">Description</label>
    <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" placeholder="Description of the API Key" value="{{ old('description', isset($apikey) ? $apikey->description : '') }}" />
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label class="custom-switch">
        <input type="checkbox" name="active" class="custom-switch-input" @if(old('active', isset($apikey) ? $apikey->active : false)) checked="checked"@endif value="1">
        <span class="custom-switch-indicator"></span>
        <span class="custom-switch-description">Active</span>
    </label>
    @error('active')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
