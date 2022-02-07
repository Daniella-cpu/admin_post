<x-admin-master>
    @section('content')
       <h1>create a post</h1>
        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="">
                @error('title')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="post_image"></label>
                <input type="file" name="post_image" class="form-control-file @error('post_image') is-invalid @enderror" id="post_image" placeholder="">
                @error('post_image')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>

            <div class="form-group">
               <textarea name="body" class="form-control @error('body') is-invalid @enderror" id="body" cols="30" rows="10"></textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection

</x-admin-master>
