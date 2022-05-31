<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');


///////// Backend Routes //////////////
Route::post('/admin-login', 'AdminPanelController@AdminLogin')->name('AdminLogin');

//Home
Route::get('/dashboard', 'AdminPanelController@dashboard')->name('dashboard')->middleware('auth');

//AdminAppointment
Route::get('/admin-appointment', 'AdminPanelController@AdminAppointment')->name('AdminAppointment')->middleware('auth');
Route::get('/admin-appointment/view/{id}', 'AdminPanelController@AppointmentView')->name('AppointmentView')->middleware('auth');



//blog
Route::get('/admin-blog', 'AdminPanelController@AdminBlog')->name('AdminBlog')->middleware('auth');
Route::post('/admin-blog-insert', 'AdminPanelController@AdminBlogInsert')->name('AdminBlogInsert')->middleware('auth');
Route::get('/admin-blog-details/{id}', 'AdminPanelController@AdminBlogDetails')->name('AdminBlogDetails')->middleware('auth');
Route::get('/admin-blog-delete/{id}', 'AdminPanelController@AdminBlogDelete')->name('AdminBlogDelete')->middleware('auth');
Route::post('/admin-blog-update', 'AdminPanelController@AdminBlogUpdate')->name('AdminBlogUpdate')->middleware('auth');
Route::get('/admin-blog/trash', 'AdminPanelController@AdminBlogTrash')->name('AdminBlogTrash')->middleware('auth');
Route::get('/admin-blog-restore/{id}', 'AdminPanelController@AdminBlogRestore')->name('AdminBlogRestore')->middleware('auth');
Route::get('/admin-blog-confirm-delete/{id}', 'AdminPanelController@AdminBlogConfirmDelete')->name('AdminBlogConfirmDelete')->middleware('auth');
Route::get('/admin-blog-comment-off/{id}', 'AdminPanelController@AdminBlogCommentOff')->name('AdminBlogCommentOff')->middleware('auth');
Route::get('/admin-blog-comment-on/{id}', 'AdminPanelController@AdminBlogCommentOn')->name('AdminBlogCommentOn')->middleware('auth');
Route::post('/admin-blog/comment/reply', 'AdminPanelController@AdminBlogCommentReply')->name('AdminBlogCommentReply')->middleware('auth');
Route::post('/admin-blog/comment/reply/edit', 'AdminPanelController@AdminBlogCommentReplyEdit')->name('AdminBlogCommentReplyEdit')->middleware('auth');
Route::get('/admin-blog-comment/delete/{id}', 'AdminPanelController@AdminBlogCommentDelete')->name('AdminBlogCommentDelete')->middleware('auth');




//info
Route::get('/admin-info', 'AdminPanelController@AdminInfo')->name('AdminInfo')->middleware('auth');
Route::post('/admin-info/update/name', 'AdminPanelController@AdminInfoName')->name('AdminInfoName')->middleware('auth');
Route::post('/admin-info/update/phone', 'AdminPanelController@AdminInfoPhone')->name('AdminInfoPhone')->middleware('auth');
Route::post('/admin-info/update/email', 'AdminPanelController@AdminInfoEmail')->name('AdminInfoEmail')->middleware('auth');
Route::post('/admin-info/update/address', 'AdminPanelController@AdminInfoAddress')->name('AdminInfoAddress')->middleware('auth');
Route::post('/admin-info/update/about', 'AdminPanelController@AdminInfoAbout')->name('AdminInfoAbout')->middleware('auth');
Route::post('/admin-info/social/update/facebook', 'AdminPanelController@AdminInfoFacebook')->name('AdminInfoFacebook')->middleware('auth');
Route::post('/admin-info/social/update/instagram', 'AdminPanelController@AdminInfoInstagram')->name('AdminInfoInstagram')->middleware('auth');
Route::post('/admin-info/social/update/linkedin', 'AdminPanelController@AdminInfoLinkedin')->name('AdminInfoLinkedin')->middleware('auth');
Route::post('/admin-info/social/update/twitter', 'AdminPanelController@AdminInfoTwitter')->name('AdminInfoTwitter')->middleware('auth');
Route::post('/admin-info/work-experience/insert', 'AdminPanelController@AdminInfoInsertWorkExperience')->name('AdminInfoInsertWorkExperience')->middleware('auth');
Route::get('/admin-info/work/delete/{id}', 'AdminPanelController@AdminWorkDelete')->name('AdminWorkDelete')->middleware('auth');
Route::post('/admin-info/work/edit', 'AdminPanelController@AdminWorkEdit')->name('AdminWorkEdit')->middleware('auth');
Route::post('/admin-info/education/insert', 'AdminPanelController@AdminInfoInsertEducation')->name('AdminInfoInsertEducation')->middleware('auth');
Route::get('/admin-info/education/delete/{id}', 'AdminPanelController@AdminEducationDelete')->name('AdminEducationDelete')->middleware('auth');
Route::post('/admin-info/education/edit', 'AdminPanelController@AdminEducationEdit')->name('AdminEducationEdit')->middleware('auth');
Route::get('/admin-info/training/delete/{id}', 'AdminPanelController@AdminTrainingDelete')->name('AdminTrainingDelete')->middleware('auth');
Route::post('/admin-info/training/insert', 'AdminPanelController@AdminInfoInsertTraining')->name('AdminInfoInsertTraining')->middleware('auth');
Route::post('/admin-info/training/edit', 'AdminPanelController@AdminTrainingEdit')->name('AdminTrainingEdit')->middleware('auth');
Route::post('/admin-info/profile-picture', 'AdminPanelController@AdminInfoProfilePicture')->name('AdminInfoProfilePicture')->middleware('auth');

//gallery
Route::get('/admin-gallery', 'AdminPanelController@AdminGallery')->name('AdminGallery')->middleware('auth');
Route::post('/admin-gallery/insert', 'AdminPanelController@AdminGalleryInsert')->name('AdminGalleryInsert')->middleware('auth');
Route::get('/admin-gallery/{id}', 'AdminPanelController@AdminGalleryView')->name('AdminGalleryView')->middleware('auth');
Route::get('/admin-gallery/image-delete/{id}', 'AdminPanelController@AdminGallerySingleImageDelete')->name('AdminGallerySingleImageDelete')->middleware('auth');
Route::post('/admin-gallery/more/insert', 'AdminPanelController@AdminGalleryMoreInsert')->name('AdminGalleryMoreInsert')->middleware('auth');
Route::get('/admin-gallery/delete/{id}', 'AdminPanelController@AdminGalleryDelete')->name('AdminGalleryDelete')->middleware('auth');
Route::post('/admin-gallery/edit', 'AdminPanelController@AdminGalleryEdit')->name('AdminGalleryEdit')->middleware('auth');

//SitePassword
Route::post('/admin-info/site', 'AdminPanelController@AdminSiteInsert')->name('AdminSiteInsert')->middleware('auth');
Route::get('/admin-info/password-info/{id}', 'AdminPanelController@AdminSiteMail')->name('AdminSiteMail')->middleware('auth');
Route::post('/admin-info/password-info/otp/', 'AdminPanelController@AdminSendOTP')->name('AdminSendOTP')->middleware('auth');
Route::post('/admin-info/password-info/otp/confirm', 'AdminPanelController@AdminOTPConfirm')->name('AdminOTPConfirm')->middleware('auth');
Route::get('/admin-info/password-info/delete/{id}', 'AdminPanelController@AdminSiteDelete')->name('AdminSiteDelete')->middleware('auth');
Route::post('/admin-info/password-info/update', 'AdminPanelController@AdminSiteUpdate')->name('AdminSiteUpdate')->middleware('auth');

//CaseStudy
Route::get('/admin-case-study', 'AdminPanelController@AdminCaseStudy')->name('AdminCaseStudy')->middleware('auth');
Route::post('/admin-case-study/insert', 'AdminPanelController@AdminCaseStudyInsert')->name('AdminCaseStudyInsert')->middleware('auth');
Route::get('/admin-case-study-details/{id}', 'AdminPanelController@AdminCaseStudyDetails')->name('AdminCaseStudyDetails')->middleware('auth');
Route::post('/admin-case-study/update', 'AdminPanelController@AdminCaseStudyUpdate')->name('AdminCaseStudyUpdate')->middleware('auth');
Route::get('/admin-case-study-delete/{id}', 'AdminPanelController@AdminCaseStudyDelete')->name('AdminCaseStudyDelete')->middleware('auth');
Route::get('/admin-case-study/trash', 'AdminPanelController@AdminCaseStudyTrash')->name('AdminCaseStudyTrash')->middleware('auth');
Route::get('/admin-case-study-restore/{id}', 'AdminPanelController@AdminCaseStudyRestore')->name('AdminCaseStudyRestore')->middleware('auth');
Route::get('/admin-case-study-confirm-delete/{id}', 'AdminPanelController@AdminCaseStudyConfirmDelete')->name('AdminCaseStudyConfirmDelete')->middleware('auth');

//Contact
Route::get('/admin-contact/{id}', 'AdminPanelController@ContactView')->name('ContactView')->middleware('auth');
Route::post('/admin-contact/reply', 'AdminPanelController@ContactReply')->name('ContactReply')->middleware('auth');



///////// Fontend Routes //////////////
Route::get('/', 'FrontController@index')->name('front');
Route::get('/appointment', 'FrontController@appointment')->name('appointment');
Route::post('/appointment/book', 'FrontController@make_appointment')->name('make_appointment');


// Route::post('/contact/submit', 'FrontController@contact')->name('contact');

// Route::get('/case-study', 'FrontController@CaseStudy')->name('CaseStudy');
// Route::get('/case-study/{id}', 'FrontController@CaseStudyDetails')->name('CaseStudyDetails');

// Route::get('/blog', 'FrontController@Blog')->name('Blog');
// Route::get('/blog/{id}', 'FrontController@BlogDetails')->name('BlogDetails');

// Route::get('/gallery', 'FrontController@Gallery')->name('Gallery');
// Route::get('/gallery/{id}', 'FrontController@GalleryDetails')->name('GalleryDetails');

// Route::post('/blog/comment', 'FrontController@BlogComment')->name('BlogComment');

