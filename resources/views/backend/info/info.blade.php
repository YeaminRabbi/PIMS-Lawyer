@extends('layouts.backend.masterLayout')
@section('pagetitle')
    Info
@endsection
@section('pagename')
    Info
@endsection

@section('pagecontent')
<section>
  <div class="container">
    <div class="row">
      <div class="col-4">
      </div>
      <div class="col-4">
          <div class="account2">
              <div class="image img-cir img-240">
                  @if (isset($user->image))
                    <img src="{{ asset('images/profile/'.$user->image) }}" alt="{{  Auth::user()->name }}" />
                  @else
                    <img src="https://www.attendit.net/images/easyblog_shared/July_2018/7-4-18/b2ap3_large_totw_network_profile_400.jpg" alt="Profile Picture" />
                  @endif
                  <button type="button" class="xbtn" data-toggle="modal" data-target="#mediumModal">
                      <i class="fa fa-pencil-square"></i>
                  </button>
              </div>
          </div>  
      </div>
      <div class="col-4">
      </div>
    </div>

    <div class="row bg-white m-t-60">
      <div class="col-12 bg-dark">
          <h3 class=" text-light">Personal Inforamtion</h3>
      </div>
      <div class="col-6">
        <div class="row">
          <div class="col-8">
            <h4 class="m-l-20 m-t-20 m-b-5">Full Name</h4>
          </div>
          <div class="col-4 m-t-20">
            <i class="fa fa-pencil-square-o" aria-hidden="true"  onclick="ShowName()" style="color:blue;cursor:pointer"></i>
          </div>
          
        </div>
          
        <div class="row m-l-5">
          @if (isset($user->name))
            <p class="m-l-20 m-t-5 m-b-20">{{ $user->name }}</p>              
          @else
          <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
          @endif
        </div>
                
        <div class="row m-l-5" style="display: none;" id="NAMEFORM">            
            <div class="col-8">   
              <form action="{{ route('AdminInfoName') }}" method="POST"> 
                @csrf
                <div class="d-flex"> 
                  <input type="text" class="form-control" name="name" value="{{ $user->name }}" autocomplete="off" required>&nbsp;
                  <button type="submit" class="btn btn-outline-success">Update</button>
                </div>
              </form>
            </div>   
        </div>

      </div>

      <div class="col-6">

        <div class="row">
          <div class="col-8">
            <h4 class="m-l-20 m-t-20 m-b-5">Phone</h4>
          </div>
          <div class="col-4 m-t-20">
            <i class="fa fa-pencil-square-o" aria-hidden="true"  onclick="ShowPhone()" style="color:blue;cursor:pointer"></i>
          </div>
          
        </div>
          
        <div class="row m-l-5">
          @if (isset($user->phone))
            <p class="m-l-20 m-t-5 m-b-20">{{ $user->phone }}</p>              
          @else
          <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
          @endif
        </div>
                
        <div class="row m-l-5" style="display: none;" id="PHONEFORM">            
            <div class="col-8">   
              <form action="{{ route('AdminInfoPhone') }}" method="POST">   
                @csrf        
                <div class="d-flex"> 
                  <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" autocomplete="off" required>&nbsp;
                  <button type="submit" class="btn btn-outline-success">Update</button>
                </div>
              </form>
            </div>   
        </div>
          
      </div>

      <div class="col-6">
        <div class="row">
          <div class="col-8">
            <h4 class="m-l-20 m-t-20 m-b-5">Email</h4>
          </div>
          <div class="col-4 m-t-20">
            <i class="fa fa-pencil-square-o" aria-hidden="true"  onclick="ShowEmail()" style="color:blue;cursor:pointer"></i>
          </div>
          
        </div>
          
        <div class="row m-l-5">
          @if (isset($user->email))
            <p class="m-l-20 m-t-5 m-b-20">{{ $user->email }}</p>              
          @else
          <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
          @endif
        </div>
                
        <div class="row m-l-5" style="display: none;" id="EMAILFORM">            
            <div class="col-8">   
              <form action="{{ route('AdminInfoEmail') }}" method="POST">           
                @csrf 
                <div class="d-flex"> 
                  <input type="email" class="form-control" name="email" autocomplete="off" value="{{ $user->email }}" required>&nbsp;
                  <button type="submit" class="btn btn-outline-success">Update</button>
                </div>
              </form>
            </div>   
        </div>
          
      </div>

      <div class="col-6">
        <div class="row">
          <div class="col-8">
            <h4 class="m-l-20 m-t-20 m-b-5">Address</h4>
          </div>
          <div class="col-4 m-t-20">
            <i class="fa fa-pencil-square-o" aria-hidden="true"  onclick="ShowAddress()" style="color:blue;cursor:pointer"></i>
          </div>
          
        </div>
          
        <div class="row m-l-5">
          @if (isset($user->address))
            <p class="m-l-20 m-t-5 m-b-20">{{ $user->address }}</p>              
          @else
          <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
          @endif
        </div>
                
        <div class="row m-l-5" style="display: none;" id="ADDRESSFORM">            
            <div class="col-8">   
              <form action="{{ route('AdminInfoAddress') }}" method="POST">  
                @csrf       
                <div class="d-flex"> 
                  <input type="text" class="form-control" name="address"  value="{{ $user->address }}" autocomplete="off" required>&nbsp;
                  <button type="submit" class="btn btn-outline-success">Update</button>
                </div>
              </form>
            </div>   
        </div>
          
      </div>

      <div class="col-12">
        <div class="row">
          <div class="col-8">
            <h4 class="m-l-20 m-t-20 m-b-5">About</h4>
          </div>
          <div class="col-4 m-t-20" style="text-align: right">
            <i class="fa fa-pencil-square-o m-r-20" aria-hidden="true"  onclick="ShowAbout()" style="color:blue;cursor:pointer;"></i>
          </div>
          
        </div>
          
        <div class="row m-l-5">
          @if (isset($user->about))
            <p class="m-l-20 m-t-5 m-b-20 m-r-20" style="text-align: justify">{{ $user->about }}</p>              
          @else
          <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
          @endif
        </div>
                
        <div class="row m-l-5" style="display: none;" id="ABOUTFORM">            
            <div class="col-8">   
              <form action="{{ route('AdminInfoAbout') }}" method="POST">    
                @csrf       
                <div class="row m-l-5" > 
                  <textarea name="about" id="" cols="120" rows="10" >{{ $user->about }}</textarea>
                </div>
                <div class="row m-l-5">
                  <button type="submit" class="btn btn-outline-success">Update</button>
                </div>
              </form>
            </div>   
        </div>
          
      </div>
    </div>
  </div>
</section>

      <!-- profile picture modal -->
			<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="mediumModalLabel">Profile Picture</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
            <form action="{{ route('AdminInfoProfilePicture') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">    
              @csrf  
						<div class="modal-body">          
                  <div class="form-group row">
                      <div class="col-md-12">
                          <img  id="output" >
                          <input class="m-t-20 form-control" type="file" name="image" accept="image/*" onchange="loadFile(event)">                         
                      </div>
                  </div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-outline-primary">Confirm</button>
							<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancel</button>
						</div>
          </form>
					</div>
				</div>
			</div>
			<!-- end modal --> 



      <section>
            <div class="container  m-t-60">
                <div class="row">
                    <div class="col-12 bg-dark">
                        <h3 class="text-white">Education, Work Experience & Training</h3>
                    </div>
                </div>
            </div>
            <div class="container bg-white">
                <div class="main-content bg-white">
                    <div class="section__content section__content--p30">
                        <div class="container-fluid">
                            <div class="row bg-white">
                                <div class="col-12 bg-white">
                                    <div class="tab-section">
                                        <div class="tab">
                                            <button class="tablinks active" onclick="openTab(event, 'Work_Experience')">Work Experience</button>
                                            <button class="tablinks" onclick="openTab(event, 'Education')">Education</button>
                                            <button class="tablinks" onclick="openTab(event, 'Training')">Training</button>

                                        </div>
    
                                        <div id="Work_Experience" class="tabcontent" >
                                            <div class="tabcontent-details">                                        
                                              <div class="tabcontent-row">
                                                  <div class="col-12 ">
                                                    @if ($work->isNotEmpty())
                                                      @foreach ($work as $data)
                                                        <div class="row tab-row">
                                                              <div class="col-1">
                                                                  <a>
                                                                      <i class="fa fa-briefcase" style="font-size: 20px;"></i> 
                                                                  </a>
                                                              </div>
                                                              <div class="col-8 col-md-8">
                                                                  <p style="font-weight: bold;font-size:15px">{{ $data->designation }} &nbsp;|&nbsp; {{ $data->work_place }}</p>
                                                                  <p style="font-size:13px;"> {{ Str::limit($data->job_description, 50,'.....') }}  <span style="color: blue;cursor:pointer;" onclick="Show('WorkPlaceEditForm-{{$data->id}}')" >See more</span></p>
                                                                  <p style="font-size: 10px;">
                                                                      {{$data->start}} to {{$data->end}}                                                             
                                                                  </p>
                                                              </div>
          
                                                              <div class="col-1 d-flex">
                                                                  <a>
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true" onclick="Show('WorkPlaceEditForm-{{$data->id}}')" style="cursor:pointer;color:blue;"></i>                                                          
                                                                  </a>
                                                                  &nbsp;&nbsp;
                                                                  <a href="{{ route('AdminWorkDelete', $data->id) }}">
                                                                    <i class="fa fa-trash" style="color:red;"></i>                                                            
                                                                </a>
                                                              </div>
                                                        </div>
                                                      @endforeach
                                                    @else
                                                        <div class="row tab-row">
                                                          <div class="col">
                                                            <b>No Data</b>
                                                          </div>
                                                        </div>
                                                    @endif
                                                        
                                                    
                                                    
                                                    <div class="row tab-row">
                                                        <div class="col-12">
                                                          <p style="color: blue;cursor:pointer;font-weight:bold;" onclick="Show('WorkPlaceForm')"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add More</p>
                                                        </div>
                                                    </div>


                                                    <div class="row tab-row mt-3" id="WorkPlaceForm" style="display: none;">
                                                        <div class="col-12 bg-dark mb-3">
                                                           <h4 class="text-white">Add new Work Experience</h4>
                                                        </div>  
                                                  
                                                        <form action="{{ route('AdminInfoInsertWorkExperience') }}" method="POST">
                                                          @csrf
                                                          
                                                          <div class="row">
                                                            <div class="col-6">
                                                              <div class="form-group">
                                                                  <label>Work Place</label>
                                                                  <input type="text" name="work_place" class="form-control" placeholder="Work place" required>
                                                              </div>
                                                              <div class="form-group">
                                                                  <label>Start</label>
                                                                  <input type="text" id="start_year" name="start_year" class="form-control" placeholder="start year">
                                                              </div>
                                                            </div>
  
                                                            <div class="col-6">
                                                              <div class="form-group">
                                                                  <label>Designation</label>
                                                                  <input type="text" name="designation" class="form-control" placeholder="Designation" required>
                                                              </div>
                                                              <div class="form-group">
                                                                  <div class="row">
                                                                    <div class="col-6">
                                                                      <label>End</label> 
                                                                    </div>
                                                                    <div class="col-6">
                                                                      <label for="present">Present</label>
                                                                      <input type="checkbox" value="present" name="present" id="present" onclick="Show('end_year')">
                                                                    </div>
                                                                  </div>
                                                                  <input type="text" id="end_year" name="end_year" class="form-control" placeholder="end year" style="display:block;">                                                                  
                                                              </div>
                                                            </div>


                                                            <div class="col-12">
                                                              <div class="form-group">
                                                                  <label>Job Description</label>
                                                                  <textarea name="job_description" id="" cols="90" rows="8" ></textarea>

                                                              </div>
                                                            </div>

                                                            <div class="col-12">
                                                              <button class="btn btn-outline-primary" type="submit">Submit</button>
                                                            </div>

                                                          </div>
                                                          

                                                        </form>
                                                      
                                                    </div>


                                                    @if ($work->isNotEmpty())
                                                        @foreach ($work as $data)
                                                            <div class="row tab-row mt-3" id="WorkPlaceEditForm-{{ $data->id }}" style="display: none;">
                                                              <div class="col-12 bg-dark mb-3">
                                                                <h4 class="text-white">Edit Work Experience</h4>
                                                              </div>  
                                                        
                                                              <form action="{{ route('AdminWorkEdit') }}" method="POST">
                                                                @csrf
                                                                
                                                                <input type="hidden" value="{{ $data->id }}" name="workID">
                                                                <div class="row">
                                                                  <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Work Place</label>
                                                                        <input type="text" value="{{ $data->work_place }}" name="edit_work_place" class="form-control" placeholder="Work place" required>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Start</label>
                                                                        <input type="text" value="{{ $data->start }}" id="edit_start_year" name="edit_start_year" class="form-control" placeholder="start year">
                                                                    </div>
                                                                  </div>
        
                                                                  <div class="col-6">
                                                                    <div class="form-group">
                                                                        <label>Designation</label>
                                                                        <input type="text" value="{{ $data->designation }}" name="edit_designation" class="form-control" placeholder="Designation" required>                              
                                                                      </div>

                                                                    
                                                                    @if ($data->end == 'present')
                                                                      <div class="form-group">
                                                                          <div class="row">
                                                                            <div class="col-6">
                                                                              <label>End</label> 
                                                                            </div>
                                                                            <div class="col-6">
                                                                              <label for="present">Present</label>
                                                                              <input type="checkbox" value="present" name="present" checked id="present" onclick="Show('edit_end_year-{{$data->id}}')">
                                                                            </div>
                                                                          </div>
                                                                          <input type="text" id="edit_end_year-{{$data->id}}" value="{{ $data->end }}" name="edit_end_year" class="form-control" placeholder="end year" style="display:none;">                                                                  
                                                                      </div>
                                                                    @else
                                                                      <div class="form-group">
                                                                          <div class="row">
                                                                            <div class="col-6">
                                                                              <label>End</label> 
                                                                            </div>
                                                                            <div class="col-6">
                                                                              <label for="present">Present</label>
                                                                              <input type="checkbox" value="present" name="present" id="present" onclick="Show('edit2_end_year-{{$data->id}}')">
                                                                            </div>
                                                                          </div>
                                                                          <input type="text" id="edit2_end_year-{{$data->id}}" value="{{ $data->end }}" name="edit_end_year" class="form-control" placeholder="end year" style="display:block;">                                                                  
                                                                      </div>
                                                                    @endif
                                                                    
                                                                  </div>
      
      
                                                                  <div class="col-12">
                                                                    <div class="form-group">
                                                                        <label>Job Description</label>
                                                                        <textarea name="edit_job_description" id="" cols="90" rows="5">{{ $data->job_description }}</textarea>
                                                                    </div>
                                                                  </div>
      
                                                                  <div class="col-12">
                                                                    <button class="btn btn-outline-success" type="submit">Update</button>
                                                                    &nbsp;
                                                                </form>
                                                                
                                                                    <a onclick="Show('WorkPlaceEditForm-{{$data->id}}')" class="btn btn-outline-dark">Back</a>
                                                                  </div>
                                                                </div>
                                                          </div>
                                                        @endforeach
                                                    @endif
                                                  
                                                  </div>  
                                              </div>
                                            </div>                                    
                                        </div> 
    
                                        <div id="Education" class="tabcontent" style="display: none;" >
                                            <div class="tabcontent-details">                                        
                                              <div class="tabcontent-row">
                                                  <div class="col-12">
                                                      @if ($education->isNotEmpty())
                                                          @foreach ($education as $data)
                                                            <div class="row tab-row">
                                                                <div class="col-1 col-md-1">
                                                                    <a>
                                                                        <i class="fa fa-graduation-cap" style="font-size: 20px;"></i> 
                                                                    </a>
                                                                </div>
                                                                <div class="col-8 col-md-8">
                                                                  <p style="font-weight: bold;font-size:15px">{{ $data->institution }}</p>
                                                                  <p style="font-size:13px;"> {{$data->degree}} &nbsp;|&nbsp; {{$data->major}} </p>
                                                                  <p style="font-size: 10px;">
                                                                      {{$data->start}} to {{$data->end}}                                                             
                                                                  </p> 
                                                                  
                                                                 
                                                                </div>
            
                                                                <div class="col-1 d-flex">
                                                                  <a>
                                                                    <i class="fa fa-pencil-square-o" aria-hidden="true" onclick="Show('EducationEditForm-{{$data->id}}')" style="cursor:pointer;color:blue;"></i>                                                          
                                                                  </a>
                                                                  &nbsp;&nbsp;
                                                                  <a href="{{ route('AdminEducationDelete', $data->id) }}">
                                                                    <i class="fa fa-trash" style="color:red;"></i>                                                            
                                                                </a>
                                                              </div>
                                                            </div>
                                                          @endforeach
                                                      @else
                                                          <div class="row tab-row">
                                                            <div class="col-12">
                                                              <b>No Data</b>
                                                            </div>
                                                          </div>
                                                      @endif

                                                      @if ($education->isNotEmpty())
                                                            @foreach ($education as $data)
                                                                <div class="row tab-row mt-3" id="EducationEditForm-{{ $data->id }}" style="display: none;">
                                                                  <div class="col-12 bg-dark mb-3">
                                                                    <h4 class="text-white">Edit Education</h4>
                                                                  </div>  
                                                            
                                                                  <form action="{{ route('AdminEducationEdit') }}" method="POST">
                                                                    @csrf
                                                                    
                                                                    <input type="hidden" value="{{ $data->id }}" name="educationID">
                                                                    <div class="row">
                                                                      <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Institution</label>
                                                                            <input type="text" value="{{ $data->institution }}" name="edit_institution" class="form-control" placeholder="Institution" required>
                                                                        </div>
                                                                      </div>
            
                                                                      <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Degree</label>
                                                                            <input type="text" value="{{ $data->degree }}" name="edit_degree" class="form-control" placeholder="Degree" required>                              
                                                                        </div>
                                                                      </div> 

                                                                      <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Major</label>
                                                                            <input type="text" value="{{ $data->major }}" name="edit_major" class="form-control" placeholder="Major" required>                              
                                                                        </div>
                                                                      </div>

                                                                      <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Start</label>
                                                                            <input type="text" value="{{ $data->start }}" name="edit_start" class="form-control" placeholder="Start" required>                              
                                                                        </div>
                                                                      </div>

                                                                      <div class="col-6">
                                                                        @if ($data->end == 'present')
                                                                            <div class="row">
                                                                              <div class="col-6">
                                                                                <label>End</label> 
                                                                              </div>
                                                                              <div class="col-6">
                                                                                <label for="present">Present</label>
                                                                                <input type="checkbox" value="present" name="present" checked id="present" onclick="Show('edit_ed_end-{{$data->id}}')">
                                                                              </div>
                                                                          </div>
                                                                          <input type="text" id="edit_ed_end-{{$data->id}}" value="{{ $data->end }}" name="edit_end" class="form-control" placeholder="end year" style="display:none;">                                                                  

                                                                        @else
                                                                          <div class="row">
                                                                              <div class="col-6">
                                                                                <label>End</label> 
                                                                              </div>
                                                                              <div class="col-6">
                                                                                <label for="present">Present</label>
                                                                                <input type="checkbox" value="present" name="present" id="present" onclick="Show('edit2_ed_end-{{$data->id}}')">
                                                                              </div>
                                                                          </div>
                                                                          <input type="text" id="edit2_ed_end-{{$data->id}}" value="{{ $data->end }}" name="edit_end" class="form-control" placeholder="end year" style="display:block;">                                                                  

                                                                        @endif 
                                                                    </div>
                                                                      
                                                      
                                                                      <div class="col-12">
                                                                        <button class="btn btn-outline-success" type="submit">Update</button>
                                                                        &nbsp;
                                                                    </form>
                                                                    
                                                                        <a onclick="Show('EducationEditForm-{{$data->id}}')" class="btn btn-outline-dark">Back</a>
                                                                      </div>
                                                                    </div>
                                                              </div>
                                                            @endforeach
                                                        @endif


                                                      <div class="row tab-row">
                                                          <div class="col-12">
                                                            <p style="color: blue;cursor:pointer;font-weight:bold;" onclick="Show('EducationForm')"><i class="fa fa-plus" aria-hidden="true" ></i>&nbsp;Add More</p>
                                                          </div>
                                                      </div>


                                                      <div class="row tab-row mt-3" id="EducationForm" style="display: none;">
                                                        <div class="col-12 bg-dark mb-3">
                                                           <h4 class="text-white">Add new Education</h4>
                                                        </div>  
                                                  
                                                        <form action="{{ route('AdminInfoInsertEducation') }}" method="POST">
                                                          @csrf
                                                          
                                                          <div class="row">
                                                            <div class="col-12">
                                                              <div class="form-group">
                                                                  <label>Institution</label>
                                                                  <input type="text" name="institution" class="form-control" placeholder="Institution" required>
                                                              </div>
                                                            </div>

                                                            <div class="col-6">
                                                              <div class="form-group">
                                                                  <label>Degree</label>
                                                                  <input type="text" name="degree" class="form-control" placeholder="Degree" required>
                                                              </div>
                                                            </div>
  
                                                            <div class="col-6">
                                                              <div class="form-group">
                                                                  <label>Major</label>
                                                                  <input type="text" name="major" class="form-control" placeholder="Major" required>
                                                              </div>
                                                            </div>

                                                            <div class="col-6">
                                                              <div class="form-group">
                                                                  <label>Start</label>
                                                                  <input type="text" name="ed_start" id="ed_start" class="form-control" placeholder="Start" required>
                                                              </div>
                                                            </div>

                                                            <div class="col-6">
                                                              <div class="form-group">
                                                                  <div class="row">
                                                                    <div class="col-6">
                                                                      <label>End</label> 
                                                                    </div>
                                                                    <div class="col-6">
                                                                      <label for="present">Present</label>
                                                                      <input type="checkbox" value="present" name="present" id="ed_present" onclick="Show('ed_end')">
                                                                    </div>
                                                                  </div>
                                                                  <input type="text" id="ed_end" name="ed_end" class="form-control" placeholder="end year" style="display:block;">                                                                  
                                                              </div>  
                                                            </div>
                                                            

                                                            <div class="col-12">
                                                              <button class="btn btn-outline-primary" type="submit">Submit</button>
                                                            </div>

                                                          </div>
                                                          

                                                        </form>
                                                      
                                                    </div>
                                                      
                                                  </div>  
                                              </div>
                                            </div>                                    
                                        </div> 

                                        <div id="Training" class="tabcontent" style="display: none;" >
                                          <div class="tabcontent-details">                                        
                                            <div class="tabcontent-row">
                                                <div class="col-12">
                                                    @if ($training->isNotEmpty())
                                                        @foreach ($training as $data)
                                                          <div class="row tab-row">
                                                              <div class="col-1 col-md-1">
                                                                  <a>
                                                                      <i class="fa fa-graduation-cap" style="font-size: 20px;"></i> 
                                                                  </a>
                                                              </div>
                                                              <div class="col-8 col-md-8">
                                                                <p style="font-weight: bold;font-size:15px">{{ $data->title }}</p>
                                                                <p style="font-size:13px;"> {{$data->institution}}</p>
                                                                <p style="font-size: 11px;">
                                                                  Duration: {{$data->duration}}   
                                                                </p>
                                                                <p style="font-size: 10px;">                                                                    
                                                                    {{ $data->training_date}}                                                       
                                                                </p> 
                                                                
                                                                <p style="font-size: 10px;">
                                                                  {{Str::limit($data->description, 50,'.....')}}                                                            
                                                              </p> 
                                                                
                                                               
                                                              </div>
          
                                                              <div class="col-1 d-flex">
                                                                <a>
                                                                  <i class="fa fa-pencil-square-o" aria-hidden="true" onclick="Show('TrainingEditForm-{{$data->id}}')" style="cursor:pointer;color:blue;"></i>                                                          
                                                                </a>
                                                                &nbsp;&nbsp;
                                                                <a href="{{ route('AdminTrainingDelete', $data->id) }}">
                                                                  <i class="fa fa-trash" style="color:red;"></i>                                                            
                                                              </a>
                                                            </div>
                                                          </div>
                                                        @endforeach
                                                    @else
                                                        <div class="row tab-row">
                                                          <div class="col-12">
                                                            <b>No Data</b>
                                                          </div>
                                                        </div>
                                                    @endif

                                                    @if ($training->isNotEmpty())
                                                          @foreach ($training as $data)
                                                              <div class="row tab-row mt-3" id="TrainingEditForm-{{ $data->id }}" style="display: none;">
                                                                <div class="col-12 bg-dark mb-3">
                                                                  <h4 class="text-white">Edit Training</h4>
                                                                </div>  
                                                          
                                                                <form action="{{ route('AdminTrainingEdit') }}" method="POST">
                                                                  @csrf
                                                                  
                                                                  <input type="hidden" value="{{ $data->id }}" name="trainingID">
                                                                    <div class="row">
                                                                      <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Training Title</label>
                                                                            <input type="text" name="edit_training_title" value="{{ $data->title }}" class="form-control" placeholder="Title" required>
                                                                        </div>
                                                                      </div>

                                                                      <div class="col-12">
                                                                        <div class="form-group">
                                                                            <label>Institution</label>
                                                                            <input type="text" name="edit_training_institution" value="{{ $data->institution }}" class="form-control" placeholder="Institution" required>
                                                                        </div>
                                                                      </div>

                                                                      <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Training Date</label>
                                                                            <input type="date" name="edit_training_training_date" value="{{ $data->training_date }}" class="form-control" required>
                                                                        </div>
                                                                      </div>

                                                                      <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Duration</label>
                                                                            <input type="text" name="edit_training_duration" value="{{ $data->duration }}" class="form-control" placeholder="duration" required>
                                                                        </div>
                                                                      </div>


                                                                      <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Description</label>
                                                                            <textarea name="edit_training_description" cols="80" rows="5">{{ $data->description }}</textarea>
                                                                        </div>
                                                                      </div>


                                                                   
                                                    
                                                                    <div class="col-12">
                                                                      <button class="btn btn-outline-success" type="submit">Update</button>
                                                                      &nbsp;
                                                                      </form>
                                                                  
                                                                      <a onclick="Show('TrainingEditForm-{{$data->id}}')" class="btn btn-outline-dark">Back</a>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                          @endforeach
                                                      @endif


                                                    <div class="row tab-row">
                                                        <div class="col-12">
                                                          <p style="color: blue;cursor:pointer;font-weight:bold;" onclick="Show('TrainingForm')"><i class="fa fa-plus" aria-hidden="true" ></i>&nbsp;Add More</p>
                                                        </div>
                                                    </div>


                                                    <div class="row tab-row mt-3" id="TrainingForm" style="display: none;">
                                                      <div class="col-12 bg-dark mb-3">
                                                         <h4 class="text-white">Add new Training</h4>
                                                      </div>  
                                                
                                                      <form action="{{ route('AdminInfoInsertTraining') }}" method="POST">
                                                        @csrf
                                                        
                                                        <div class="row">
                                                          <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Training Title</label>
                                                                <input type="text" name="title" class="form-control" placeholder="Title" required>
                                                            </div>
                                                          </div>

                                                          <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Institution</label>
                                                                <input type="text" name="institution" class="form-control" placeholder="Institution" required>
                                                            </div>
                                                          </div>

                                                          <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Training date</label>
                                                                <input type="date" name="training_date" class="form-control" required>
                                                            </div>
                                                          </div>

                                                          <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Duration</label>
                                                                <input type="text" name="duration" class="form-control" placeholder="duration" required>
                                                            </div>
                                                          </div>

                                                          <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="description" id="" cols="80" rows="5"></textarea>
                                                            </div>
                                                          </div>

                                                          
                                                          

                                                          <div class="col-12">
                                                            <button class="btn btn-outline-primary" type="submit">Submit</button>
                                                          </div>

                                                        </div>
                                                        

                                                      </form>
                                                    
                                                  </div>
                                                    
                                                </div>  
                                            </div>
                                          </div>                                    
                                      </div> 


                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
      </section>
        <!-- END Work Experience and Education-->
        
        
        <!-- Start Social Media-->
        <section>
            <div class="container">
                <div class="row bg-white m-t-60">
                    <div class="col-12 bg-dark">
                        <h3 class="text-white">Social Media</h3>
                    </div>
                   
                      <div class="col-12">
                          <div class="row">
                            <div class="col-8">
                              <h4 class="m-l-20 m-t-20 m-b-5">Facebook</h4>
                            </div>
                            <div class="col-4 m-t-20">
                              <i class="fa fa-pencil-square-o" aria-hidden="true" onclick="ShowSocial('FACEBOOKFORM')" style="color:blue;cursor:pointer"></i>
                            </div>
                            
                          </div>                       
                          <div class="row m-l-5">
                              @if (isset($social->facebook))
                              <a href="{{ $social->facebook }}" target="_blank">
                                <p class="m-l-20 m-t-5 m-b-20">{{ $social->facebook }}</p> 
                              </a>  
                              @else
                              <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
                              @endif
                          </div>
                          
                          <div class="row m-l-10" style="display: none;width:70%;" id="FACEBOOKFORM">
                            <form action="{{ route('AdminInfoFacebook') }}" method="POST">
                              @csrf
                              <div class="d-flex">                                 
                                  <input type="text" class="form-control" name="facebook" @if (isset($social->facebook)) value="{{ $social->facebook }}" @endif autocomplete="off" required>&nbsp;
                                  <button type="submit" class="btn btn-outline-success">Update</button>
                              </div>
                            </form>                              

                          </div>
                          
                      </div>

                      <div class="col-12">
                        <div class="row">
                          <div class="col-8">
                            <h4 class="m-l-20 m-t-20 m-b-5">Instagram</h4>
                          </div>
                          <div class="col-4 m-t-20">
                            <i class="fa fa-pencil-square-o" aria-hidden="true" onclick="ShowSocial('INSTAGRAMFORM')" style="color:blue;cursor:pointer"></i>
                          </div>
                          
                        </div>                       
                        <div class="row m-l-5">
                            @if (isset($social->instagram))
                              <a href="{{ $social->instagram }}">
                                <p class="m-l-20 m-t-5 m-b-20">{{ $social->instagram }}</p>              
                              </a>
                            @else
                            <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
                            @endif
                        </div>
                        
                        <div class="row m-l-10" style="display: none;width:70%;" id="INSTAGRAMFORM">
                          <form action="{{ route('AdminInfoInstagram') }}" method="POST">
                            @csrf
                            <div class="d-flex"> 
                                <input type="text" class="form-control" name="instagram" @if (isset($social->instagram)) value="{{ $social->instagram }}" @endif autocomplete="off" required>&nbsp;
                                <button type="submit" class="btn btn-outline-success">Update</button>
                            </div>
                          </form>                              

                        </div>

                      </div>

                      <div class="col-12">
                          <div class="row">
                            <div class="col-8">
                              <h4 class="m-l-20 m-t-20 m-b-5">Lindedin</h4>
                            </div>
                            <div class="col-4 m-t-20">
                              <i class="fa fa-pencil-square-o" aria-hidden="true" onclick="ShowSocial('LINKEDINFORM')" style="color:blue;cursor:pointer"></i>
                            </div>
                            
                          </div>                       
                          <div class="row m-l-5">
                              @if (isset($social->linkedin))
                                <a href="{{ $social->linkedin }}">
                                  <p class="m-l-20 m-t-5 m-b-20">{{ $social->linkedin }}</p>              
                                </a>
                              @else
                              <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
                              @endif
                          </div>
                          
                          <div class="row m-l-10" style="display: none;width:70%;" id="LINKEDINFORM">
                            <form action="{{ route('AdminInfoLinkedin') }}" method="POST">
                              @csrf
                              <div class="d-flex"> 
                                  <input type="text" class="form-control" name="linkedin" @if (isset($social->linkedin)) value="{{ $social->linkedin }}" @endif autocomplete="off" required>&nbsp;
                                  <button type="submit" class="btn btn-outline-success">Update</button>
                              </div>
                            </form>                              

                          </div>
                          
                      </div>
                      
                      <div class="col-12">
                          <div class="row">
                            <div class="col-8">
                              <h4 class="m-l-20 m-t-20 m-b-5">Twitter</h4>
                            </div>
                            <div class="col-4 m-t-20">
                              <i class="fa fa-pencil-square-o" aria-hidden="true" onclick="ShowSocial('TWITTERFORM')" style="color:blue;cursor:pointer"></i>
                            </div>
                            
                          </div>                       
                          <div class="row m-l-5">
                              @if (isset($social->twitter))
                                <a href="{{ $social->twitter }}">
                                  <p class="m-l-20 m-t-5 m-b-20">{{ $social->twitter }}</p>              
                                </a>
                              @else
                              <p class="m-l-20 m-t-5 m-b-20">No Data</p>              
                              @endif
                          </div>
                          
                          <div class="row m-l-10" style="display: none;width:70%;" id="TWITTERFORM">
                            <form action="{{ route('AdminInfoTwitter') }}" method="POST">
                              @csrf
                              <div class="d-flex"> 
                                  <input type="text" class="form-control" name="twitter" @if (isset($social->twitter)) value="{{ $social->twitter }}" @endif autocomplete="off" required>&nbsp;
                                  <button type="submit" class="btn btn-outline-success">Update</button>
                              </div>
                            </form>                              

                          </div>
                      </div>
                    
                    
                </div>
            </div>
        </section>
        <!-- End Social Media-->
        
        <!-- Password & Links -->
        <section id="SitePassword">
          <div class="container">
            <div class="row bg-white m-t-60">
              <div class="col-12 bg-dark">
                  <h3 class="text-white">Password</h3>
              </div>
              @if (isset($sitepassword))
                @foreach ($sitepassword as $data)
                <div class="col-12">
                    <h4 class="m-l-20 m-t-20 m-b-5">Site Name : <span>{{$data->site}}</span></h4>
                    <p class="m-l-20 m-t-5">Site Link: <a href="{{$data->link}}">{{$data->link}}</a></p>
                    {{--  <button type="button" class="btn btn-outline-primary m-l-20 m-b-20" data-toggle="modal" data-target="#ShowModal">Show Password</button>  --}}

                    <a href="{{ route('AdminSiteMail', $data->id) }}">
                        <button class="btn btn-outline-primary m-l-20 m-b-20">View and Edit</button>
                    </a>

                    <a href="{{ route('AdminSiteDelete', $data->id) }}">
                      <button class="btn btn-outline-danger m-b-20">Delete</button>

                    </a>
                </div>
                @endforeach
              @else
                <div class="col-12">
                    <h3>No Data</h3>
                </div>
              @endif

                                                    
             
              <div class="col-12">
                <a href="#PASSWORDINFO">
                  <p style="color: blue;cursor:pointer;font-weight:bold;" onclick="Show('PASSWORDINFO')"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add More</p>
                </a>
              </div>
            

            </div>
          </div>
      </section>
        <!-- End Password & Links -->

        <!-- Password Update -->
        <section id="PASSWORDINFO" style="display: none;">
          <div class="container">
              <div class="row bg-white m-t-60">
                  <div class="col-12 bg-dark">
                      <h3 class="text-white">Password Information</h3>
                  </div>
                 
                  <div class="col-12 m-t-10">
                    <form action="{{ route('AdminSiteInsert') }}" method="post" class="form-horizontal">
                      @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="hf-email" class=" form-control-label">Site Name</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text"  id="" name="site" placeholder="Site Name..." class="form-control" autocomplete="off">
                                <span class="help-block">Please enter site name</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="hf-email" class=" form-control-label">Site Link</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="hf-email" name="link" placeholder="Site Link..." class="form-control" autocomplete="off">
                                <span class="help-block">Please enter Site Link</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="hf-email" class=" form-control-label">User Name or Email</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="hf-email" name="name_email" placeholder="Enter User Name or Email..." class="form-control" autocomplete="off">
                                <span class="help-block">Please enter your user name or email</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="hf-password" class=" form-control-label">Password</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" id="hf-password" name="password" placeholder="Enter Password..." class="form-control" autocomplete="off">
                                <span class="help-block">Please enter your password</span>
                            </div>
                        </div>

                        <div class="row form-group">
                          <div class="col-12 col-md-9">
                            <button type="submit" class="btn btn-primary btn-sm m-b-45">
                                        <i class="fa fa-save"></i>&nbsp; Save
                            </button>

                            <a href="#PASSWORDINFO" class="btn btn-dark btn-sm m-b-45" onclick="Show('PASSWORDINFO')"> Back </a>
                          </div>

                        </div>

                    </form>
                </div>
                  
                  
              </div>
          </div>
      </section>
        <!-- End Password Update -->

@endsection


@section('footer_js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

<script>
    function ShowName() {
        var x = document.getElementById("NAMEFORM");
        if (x.style.display === "none") {
          x.style.display = "block";         

        } else {
          x.style.display = "none";

        }
      }

      function ShowPhone() {
        var x = document.getElementById("PHONEFORM");
        if (x.style.display === "none") {
          x.style.display = "block";         

        } else {
          x.style.display = "none";

        }
      }

      function ShowEmail() {
        var x = document.getElementById("EMAILFORM");
        if (x.style.display === "none") {
          x.style.display = "block";         

        } else {
          x.style.display = "none";

        }
      }

      function ShowAddress() {
        var x = document.getElementById("ADDRESSFORM");
        if (x.style.display === "none") {
          x.style.display = "block";         

        } else {
          x.style.display = "none";

        }
      }

      function ShowAbout() {
        var x = document.getElementById("ABOUTFORM");
        if (x.style.display === "none") {
          x.style.display = "block";         

        } else {
          x.style.display = "none";

        }
      }

      function ShowSocial(data) {
        var x = document.getElementById(data);
        if (x.style.display === "none") {
          x.style.display = "block";         

        } else {
          x.style.display = "none";

        }
      }

      function Show(data) {
        var x = document.getElementById(data);
        if (x.style.display === "none") {
          x.style.display = "block";         

        } else {
          x.style.display = "none";

        }
      }

      
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

<script>
    function openTab(evt, tabName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the link that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
    }
</script>

<script>

  $(document).ready(function(){
      $("#start_year").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          autoclose:true
      });  
      $("#end_year").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          autoclose:true
      }); 

      $("#edit_start_year").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          autoclose:true
      });  
      $("#edit_end_year").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          autoclose:true
      }); 

      $("#ed_start").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          autoclose:true
      });

      $("#ed_end").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          autoclose:true
      });

      $("#edit_ed_end").datepicker({
          format: "yyyy",
          viewMode: "years", 
          minViewMode: "years",
          autoclose:true
      });

    
    });
</script>

@endsection