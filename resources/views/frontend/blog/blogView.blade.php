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
    Blog
@endsection

@section('content')
<section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 ftco-animate">
          <h2 class="mb-3">{{$blog->title}}</h2>
          
          <p>
            <img src="{{ asset('images/blog/'.$blog->created_at->format('Y/M/').'/'.$blog->image) }}" alt="" class="img-fluid">
          </p>

          <h3 class="mb-3">{{$blog->introduction}}</h3>

          <div>
              {!! $blog->text !!}
          </div>
         
        

          <div class="pt-5 mt-5" id="COMMENTSECTION">
            <h3 class="mb-5">Comments</h3>
            <ul class="comment-list">
             
             @if ($blog_comments->isNotEmpty())
                 @foreach ($blog_comments as $data)
                    <li class="comment">
                      <div class="comment-body">
                        <h3>{{$data->name}}</h3>
                        <div class="meta">{{$data->created_at->format('d M, Y | h:ia')}}</div>
                        <p>{{ $data->message }}</p>
                      </div>
                        @if ($data->check_reply($data->id) != 0)
                          <div class="" style="margin-left: 20%;">
                            <h3> {{ $data->get_ReplyByID($data->id)->name }} </h3>
                            <div style="color: #F7DA0C;" class="meta">{{ date('d M, Y | h:ia', strtotime($data->get_ReplyByID($data->id)->creted_at))}}</div>
                            <p>
                              {{ $data->get_ReplyByID($data->id)->reply }}
                            </p>
                           
                          </div>
                        @endif
                    </li>

                    
                    
                 @endforeach

             @else 
              <p>No Comments yet</p>
             @endif
              



              {{-- comment with reply --}}
              {{-- <li class="comment">
                
                <div class="comment-body">
                  <h3>John Doe</h3>
                  <div class="meta">June 20, 2019 at 2:21pm</div>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                  <p><a href="#" class="reply">Reply</a></p>



                  <div class="ml-5">
                    <h3>John Doe</h3>
                    <div class="meta">June 20, 2019 at 2:21pm</div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?</p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>
                </div>

                
              </li> --}}

            </ul>
            <!-- END comment-list -->
            
            <div class="comment-form-wrap pt-5" >
              <h3 class="mb-5">Leave a comment</h3>
              <form action="{{ route('BlogComment') }}" method="POST" class="p-5 bg-dark">
                @csrf

                <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <input type="text" name="name" class="form-control" id="name" required>
                </div>
                <div class="form-group">
                  <label for="email">Email *</label>
                  <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                  <label for="website">Website (Optional)</label>
                  <input type="url" name="website" class="form-control" id="website">
                </div>

                <div class="form-group">
                  <label for="message">Message</label>
                  <textarea name="message" id="message" cols="30" rows="10" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                  <input type="submit" value="Post Comment" class="btn py-3 px-4 btn-primary">
                </div>

              </form>
            </div>
          </div>

        </div> <!-- .col-md-8 -->

        @if ($otherblog->isNotEmpty())
            <div class="col-lg-4 sidebar ftco-animate">
            
                <div class="sidebar-box ftco-animate">
                <h3 class="heading-sidebar">Other Blogs</h3>
                
                @foreach ($otherblog as $data)
                    <div class="block-21 mb-4 d-flex">
                        <a href="{{ route('BlogDetails', $data->id)}}" class="blog-img mr-4" style="background-image: url({{ asset('images/blog/'.$data->created_at->format('Y/M/').'/'.$data->image) }});"></a>
                        <div class="text">
                        <h3 class="heading"><a href="{{ route('BlogDetails', $data->id)}}">{{$data->title}}</a></h3>
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
      

@endsection