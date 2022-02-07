<x-admin-master>
    @section('content')

        <h1>User profile for:  {{$user->username}}</h1>

        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('admin.users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <img style="height: 3rem;width: 3rem;" class="img-profile rounded-circle mb-3" src="/storage/{{$user->avatar}}">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control  @error('username') is-invalid @enderror" name="username" id="username" value="{{$user->username}}">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{$user->name}}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{$user->email}}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>

                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password-confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Option</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Option</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Attach</th>
                            <th>Detach</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td><input type="checkbox"
                                    @foreach($user->roles as $user_role)
                                        @if($user_role->name == $role->name)
                                            checked
                                            @endif
                                        @endforeach
                                    ></td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <form method="post" action="{{route('users.role.attach', $user->id)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-primary"
                                        @if($user->roles->contains($role))
                                            disabled
                                            @endif

                                        >Attach</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="post" action="{{route('users.role.detach', $user->id)}}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}">
                                        <button class="btn btn-danger"
                                                @if(!$user->roles->contains($role))
                                                disabled
                                            @endif

                                        >Detach</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>


    @endsection
</x-admin-master>
