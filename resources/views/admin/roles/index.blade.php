<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-3 form-group">
                @if(session()->has('role-created'))
                    <div class="alert alert-success">{{session('role-created')}}</div>
                @endif
                <form method="post" action="{{route('roles.store')}}">
                    @csrf
                    <label for="name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button class="btn btn-primary mt-3">Create</button>
                </form>
            </div>

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
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td><a href="{{route('roles.edit', $role->id)}}">{{$role->name}}</a></td>
                                    <td>{{$role->slug}}</td>
                                    <td>
                                        <form method="post" action="{{route('roles.delete', $role->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger">Delete</button>
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


    @endsection
</x-admin-master>
