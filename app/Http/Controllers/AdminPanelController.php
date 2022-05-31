<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Blog;
use App\Education;
use App\WorkExperience;
use App\SocialMedia;
use App\Training;
use App\Gallery;
use App\GalleryImages;
use App\SitePassword;
use App\OTP;
use App\CaseStudy;
use App\Contact;
use App\Comment;
use App\CommentReply;
use App\Appointment;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminPanelController extends Controller
{
    
    function AppointmentView($id)
    {
        $appointment = Appointment::where('id' , $id)->first();
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
        
        
        if(!empty($appointment))
        {  
            $appointment->status =1;
            $appointment->save();

            return view('backend.appointment.view', [
                'appointment'=> $appointment,                
                'unreadcontact' => $unreadcontact
                
            ]);

        }
        else{
            return view('404NotFound');
        }
    }

    function AdminAppointment()
    {

       
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
        $appointments = Appointment::orderBy('id', 'DESC')->get();

        return view('backend.appointment.list', [
            'appointments' => $appointments,
            'unreadcontact' => $unreadcontact    
        ]);
    }

    function AdminLogin(Request $req)
    {   
        $req->validate([          
            'email' => 'required|email',          
            'password' => 'required'
        ]);

        if (Auth::attempt(array('email' => $req->email, 'password' => $req->password))){
           
            $user = Auth::user();
            
             return redirect()->route('dashboard');
         }else{
             return back()->with('error', "These credentials doesn't match with our records");
         }     
    }


    function dashboard()
    {

        $user = Auth::user();
        $contact = Contact::orderBy('id', 'DESC')->get();
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();

        $blog_count = Blog::count();
        $case_study_count = CaseStudy::count();
        $contact_count = Contact::count();

        return view('backend.home.home', [
            'user' => $user,
            'contact' => $contact,
            'unreadcontact' => $unreadcontact,
            'blog_count' => $blog_count,
            'case_study_count' => $case_study_count,
            'contact_count' => $contact_count
        ]);
    }


    function AdminBlog()
    {
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
       
        $blogs = Blog::orderBy('id', 'DESC')->get();
        return view('backend.blog.blog', [
            'blogs'=> $blogs,
            'unreadcontact' => $unreadcontact
        ]);
    }



    function AdminBlogInsert(Request $req)
    {
        if($req->hasFile('image')){
            $image= $req->file('image');
            $IMGNAME = Str::random(10).'.'. $image->getClientOriginalExtension();       
    
            $thumbnail_location = 'images/blog/'
            . Carbon::now()->format('Y/M/')
            .'/';

            //Make Directory 
            File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
            //save Image to the thumbnail path
            Image::make($image)->save(public_path($thumbnail_location.$IMGNAME));

            $blog = new Blog;
            $blog->title = $req->title;
            $blog->text = $req->text;
            $blog->image = $IMGNAME;
            $blog->introduction = $req->introduction;
            $blog->save();
            return back();

        }
        else{

            return back()->with('error', "Data Input Error");

        }

    }


    function AdminBlogDetails($id)
    {
        $blog = Blog::where('id' , $id)->first();
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
        $blog_comment = Comment::where('blog_id', $id)->orderBy('id', 'DESC')->get();
        
        if(!empty($blog))
        {
            $otherBlogs = Blog::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(5)->get();

            return view('backend.blog.blogView', [
                'blog'=> $blog,
                'otherBlogs' => $otherBlogs,
                'unreadcontact' => $unreadcontact,
                'blog_comment' => $blog_comment
            ]);

        }
        else{
            return view('404NotFound');
        }
        
    }

    function AdminBlogDelete($id){
        $blog = Blog::find($id);
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
        
        if(!empty($blog))
        {
            $blog->delete();
            
            $blogs = Blog::orderBy('id', 'DESC')->get();
            return view('backend.blog.blog', [
                'blogs'=> $blogs,
                'unreadcontact' => $unreadcontact
            ]);

        }
        else{
            return view('404NotFound');
        }        
    }


    function AdminBlogUpdate(Request $req){


        $req->validate([          
            'title' => 'required',          
            'text' => 'required'
        ]);


        $blog = Blog::find($req->BlogID);

        if(!empty($blog))
        {

            if($req->hasFile('image')){

                $image= $req->file('image');
                $IMGNAME = Str::random(10).'.'. $image->getClientOriginalExtension();       
        
                $thumbnail_location = 'images/blog/'
                . Carbon::now()->format('Y/M/')
                .'/';

                //Make Directory 
                File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
                //save Image to the thumbnail path
                Image::make($image)->save(public_path($thumbnail_location.$IMGNAME));

                //Delete previous Image
                $old_img_location = public_path('images/blog/'.$blog->created_at->format('Y/M/').'/'.$blog->image);
                if(file_exists($old_img_location)){
                   unlink($old_img_location);
                }                
                //saving the new image
                $blog->image = $IMGNAME;
            }
                
            $blog->title = $req->title;
            $blog->text = $req->text;
            $blog->introduction = $req->introduction;
            $blog->save();   
            $otherBlogs = Blog::where('id', '!=', $blog->id)->orderBy('id', 'DESC')->limit(5)->get();    

            $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
            
            return view('backend.blog.blogView', [
               'blog'=> $blog,
                'otherBlogs' => $otherBlogs,
                'unreadcontact' => $unreadcontact
            ]);
        }
        else{
            return view('404NotFound');
        }    

    }

    function AdminBlogTrash()
    {
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
        
        $blogs = Blog::onlyTrashed()->orderBy('id', 'DESC')->get();
        return view('backend.blog.blogtrash', [
            'blogs'=> $blogs,
            'unreadcontact' => $unreadcontact
        ]);
    }


    function AdminBlogRestore($id)
    {
        $blog = Blog::where('id', $id)->onlyTrashed()->first();

        if(!empty($blog))
        {
            $blog->restore();
            return redirect()->back()->with('success', "Your Blog has been Restored!");

        }
        else{
            return view('404NotFound');
        }        
    }


    function AdminBlogConfirmDelete($id)
    {
        $blog = Blog::where('id', $id)->onlyTrashed()->first();

        if(!empty($blog))
        {
            //Delete previous Image
            $old_img_location = public_path('images/blog/'.$blog->created_at->format('Y/M/').'/'.$blog->image);
            if(file_exists($old_img_location)){
               unlink($old_img_location);
            } 

            $blog->forceDelete();
            return redirect()->back()->with('delete', "Your Blog has been Deleted!");

        }
        else{
            return view('404NotFound');
        }       
    }


    function AdminBlogCommentOff($id)
    {
        $blog = Blog::find($id);

        if(!empty($blog))
        {
            $blog->comment_switch = 0;
            $blog->save();
            return back();

        }
        else{
            return view('404NotFound');
        }     
    }


    function AdminBlogCommentOn($id)
    {
        $blog = Blog::find($id);

        if(!empty($blog))
        {
            $blog->comment_switch = 1;
            $blog->save();
            return back();

        }
        else{
            return view('404NotFound');
        }     
    }



    function AdminInfo()
    {
        $CheckSocial= SocialMedia::get();
        $work = WorkExperience::orderBy('id', 'DESC')->get();
        $education = Education::orderBy('id', 'DESC')->get();
        $training = Training::orderBy('id', 'DESC')->get();
        $sitepassword = SitePassword::orderBy('id', 'DESC')->get();
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();

        if($CheckSocial->isEmpty())
        {
            $insertSocial = new SocialMedia;
            $insertSocial->id = 1;
            $insertSocial->save();
        }
        



        $user= Auth::user();
        $social= SocialMedia::where('id', 1)->first();
        return view('backend.info.info', [
            'user' => $user,
            'social'=> $social,
            'work'=>$work,
            'education'=>$education,
            'training'=>$training,
            'sitepassword'=>$sitepassword,
            'unreadcontact' => $unreadcontact
        ]);
    }



    function AdminInfoName(Request $req)
    {
        $req->validate([          
            'name' => 'required'
        ]);

        $user = User::where('id', Auth::id())->first();
        $user->name = $req->name;
        $user->save();
        return back();
    }

    function AdminInfoPhone(Request $req)
    {
        $req->validate([          
            'phone' => 'required'
        ]);

        $user = User::where('id', Auth::id())->first();
        $user->phone = $req->phone;
        $user->save();
        return back();
    }

    function AdminInfoEmail(Request $req)
    {
        $req->validate([          
            'email' => 'required'
        ]);

        $user = User::where('id', Auth::id())->first();
        $user->email = $req->email;
        $user->save();
        return back();
    }


    function AdminInfoAddress(Request $req){
        $req->validate([          
            'address' => 'required'
        ]);

        $user = User::where('id', Auth::id())->first();
        $user->address = $req->address;
        $user->save();
        return back();
    }

    function AdminInfoAbout(Request $req)
    {
        $req->validate([          
            'about' => 'required'
        ]);

        $user = User::where('id', Auth::id())->first();
        $user->about = $req->about;
        $user->save();
        return back();
    }

    function AdminInfoFacebook(Request $req)
    {
        $req->validate([          
            'facebook' => 'required'
        ]);

        $social = SocialMedia::where('id', 1)->first();
        $social->facebook = $req->facebook;
        $social->save();
        return back();
    }

    function AdminInfoInstagram(Request $req)
    {
        $req->validate([          
            'instagram' => 'required'
        ]);

        $social = SocialMedia::where('id', 1)->first();
        $social->instagram = $req->instagram;
        $social->save();
        return back();
    }

    function AdminInfoLinkedin(Request $req)
    {
        $req->validate([          
            'linkedin' => 'required'
        ]);

        $social = SocialMedia::where('id', 1)->first();
        $social->linkedin = $req->linkedin;
        $social->save();
        return back();
    }

    function AdminInfoTwitter(Request $req)
    {
        $req->validate([          
            'twitter' => 'required'
        ]);

        $social = SocialMedia::where('id', 1)->first();
        $social->twitter = $req->twitter;
        $social->save();
        return back();
    }



    function AdminInfoInsertWorkExperience(Request $req)
    {
        $req->validate([          
            'work_place' => 'required',
            'start_year' => 'required',
            'designation' => 'required'
        ]); 


        $work = new WorkExperience;
        $work->work_place = $req->work_place;
        $work->designation = $req->designation;
        $work->start = $req->start_year;
        $work->job_description = $req->job_description;
        $work->user_id = Auth::id();

        if(isset($req->end_year))
        {
            $work->end = $req->end_year;
        }
        else{
            $work->end = 'present';
        }

        $work->save();
        return back();
    }

    function AdminWorkDelete($id)
    {
        $work = WorkExperience::find($id);

        if(!empty($work))
        {
            $work->delete();
            
            return back();

        }
        else{
            return view('404NotFound');
        }   
    }


    function AdminWorkEdit(Request $req)
    {
        $work = WorkExperience::where('id' , $req->workID)->where('user_id', Auth::id())->first();
        $work->work_place = $req->edit_work_place;
        $work->designation = $req->edit_designation;
        $work->start = $req->edit_start_year;
        $work->job_description = $req->edit_job_description;
        
        if(isset($req->present))
        {
            $work->end = 'present';
        }
        else{
            $work->end = $req->edit_end_year;

        }


        $work->save();
        return back();
    }


    function AdminInfoInsertEducation(Request $req)
    {
        $req->validate([          
            'institution' => 'required',
            'degree' => 'required',
            'major' => 'required',
            'ed_start' => 'required'
            
        ]); 

        $education = new Education;
        $education->institution = $req->institution;
        $education->degree = $req->degree;
        $education->major = $req->major;
        $education->start = $req->ed_start;
        $education->user_id = Auth::id();

        if(isset($req->ed_end)){
            $education->end = $req->ed_end;
        }
        else{
            $education->end = 'present';
        }

        $education->save();
        return back();
    }


    function AdminEducationDelete($id)
    {
        $education = Education::find($id);

        if(!empty($education))
        {
            $education->delete();
            
            return back();

        }
        else{
            return view('404NotFound');
        }   
    }


    function AdminEducationEdit(Request $req)
    {
        $education = Education::where('id', $req->educationID)->first();
        $education->institution = $req->edit_institution;
        $education->degree = $req->edit_degree;
        $education->major = $req->edit_major;
        $education->start = $req->edit_start;
        if(isset($req->present))
        {
            $education->end = 'present';
        }
        else{
            $education->end = $req->edit_end;
        }
        $education->save();
        return back();


    }


    function AdminTrainingDelete($id)
    {
        $training = Training::find($id);

        if(!empty($training))
        {
            $training->delete();
            
            return back();

        }
        else{
            return view('404NotFound');
        }  
    }


    function AdminInfoInsertTraining(Request $req)
    {
        $req->validate([          
            'title' => 'required',
            'institution' => 'required',
            'training_date' => 'required',
            'duration' => 'required'            
        ]); 

        $train = new Training;
        $train->title = $req->title;
        $train->institution = $req->institution;
        $train->training_date = $req->training_date;
        $train->duration = $req->duration;
        $train->description = $req->description;
        $train->save();
        return back();
    }


    function AdminTrainingEdit(Request $req)
    {
        $train = Training::where('id',$req->trainingID)->first();
        $train->title = $req->edit_training_title;
        $train->institution = $req->edit_training_institution;
        $train->training_date = $req->edit_training_training_date;
        $train->duration = $req->edit_training_duration;
        $train->description = $req->edit_training_description;
        $train->save();
        return back();
    }


    function AdminInfoProfilePicture(Request $req)
    {
        
        if($req->hasFile('image'))
        {
            $user = User::where('id', Auth::id())->first();

            if(isset($user->image)){
                //deleting the previous profile picture
                $old_img_location = public_path('images/profile/'.$user->image);
                if(file_exists($old_img_location)){
                unlink($old_img_location);
                }    
            }
                       


            $image= $req->file('image');
            $IMGNAME = Str::random(10).'.'. $image->getClientOriginalExtension();       
    
            $thumbnail_location = 'images/profile/';
    
            //Make Directory 
            File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
            //save Image to the thumbnail path
            Image::make($image)->save(public_path($thumbnail_location.$IMGNAME));
           
            $user->image = $IMGNAME;
            $user->save();
        }
       
        return back();
    }

    function AdminGallery()
    {
        $gallery = Gallery::orderBy('id', 'DESC')->get();
         $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();

        return view('backend.gallery.gallery',[
            'gallery' => $gallery,
            'unreadcontact' => $unreadcontact
        ]);
    }

    function AdminGalleryInsert(Request $req)
    {
        $req->validate([          
            'title' => 'required',
            'caption' => 'required'            
        ]); 

        $gallery = new Gallery;

        if($req->hasFile('images'))
        {

            $gallery->title = $req->title;
            $gallery->caption = $req->caption;
            $gallery->save();

            $images = $req->file('images');

            $new_location = 'images/gallery/'
                . Carbon::now()->format('Y/M/') .'/';

            File::makeDirectory($new_location, $mode=0777, true, true);

            foreach ($images as $img) {
                $img_ext = Str::random(10).'.'.$img->getClientOriginalExtension();
                Image::make($img)->save(public_path($new_location. $img_ext));

                $gallery_images = new GalleryImages;
                $gallery_images->gallery_id = $gallery->id;
                $gallery_images->image = $img_ext;
                $gallery_images->save();
            }
            
        }

        return back();
    }



    function AdminGalleryView($id){
        $gallery = Gallery::where('id' , $id)->first();

        if(!empty($gallery))
        {
            $gallery_images = GalleryImages::where('gallery_id', $id)->orderBy('id', 'ASC')->get();
            $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
            
            return view('backend.gallery.galleryView', [
                'gallery'=> $gallery,
                'gallery_images' => $gallery_images,
                'unreadcontact' => $unreadcontact
            ]);

        }
        else{
            return view('404NotFound');
        }
    }


    function AdminGallerySingleImageDelete($id)
    {
        $galleryImg = GalleryImages::where('id' , $id)->first();
        $gallery = Gallery::where('id', $galleryImg->gallery_id)->first();

        if(!empty($galleryImg))
        {   

            $galleryImg->delete();

            //Delete previous Image
            $old_img_location = public_path('images/gallery/'.$gallery->created_at->format('Y/M/').'/'.$galleryImg->image);
            if(file_exists($old_img_location)){
               unlink($old_img_location);
            } 
            return back();

        }
        else{
            return view('404NotFound');
        }
    }



    function AdminGalleryMoreInsert(Request $req)
    {
        if($req->hasFile('images'))
        {
            $gallery_id = $req->gallery_id;

            $images = $req->file('images');

            $new_location = 'images/gallery/'
                . Carbon::now()->format('Y/M/') .'/';

            File::makeDirectory($new_location, $mode=0777, true, true);

            foreach ($images as $img) {
                $img_ext = Str::random(10).'.'.$img->getClientOriginalExtension();
                Image::make($img)->save(public_path($new_location. $img_ext));

                $gallery_images = new GalleryImages;
                $gallery_images->gallery_id = $gallery_id;
                $gallery_images->image = $img_ext;
                $gallery_images->save();
            }
            
        }

        return back();
    }


    function AdminGalleryDelete($id)
    {
        $gallery = Gallery::where('id' , $id)->first();

        if(!empty($gallery))
        {
            $gallery_images = GalleryImages::where('gallery_id', $id)->get();

            foreach ($gallery_images as $data) {
                //Delete previous Image
                $old_img_location = public_path('images/gallery/'.$gallery->created_at->format('Y/M/').'/'.$data->image);
                if(file_exists($old_img_location)){
                unlink($old_img_location);
                } 

                $data->delete();
                
            }
            $gallery->delete();

            $galleryAll = Gallery::orderBy('id', 'DESC')->get();
            return redirect()->route( 'AdminGallery' );
        }


        else{
            return view('404NotFound');
        }
    }


    function AdminGalleryEdit(Request $req)
    {

        $gallery = Gallery::where('id', $req->gallery_id)->first();
        $gallery->title = $req->title;
        $gallery->caption = $req->caption;
        $gallery->save();
        return back();

    }

    function AdminSiteInsert(Request $req)
    {

        $req->validate([          
            'name_email' => 'required',
            'password' => 'required' ,
            'site' => 'required',
            'link' => 'required'           
        ]); 

        $password = $req->password;
        $name_email = $req->name_email;

        $encryptPassword = Crypt::encryptString($password);
        $encryptNameEmail = Crypt::encryptString($name_email);

        
        $siteData = new SitePassword;
        $siteData->site = $req->site;
        $siteData->link = $req->link;
        $siteData->name_email = $encryptNameEmail;
        $siteData->password = $encryptPassword;
        $siteData->save();

        return redirect('admin-info' .'/#SitePassword');
       
    }



    function AdminSiteMail($id)
    {
        $siteInfo = SitePassword::where('id' , $id)->first();

        if(!empty($siteInfo))
        {
            
            $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
            
            return view('backend.otp.otp', [
                'site' => $siteInfo,
                'unreadcontact' => $unreadcontact
            ]);

            
        }
        else{
            return view('404NotFound');
        }
    }


    function AdminSendOTP(Request $req)
    {
        $siteInfo = SitePassword::where('id' , $req->site_id)->first();

        if(!empty($siteInfo))
        {
           
            $otp = new OTP;
            $user = Auth::user();
            $otp_generator = Str::random(6);
            
            $otp->email_from = $user->email;
            $otp->email_to = $user->email;   
            $otp->otp = Crypt::encryptString($otp_generator);
            $otp->site_id = $siteInfo->id;
            $otp->start_time = Carbon::now();
            $otp->end_time = Carbon::now()->addMinutes(15);
            $otp->user_id = Auth::id();
            $otp->attempts = 3;
            $otp->save();
            

            try {
                $decrypted_otp = Crypt::decryptString($otp->otp);
            } catch (DecryptException $e) {
                return $e;
            }
            
           //sending OTP through mail
            $details = [
                'title' => 'Mail from PaperArt',
                'body' => 'This is for testing email using smtp LARAVEL',
                'data' => $siteInfo,
                'opt' => $decrypted_otp,
                'duration' => '15 mins'
            ];
           
            \Mail::to(Auth::user()->email)->send(new \App\Mail\SitePasswordMail($details));
           
            // return redirect('admin-info' .'/#SitePassword');

            return back()->with('opt_msg', $otp->id);
        }
        else{
            return view('404NotFound');
        }  
    }

    function AdminOTPConfirm(Request $req)
    {
        $req->validate([          
            'site_id' => 'required',          
            'otp_id' => 'required'
        ]);

        $otp = OTP::where('id', $req->otp_id)->where('site_id', $req->site_id)->first();
        

        if(!empty($otp))
        {

            if($otp->attempts <= 0)
            {
                return redirect()->route('AdminInfo');
                die();
            }


            //checking the duration of the OTP
            $now = Carbon::now();
            $start_time = $otp->start_time;
            $end_time = $otp->end_time;

            
            if($start_time<=$now && $now<=$end_time)
            {
                $inputOTP = $req->otp;
                $siteInfo = SitePassword::where('id', $otp->site_id)->first();
    
                try {
                    $decryptOTP = Crypt::decryptString($otp->otp);
                } catch (DecryptException $e) {
                    return $e;
                }
                
                if($decryptOTP == $inputOTP)
                {
                    $otp->attempts -= 1;
                    $otp->save();
                    return back()->with([
                        'otp_confirm' => 'Confirmed',
                        'name_email' => Crypt::decryptString($siteInfo->name_email),
                        'password' => Crypt::decryptString($siteInfo->password)
    
                    ]);
                }
                else{
                    $otp->attempts -= 1;
                    $otp->save();
                    return back()->with([
                        'opt_msg' => $otp->id,
                        'attempts_left' =>$otp->attempts
                    ]);
                    // return back()->with('otp_error', $otp->attempts);
                }
            }
            else 
            {
                return back()->with('otp_expire','Expired OTP');
            }

            
        }
        else{
            return view('404NotFound');
        }  
    }


    function AdminSiteDelete($id)
    {
        $site = SitePassword::where('id', $id)->first();

        if(!empty($site)){
            $site->delete();
            return redirect('admin-info' .'/#SitePassword');

        }   
        else{
            return view('404NotFound');
        }
    }


    function AdminSiteUpdate(Request $req)
    {
        $req->validate([          
            'site_id' => 'required',          
            'password' => 'required',
            'name_email' => 'required',
            'site' => 'required',
            'link' => 'required'
        ]);
        $site = SitePassword::where('id', $req->site_id)->first();

        if(!empty($site)){
           
            $en_name_email = Crypt::encryptString($req->name_email);
            $en_password = Crypt::encryptString($req->password);

            $site->site= $req->site;
            $site->link= $req->link;
            $site->name_email= $en_name_email;
            $site->password= $en_password;
            $site->save();
            return redirect('admin-info' .'/#SitePassword');
        }   
        else{
            return view('404NotFound');
        }


    }


    function AdminCaseStudy()
    {

        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
        
        $caseStudies = CaseStudy::orderBy('id', 'DESC')->get();
        return view('backend.casestudy.casestudy', [
            'caseStudies'=> $caseStudies,
            'unreadcontact' => $unreadcontact
        ]);

    }


    function AdminCaseStudyInsert(Request $req)
    {
        if($req->hasFile('image')){
            $image= $req->file('image');
            $IMGNAME = Str::random(10).'.'. $image->getClientOriginalExtension();       
    
            $thumbnail_location = 'images/case_study/'
            . Carbon::now()->format('Y/M/')
            .'/';

            //Make Directory 
            File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
            //save Image to the thumbnail path
            Image::make($image)->save(public_path($thumbnail_location.$IMGNAME));

            $casestudy = new CaseStudy;
            $casestudy->title = $req->title;
            $casestudy->text = $req->text;
            $casestudy->introduction = $req->introduction;
            $casestudy->image = $IMGNAME;
            $casestudy->save();
            return back();

        }
        else{

            return back()->with('error', "Data Input Error");

        }
    }


    function AdminCaseStudyDetails($id)
    {
        
        $casestudy = CaseStudy::where('id' , $id)->first();

        if(!empty($casestudy))
        {
            $othercasestudy = CaseStudy::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(5)->get();
            $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
            
            return view('backend.casestudy.casestudyView', [
                'casestudy'=> $casestudy,
                'othercasestudy' => $othercasestudy,
                'unreadcontact' => $unreadcontact
            ]);

        }
        else{
            return view('404NotFound');
        }
    }


    function AdminCaseStudyUpdate(Request $req)
    {
        
        $req->validate([          
            'title' => 'required',          
            'text' => 'required'
        ]);


        $casestudy = CaseStudy::find($req->casestudyID);

        if(!empty($casestudy))
        {

            if($req->hasFile('image')){

                $image= $req->file('image');
                $IMGNAME = Str::random(10).'.'. $image->getClientOriginalExtension();       
        
                $thumbnail_location = 'images/case_study/'
                . Carbon::now()->format('Y/M/')
                .'/';

                //Make Directory 
                File::makeDirectory($thumbnail_location, $mode=0777, true, true);        
                //save Image to the thumbnail path
                Image::make($image)->save(public_path($thumbnail_location.$IMGNAME));

                //Delete previous Image
                $old_img_location = public_path('images/case_study/'.$casestudy->created_at->format('Y/M/').'/'.$casestudy->image);
                if(file_exists($old_img_location)){
                   unlink($old_img_location);
                }                
                //saving the new image
                $casestudy->image = $IMGNAME;
            }
                
            $casestudy->title = $req->title;
            $casestudy->introduction = $req->introduction;
            $casestudy->text = $req->text;
            $casestudy->save();   

            $othercasestudy = CaseStudy::where('id', '!=', $casestudy->id)->orderBy('id', 'DESC')->limit(5)->get();  
            $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
              
            return view('backend.casestudy.casestudyView', [
               'casestudy'=> $casestudy,
                'othercasestudy' => $othercasestudy,
                'unreadcontact' => $unreadcontact
            ]);
        }
        else{
            return view('404NotFound');
        }    

    }


    function AdminCaseStudyDelete($id)
    {
        $casestudy = CaseStudy::find($id);

        if(!empty($casestudy))
        {
            $casestudy->delete();
            $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
            
            $caseStudies = CaseStudy::orderBy('id', 'DESC')->get();
            return view('backend.casestudy.casestudy', [
                'caseStudies'=> $caseStudies,
                'unreadcontact' => $unreadcontact
            ]);

        }
        else{
            return view('404NotFound');
        }       
    }

    function AdminCaseStudyTrash()
    {
        $casestudies = CaseStudy::onlyTrashed()->orderBy('id', 'DESC')->get();
        $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
        
        return view('backend.casestudy.casestudytrash', [
            'casestudies'=> $casestudies ,
            'unreadcontact' => $unreadcontact
        ]);
    }


    function AdminCaseStudyRestore($id)
    {
        $casestudy = CaseStudy::where('id', $id)->onlyTrashed()->first();

        if(!empty($casestudy))
        {
            $casestudy->restore();
            return redirect()->back()->with('success', "Your Case Study has been Restored!");

        }
        else{
            return view('404NotFound');
        }        
    }

    function AdminCaseStudyConfirmDelete($id)
    {
        $casestudy = CaseStudy::where('id', $id)->onlyTrashed()->first();

        if(!empty($casestudy))
        {
            //Delete previous Image
            $old_img_location = public_path('images/case_study/'.$casestudy->created_at->format('Y/M/').'/'.$casestudy->image);
            if(file_exists($old_img_location)){
               unlink($old_img_location);
            } 

            $casestudy->forceDelete();
            return redirect()->back()->with('delete', "Your Case Study has been Deleted!");

        }
        else{
            return view('404NotFound');
        }       
    }



    function ContactView($id)
    {
        $contact = Contact::where('id', $id)->first();

        if(!empty($contact))
        {
            $contact->read = 1;
            $contact->save();
            $unreadcontact = Contact::where('read', 0)->orderBy('id', 'DESC')->limit(3)->get();
            

            return view('backend.contact.contactView', [
                'contact'=>$contact,
                'unreadcontact' => $unreadcontact
            ]);

        }
        else{
            return view('404NotFound');
        }    
    }


    function ContactReply(Request $req)
    {

        $req->validate([          
            'reply' => 'required'
        ]);

        $details = [
            'reply' => $req->reply
        ];

        $contact = Contact::where('id', $req->contact_id)->first();
        $contact->reply = 1;
        // $contact->reply_content = $req->reply;
        // $contact->reply_content_date = Carbon::now();
        $contact->save();

        $email_to = $contact->email;

        

        \Mail::to($email_to)->send(new \App\Mail\ContactReply($details));

        return back();

    }

    function AdminBlogCommentReply(Request $req)
    {
        $req->validate([          
            'reply' => 'required'
        ]);

        $reply = new CommentReply;
        $reply->blog_id = $req->blog_id;
        $reply->comment_id = $req->comment_id;
        $reply->name =  Auth::user()->name;
        $reply->email = Auth::user()->email;
        $reply->reply = $req->reply;
        $reply->save();

        return back();


    }

    function AdminBlogCommentReplyEdit(Request $req)
    {
        $req->validate([          
            'reply' => 'required'
        ]);

        $reply = CommentReply::where('comment_id', $req->comment_id)->first();
        $reply->blog_id = $req->blog_id;
        $reply->comment_id = $req->comment_id;
        $reply->name =  Auth::user()->name;
        $reply->email = Auth::user()->email;
        $reply->reply = $req->reply;
        $reply->save();

        return back();
    }


    function AdminBlogCommentDelete($id)
    {
        $comment = Comment::where('id', $id)->first();

        if(!empty($comment))
        {
            $comment->delete();

            $comment_reply = CommentReply::where('comment_id', $id)->first();
            $comment_reply->delete();

            return back();

        }
        else{
            return view('404NotFound');
        }  
    }
}

