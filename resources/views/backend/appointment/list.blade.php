@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Appointment
@endsection
@section('pagename')
    Appointment
@endsection

@section('pagecontent')




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
                                    <th>Appointment Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($appointments->isNotEmpty())
                                    @foreach ($appointments as $key=> $data)
                                        @if ($data->status == 1)
                                            <tr >
                                                <td style="color:black; text-align: center;">{{ $key+1 }}</td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;">{{date('d M, Y', strtotime($data->appointment_date))}}</a></td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;">{{$data->name}}</a></td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;">{{$data->email}}</a></td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;">{{$data->phone}}</a></td>
                                               
                                               <td>
                                                    <a href="{{ route('AppointmentView', $data->id) }}" class="btn btn-outline-primary">View</a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr style="background-color:beige;">
                                                <td style="color:black; text-align: center;">{{ $key+1 }}</td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;font-weight:bold;">{{date('d M, Y', strtotime($data->appointment_date))}}</a></td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;font-weight:bold;">{{$data->name}}</a></td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;font-weight:bold;">{{$data->email}}</a></td>
                                                <td><a href="{{ route('AppointmentView', $data->id) }}" style="color: black;font-weight:bold;">{{$data->phone}}</a></td>
                                                
                                                <td>
                                                    <a href="{{ route('AppointmentView', $data->id) }}" class="btn btn-outline-primary">View</a>
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