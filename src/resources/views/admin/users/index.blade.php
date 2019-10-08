@extends('layouts.application', [
    'title' => [
        'Users',
    ]
]
)

@section('content')
    <div class="page-header">
        <h1>
            Users
        </h1>
    </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive">
                    <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
                        <thead>
                            <tr>
                                <th colspan="2">Nickname</th>
                                <th>Email</th>
                                <th>Admin</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="w-1">
                                    <span class="avatar rounded" style="background-image: url('{{ $user->avatar }}');"></span>
                                </td>
                                <td>{{ $user->nickname }}</td>
                                <td>
                                    @if ($user->email)
                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    @else
                                        <span class="text-muted">Not Provided</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($user->admin)
                                        <span class="status-icon bg-success"></span>
                                        Admin
                                    @endif
                                </td>
                                <td class="w-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary btn-sm"><i class="fe fe-edit-2"></i></a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#deleteUserModal{{ $user->id }}"><i class="fe fe-trash"></i></button>


                                    <div class="modal fade" id="deleteUserModal{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="delete-link" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Delete User</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete <strong>{{ $user->nickname }}</strong>?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('admin.users.destroy', $user) }}" method="post">
                                                            {{ csrf_field() }}
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-danger ml-auto" type="submit">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if ($users->hasMorePages())
                    <div class="card-footer">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
