@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Contact
@endsection
@section('pagename')
    Contact
@endsection

@section('pagecontent')
       <section id="Contact">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container">
                        <div>
                            <a href="{{ route('dashboard') }}">
                                <button class="btn btn-outline-dark mb-3"><i class="fa fa-chevron-left"></i>&nbsp; Back</button>                            
                            </a>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <p>
                                    <b>{{$contact->email}}</b>
                                </p>
                                <p>
                                    <b>{{$contact->name}}</b>

                                </p>
                                <p>
                                    <b>Subject: {{$contact->subject}}</b>

                                </p>
                            

                            </div>
                            <div class="col-lg-4">
                                <h5>{{$contact->created_at->format('d M, Y | h:ia')}}</h5>
                            </div>
                        </div>

                        <div class="row mt-3">
                        
                            <div class="col-lg-8">
                                <div>

                                    <p>{{$contact->message}}</p>

                                </div>

                            </div>
                            <div class="col-lg-12 mt-3 mb-3">
                                <h4>Reply to this mail:</h4>
                                <form action="{{route('ContactReply')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="contact_id" value="{{ $contact->id }}"> 
                                    <div>
                                        <textarea name="reply" id="" cols="100" rows="10"></textarea>
                                    </div>
                                    <div>
                                        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                                            <i class="fa fa-chevron-left"></i>&nbsp; Back                         
                                        </a>
                                        <button class="btn btn-outline-primary" type="submit"><i class="fa fa-location-arrow"></i>&nbsp; Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>


       </section>
@endsection
