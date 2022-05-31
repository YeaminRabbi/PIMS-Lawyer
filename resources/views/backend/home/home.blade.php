@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Home
@endsection
@section('pagename')
    Dashboard
@endsection

@section('pagecontent')
<!-- WELCOME-->
<section class="welcome p-t-10">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title-4">Welcome back
                    <span>{{ $user->name }}!</span>
                </h1>
                <hr class="line-seprate">
            </div>
        </div>
    </div>
</section>
<!-- END WELCOME-->

<!-- STATISTIC-->
<section class="statistic statistic2">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="statistic__item statistic__item--green">
                    <h2 class="number">{{ $blog_count }}</h2>
                    <span class="desc">Blogs</span>
                    <div class="icon">
                        <i class="zmdi zmdi-account-o"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="statistic__item statistic__item--orange">
                    <h2 class="number">{{ $case_study_count }}</h2>
                    <span class="desc">Case Studies</span>
                    <div class="icon">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="statistic__item statistic__item--blue">
                    <h2 class="number">{{ $contact_count }}</h2>
                    <span class="desc">Mails</span>
                    <div class="icon">
                        <i class="zmdi zmdi-calendar-note"></i>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-lg-3">
                <div class="statistic__item statistic__item--red">
                    <h2 class="number">$1,060,386</h2>
                    <span class="desc">Site View</span>
                    <div class="icon">
                        <i class="zmdi zmdi-money"></i>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
<!-- END STATISTIC-->

 <!-- Email inbox Table -->

 <div class="main-content container">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive table--no-card m-b-30">
                        <table class="table table-borderless table-earning" id="emailInbox">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Date</th>
                                    <th class="text-center">Reply</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($contact->isNotEmpty())
                                    @foreach ($contact as $key=> $data)
                                        @if ($data->read == 1)
                                            <tr >
                                                <td style="color:black; text-align: center;">{{ $key+1 }}</td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;">{{$data->name}}</a></td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;">{{$data->email}}</a></td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;">{{$data->subject}}</a></td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;">{{$data->created_at->format('d M, Y')}}</a></td>
                                                @if ($data->reply == 1)
                                                    <td class="text-center">
                                                        <i class="fa fa-check-circle" aria-hidden="true" style="color:blue;"></i>
                                                    </td>

                                                @else 
                                                    <td class="text-center">
                                                        
                                                    </td>

                                                @endif
                                               <td>
                                                    <a href="{{ route('ContactView', $data->id) }}" class="btn btn-outline-primary">View</a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr style="background-color:beige;">
                                                <td style="color:black; text-align: center;">{{ $key+1 }}</td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;font-weight:bold;">{{$data->name}}</a></td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;font-weight:bold;">{{$data->email}}</a></td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;font-weight:bold;">{{$data->subject}}</a></td>
                                                <td><a href="{{ route('ContactView', $data->id) }}" style="color: black;font-weight:bold;">{{$data->created_at->format('d M, Y')}}</a></td>
                                                @if ($data->reply == 1)
                                                    <td class="text-center">
                                                        <i class="fa fa-check-circle" aria-hidden="true" style="color:blue;"></i>
                                                    </td>
                                                @else 
                                                    <td class="text-center">
                                                            
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('ContactView', $data->id) }}" class="btn btn-outline-primary">View</a>
                                                </td>
                                            </tr>
                                        @endif
                                       
                                    @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
<!-- End Email inbox Table -->

@endsection


@section('footer_js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
        $('#emailInbox').DataTable();
    } );
</script>
@endsection