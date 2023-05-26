@extends('dashboard.layouts.main')

@section('container')
 
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Edit Post</h1>
</div>
<div class="col-lg-8">
    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3 ">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" autofocus required value="{{  old('title',$post->title) }}" >
          @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="mb-3 ">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required value="{{  old('slug',$post->slug) }}">
            @error('slug')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3 ">
            <label for="category" class="form-label">Category</label>
            <select class="form-select"  name="category_id">
            @foreach ($categries as $category)

        {{-- untuk memberikan old('category') -> jika old('category') == category id sebelumnya maka pilih berisak 'selected' di option --}}
            @if(old('category_id',$post->category->id) == $category->id)
            <option value="{{ $category->id }}" selected>{{  $category->name }}</option>
        {{-- tetapi jika bukan pilih option yang tanpa ada 'selected' --}}
            @else
            <option value="{{ $category->id }}">{{  $category->name }}</option>
            @endif
            @endforeach
              </select>
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label for="image" class="form-label">Post Image</label>
            {{-- input di bawah untuk menyimpan image lama --}}
            <input type="hidden" name="oldImage" value="{{ $post->image }}">
        {{-- Untuk menampilkan data image edit sebelumnya --}}
            @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }} "class="img-preview img-fluid mb-3 col-sm-5 d-block">   
            @else
            {{-- img-preview: class agar bisa di panggil di js  , img-fluid:Agar imgnya responsif  --}}
            <img class="img-preview img-fluid mb-3 col-sm-5">     
            @endif

            <input class="form-control   @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
            @error('image')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
        </div>
       {{-- End Image --}}

        {{-- text editor --}}
        <div class="mb-3 ">
          <label for="body" class="form-label">Body</label>
          @error('body')
          <p class="text-danger"> {{ $message }} </p> 
          @enderror
          {{-- <input type="hidden"  id="body" name="body" value="{{  old('body',$post->body) }}"> --}}
          <textarea type="hidden" id="body" name="body">{{ old('body',$post->body) }}</textarea>
        </div>
        {{-- end --}}
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>


<script>
    // {{-- script untuk pembuatan slug otomatis --}}
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    // event handeller
    title.addEventListener('change', function(){
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => slug.value = data.slug)
    })

    // CKEDITOR.replace( 'editor1' );
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

     //Preview Image
     function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector ('.img-preview');
        
        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection


