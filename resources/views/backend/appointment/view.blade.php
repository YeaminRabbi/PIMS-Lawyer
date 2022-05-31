@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Appointment
@endsection
@section('pagename')
    Appointment
@endsection

@section('pagecontent')
       <section id="Contact">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container">
                        <div>
                            <a href="{{ route('AdminAppointment') }}">
                                <button class="btn btn-outline-dark mb-3"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>                            
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <p>
                                    <b>Appointment Date:   {{date('d M, Y', strtotime($appointment->appointment_date))}}</b>
                                </p>
                                
                                <p>
                                    <b>{{$appointment->name}}</b>

                                </p>
                                <p>
                                    <b>{{$appointment->email}}</b>
                                </p>
                                <p>
                                    <b>{{$appointment->subject}}</b>

                                </p>
                            

                            </div>
                            <div class="col-lg-4">
                                <h5>Posted at: {{$appointment->created_at->format('d M, Y | h:ia')}}</h5>
                            </div>
                        </div>

                        <div class="row mt-3">
                        
                            <div class="col-lg-8">
                                <div>

                                    <p>{{$appointment->summary}}</p>

                                </div>

                            </div>

                            <div class="col-lg-12 mt-3">
                                <div>

                                   <button class="btn btn-primary">Accept Request</button>

                                </div>

                            </div>
                           
                        </div>
                    </div>
                
                </div>
            </div>


       </section>
@endsection
