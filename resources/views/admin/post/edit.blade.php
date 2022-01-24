<x-admin-master>
    @section('content')
        <h1>Edit</h1>
        <form method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter a title" value="{{$post->title}}">
            </div>

            <div class="form-group">
                <label for="post_image">File</label>
                <img class="img-fluid w-50" src="/storage/{{$post->post_image}}">
                <input type="file" name="post_image" class="form-control-file" id="post_image" placeholder="">
            </div>

            <div class="form-group">
                <textarea name="body" class="form-control" id="body" cols="30" rows="10">value="{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection

</x-admin-master>
