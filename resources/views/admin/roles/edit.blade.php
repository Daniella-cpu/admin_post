<x-admin-master>
    @section('content')
        <h1>Role of: {{$role->name}}</h1>

    <div class="row">
        <div class="col-sm-3 form-group">
            @if(session()->has('role-updated'))
                <div class="alert alert-success">{{session('role-updated')}}</div>
            @endif
            <form method="post" action="{{route('roles.update', $role->id)}}">
                @csrf
                @method('PUT')
                <label for="name">Name</label>
                <input class="form-control" type="text" name="name" id="name" value="{{$role->name}}">
                <button class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>

    @if($permissions->isNotEmpty())
        <div class="row">
            <div class="col-lg-12">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTables">
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
                                    @foreach($permissions as $permission)
                                        <tr>
                                            <td>
                                                <input type="checkbox"
                                                @foreach($role->permissions as $role_permit)
                                                    @if($role_permit->name == $permission->name)
                                                        checked
                                                    @endif
                                                    @endforeach
                                                >
                                            </td>
                                            <td>{{$permission->id}}</td>
                                            <td><a href="">{{$permission->name}}</a></td>
                                            <td>{{$permission->name}}</td>
                                            <td>
                                                <form method="post" action="{{route('roles.permission.attach', $role->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button class="btn btn-primary"
                                                            @if($role->permissions->contains($permission))
                                                            disabled
                                                         @endif

                                                    >Attach</button>
                                                </form>
                                            </td>

                                            <td>
                                                <form method="post" action="{{route('roles.permission.detach', $role->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button class="btn btn-danger"
                                                            @if(!$role->permissions->contains($permission))
                                                            disabled
                                                        @endif

                                                    >Detach</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endif


    @endsection
</x-admin-master>
