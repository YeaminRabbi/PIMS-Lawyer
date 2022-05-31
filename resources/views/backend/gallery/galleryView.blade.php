@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Gallery
@endsection
@section('pagename')
   <a href="{{route('AdminGallery')}}" style="color:grey;">Gallery</a> &nbsp;/&nbsp; {{$gallery->title}}
@endsection

@section('pagecontent')
<section id="Gallery" style="display: block;">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a href="{{ route('AdminGallery') }}">
                    <button class="btn btn-outline-dark"> <i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                </a>
            </div>
        </div>
        <div class="row m-t-45">
            <div class="col-6">
                <h2>
                    {{$gallery->title}}
                </h2>
            </div>
            <div class="col-6" style="text-align: right;" style="padding-left: 10px">
                <div style="margin-left: 60%;">
                    <button class="btn btn-outline-warning" onclick="ShowHide()"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                    <a href="{{ route('AdminGalleryDelete' , $gallery->id) }}" onclick="return confirm('Your Album will be deleted!')">
                        <button class="btn btn-outline-danger" ><i class="fa fa-trash" aria-hidden="true" ></i> Delete</button>
                    </a>
                </div>
            </div>
            <div class="col-6">
                <p>
                    <i class="fa fa-clock"></i>
                    {{$gallery->created_at->format('d M, Y')}}
                </p>
            </div>
            
            <div class="col-12 m-t-10 text-justify">
                <p>{{ $gallery->caption }}</p>
            </div>

            <div class="col-12 m-t-30 m-l-20" id="UpdateGallery" style="display: none;">
                <div class="row">
                    <h3>Update Gallery</h3>
                </div>

                <div class="row">
                    <form action="{{ route('AdminGalleryEdit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label>Title</label>
                                </div>
                                <div class="col-12">
                                   <input type="text" class="form-control" value="{{$gallery->title}}" name="title">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label>Caption</label>
                                </div>
                                <div class="col-12">
                                    <textarea name="caption" id="" cols="120" rows="5" required>{{ $gallery->caption }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div >
                            <button type="submit" class="btn btn-outline-success">Update</button>
                            
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">

            @foreach ($gallery_images as $data)
                <div class="col-md-4 m-t-15">
                    <img class="album-img-view" src="{{ asset('images/gallery/'.$gallery->created_at->format('Y/M/').'/'.$data->image) }}" alt="Img" />
                    <a href="{{ route('AdminGallerySingleImageDelete' , $data->id) }}" onclick="return confirm('Your File will be deleted!')">
                        <button type="button" class="xbtn-1" data-toggle="modal" data-target="#Modal">
                            <i class="fa fa-trash"></i>
                        </button>
                    </a>
                    
                </div>
            @endforeach
           
            
            <div class="col-md-4 m-t-15">
                <img class="album-img-view-add" src="{{ asset('backendAssets/images/add-imge.png') }}" alt="Img" onclick="Show()" style="cursor: pointer;"/>
            </div>
        </div>
    </div>
</section>

<section id="GalleryForm" class="mt-5" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col">

                <b>Add More Images to Gallery</b>
                <div class="mt-3">
                    @if (\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                    @endif
                 
                    <form action="{{ route('AdminGalleryMoreInsert') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="gallery_id" value="{{ $gallery->id }}">
                        <input type="hidden" name="title" value="{{ $gallery->title }}">

                        <div class="form-group">
                            <label>Gallery Images</label>
                            {{-- <input class="form-control" type="file" name="images[]" id="GalleryImg" accept="image/*" multiple required> --}}
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                  <label class="upload__btn">
                                    <p>Select image</p>
                                    <input type="file" data-max_length="20" class="upload__inputfile" class="form-control" type="file" name="images[]" id="GalleryImg" accept="image/*" multiple required>
                                  </label>
                                </div>
                                <div class="upload__img-wrap"></div>
                            </div>
                        </div>
                                                     
                        <div>
                            <button class="btn btn-outline-primary m-b-20 mt-3" type="submit">Submit</button>                               
                            <button class="btn btn-outline-dark m-b-20 mt-3" onclick="Reset()" >Back</button>                               
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('footer_js')
    
    <script>
        function Show() {
            var x = document.getElementById("GalleryForm");
           
            if (x.style.display === "none") {
            x.style.display = "block";
           
            } else {
            x.style.display = "none";
         

            }
        }


        function Reset(){
            var x = document.getElementById("GalleryForm");
            if (x.style.display === "block") {
            x.style.display = "none";
            } else {
            x.style.display = "block";
         
            }
        }

        function Reset2(){
            var x = document.getElementById("UpdateGallery");
            if (x.style.display === "block") {
            x.style.display = "none";
            } else {
            x.style.display = "block";
         
            }
        }
        function ShowHide() {
            var x = document.getElementById("UpdateGallery");
           
            if (x.style.display === "none") {
            x.style.display = "block";
           
            } else {
            x.style.display = "none";
         

            }
        }

        
    </script>
<script>
    jQuery(document).ready(function () {
      ImgUpload();
    });
    
    function ImgUpload() {
      var imgWrap = "";
      var imgArray = [];
    
      $(".upload__inputfile").each(function () {
        $(this).on("change", function (e) {
          imgWrap = $(this).closest(".upload__box").find(".upload__img-wrap");
          var maxLength = $(this).attr("data-max_length");
    
          var files = e.target.files;
          var filesArr = Array.prototype.slice.call(files);
          var iterator = 0;
          filesArr.forEach(function (f, index) {
            if (!f.type.match("image.*")) {
              return;
            }
    
            if (imgArray.length > maxLength) {
              return false;
            } else {
              var len = 0;
              for (var i = 0; i < imgArray.length; i++) {
                if (imgArray[i] !== undefined) {
                  len++;
                }
              }
              if (len > maxLength) {
                return false;
              } else {
                imgArray.push(f);
    
                var reader = new FileReader();
                reader.onload = function (e) {
                  var html =
                    "<div class='upload__img-box'><div style='background-image: url(" +
                    e.target.result +
                    ")' data-number='" +
                    $(".upload__img-close").length +
                    "' data-file='" +
                    f.name +
                    "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                  imgWrap.append(html);
                  iterator++;
                };
                reader.readAsDataURL(f);
              }
            }
          });
        });
      });
    
      $("body").on("click", ".upload__img-close", function (e) {
        var file = $(this).parent().data("file");
        for (var i = 0; i < imgArray.length; i++) {
          if (imgArray[i].name === file) {
            imgArray.splice(i, 1);
            break;
          }
        }
        $(this).parent().parent().remove();
      });
    }
        
    </script> 
   
@endsection