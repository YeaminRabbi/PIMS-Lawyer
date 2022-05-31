@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Blog
@endsection
@section('pagename')
    Blog / Trash
@endsection

@section('pagecontent')
       <!-- Blog Trash -->
       <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Trash Blogs</h3>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 mb-3">
                    <a href="{{ route('AdminBlog') }}">
                        <button class="btn btn-outline-dark"> <i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                    </a>
                </div>
                <div class="col-md-12">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            {!! \Session::get('success') !!}
                        </div>
                    @endif

                    @if (\Session::has('delete'))
                    <div class="alert alert-warning">
                        {!! \Session::get('delete') !!}
                     </div>
                    @endif
                </div>
               

                @if ($blogs->isNotEmpty())
                    @foreach ($blogs as $data)
                        <div class="col-md-4">
                            <div class="card">
                                <img class="blog-img-view-1" src="{{ asset('images/blog/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <h2 class="card-title">{{ $data->title }}</h2>
                                    <p style="font-size: 18px;font-weight: bold;"><?php echo date_format($data->created_at,"d M, Y"); ?></p>
                                    <div>
                                        {!! Str::limit($data->introduction, 120,'.....') !!}                                               
                                    </div>
                                    
                                    <div>
                                        <a href="{{ route('AdminBlogRestore', $data->id) }}">
                                            <button class="btn btn-outline-info mt-2"><i class="fa fa-window-restore" aria-hidden="true"></i>&nbsp;Restore</button>
                                        </a>
                                        <a href="{{ route('AdminBlogConfirmDelete', $data->id) }}">
                                            <button class="btn btn-outline-danger mt-2"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="col-md-12 mt-3">
                    <a href="{{ route('AdminBlog') }}">
                        <button class="btn btn-outline-dark"> <i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                    </a>
                </div>
                

            </div>
        </div>
    </section>

    <!-- End Blog Trash -->

@endsection

