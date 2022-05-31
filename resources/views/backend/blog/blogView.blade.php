@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Blog 
@endsection
@section('pagename')
    <a href="{{route('AdminBlog')}}" style="color:grey;">Blog</a> &nbsp; /&nbsp; {{ $blog->title }}
@endsection

@section('pagecontent')
<!-- blog content -->
<section id="BlogView" style="display:block;">
    <div class="container pt-3">
        <div class="row">
            <div class="col-lg-8">
                <div class="mt-2 mb-2">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('AdminBlog') }}">
                                <button class="btn btn-outline-dark"> <i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                            </a>
                        </div>  
                        <div class="col-6" style="text-align: right">
                            <button class="btn btn-outline-warning m-t-10" onclick="ShowBlogForm()"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp; Edit</button>
                            <a href="{{ route('AdminBlogDelete', $blog->id) }}">
                                <button class="btn btn-outline-danger m-t-10"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                            </a>
                        </div> 
                    </div>
                
                </div>
                <div class="blogImage">
                    <img class="blog-img-view-121" src="{{ asset('images/blog/'.$blog->created_at->format('Y/M/').'/'.$blog->image) }}" style="width: 100%;" alt="Blog Img">
                </div>
                <div class="blogContent mt-3">
                    <div class="d-flex">
                        <div>
                            <p style="font-weight: bold;font-size: 24px">{{ $blog->title }}</p>
                            <p style="font-size: 14px"><i class="fa fa-clock m-r-10"></i>{{ $blog->created_at->format('d M, Y') }}</p>

                            
                        </div>
                        <div class="ml-auto">
                            
                            @if ($blog->comment_switch == 1)
                                <span>Comments</span>
                                <a href="{{ route('AdminBlogCommentOff', $blog->id) }}">
                                    <label class="switch switch-text switch-danger switch-pill">
                                        <input type="checkbox" class="switch-input" checked="true">
                                        <span data-on="Off" class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </a>
                                
                            @else
                                <span>Comments</span>
                                <a href="{{ route('AdminBlogCommentOn', $blog->id) }}">
                                    <label class="switch switch-text switch-primary switch-pill">
                                        <input type="checkbox" class="switch-input" checked="true">
                                        <span data-on="On" class="switch-label"></span>
                                        <span class="switch-handle"></span>
                                    </label>
                                </a>
                                
                            @endif
                           
                        </div>
                    </div>
                    
                </div>
                <div class="blogtext mt-3">
                    <p style="font-size: 18px; font-weight: bold; font-style: italic; text-align:justify"  class="mt-3">{{ $blog->introduction }}</p>
                    <div style="overflow: hidden; text-align: justify" class="m-t-20">
                    
                        {!! $blog->text !!}

                    </div>
                </div>

                <div class="blogComments mt-3 mb-5">
                    <h3>Comments</h3>
                    @if ($blog_comment->isNotEmpty())
                        @foreach ($blog_comment as $data)
                            <div class="row mt-5"  style="background-color: #F5F1EE;padding: 5px;">
                                <div class="col-9">
                                    <div class="commentName" style="font-size: 18px;font-weight: bold;">
                                       {{ $data->name }}
                                    </div>
                                    <div class="commentName" style="font-size: 17px;font-weight: bold;">
                                        {{ $data->email }}
                                     </div>
                                     <div class="commentName" style="font-size: 15px;font-weight: bold;">
                                        {{ $data->website }}
                                     </div>
                                    <div class="commentDate">
                                        {{ $data->created_at->format('d M, Y | h:ia') }}
                                    </div>
                                    <div class="commentText mt-2">
                                        <p>{{ $data->message }}</p>
                                    </div>
                                </div>
                                <div class="col-3">
                                    @if ($data->check_reply($data->id) == 0)
                                        <a onclick="ReplyForm({{$data->id}})" style="cursor: pointer;color:blue;"><i class="fa fa-chevron-right"></i> Reply</a>&nbsp;
                                    @else
                                        <a onclick="ReplyEditForm({{$data->id}})" style="cursor: pointer;color:blue;"><i class="fa fa-chevron-right"></i> Edit Reply</a>&nbsp;
                                        
                                    @endif
                                    <a href="{{ route('AdminBlogCommentDelete', $data->id) }}"><i class="fa fa-trash"></i> Delete</a>                                    
                                </div>
                            </div>

                            @if ($data->check_reply($data->id) != 0)
                                <div class="row mt-3" >
                                    <div class="col-12">
                                        <h5>Replied:</h5><br>
                                        <div class="commentName ml-4" style="background-color: #F5F1EE;font-size: 18px;font-weight: bold;">
                                        {{ App\Comment::get_reply($data->id) }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            

                            <div class="row mt-3" style="display: none;" id="COMMENTID-{{$data->id}}">
                               <div class="col-12">
                                <form action="{{ route('AdminBlogCommentReply') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    

                                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                    <input type="hidden" name="comment_id" value="{{ $data->id }}">


                                    <div class="form-group">
                                        <label style="font-weight: bold;">Reply</label><br>
                                        <textarea name="reply" id="" cols="80" rows="3"></textarea>
                                    </div>

                                    <div>
                                        <button class="btn btn-outline-primary m-b-20 mt-1" type="submit">Submit</button> 
                                    </div>  
                                </form>  
                               </div>
                            </div>

                            <div class="row mt-3" style="display: none;" id="COMMENTIDEDIT-{{$data->id}}">
                                    <div class="col-12">
                                    <form action="{{ route('AdminBlogCommentReplyEdit') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        
    
                                        <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                                        <input type="hidden" name="comment_id" value="{{ $data->id }}">
    
    
                                        <div class="form-group">
                                            <label style="font-weight: bold;">Reply</label><br>
                                            <textarea name="reply" id="" cols="80" rows="3"></textarea>

                                        </div>
    
                                        <div>
                                            <button class="btn btn-outline-primary m-b-20 mt-1" type="submit">Submit</button> 
                                        </div>  
                                    </form>  
                                    </div>
                            </div>
                        @endforeach

                    @else
                        <p>No Comments</p>
                    @endif
                     
                    
                    
                    <div class="mt-3">
                        <a href="{{ route('AdminBlog') }}">
                            <button class="btn btn-outline-dark"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                        </a>
                        <a href="{{ route('AdminBlogDelete', $blog->id) }}">
                            <button class="btn btn-outline-danger"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                        </a>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 mt-4">

                <h4 class="mb-3">Other Blogs</h4>

                @if ($otherBlogs->isNotEmpty())
                    
                    @foreach ($otherBlogs as $data)
                        <div class="row mb-3">
                            <div class="col-5">
                                <a href="{{ route('AdminBlogDetails', $data->id) }}">
                                    <img src="{{ asset('images/blog/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Blog Img" class="side-blog-img">
                                </a>
                                
                            </div>
                            <div class="col-7" style="margin-left: -50px;">
                                <a href="{{ route('AdminBlogDetails', $data->id) }}">
                                    <h4 class="m-t-20">{{ $data->title }}</h4>
                                    <b><?php echo date_format($data->created_at,"d M, Y"); ?></b> 
                                </a>  
                            </div>
                        </div>
                    @endforeach
                    
                @endif
            

                
                <div>
                    <a href="{{ route('AdminBlog') }}">See more...</a>
                </div>
            </div>

        </div>
    </div>

</section>
<!-- end blog content -->

<!-- Edit Blog content -->

            <section id="EDITBLOG" style="display: none;">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div>
                                <button class="btn btn-outline-dark m-b-20 mt-3" onclick="Reset()" >Back</button>                               

                            </div>

                            <b>Your Blog</b>
                            <div class="mt-3">
                                @if (\Session::has('error'))
                                        <div class="alert alert-danger">
                                            {!! \Session::get('error') !!}
                                        </div>
                                @endif
                             
                                <form action="{{ route('AdminBlogUpdate') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    

                                    <input type="hidden" name="BlogID" value="{{ $blog->id }}">
                                    <div class="form-group">
                                        <img class="blog-img-view-121" id="output" src="{{ asset('images/blog/'.$blog->created_at->format('Y/M/').'/'.$blog->image) }}" alt="Blog Img" >
                                            <label class="label-bold m-t-10">Blog Image: (Choose to upload New Image)</label>
                                            <input class="form-control" type="file" name="image" id="BlogImg" accept="image/*" onchange="loadFile(event)" >
                                    </div>

                                    <div class="form-group">
                                        <label class="label-bold">Blog Title</label>
                                        <input class="form-control" type="text" name="title" placeholder="Blog Title" value="{{ $blog->title }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="label-bold">Blog Introduction</label>
                                        <textarea cols="120" rows="10" class="form-control" type="text" name="introduction" placeholder="Blog introduction" required>{{ $blog->introduction }}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="label-bold">Blog Content</label>
                                        <textarea name="text" id="" cols="30" rows="10" required>
                                            {{ $blog->text }}
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
        var x = document.getElementById("EDITBLOG");
        var y = document.getElementById("BlogView");

        if (x.style.display === "none") {
          x.style.display = "block";
          y.style.display = "none";

        } else {
          x.style.display = "none";
          y.style.display = "block";

        }
      }


      function Reset(){
            var x = document.getElementById("EDITBLOG");
            var y = document.getElementById("BlogView");

            if (x.style.display === "block") {
            x.style.display = "none";
            y.style.display = "block";

            } else {
            x.style.display = "block";
            y.style.display = "none";

            }
        }


        function ReplyForm(data){
            var x = document.getElementById("COMMENTID-"+data);
            if (x.style.display === "none") {
                x.style.display = "block";
                } 
            else {
                x.style.display = "none";
                
                }
        }


        function ReplyEditForm(data)
        {
            var x = document.getElementById("COMMENTIDEDIT-"+data);
            if (x.style.display === "none") {
                x.style.display = "block";
                } 
            else {
                x.style.display = "none";
                
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
