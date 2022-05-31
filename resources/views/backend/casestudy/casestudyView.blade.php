@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Case Study 
@endsection
@section('pagename')
    <a href="{{route('AdminCaseStudy')}}" style="color:grey;">Case Study</a> &nbsp; /&nbsp; {{ $casestudy->title }}
@endsection

@section('pagecontent')
<!-- blog content -->
<section id="CaseStudyView" style="display:block;">
    <div class="container pt-3 ">
        <div class="row">
            <div class="col-lg-8">
                <div class="mt-2 mb-2">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('AdminCaseStudy') }}">
                                <button class="btn btn-outline-dark"> <i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                            </a>
                        </div>  
                        <div class="col-6" style="text-align: right">
                            <button class="btn btn-outline-warning" onclick="ShowBlogForm()"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp; Edit</button>
                            <a href="{{ route('AdminCaseStudyDelete', $casestudy->id) }}">
                                <button class="btn btn-outline-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                            </a>
                        </div> 
                    </div>
                
                </div>
                <div class="blogImage">
                    <img class="blog-img-view-121" src="{{ asset('images/case_study/'.$casestudy->created_at->format('Y/M/').'/'.$casestudy->image) }}" style="width: 100%;" alt="Blog Img">
                </div>
                <div class="blogContent mt-3">
                    <div class="d-flex">
                        <div>
                            <h3>{{ $casestudy->title }}</h3>
                            <p style="font-size: 14px;"> <i class="fa fa-clock"></i> {{ $casestudy->created_at->format('d M, Y') }}</p>
                        </div>
                    {{--    <div class="ml-auto">
                            
                            @if ($casestudy->comment_switch == 1)
                                <span>Comments</span>
                                <a href="{{ route('AdminBlogCommentOff', $casestudy->id) }}">
                                    <label class="switch switch-text switch-danger switch-pill">
                                        <input type="checkbox" class="switch-input" checked="true">
                                        <span data-on="Off" class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </a>
                                
                            @else
                                <span>Comments</span>
                                <a href="{{ route('AdminBlogCommentOn', $casestudy->id) }}">
                                    <label class="switch switch-text switch-primary switch-pill">
                                        <input type="checkbox" class="switch-input" checked="true">
                                        <span data-on="On" class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </a>
                                
                            @endif
                           
                        </div> --}}
                    </div>
                    
                </div>
                <div class="casestudytext mt-3">
                    <div style="overflow: hidden;" >
                        <p class="mt-3" style="font-weight: bold; font-style:italic; text-align:justify">{{ $casestudy->introduction }}</p>
                    </div>
                </div>
                <div class="casestudytext mt-3">
                    <div style="overflow: hidden; text-align: justify" >
                        {!! $casestudy->text !!}
                    </div>
                </div>

                {{-- <div class="blogComments mt-3 mb-5">
                    <h3>Comments</h3>
                    (On progress)
                     <div class="row mt-3" style="background-color: #F5F1EE;padding: 5px;">
                        <div class="col-9">
                            <div class="commentName" style="font-size: 17px;font-weight: bold;">
                                JellyFish
                            </div>
                            <div class="commentDate">
                                1 jan, 2022
                            </div>
                            <div class="commentText">
                                <p>Lorem Ipsum cluding versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <a href=""><i class="fa fa-chevron-right"></i> &nbsp;Reply</a>&nbsp;
                            <a href=""><i class="fa fa-trash"></i> &nbsp;Delete</a>                                    
                        </div>
                    </div>

                    <div class="row mt-3" style="background-color: #F5F1EE;padding: 5px;">
                        <div class="col-9">
                            <div class="commentName" style="font-size: 17px;font-weight: bold;">
                                JellyFish
                            </div>
                            <div class="commentDate">
                                1 jan, 2022
                            </div>
                            <div class="commentText">
                                <p>Lorem Ipsum cluding versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                        <div class="col-3">
                            <a href=""><i class="fa fa-chevron-right"></i> &nbsp;Reply</a>&nbsp;
                            <a href=""><i class="fa fa-trash"></i> &nbsp;Delete</a>                                    
                        </div>
                    </div> 

                    <div class="mt-3">
                        <a href="{{ route('AdminCaseStudy') }}">
                            <button class="btn btn-outline-dark"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                        </a>
                        <a href="{{ route('AdminCaseStudyDelete', $casestudy->id) }}">
                            <button class="btn btn-outline-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                        </a>
                    </div>

                </div> --}}
                <div class="mt-3">
                    <a href="{{ route('AdminCaseStudy') }}">
                        <button class="btn btn-outline-dark"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                    </a>
                    <a href="{{ route('AdminCaseStudyDelete', $casestudy->id) }}">
                        <button class="btn btn-outline-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                    </a>
                </div>
            </div>


            <div class="col-lg-4 mt-4">

                <h4 class="mb-3">Other Case Studies</h4>

                @if ($othercasestudy->isNotEmpty())
                    
                    @foreach ($othercasestudy as $data)
                        <div class="row mb-3">
                            <div class="col-5">
                                <a href="{{ route('AdminCaseStudyDetails', $data->id) }}">
                                    <img src="{{ asset('images/case_study/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Blog Img" class="side-blog-img">
                                </a>
                                
                            </div>
                            <div class="col-7" style="margin-left: -50px;">
                                <a href="{{ route('AdminCaseStudyDetails', $data->id) }}">
                                    <h4 class="m-t-20">{{ $data->title }}</h4>
                                    <b><?php echo date_format($data->created_at,"d M, Y"); ?></b> 
                                </a>  
                            </div>
                        </div>
                    @endforeach
                    
                @endif
            

                
                <div>
                    <a href="{{ route('AdminCaseStudy') }}">See more...</a>
                </div>
            </div>

        </div>
    </div>

</section>
<!-- end blog content -->

<!-- Edit Blog content -->

            <section id="EDITCASESTUDY" style="display: none;">
                <div class="container bg-white">
                    <div class="row">
                        <div class="col">

                            <div>
                                <button class="btn btn-outline-dark m-b-20 mt-3" onclick="Reset()" >Back</button>                               

                            </div>

                            <b>Your Case Study</b>
                            <div class="mt-3">
                                @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            {!! \Session::get('error') !!}
                                        </div>
                                @endif
                             
                                <form action="{{ route('AdminCaseStudyUpdate') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    

                                    <input type="hidden" name="casestudyID" value="{{ $casestudy->id }}">
                                    <div class="form-group">
                                        <img class="blog-img-view-121" src="{{ asset('images/case_study/'.$casestudy->created_at->format('Y/M/').'/'.$casestudy->image) }}" alt="Case Study Img" id="output">
                                        <div class="form-group">
                                            <label>Case Study Image: (Choose to upload New Image)</label>
                                            <input class="form-control" type="file" name="image" id="CaseStudyImg" accept="image/*" onchange="loadFile(event)" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Case Study Title</label>
                                        <input class="form-control" type="text" name="title" placeholder="Title" value="{{ $casestudy->title }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Case Study Introduction</label>
                                        <textarea cols="30" rows="5" class="form-control" type="text" name="introduction" placeholder="Introduction" required>{{ $casestudy->introduction }}</textarea>
                                        
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Case Study Content</label>
                                        <textarea name="text" id="" cols="30" rows="10" required>
                                            {{ $casestudy->text }}
                                        </textarea>
                                    </div>
    
                                    
                                    <div>
                                        <button class="btn btn-outline-success m-b-20 mt-3" type="submit">Update</button>   
                                    </form>                            
                                        <a class="btn btn-outline-dark m-b-20 mt-3" onclick="Reset()" >Back</a>                               
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </section>



<!-- End Edit Blog content -->

@endsection


@section('footer_js')

<script>
    function ShowBlogForm() {
        var x = document.getElementById("EDITCASESTUDY");
        var y = document.getElementById("CaseStudyView");

        if (x.style.display === "none") {
          x.style.display = "block";
          y.style.display = "none";

        } else {
          x.style.display = "none";
          y.style.display = "block";

        }
      }


      function Reset(){
            var x = document.getElementById("EDITCASESTUDY");
            var y = document.getElementById("CaseStudyView");

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
