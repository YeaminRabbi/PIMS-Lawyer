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


@section('custom_css')
    <style>
        #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    
    #myImg:hover {opacity: 0.7;}
    
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }
    
    /* Modal Content (Image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }
    
    /* Caption of Modal Image (Image Text) - Same Width as the Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }
    
    /* Add Animation - Zoom in the Modal */
    .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }
    
    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }
    
    /* The Close Button */
    .close {
        position: absolute;
        top: 75px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        z-index: 2;
    }
    
    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }
    
    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
        width: 100%;
        }
    }
    </style>
@endsection

@section('content')
<section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 ftco-animate">
          <h2 class="mb-3">{{$gallery->title}}</h2>
          
          <p>
            {{$gallery->caption}}
          </p>
         
        <div class="row">

            @foreach ($galleryImg as $data)
                <div class="col-md-6 col-6 d-flex">
                    <div class="album-img-view-add p-2">
                        <img id="myImg-{{ $data->id }}" onclick="ViewImage({{$data->id}})" src="{{ asset('images/gallery/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="img">
                    </div>
                </div>
            @endforeach
           
        </div>

        </div> <!-- .col-md-8 -->

        @if ($othergallery->isNotEmpty())
            <div class="col-lg-4 sidebar ftco-animate">
            
                <div class="sidebar-box ftco-animate">
                <h3 class="heading-sidebar">Other Albums</h3>
                
                @foreach ($othergallery as $data)
                    <div class="block-21 mb-4 d-flex">
                        <a href="{{ route('GalleryDetails', $data->id)}}" class="blog-img mr-4" style="background-image: url({{ asset('images/gallery/'.$data->created_at->format('Y/M/').'/'.$data->get_firstImage($data->id)) }});"></a>
                        <div class="text">
                        <h3 class="heading"><a href="{{ route('GalleryDetails', $data->id)}}">{{$data->title}}</a></h3>
                        <div class="meta">
                            <div>
                                <a>
                                    <span class="icon-calendar"></span> {{date('d M, Y', strtotime($data->created_at))}}
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach

                </div>
            </div>
        @endif
       

      </div>
    </div>
  </section> <!-- .section -->


  <section id="MODAL">
   
    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- The Close Button -->
    <span class="close" style="color: white;">&times;</span>

    <!-- Modal Content (The Image) -->
    <img class="modal-content" id="img01">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
    </div>
  </section>

@endsection


@section('footer_js')
    
<script>
    function ViewImage(data)
    {
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('myImg-'+data);
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        modal.style.display = "block";
        modalImg.src = img.src;

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }
    }
</script>
@endsection