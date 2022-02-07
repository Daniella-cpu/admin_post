<x-admin-master>
    @section('content')
        <h1>Permission to: {{$permission->name}}</h1>

        <div class="row">
            <div class="col-sm-3 form-group">
                @if(session()->has('permission-updated'))
                    <div class="alert alert-success">{{session('permission-updated')}}</div>
                @endif
                <form method="post" action="{{route('permissions.update', $permission->id)}}">
                    @csrf
                    @method('PUT')
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$permission->name}}">
                    <button class="btn btn-primary mt-3">Update</button>
                </form>
            </div>
        </div>
    @endsection
</x-admin-master>
