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


class FrontController extends Controller
{

    function make_appointment(Request $req)
    {
        $req->validate([          
            'email' => 'required|email',          
            'name' => 'required',
            'appointment_date' => 'required',
            'phone' => 'required'
        ]);

        $appointment = new Appointment;
        $appointment->appointment_date = $req->appointment_date;
        $appointment->name = $req->name;
        $appointment->email = $req->email;
        $appointment->phone = $req->phone;
        $appointment->subject = $req->subject;
        $appointment->summary = $req->summary;
        $appointment->save();

        return back()->with('success', 'Our Representative will contact you soon!');
    }

    function appointment()
    {
        return view('frontend.appointment.get_appointment');
    }

    function index()
    {
        $user = User::select('name','address','phone','email','about')->where('id', 1)->first() ;
        $education = Education::orderBy('id', 'DESC')->get();
        $work = WorkExperience::orderBy('id', 'DESC')->get();
        $training = Training::orderBy('id', 'DESC')->get();
        $gallery = Gallery::orderBy('id', 'DESC')->limit(6)->get();
        $casestudy = CaseStudy::orderBy('id', 'DESC')->limit(3)->get();
        $blog = Blog::orderBy('id', 'DESC')->limit(3)->get();
        $socialmedia = SocialMedia::where('id', 1)->first();
        return view('frontend.home.index', [
            'user' => $user,
            'education' => $education,
            'work' => $work,
            'training' => $training,
            'gallery' => $gallery,
            'casestudy'=>$casestudy,
            'blog' => $blog,
            'socialmedia' => $socialmedia

        ]);
    }


    function contact(Request $data)
    {
        $contact = new Contact;
        $contact->name = $data->name;
        $contact->email = $data->email;
        $contact->subject = $data->subject;
        $contact->message = $data->message;
       
        $contact->save();

    }


    function CaseStudy()
    {
        $casestudy = CaseStudy::orderBy('id', 'DESC')->get();
        
        $user = User::select('name','address','phone','email','about')->where('id', 1)->first() ;
        $socialmedia = SocialMedia::where('id', 1)->first();

        return view('frontend.casestudy.casestudy', [
            'casestudy' => $casestudy,
            'user' => $user,
            'socialmedia' => $socialmedia
        ]);
    }


    function CaseStudyDetails($id)
    {
        $casestudy = CaseStudy::where('id', $id)->first();

        $user = User::select('name','address','phone','email','about')->where('id', 1)->first() ;
        $socialmedia = SocialMedia::where('id', 1)->first();


        if(!empty($casestudy))
        {

            $othercasestudy = CaseStudy::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(5)->get();

            return view('frontend.casestudy.casestudyView', [
                'casestudy'=> $casestudy,
                'othercasestudy' => $othercasestudy,
                'user' => $user,
                'socialmedia' => $socialmedia
            ]);

        }
        else{
            return view('404NotFound');
        }
    }


    function Blog()
    {
        $blog = Blog::orderBy('id', 'DESC')->get();
        
        $user = User::select('name','address','phone','email','about')->where('id', 1)->first() ;
        $socialmedia = SocialMedia::where('id', 1)->first();

        return view('frontend.blog.blog', [
            'blog' => $blog,
            'user' => $user,
            'socialmedia' => $socialmedia
        ]);
    }


    function BlogDetails($id)
    {
        $blog = Blog::where('id', $id)->first();

        $user = User::select('name','address','phone','email','about')->where('id', 1)->first() ;
        $socialmedia = SocialMedia::where('id', 1)->first();
        $blog_comments = Comment::where('blog_id', $id)->orderBy('id', 'DESC')->get();

        if(!empty($blog))
        {

            $otherblog = Blog::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(5)->get();

            return view('frontend.blog.blogView', [
                'blog'=> $blog,
                'otherblog' => $otherblog,
                'user' => $user,
                'socialmedia' => $socialmedia,
                'blog_comments' => $blog_comments
            ]);

        }
        else{
            return view('404NotFound');
        }
    }


    function Gallery()
    {
        $gallery = Gallery::orderBy('id', 'DESC')->get();
        
        $user = User::select('name','address','phone','email','about')->where('id', 1)->first() ;
        $socialmedia = SocialMedia::where('id', 1)->first();

        return view('frontend.gallery.gallery', [
            'gallery' => $gallery,
            'user' => $user,
            'socialmedia' => $socialmedia
        ]);
    }


    function GalleryDetails($id)
    {
        $gallery = Gallery::where('id', $id)->first();
       
        $user = User::select('name','address','phone','email','about')->where('id', 1)->first() ;
        $socialmedia = SocialMedia::where('id', 1)->first();


        if(!empty($gallery))
        {
            $galleryImg = GalleryImages::where('gallery_id', $id)->get();

            $othergallery = Gallery::where('id', '!=', $id)->orderBy('id', 'DESC')->limit(5)->get();

            return view('frontend.gallery.galleryView', [
                'gallery'=> $gallery,
                'galleryImg' => $galleryImg,
                'othergallery' => $othergallery,
                'user' => $user,
                'socialmedia' => $socialmedia
            ]);

        }
        else{
            return view('404NotFound');
        }
    }

    function BlogComment(Request $req)
    {
        $blog_id = $req->blog_id;

        $comment = new Comment;
        $comment->blog_id = $blog_id;
        $comment->name = $req->name;
        $comment->email = $req->email;
        $comment->website = $req->website;
        $comment->message = $req->message;
        $comment->save();

        return back();


    }

    
}
