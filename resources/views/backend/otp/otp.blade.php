@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Info
@endsection
@section('pagename')
    <a href="{{route('AdminInfo')}}" style="color:grey;">Info</a> &nbsp;/&nbsp; Password Information
@endsection

@section('pagecontent')


        <!-- Password information -->
    <section id="PASSWORDINFO">
          <div class="container">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('AdminInfo') }}">
                            <button class="btn btn-outline-dark"> <i class="fa fa-chevron-left"></i>&nbsp; Back</button>
                        </a>
                        <a>
                            <button class="btn btn-outline-warning" onclick="Show('PASSWORDUPDATE')"> <i class="fa fa-edit"></i>&nbsp; Edit</button>
                        </a>
                    </div>
                </div>

              <div class="row bg-white m-t-20">
                  <div class="col-12 bg-dark">
                      <h3 class="text-white">Password Information</h3>
                  </div>
                 
                  <div class="col-12 m-t-10">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="hf-email" class=" form-control-label">Site Name</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text"  id="" name="site" placeholder="Site Name..." value="{{ $site->site }}" disabled class="form-control" autocomplete="off">
                               
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="hf-email" class=" form-control-label">Site Link</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="hf-email" name="link" placeholder="Site Link..." value="{{ $site->link }}" disabled class="form-control" autocomplete="off">
                                
                            </div>
                        </div>
                        
                        @if (\Session::has('opt_msg') || \Session::has('otp_confirm') || \Session::has('otp_expire'))
                            <div>
                                {{-- empty --}}
                            </div>
                        @else
                            <form action="{{ route('AdminSendOTP') }}" method="post">
                                @csrf 
                                <input type="hidden" value="{{ $site->id }}" name="site_id">
                                <button type="submit" class="btn btn-outline-primary m-b-45">Send OPT</button>

                            </form>
                        @endif
                        
                        @if (\Session::has('otp_expire'))
                            <div class="col-12 col-md-9">
                                <p style="color: red;font-weight:bold;">Your OTP duration has been Expired</p>
                                <form action="{{ route('AdminSendOTP') }}" method="post">
                                    @csrf 
                                    <input type="hidden" value="{{ $site->id }}" name="site_id">
                                    <button type="submit" class="btn btn-outline-primary m-b-45">Resend OPT</button>
    
                                </form>
                            </div>
                        @endif
                        
                        @if (\Session::has('opt_msg'))
                            <form action="{{ route('AdminOTPConfirm') }}" method="post">
                                @csrf

                                <input type="hidden" name="site_id" value="{{ $site->id }}">
                                <input type="hidden" name="otp_id" value="{!! \Session::get('opt_msg') !!}">
                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        <label for="hf-email" class=" form-control-label">Enter OTP</label>
                                    </div>

                                    <div class="col-12 col-md-9">
                                        <input type="text" id="hf-email" name="otp" class="form-control" autocomplete="off">
                                        
                                        @if (\Session::has('attempts_left'))
                                            <span style="color: red;font-weight:bold;">Your attempts left: {!! \Session::get('attempts_left') !!}</span>
                                            
                                        @else
                                            <span style="color: red;font-weight:bold;">This OTP will expire in 15 mins</span>
                                            
                                        @endif
                                        
                                    </div>
    
                                    <button type="submit" class="btn btn-outline-success m-l-20">Confirm</button>
                                </div>
                            </form>
                        @endif

                        @if (\Session::has('otp_confirm'))
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="hf-email" class=" form-control-label">Username / Email</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="hf-email" name="name_email" value="{!! \Session::get('name_email') !!}" disabled class="form-control" autocomplete="off">
                                    
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="hf-email" class=" form-control-label">Password</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="hf-email" name="password" value="{!! \Session::get('password') !!}" disabled class="form-control" autocomplete="off">
                                    
                                </div>
                            </div>
                        @endif

                        
                    
                </div>
                  
                  
              </div>
          </div>
    </section>
        <!-- End Password information -->

        <!-- Password information Edit -->

        <section id="PASSWORDUPDATE" style="display: none;">
            <div class="container">
                <div class="row bg-white m-t-20">
                    <div class="col-12 bg-dark">
                        <h3 class="text-white">Edit Password Information</h3>
                    </div>
                   
                    <div class="col-12 m-t-10">

                        <form action="{{ route('AdminSiteUpdate') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $site->id }}" name="site_id">
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="hf-email" class=" form-control-label">Site Name</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text"  id="" name="site" placeholder="Site Name..." value="{{ $site->site }}" class="form-control" autocomplete="off">
                                   
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="hf-email" class=" form-control-label">Site Link</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="hf-email" name="link" placeholder="Site Link..." value="{{ $site->link }}" class="form-control" autocomplete="off">
                                    
                                </div>
                            </div>
  
                            <div class="row form-group">
                              <div class="col col-md-3">
                                  <label for="hf-email" class=" form-control-label">User Name / Email</label>
                              </div>
                              <div class="col-12 col-md-9">
                                  <input type="text" id="hf-email" name="name_email"  class="form-control" autocomplete="off">
                              </div>
                            </div>
  
                            <div class="row form-group">
                              <div class="col col-md-3">
                                  <label for="hf-email" class=" form-control-label">Password</label>
                              </div>
                              <div class="col-12 col-md-9">
                                  <input type="password" id="hf-email" name="password"  class="form-control" autocomplete="off">
                              </div>
                            </div>
                           
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <button class="btn btn-outline-success" type="submit">Update</button>
                                    <a class="btn btn-outline-dark" onclick="Reset()">Back</a>

                                </div>
                                
                            </div>

                        </form>

                       
                  </div>
                    
                    
                </div>
            </div>
            
        </section>

        <!-- End Password information Edit -->


@endsection


@section('footer_js')

<script>
      function Show(data) {
        var x = document.getElementById(data);
        var y = document.getElementById('PASSWORDINFO');
        if (x.style.display === "none") {
          x.style.display = "block";         
          y.style.display = "none";         

        } else {
          x.style.display = "none";
          y.style.display = "block";         

        }
      }

      function Reset() {
        var x = document.getElementById('PASSWORDINFO');
        var y = document.getElementById('PASSWORDUPDATE');
        if (x.style.display === "none") {
          x.style.display = "block";         
          y.style.display = "none";         

        } else {
          x.style.display = "none";
          y.style.display = "block";         

        }
      }
      
</script>   


@endsection