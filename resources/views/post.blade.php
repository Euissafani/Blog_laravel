@extends('layout.main')

@section('container')

<div class="container">
   <div class="row justify-content-center">
    <div class="col-md-8">
        <h2 class="mb-3">  {{ $post->title }}</h2>
        <p>By.<a href="/posts?author={{ $post->author->user_name }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/posts?category=/{{ $post->category->slug }}">{{ $post->category->name }}</a></p>
        
        {{-- Cara Upload gambar --}}
        @if ($post->image)
        <div style="max-height: 350px; overflow:hidden">
            <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid mt-4" alt="{{ $post->category->name }}">
        </div>    
        @else  
        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid" alt="{{ $post->category->name }}">
        @endif
       
       
        <article class="my-3 fs-5">

            {{-- Untuk menghilangkan tag <p> atau tag hatml gunakan {!!  !!} --}}
            {!! $post->body !!}
        </article>
      
        
        <a href="/posts" class="d-block mt-3">Back to post</a>
    </div>
   </div>
</div>


@endsection


