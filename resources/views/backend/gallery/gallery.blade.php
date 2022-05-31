@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Gallery
@endsection
@section('pagename')
    Gallery
@endsection

@section('pagecontent')
        <!-- Gallery-->
         

            <section class="statistic-chart" id="Gallery" style="display: block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="title-5 m-b-35">Gallery</h3>
                        </div>
                    </div>
                    <div class="row">
                        
                        @if ($gallery->isNotEmpty())
                            @foreach ($gallery as $data)
                                <div class="col-md-4">
                                    <div class="card">
                                        <a href="{{ route('AdminGalleryView', $data->id) }}">
                                            <img class="blog-img-view-1" src="{{ asset('images/gallery/'.$data->created_at->format('Y/M/').'/'.$data->get_firstImage($data->id)) }}" alt="Card image cap">
                                        </a>
                                        <div class="card-body">
                                            <p style="font-size: 20px;font-weight: bold;">{{$data->title}}</p>
                                            <p style="font-size: 14px;"> <i class="fa fa-clock m-r-5"></i> {{$data->created_at->format('d M, Y')}} &nbsp;|&nbsp; Images ({{$data->get_imagesCount($data->id)}})</p>
                                            <p class="card-text m-t-10">
                                                {!! Str::limit($data->caption, 70,'.....') !!}
                                            </p>
                                            <a href="{{ route('AdminGalleryView', $data->id) }}">
                                                <button class="btn btn-outline-primary mt-2">View</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div class="col-md-4">
                            <div class="card" >
                                <div class="">
                                    <img class="album-img-view-1" src="{{ asset('backendAssets/images/add-imge-1.png') }}" alt="Card image cap" onclick="Show()">
                                </div>
                                <div class="card-body" style="margin:auto;">
                                    <h4 class="card-title mb-3">Add new Gallery</h4>
                                    <button class="btn btn-outline-primary" onclick="Show()" >Create Gallery</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="GalleryForm" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div>
                                <button class="btn btn-outline-dark m-b-20 mt-3" onclick="Reset()" >Back</button>                               
                            </div>
                            <b>Create New Gallery</b>
                            <div class="mt-3">
                                @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            {!! \Session::get('error') !!}
                                        </div>
                                @endif
                                <form action="{{ route('AdminGalleryInsert') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Gallery Title</label>
                                        <input class="form-control" type="text" name="title" placeholder="Title" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <label>Caption</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea name="caption" id="" style="width: 100%" rows="5" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Gallery Images</label>
                                        {{--<input class="form-control" type="file" name="images[]" id="GalleryImg" accept="image/*" multiple required>--}}
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
        var y = document.getElementById("Gallery");

        if (x.style.display === "none") {
          x.style.display = "block";
          y.style.display = "none";

        } else {
          x.style.display = "none";
          y.style.display = "block";

        }
      }


    function Reset(){
        var x = document.getElementById("GalleryForm");
        var y = document.getElementById("Gallery");

        if (x.style.display === "block") {
          x.style.display = "none";
          y.style.display = "block";

        } else {
          x.style.display = "block";
          y.style.display = "none";

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