<x-layouts.main xmlns:x-slot="http://www.w3.org/1999/xlink">
    <x-slot:title>
        Create Blog
    </x-slot:title>

    <x-page-header-start>
        Create Blog
    </x-page-header-start>

    <div class="bg-light rounded p-5">
        <div class="col-lg-7 mb-5 mb-lg-0 m-auto">
            <div class="contact-form">
                <div id="success"></div>

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="control-group">
                        <input type="text" class="form-control p-4" name="title" placeholder="Title"/>
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
                        <textarea class="form-control p-4" rows="3" name="short_content" placeholder="Short Content"></textarea>
                        <p class="help-block text-danger"></p>
                        @error('short_content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="control-group">
                        <textarea class="form-control p-4" rows="6" name="content" placeholder="Content"></textarea>
                        <p class="help-block text-danger"></p>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <button class="btn btn-primary btn-block py-3 px-5" type="submit" >Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</x-layouts.main>
