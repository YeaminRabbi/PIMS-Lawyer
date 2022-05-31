@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Blog
@endsection
@section('pagename')
    Blog
@endsection

@section('pagecontent')
        <!-- Blog-->
            <section class="statistic-chart" id="BLOG" style="display: block">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-6">
                            <h3 class="title-5 m-b-35">Blogs</h3>
                        </div>
                        <div class="col-6" style="text-align: right">
                            <button class="btn btn-outline-primary m-t-10" onclick="ShowBlogForm()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Blog</button>
                            <a href="{{ route('AdminBlogTrash') }}">
                                <button class="btn btn-outline-danger m-t-10"><i class="fa fa-trash" aria-hidden="true"></i> Trash</button>
                            </a>

                        </div>
                    </div>
                    <div class="row">
                       
                        @if ($blogs->isNotEmpty())                            
                            @foreach ($blogs as $data)
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="blog-img-view-1" src="{{ asset('images/blog/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <p style="font-size: 20px;font-weight: bold;">{{ $data->title }}</p>
                                            <p style="font-size: 14px;"><?php echo date_format($data->created_at,"d M, Y"); ?> &nbsp;|&nbsp; Comments (5)</p>
                                             <div class="m-t-10">
                                                {!! Str::limit($data->introduction, 120,'.....') !!}                                               
                                            </div> 
                                            
                                            <a href="{{ route('AdminBlogDetails', $data->id) }}">
                                                <button class="btn btn-outline-primary mt-2">View</button>                                                
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach                            
                        @endif

                        <div class="col-md-4">
                            <div class="card" >
                                <div class="zoom">
                                    <img class="card-img-top" src="{{ asset('backendAssets/images/add.jpg') }}" alt="Card image cap" onclick="ShowBlogForm()">
                                </div>
                                <div class="card-body" style="margin:auto;">
                                    <h4 class="card-title mb-3">Add new Blog</h4>
                                    <button class="btn btn-outline-primary" onclick="ShowBlogForm()" >Create Blog</button>
                                </div>
                            </div>
                        </div>
                       

                    </div>
                </div>
            </section>


            <section id="WRITEBLOG" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div>
                                <button class="btn btn-outline-dark m-b-20 mt-3" onclick="Reset()" >Back</button>                               

                            </div>

                            <b>Write New Blog</b>
                            <div class="mt-3">
                                @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            {!! \Session::get('error') !!}
                                        </div>
                                @endif
                             
                                <form action="{{ route('AdminBlogInsert') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div>
                                        <img class="blog-img-view-121" id="output" src="{{ asset('backendAssets/images/add-imge-05.png') }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="label-bold">Blog Image</label>
                                        <input class="form-control" type="file" name="image" id="BlogImg" accept="image/*" onchange="loadFile(event)" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-bold">Blog Title</label>
                                        <input class="form-control" type="text" name="title" placeholder="Blog Title" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-bold">Blog Introduction</label>
                                        <textarea class="form-control" type="text" name="introduction" placeholder="Blog Introduction" required cols="120" rows="5"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="label-bold">Blog Content</label>
                                        <textarea name="text" id="" cols="30" rows="10" required></textarea>
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
    
    function ShowBlogForm() {
        var x = document.getElementById("WRITEBLOG");
        var y = document.getElementById("BLOG");

        if (x.style.display === "none") {
          x.style.display = "block";
          y.style.display = "none";

        } else {
          x.style.display = "none";
          y.style.display = "block";

        }
      }


    function Reset(){
        var x = document.getElementById("WRITEBLOG");
        var y = document.getElementById("BLOG");

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
    
    CKEDITOR.replace('text');
</script>

<script>
    var loadFile = function(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
      }
    };
</script>


@endsection