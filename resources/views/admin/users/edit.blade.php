@extends('layouts.application', [
    'title' => [
        'Users',
        $user->nickname
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            Users
        </h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form class="card" action="{{ route('admin.users.update', $user) }}" method="post">
                {{ csrf_field() }}
                @method('PATCH')
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="form-group">
                                <label class="form-label" for="nickname">Nickname</label>
                                <input class="form-control @error('nickname') is-invalid @enderror" type="text" name="nickname" placeholder="Nickname for the user" value="{{ old('nickname', $user->nickname) }}" />
                                @error('nickname')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email address for the user" value="{{ old('email', $user->email) }}" />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="avatar">Avatar</label>
                                <input class="form-control @error('avatar') is-invalid @enderror" type="text" name="avatar" placeholder="Avatar URL" value="{{ old('avatr', $user->avatar) }}" />
                                @error('avatar')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="custom-switch">
                                    <input type="checkbox" name="admin" class="custom-switch-input" @if(old('admin', $user->admin)) checked="checked"@endif value="1">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">Admin</span>
                                </label>
                                @error('active')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <div class="d-flex">
                        <a class="btn btn-link" href="{{ route('admin.users.index') }}">Cancel</a>
                        <button class="btn btn-primary ml-auto" type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
