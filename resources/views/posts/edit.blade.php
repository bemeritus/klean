<x-layouts.main xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot:title>
        Edit Post #{{ $post->id }}
    </x-slot:title>

    <x-page-header-start>
        Edit Post #{{ $post->id }}
    </x-page-header-start>

    <div class="bg-light rounded p-5">
        <div class="col-lg-7 mb-5 mb-lg-0 m-auto">
            <div class="contact-form">
                <div id="success"></div>

                <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="control-group">
                        <input type="text" class="form-control p-4" name="title" value="{{ $post->title }}" placeholder="Title"/>
                        <p class="help-block text-danger"></p>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="control-group form-control p-4 mb-4">
                        <input type="file" class="" name="photo" placeholder="Photo"/>
                        @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="control-group">
                        <textarea class="form-control p-4" rows="3" name="short_content" placeholder="Short Content">{{ $post->short_content }}</textarea>
                        <p class="help-block text-danger"></p>
                        @error('short_content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="control-group">
                        <textarea class="form-control p-4" rows="6" name="content" placeholder="Content">{{ $post->content }}</textarea>
                        <p class="help-block text-danger"></p>
                        @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center row-cols-2" style="column-gap: 12px">

                        <button class="btn btn-success py-3 px-5" type="submit" >Save</button>

                        <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-danger py-3 px-5"> Cancel Edit</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-layouts.main>
