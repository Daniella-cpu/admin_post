<x-admin-master>
    @section('content')
    @if(session('message'))

        <div class="alert alert-danger">{{session('message')}}</div>

        @elseif(session('post-message'))
            <div class="alert alert-success">{{session('post-message')}}</div>

        @endif

    @if($posts->isNotEmpty())
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Body</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>id</th>
                        <th>Owner</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Body</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Delete</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->user->name}}</td>
                        <td><a href="{{route('post.edit', $post->id)}}">{{$post->title}}</a></td>
                        <td>
                            <img height="40px" src="/storage/{{$post->post_image}}">
                        </td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                        <td>
{{--                            @can('view', $post)--}}
                            <form method="post" action="{{route('post.delete', $post->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Delete</button>
                            </form>
{{--                            @endcan--}}
                        </td>

                    </tr>

                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        </div>

        @else()
        <h1>No Post created</h1>

        @endif

        <div class="d-flex">
            <div class="mx-auto">
                {{$posts->links()}}
            </div>
        </div>
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->


        @endsection
</x-admin-master>
