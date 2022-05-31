@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Case Study
@endsection
@section('pagename')
    Case Study / Trash
@endsection

@section('pagecontent')
       <!-- Case Study Trash -->
       <section class="statistic-chart">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title-5 m-b-35">Trash Case Study</h3>
                </div>
            </div>
            <div class="row">

                <div class="col-md-12 mb-3">
                    <a href="{{ route('AdminCaseStudy') }}">
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
               

                @if ($casestudies->isNotEmpty())
                    @foreach ($casestudies as $data)
                        <div class="col-md-4">
                            <div class="card">
                                <img class="blog-img-view-1" src="{{ asset('images/case_study/'.$data->created_at->format('Y/M/').'/'.$data->image) }}" alt="Card image cap">
                                <div class="card-body">
                                    <p style="font-size: 14px;font-weight: bold;">{{ $data->title }}</p>
                                    <p style="font-size: 14px;"><?php echo date_format($data->created_at,"d M, Y"); ?></p>
                                    <div class="m-t-10">
                                        {!! Str::limit($data->introduction, 100,'.....') !!}                                               
                                    </div>
                                    
                                    <div>
                                        <a href="{{ route('AdminCaseStudyRestore', $data->id) }}">
                                            <button class="btn btn-outline-info mt-2"><i class="fa fa-window-restore" aria-hidden="true"></i>&nbsp;Restore</button>
                                        </a>
                                        <a href="{{ route('AdminCaseStudyConfirmDelete', $data->id) }}">
                                            <button class="btn btn-outline-danger mt-2"><i class="fa fa-trash"></i>&nbsp; Delete</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="col-md-12 mt-3">
                    <a href="{{ route('AdminCaseStudy') }}">
                        <button class="btn btn-outline-dark"> <i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                    </a>
                </div>
                

            </div>
        </div>
    </section>

    <!-- End Case Study Trash -->

@endsection

