<x-admin-master>
    @section('content')
        <h1>Users</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
            @if(session('user-delete'))
                <div class="alert alert-danger">{{session('user-delete')}}</div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
{{--                    @if(auth()->user()->userHasPost)--}}
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profile image</th>
                            <th>Registered Date</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>id</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Name</th>
                            <th>Profile image</th>
                            <th>Registered Date</th>
                            <th>Updated At</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>

                        <tbody>
                        @foreach($user as $users)
                            <tr>
                                <td>{{$users->id}}</td>
                                <td>{{$users->username}}</td>
                                <td>{{$users->name}}</td>
                                <td>{{$users->email}}</td>
                                <td>
                                    <img height="40px" src="/storage/{{$users->avatar}}">
                                </td>
                                <td>{{$users->created_at->diffForHumans()}}</td>
                                <td>{{$users->updated_at->diffForHumans()}}</td>
                                <td>
{{--                                                                @can('view', $post)--}}
                                    <form method="post" action="{{route('user.delete', $users->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
{{--                                                                @endcan--}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="mx-auto">
                {{$user->links()}}
            </div>
        </div>

{{--        @endif--}}
    @endsection

        @section('scripts')
        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

{{--            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>--}}

            <!-- Page level custom scripts -->


        @endsection
</x-admin-master>
