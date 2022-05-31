@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Case Study
@endsection
@section('pagename')
    Case Study
@endsection

@section('pagecontent')
        <!-- Blog-->
            <section class="statistic-chart" id="CASESTUDY" style="display: block">
                <div class="container">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <h3 class="title-5 m-b-35">Case Study</h3>
                        </div>
                        <div class="col-md-6" style="text-align: right">
                            <button class="btn btn-outline-primary" onclick="ShowBlogForm()"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</button>
                            <a href="{{ route('AdminCaseStudyTrash') }}">
                                <button class="btn btn-outline-danger"><i class="fa fa-trash" aria-hidden="true"></i> Trash</button>
                            </a>

                        </div>
                    </div>
                    <div class="row">
                       
                        @if ($caseStudies->isNotEmpty())                            
                            @foreach ($caseStudies as $data)
                                <div class="col-md-4">
                                    <div class="card">
                                        <a href="{{ route('AdminCaseStudyDetails', $data->id) }}">
                                            <img class="blog-img-view-1" src="{{ asset('images/case_study/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Card image cap">
                                        </a>
                                        <div class="card-body">
                                            <p style=" font-size: 20px;font-weight: bold;">{{ $data->title }}</p>
                                            <p style="font-size: 14px;"><i class="fa fa-clock m-r-5"></i><?php echo date_format($data->created_at,"d M, Y"); ?> &nbsp;</p>
                                             <div class="m-t-10">
                                                {!! Str::limit($data->introduction, 100,'.....') !!}                                               
                                            </div> 
                                            
                                            <a href="{{ route('AdminCaseStudyDetails', $data->id) }}">
                                                <button class="btn btn-outline-primary mt-2">View</button>                                                
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach                            
                        @endif

                        <div class="col-md-4">
                            <div class="card" >
                                <div class="zoom">
                                    <img class="card-img-top" src="{{ asset('backendAssets/images/add.jpg') }}" alt="Card image cap" onclick="ShowBlogForm()"  onclick="ShowBlogForm()">
                                </div>
                                <div class="card-body" style="margin:auto;">
                                    <h4 class="card-title mb-3">Add new Case Study</h4>
                                    <button class="btn btn-outline-primary" onclick="ShowBlogForm()" >Create Case Study</button>
                                </div>
                            </div>
                        </div>
                       

                    </div>
                </div>
            </section>


            <section id="WRITECASESTUDY" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div>
                                <button class="btn btn-outline-dark m-b-20 mt-3" onclick="Reset()" >Back</button>                               

                            </div>

                            <b style="font-size: 24px">Write New Case Study</b>
                            <div class="mt-3">
                                @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            {!! \Session::get('error') !!}
                                        </div>
                                @endif
                             
                                <form action="{{ route('AdminCaseStudyInsert') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div>
                                        <img class="blog-img-view-121" id="output" src="{{ asset('backendAssets/images/add-imge-3.png') }}">
                                    </div>

                                    <div class="form-group m-t-20">
                                        <label class="label-bold">Case Study Image</label>
                                        <input class="form-control" type="file" name="image" id="BlogImg" accept="image/*" onchange="loadFile(event)" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-bold">Case Study Title</label>
                                        <input class="form-control" type="text" name="title" placeholder="Title" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-bold">Case Study Introduction</label>
                                        <textarea id="" cols="30" rows="5" class="form-control" type="text" name="introduction" placeholder="Introduction" required></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="label-bold">Case Study Content</label>
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
        var x = document.getElementById("WRITECASESTUDY");
        var y = document.getElementById("CASESTUDY");

        if (x.style.display === "none") {
          x.style.display = "block";
          y.style.display = "none";

        } else {
          x.style.display = "none";
          y.style.display = "block";

        }
      }


    function Reset(){
        var x = document.getElementById("WRITECASESTUDY");
        var y = document.getElementById("CASESTUDY");

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