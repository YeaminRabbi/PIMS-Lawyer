@extends('layouts.frontend.masterLayout')
@section('NAVBAR')
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar ftco-navbar-light site-navbar-target" id="ftco-navbar">
        <div class="container">
        <a class="navbar-brand" href="{{route('front')}}">Jahid</a>
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav nav ml-auto">
            <li class="nav-item"><a href="{{route('front')}}" class="nav-link"><span>Home</span></a></li>
            <li class="nav-item"><a href="{{route('Gallery')}}" class="nav-link"><span>Gallery</span></a></li>
            <li class="nav-item"><a href="{{route('CaseStudy')}}" class="nav-link"><span>Case Study</span></a></li>
            <li class="nav-item"><a href="{{route('Blog')}}" class="nav-link"><span>Blogs</span></a></li>
            </ul>
        </div>
        </div>
    </nav>
@endsection

@section('pagetitle')
    Gallery
@endsection

@section('content')
<section class="ftco-section" id="case-study">
    <div class="container">
            <div class="row justify-content-center mb-5 pb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                <h2 class="mb-4">Gallery</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($gallery as $data)
                    <div class="col-md-4 d-flex ftco-animate" >
                        <div class="blog-entry justify-content-end">
                            <a href="{{ route('GalleryDetails', $data->id)}}" class="block-20" style="background-image: url({{ asset('images/gallery/'.$data->created_at->format('Y/M/').'/'.$data->get_firstImage($data->id)) }});">
                            </a>
                            <div class="text mt-3 float-right d-block">
                                <div class="d-flex align-items-center mb-3 meta">
                                <p class="mb-0">
                                    <span class="mr-2">{{date('d M, Y', strtotime($data->created_at))}}</span>
                                    <a class="mr-2">{{ $user->name }}</a>
                                    <a class="meta-chat"><span class="icon-chat"></span> 3</a>
                                </p>
                            </div>
                            <a href="{{ route('GalleryDetails', $data->id)}}">
                                <h3 class="heading">{{$data->title}}</h3>
                            </a>
                            <p>{!! Str::limit($data->caption, 100,'.....') !!}</p>
                            
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        
    </div>
</section>
@endsection