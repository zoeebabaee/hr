<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use HR\CurlImpersonated;





/**
 * Mahdavi Kia
 * 1397/11/13
 */
// Route::get('/mkia_get_master_cities','ApiController@mkia_get_master_cities');


/**
 * User Registration
 */
 
 Route::get('zoeeeeeeeeee', function () {
    $token = "";
    $base_url = "";
});
 
Route::get('/reportticket','ReportTicketController@dd')->name('reportticket');
Route::get('/register','registerationController@create')->name('register');
Route::get('/user/confirm-mobile','registerationController@confirm_mobile_get')->name('register.confirm.mobile');
Route::post('/user/confirm-mobile','registerationController@confirm_mobile_post')->name('register.confirm.mobile.post');
Route::post('/user/confirm-mobile/change-mobile','registerationController@change_mobile_in_confirm_mobile')
    ->name('register.confirm.mobile.change.mobile.post');
Route::get('/user/confirm-email/{key}','registerationController@confirm_email')->name('register.confirm.email');

Route::post('/register','registerationController@store')->name('register.store');

Route::get('/user/forget_password','registerationController@forget_password')->name('user.forget.password');
Route::post('/user/forget_password/post','registerationController@forget_password_post')->name('user.forget.password.post');
Route::get('/user/forget_password/verify-mobile/{mobile}','registerationController@forget_password_verify_mobile')->name('user.forget.confirm.mobile');
Route::post('/user/forget_password/verify-mobile/post/{mobile}','registerationController@forget_password_verify_mobile_post')->name('user.forget.confirm.mobile.post');
/**
 * User Login
 */
Route::get('/login','sessionsController@create')->name('login');
Route::post('/login','sessionsController@store')->name('login.store');
Route::post('/login/modal','sessionsController@store_modal')->name('login.store.modal');
Route::get('/logout','sessionsController@destroy')->name('logout');
Route::post('/user/resend/{user}','sessionsController@resend_sms')->name('resend.sms')->middleware('isAdmin');
Route::post('/login/as/{user}','sessionsController@loginAs')->name('admin.login.as')->middleware('isAdmin');
Route::get('/login/as/return','sessionsController@returnToAdmin')->name('admin.login.as.return')->middleware('auth');
Route::get('/cv/{id?}/show.pdf','ApiController@apiGetUploadedCv')->name('api.show.uploaded.resume');
Route::get('/cv/show.pdf/{national_code?}/{token?}','ApiController@apiGetOnlineCv')->name('api.get.online.cv');

Route::get('/resumes/{id}/{token?}/show','resumeController@apiShowResume')->name('api.resumes.show');





Route::prefix('adpanel')->group(
    function (){
        /**
         * Admin Panel
         */
         
        Route::post('/support-tickets/store','SupportTicketController@storeTicket');
        Route::post('/support-tickets/store_reply','SupportTicketController@storeTicketReply')->name('support_ticket_replies.store');
        Route::get('/support-tickets/show/{ticket_id}','SupportTicketController@show')->name('support.tickets.show');

        Route::get('/testmwebservice','ApiController@testmwebservice');
        Route::get('/update-bi-data', 'UpdateUserDataController@index')->name('update_users_bi');
        Route::get('/update-email', 'UpdateUserEmailController@index')->name('update_usersemail');
        Route::post('/extend-specific-day', 'JobController@extendSpecificDay')->name('extend-specific-day');
        Route::get('/jobs/{id}/show-non-automatic-extend', 'JobController@showNonAutomaticExtend')->name('jobs.show-non-automatic-extend');
        
        Route::get('/update-job-persian-alias', 'UpdatePersianAliasController@index')->name('update_job_persian_alias');


        Route::get('/checkblack','BlacklistController@index');
        Route::get('/zoeezoee','BlacklistController@zoee');
        Route::get('/check_myself_code','BlacklistController@check_myself_code');

        Route::get('/deactive','BlacklistController@deactive');
        Route::get('/new_table','BlacklistController@new_table');
        
        Route::get('/personnelapi/addprovince','personnelapi\ProvinceController@addProvince');
        Route::get('/personnelapi/addallcity','personnelapi\CityController@addAllCity');
        Route::get('/personnelapi/addcompanies','personnelapi\CompanyController@addCompanies');
        Route::get('/personnelapi/addmasterid','personnelapi\CompanyController@addMasterId');
        Route::get('/personnelapi/adddegree','personnelapi\DegreeController@addDegree');
        Route::get('/personnelapi/addfieldtype','personnelapi\FieldTypeController@addFieldType');
        Route::get('/personnelapi/addallfields','personnelapi\FieldController@addAllFields');
        Route::get('/personnelapi/addorientation','personnelapi\FieldOrientationController@addOrientation');
        Route::get('/personnelapi/add_institute_type','personnelapi\InstituteTypeController@addInstituteType');
        Route::get('/personnelapi/add_institute_place','personnelapi\InstitutePlaceController@addInstitutePlace');
        
        Route::get('/personnelapi/check_additional_institute','personnelapi\InstitutePlaceController@check_additional_institute');
        
        Route::get('/personnelapi/update_lang','personnelapi\LanguagesController@update_lang');
        Route::get('/personnelapi/seve_gender_relation','personnelapi\RelationGenderController@saveRelationGender');


        Route::get('/', 'adminHomeController@index')->name('adpanel');


        Route::resource('worker-list','WorkerListController');

        /**
         * Roles CRUD
         */
        Route::post('/roles','RoleController@store')->name('roles.store');
        Route::get('/roles','RoleController@index')->name('roles.index');
        Route::get('/roles/create','RoleController@create')->name('roles.create');
        Route::delete('/roles/{roles}','RoleController@destroy')->name('roles.destroy');
        Route::put('/roles/{roles}','RoleController@update')->name('roles.update');
        Route::get('/roles/{roles}/edit','RoleController@edit')->name('roles.edit');

        Route::get('/resumes','resumeController@index')->name('resumes.index');
        Route::get('/resumes/{resume}/show','resumeController@show')->name('resumes.show');
        Route::get('/resumes/{resume}/show2','resumeController@show2')->name('resumes.show2');

        Route::get('/cv/{id?}/show.pdf','SiteUserController@get_cv')->name('cv.show');

        /**
         * Permissions CRUD
         */
        Route::post('/permissions','PermissionController@store')->name('permissions.store');
        Route::get('/permissions','PermissionController@index')->name('permissions.index');
        Route::get('/permissions/create','PermissionController@create')->name('permissions.create');
        Route::delete('/permissions/{permission}','PermissionController@destroy')->name('permissions.destroy');
        Route::put('/permissions/{permission}','PermissionController@update')->name('permissions.update');
        Route::get('/permissions/{permission}/edit','PermissionController@edit')->name('permissions.edit');
        /**
         * Users CRUD
         */
        Route::post('/users','UserController@store')->name('users.store');
        Route::get('/users','UserController@index')->name('users.index');
/*        Route::get('/zoee_search','UserController@zoee_search')->name('users.zoee_search');*/
        Route::get('/users-replies/{user_id}','UserController@apply_list')->name('users.apply_list');
        Route::get('/users/export-csv','UserController@have_resume_export_csv')->name('users.export_csv');
        Route::get('/users/export-csv-no-resume','UserController@not_have_resume_export_csv')->name('users.export_csv_no_resume');
        Route::get('/useresumesrs/export-admins-csv','UserController@export_admins_csv')->name('users.export_admins_csv');
        Route::get('/users/export-companies-activity','UserController@export_companies_activity')->name('users.export_companies_activity');
        Route::get('/users/export-companies-activity-all','UserController@export_companies_activity_all')->name('users.export_companies_activity_all');
        //Route::get('/users/create','UserController@create')->name('users.create');
        Route::delete('/users/{user}','UserController@destroy')->name('users.destroy');
        Route::put('/users/{user}/confirm_email','UserController@confirm_email')->name('users.confirm_email');
        Route::put('/users/{user}/confirm_mobile','UserController@confirm_mobile')->name('users.confirm_mobile');
        Route::put('/users/{user}','UserController@update')->name('users.update');
        Route::get('/users/{user}/edit','UserController@edit')->name('users.edit');
        //Route::get('users/{user}/pic','UserController@getPic')->name('users.avatar');
        Route::get('/users/search','UserController@Search')->name('users.search');
        Route::get('/users/blacklist','UserController@Blacklist')->name('users.blacklist');
        Route::get('/users/export-blacklist','UserController@export_blacklist')->name('users.export_blacklist');


        /**
         * ContentCategory CRUD
         */
        Route::get('/content-categories','ContentCategoryController@index')->name('content_categories.index');
        Route::post('/content-categories','ContentCategoryController@store')->name('content_categories.store');
        Route::delete('/content-categories/{contentCategories}','ContentCategoryController@destroy')->name('content_categories.destroy');
        Route::post('/content-categories/{contentCategories}','ContentCategoryController@restore')->name('content_categories.restore');
        Route::get('/content-categories/create','ContentCategoryController@create')->name('content_categories.create');
        Route::put('/content-categories/{contentCategories}','ContentCategoryController@update')->name('content_categories.update');
        Route::get('/content-categories/{contentCategories}/edit','ContentCategoryController@edit')->name('content_categories.edit');
        Route::get('/content-categories/search','ContentCategoryController@Search')->name('content_categories.search');
//Route::get('content-categories/{contentCategories}/pic','ContentCategoryController@getPic')->name('content_categories.avatar');

        /**
         * TimeLine CRUD
         */
        Route::get('/time-line/{ref}','TimeLineController@index')->name('timeLine.index');
        Route::post('/time-line','TimeLineController@store')->name('timeLine.store');
        Route::delete('/time-line/{id}','TimeLineController@destroy')->name('timeLine.destroy');
        Route::get('/time-line/create/new','TimeLineController@create')->name('timeLine.create');
        Route::put('/time-line/{id}','TimeLineController@update')->name('timeLine.update');
        Route::get('/time-line/{id}/edit','TimeLineController@edit')->name('timeLine.edit');

        /**
         * Gallery CRUD
         */
        Route::get('/gallery','GalleryController@index')->name('gallery.index');
        Route::post('/gallery','GalleryController@store')->name('gallery.store');
        Route::delete('/gallery/{id}','GalleryController@destroy')->name('gallery.destroy');
        Route::get('/gallery/create','GalleryController@create')->name('gallery.create');
        Route::put('/gallery/{id}','GalleryController@update')->name('gallery.update');
        Route::get('/gallery/{id}/edit','GalleryController@edit')->name('gallery.edit');
        Route::post('/gallery/{gallery}/accept','GalleryController@accept')->name('gallery.accept');
        Route::post('/gallery/{gallery}/reject','GalleryController@reject')->name('gallery.reject');

        /**
         * GalleryCategory CRUD
         */
        Route::get('/gallery-category','GalleryCategoryController@index')->name('galleryCategory.index');
        Route::post('/gallery-category','GalleryCategoryController@store')->name('galleryCategory.store');
        Route::delete('/gallery-category/{id}','GalleryCategoryController@destroy')->name('galleryCategory.destroy');
        Route::get('/gallery-category/create','GalleryCategoryController@create')->name('galleryCategory.create');
        Route::put('/gallery-category/{id}','GalleryCategoryController@update')->name('galleryCategory.update');
        Route::get('/gallery-category/{id}/edit','GalleryCategoryController@edit')->name('galleryCategory.edit');


        /**
         * Videos CRUD
         */
        Route::get('/videos','VideosController@index')->name('videos.index');
        Route::post('/videos','VideosController@store')->name('videos.store');
        Route::delete('/videos/{id}','VideosController@destroy')->name('videos.destroy');
        Route::get('/videos/create','VideosController@create')->name('videos.create');
        Route::put('/videos/{id}','VideosController@update')->name('videos.update');
        Route::get('/videos/{id}/edit','VideosController@edit')->name('videos.edit');

        /**
         * VideoCategory CRUD
         */
        Route::get('/video-gallery','VideoGalleryController@index')->name('video_gallery.index');
        Route::post('/video-gallery','VideoGalleryController@store')->name('video_gallery.store');
        Route::delete('/video-gallery/{id}','VideoGalleryController@destroy')->name('video_gallery.destroy');
        Route::get('/video-gallery/create','VideoGalleryController@create')->name('video_gallery.create');
        Route::put('/video-gallery/{id}','VideoGalleryController@update')->name('video_gallery.update');
        Route::get('/video-gallery/{id}/edit','VideoGalleryController@edit')->name('video_gallery.edit');
        /**
         * Books CRUD
         */
        Route::get('/books','BookIntroductionController@index')->name('books.index');
        Route::post('/books','BookIntroductionController@store')->name('books.store');
        Route::delete('/books/{id}','BookIntroductionController@destroy')->name('books.destroy');
        Route::get('/books/create','BookIntroductionController@create')->name('books.create');
        Route::put('/books/{id}','BookIntroductionController@update')->name('books.update');
        Route::get('books/{id}/edit','BookIntroductionController@edit')->name('books.edit');

        /**
         * Company CRUD
         */
        Route::get('/companies','CompanyController@index')
            ->name('companies.index');

        Route::post('/companies','CompanyController@store')
            ->name('companies.store');

        Route::delete('/companies/{id}','CompanyController@destroy')
            ->name('companies.destroy');

        Route::get('/companies/create','CompanyController@create')
            ->name('companies.create');

        Route::put('/companies/{id}','CompanyController@update')
            ->name('companies.update');

        Route::get('companies/{id}/edit','CompanyController@edit')
            ->name('companies.edit');

        Route::get('companies/export','CompanyController@export')
            ->name('companies.export');

        Route::get('/others-say','OthersSayController@index')->name('OthersSay.index');
        Route::post('/others-say','OthersSayController@store')->name('OthersSay.store');
        Route::delete('/others-say/{id}','OthersSayController@destroy')->name('OthersSay.destroy');
        Route::get('/others-say/create','OthersSayController@create')->name('OthersSay.create');
        Route::put('/others-say/{id}','OthersSayController@update')->name('OthersSay.update');
        Route::get('others-say/{id}/edit','OthersSayController@edit')->name('OthersSay.edit');
    
        Route::get('/faqs','FaqController@index')->name('faqs.index');
        Route::post('/faqs','FaqController@store')->name('faqs.store');
        Route::delete('/faqs/{id}','FaqController@destroy')->name('faqs.destroy');
        Route::get('/faqs/create','FaqController@create')->name('faqs.create');
        Route::put('/faqs/{id}','FaqController@update')->name('faqs.update');
        Route::get('faqs/{id}/edit','FaqController@edit')->name('faqs.edit');
        Route::post('/faqs/{id}/accept','FaqController@accept')->name('faqs.accept');
        Route::post('/faqs/{id}/reject','FaqController@reject')->name('faqs.reject');

        /**
         * Content CRUD
         */
        Route::get('/contents','ContentController@index')->name('contents.index');
        Route::post('/contents','ContentController@store')->name('contents.store');
        Route::delete('/contents/{contents}','ContentController@destroy')->name('contents.destroy');
        Route::post('/contents/{contents}','ContentController@restore')->name('contents.restore');
        Route::post('/contents/{contents}/pin','ContentController@pin')->name('contents.pin');
        Route::post('/contents/{contents}/unpin','ContentController@unpin')->name('contents.unpin');
        Route::get('/contents/create','ContentController@create')->name('contents.create');
        Route::put('/contents/{contents}','ContentController@update')->name('contents.update');
        Route::get('/contents/{contents}/edit','ContentController@edit')->name('contents.edit');
        Route::get('/contents/search','ContentController@Search')->name('contents.search');
        Route::post('/contents/{contents}/accept','ContentController@accept')->name('contents.accept');
        Route::post('/contents/{id}/reject','ContentController@reject')->name('contents.reject');


        /**
         * Settings update
         */
        Route::get('/first-content','Setting\FirstContentController@edit')->name('first-content.edit');
        Route::put('/first-content','Setting\FirstContentController@update')->name('first-content.update');

        Route::get('/absorption-process','Setting\AbsorptionProcessController@edit')->name('absorption-process.edit');
        Route::put('/absorption-process','Setting\AbsorptionProcessController@update')->name('absorption-process.update');

        Route::get('/setting/first-page-slider','Setting\FirstPageSliderController@edit')->name('first-page-slider.edit');
        Route::put('/setting/first-page-slider','Setting\FirstPageSliderController@update')->name('first-page-slider.update');

        Route::get('/setting/first-page-footer','Setting\FirstPageFooterController@edit')->name('first-page-footer.edit');
        Route::put('/setting/first-page-footer','Setting\FirstPageFooterController@update')->name('first-page-footer.update');

        Route::get('/setting/global-footer','Setting\GlobalFooterController@edit')->name('global-footer.edit');
        Route::put('/setting/global-footer','Setting\GlobalFooterController@update')->name('global-footer.update');

        Route::get('/setting/about-usr','Setting\AboutUsController@edit')->name('aboutUsText.edit');
        Route::put('/setting/about-us','Setting\AboutUsController@update')->name('aboutUsText.update');

        /**
         * Comments CRUD
         */
          // Route::get('/support-tickets','SupportTicketController@index')->name('support.tickets.show');
        Route::get('/ticket-related-admin','SupportTicketController@adminTickets')->name('admin.tickets.show');
        Route::get('/ticket-related-technical','SupportTicketController@technicalTickets')->name('technical.tickets.show');
        Route::get('/ticket-related-defect','SupportTicketController@defectTickets')->name('defect.tickets.show');
                Route::get('/ticket-related-suggestion','SupportTicketController@suggestionTickets')->name('suggestion.tickets.show');

        
         
        Route::get('/comments','ContentCommentController@index')->name('comments.index');
        Route::delete('/comments/{contents}','ContentCommentController@destroy')->name('comments.destroy');
        Route::post('/comments/{contents}/accept','ContentCommentController@accept')->name('comments.accept');
        Route::post('/comments/{contents}/reject','ContentCommentController@reject')->name('comments.reject');
        Route::get('/comments/search','ContentCommentController@Search')->name('comments.search');
        Route::post('/comments/{comments}','ContentCommentController@restore')->name('comments.restore');


        /**
         * Messages CRUD
         */
        Route::get('/messages/inbox','MessageController@inbox')->name('messages.inbox');
        Route::get('/messages/sent','MessageController@sent')->name('messages.sent');
        Route::get('/messages/trash','MessageController@trash')->name('messages.trash');
        Route::get('/messages/{message}/show','MessageController@show')->name('messages.show');
        Route::get('/messages/compose/{user_id}/{ref}/{id}','MessageController@compose')->name('messages.compose');
        Route::post('/messages/send-to-comapny/{jobId}','MessageController@company_msg')->name('messages.company');
        Route::get('/messages/{message}/reply','MessageController@reply')->name('messages.reply');
        Route::post('/messages','MessageController@store')->name('messages.store');
        Route::delete('/messages/{message}','MessageController@destroy')->name('messages.destroy');
        Route::get('/messages/search','MessageController@Search')->name('messages.search');
        Route::post('/messages/{message}','MessageController@restore')->name('messages.restore');

        /**
         * Tags CRUD
         */
        Route::get('/tags','TagController@index')->name('tags.index');
        Route::post('/tags','TagController@store')->name('tags.store');
        Route::delete('/tags/{tags}','TagController@destroy')->name('tags.destroy');
        Route::get('/tags/create','TagController@create')->name('tags.create');
        Route::put('/tags/{tags}','TagController@update')->name('tags.update');
        Route::get('/tags/{tags}/edit','TagController@edit')->name('tags.edit');
        Route::get('/tags/search','TagController@Search')->name('tags.search');


        /**
         * User Comments Crud
         */
        Route::get('/user-comments/create/{apply_id}','UserCommentController@create')->name('UserComment.create');
        Route::post('/user-comments/store','UserCommentController@store')->name('UserComment.store');
        Route::get('/user-comments/index/{user_id}','UserCommentController@index')->name('UserComment.index');

        /**
         *  Departments
         */
        Route::get('/departments','JobDepartmentController@index')->name('departments.index');
        Route::post('/departments','JobDepartmentController@store')->name('departments.store');
        Route::delete('/departments/{departments}','JobDepartmentController@destroy')->name('departments.destroy');
        Route::get('/departments/departments','JobDepartmentController@create')->name('departments.create');
        Route::put('/departments/{departments}','JobDepartmentController@update')->name('departments.update');
        Route::get('/departments/{departments}/edit','JobDepartmentController@edit')->name('departments.edit');
        Route::get('/departments/search','JobDepartmentController@Search')->name('departments.search');
        Route::post('/departments/{department}','JobDepartmentController@restore')->name('departments.restore');


        /**
         *  industry
         */
        Route::get('/industries','IndustryController@index')->name('industries.index');
        Route::post('/industries','IndustryController@store')->name('industries.store');
        Route::delete('/industries/{industry}','IndustryController@destroy')->name('industries.destroy');
        Route::get('/industries/industries','IndustryController@create')->name('industries.create');
        Route::put('/industries/{industry}','IndustryController@update')->name('industries.update');
        Route::get('/industries/{industry}/edit','IndustryController@edit')->name('industries.edit');
        Route::get('/industries/search','IndustryController@Search')->name('industries.search');
        Route::post('/industries/{industry}','IndustryController@restore')->name('industries.restore');

        /**
         *  reject_reasons
         */
        Route::get('/reject-reasons','RejectReasonsController@index')->name('reject_reasons.index');
        Route::post('/reject-reasons','RejectReasonsController@store')->name('reject_reasons.store');
        Route::delete('/reject-reasons/{reason}','RejectReasonsController@destroy')->name('reject_reasons.destroy');
        Route::get('/reject-reasons/create','RejectReasonsController@create')->name('reject_reasons.create');
        Route::put('/reject-reasons/{reason}','RejectReasonsController@update')->name('reject_reasons.update');
        Route::get('/reject-reasons/{reason}/edit','RejectReasonsController@edit')->name('reject_reasons.edit');

        /**
         *  JOB POST
         */
        Route::get('/job-posts','JobPostController@index')->name('jobPosts.index');
        Route::post('/job-posts','JobPostController@store')->name('jobPosts.store');
        Route::delete('/job-posts/{jobPost}','JobPostController@destroy')->name('jobPosts.destroy');
        Route::get('/job-posts/jobPost','JobPostController@create')->name('jobPosts.create');
        Route::put('/job-posts/{jobPost}','JobPostController@update')->name('jobPosts.update');
        Route::get('/job-posts/{jobPost}/edit','JobPostController@edit')->name('jobPosts.edit');
        Route::get('/job-posts/search','JobPostController@Search')->name('jobPosts.search');
        Route::post('/job-posts/{jobPost}','JobPostController@restore')->name('jobPosts.restore');

        /**
         *  organizationalCategory
         */
        Route::get('/organizational-categories','JobOrganizationalCategoryController@index')
            ->name('organizationalCategories.index');

        Route::post('/organizational-categories','JobOrganizationalCategoryController@store')
            ->name('organizationalCategories.store');

        Route::delete('/organizational-categories/{industry}','JobOrganizationalCategoryController@destroy')
            ->name('organizationalCategories.destroy');

        Route::get('/organizational-categories/industries','JobOrganizationalCategoryController@create')
            ->name('organizationalCategories.create');

        Route::put('/organizational-categories/{industry}','JobOrganizationalCategoryController@update')
            ->name('organizationalCategories.update');

        Route::get('/organizational-categories/{industry}/edit','JobOrganizationalCategoryController@edit')
            ->name('organizationalCategories.edit');

        Route::get('/organizational-categories/search','JobOrganizationalCategoryController@Search')
            ->name('organizationalCategories.search');

        Route::post('/organizational-categories/{industry}','JobOrganizationalCategoryController@restore')
            ->name('organizationalCategories.restore');

        /**
         *  generalMerites
         */
        Route::get('/general-merites','JobGeneralMeritesController@index')
            ->name('generalMerites.index');
        Route::get('/general-merites/export','JobGeneralMeritesController@export')
            ->name('generalMerites.export');

        Route::post('/general-merites','JobGeneralMeritesController@store')
            ->name('generalMerites.store');
    
        Route::post('/general-merites/replace/{id}','JobGeneralMeritesController@replace')
            ->name('generalMerites.replace');
        
        Route::delete('/general-merites/{generalMerites}','JobGeneralMeritesController@destroy')
            ->name('generalMerites.destroy');

        Route::get('/general-merites/generalmerites','JobGeneralMeritesController@create')
            ->name('generalMerites.create');

        Route::put('/general-merites/{generalMerites}','JobGeneralMeritesController@update')
            ->name('generalMerites.update');

        Route::get('/general-merites/{generalMerites}/edit','JobGeneralMeritesController@edit')
            ->name('generalMerites.edit');

        Route::get('/general-merites/search','JobGeneralMeritesController@Search')
            ->name('generalMerites.search');

        Route::post('/general-merites/{generalMerites}','JobGeneralMeritesController@restore')
            ->name('generalMerites.restore');

        /**
         *  professionalMerites
         */
        Route::get('/professional-merites','JobProfessionalMeritesController@index')
            ->name('professionalMerites.index');

        Route::post('/professional-merites/batchdelete','JobProfessionalMeritesController@batchdelete')
            ->name('professionalMerites.batchdelete');

        Route::get('/professional-merites/export','JobProfessionalMeritesController@export')
            ->name('professionalMerites.export');

        Route::post('/professional-merites','JobProfessionalMeritesController@store')
            ->name('professionalMerites.store');
    
        Route::post('/professional-merites/replace/{id}','JobProfessionalMeritesController@replace')
            ->name('professionalMerites.replace');

        Route::delete('/professional-merites/{professionalMerites}','JobProfessionalMeritesController@destroy')
            ->name('professionalMerites.destroy');

        Route::get('/professional-merites/generalmerites','JobProfessionalMeritesController@create')
            ->name('professionalMerites.create');

        Route::put('/professional-merites/{professionalMerites}','JobProfessionalMeritesController@update')
            ->name('professionalMerites.update');

        Route::get('/professional-merites/{professionalMerites}/edit','JobProfessionalMeritesController@edit')
            ->name('professionalMerites.edit');

        Route::get('/professional-merites/search','JobProfessionalMeritesController@Search')
            ->name('professionalMerites.search');

        Route::post('/professional-merites/{professionalMerites}','JobProfessionalMeritesController@restore')
            ->name('professionalMerites.restore');

        /**
         * Jobs CRUD
         */
        Route::get('/reminder_email','JobController@reminder_email')->name('jobs.reminder_email');
        Route::get('/jobs','JobController@index')->name('jobs.index');
        Route::post('/jobs','JobController@store')->name('jobs.store');
        Route::delete('/jobs/{jobs}','JobController@destroy')->name('jobs.destroy');
        Route::get('/jobs/export-csv','JobController@export_csv')->name('jobs.export_csv');
        Route::post('/jobs/{jobs}','JobController@restore')->name('jobs.restore');
        Route::post('/jobs/{jobs}/pin','JobController@pin')->name('jobs.pin');
        Route::post('/jobs/{jobs}/unpin','JobController@unpin')->name('jobs.unpin');
        Route::get('/jobs/create','JobController@create')->name('jobs.create');
        Route::get('/jobs/company-organization/{id?}','JobController@companyOrganization')->name('jobs.organization');
        Route::get('/jobs/organization-post/{company_id?}/{unit_id?}','JobController@organizationPost')->name('jobs.post');
        Route::get('/jobs/get-field/{id?}','JobController@getField')->name('jobs.getField');
        //Route::get('/jobs/get-oriented/{id?}','JobController@getOrientation')->name('jobs.getOrientation');
        Route::get('/jobs/load-inactive-company-department','JobController@loadInactiveCompanyDepartment')->name('jobs.loadInactiveCompanyDepartment');
        Route::get('/jobs/get-inactive-company-merits','JobController@getInactiveCompanyMerits')->name('jobs.getInactiveCompanyMerits');
        Route::get('/jobs/get-active-company-merits/{company_id?}/{post_id?}','JobController@getActiveCompanyMerits')->name('jobs.getActiveCompanyMerits');
        Route::put('/jobs/{jobs}','JobController@update')->name('jobs.update');
        Route::get('/jobs/{jobs}/edit','JobController@edit')->name('jobs.edit');
        Route::get('/jobs/search','JobController@Search')->name('jobs.search');
        Route::post('/jobs/{jobs}/accept','JobController@accept')->name('jobs.accept');
        Route::post('/jobs/{jobs}/accept-without-release','JobController@acceptWithouotRelease')->name('jobs.acceptwithoutrelease');
        Route::post('/jobs/{jobs}/reject','JobController@reject')->name('jobs.reject');
        Route::get('/jobs/get/cities','JobController@GetCities')->name('jobs.get.cities');
        Route::post('/jobs/sort-order/update','JobController@update_sort_order')->name('jobs.update.sort_order');

        Route::get('/jobs/{id}/archive', 'JobController@archive_job')->name('jobs.archive');
        Route::get('/jobs/{id}/copy', 'JobController@copy')->name('jobs.copy');
        Route::get('/jobs/{id}/extend', 'JobController@extend')->name('jobs.extend');

        Route::post('/galleries/sort-order/update','GalleryController@update_sort_order')->name('galleries.update.sort_order');

        Route::post('/videos/sort-order/update','VideosController@update_sort_order')->name('videos.update.sort_order');
        Route::post('/image-galleries/sort-order/update','GalleryCategoryController@update_sort_order')->name('gallery.categories.update.sort_order');
        Route::post('/videos-galleries/sort-order/update','VideoGalleryController@update_sort_order')->name('video.galleries.update.sort_order');

        Route::post('/applies','ApplyController@store')->name('applies.store');
        Route::get('/testtttt','ApplyController@testtttt')->name('testtttt');
        Route::get('/apply-list/{id}/{status?}','ApplyController@index')->name('applies.index');

        Route::post('/apply-list/ajax/seen','ApplyController@ajax')->name('applies.ajax');
        Route::post('/apply-list/ajax/waiting','ApplyController@ajaxwaiting')->name('applies.ajaxwaiting');
        Route::post('/apply-list/ajax/reject','ApplyController@ajaxreject')->name('applies.ajaxreject');
        Route::post('/apply-list/ajax/accept','ApplyController@ajaxaccept')->name('applies.ajaxaccept');
        Route::post('/apply-list/ajax/first_priority','ApplyController@firstPriority')->name('applies.first_priority');
        Route::post('/apply-list/ajax/second_priority','ApplyController@secondPriority')->name('applies.second_priority');

        Route::get('/apply-list-export/{id}/{status?}','ApplyController@export_csv')->name('applies.export_csv');
        Route::delete('/applies/{apply}/destroy','ApplyController@destroy')->name('applies.destroy');
        Route::post('/applies/{apply}/restore','ApplyController@restore')->name('applies.restore');
        Route::get('/applies/{apply}/accept','ApplyController@accept')->name('applies.accept');
        Route::get('/applies/{apply}/waiting','ApplyController@waiting')->name('applies.waiting');
        Route::post('/applies/{apply}/reject','ApplyController@reject')->name('applies.reject');
        Route::get('/applies/{apply}/seen','ApplyController@seen')->name('applies.seen');
        Route::post('/applies/seen-all','ApplyController@seenAll')->name('applies.seenAll');
        Route::post('/applies/reject-all','ApplyController@rejectAll')->name('applies.rejectAll');

        Route::get('/contact-us','ContactUSController@index')->name('contact.index');
        Route::post('/contact-us/read/{ticket_id}', 'ContactUSController@read')->name('contact.read');


        Route::get('/tickets', 'TicketController@index')->name('tickets.index');
        Route::get('/tickets/{ticket_id}', 'TicketController@show')->name('tickets.show');
        Route::get('/tickets/create/{user_id}/{job_id?}', 'TicketController@create')->name('tickets.create');
        Route::post('/tickets/close/{ticket_id}', 'TicketController@close')->name('tickets.close');
        Route::post('/tickets','TicketController@store')->name('tickets.store');


        Route::post('/ticket-replies','TicketReplyController@store')->name('ticket_replies.store');

        Route::get('/talks/{to?}', 'TalkController@index')->name('talks');
        Route::post('/talks/{to?}', 'TalkController@store')->name('talks.store');
        Route::get('/talks-refresh/{msg_id}/{chat_id?}', 'TalkController@refresh')->name('talks.refresh');

    }
);


Route::group(['middleware' => 'isAdmin'], function () {
    Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
    Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\LfmController@upload');
});
Route::get('/laravel-filemanager/crop', '\Unisharp\Laravelfilemanager\controllers\CropController@getCrop');
Route::get('/laravel-filemanager/cropimage', '\Unisharp\Laravelfilemanager\controllers\CropController@getCropimage');



Route::get('/', 'HomeController@index')->name('home');
Route::get('/jobs/{job}', 'JobController@show')->name('jobs.show');
Route::post('/jobs/favorite', 'JobController@favorite')->name('jobs.make.favorite')->middleware('isMobileVerified');



Route::get('/events', 'ContentCategoryController@site_Events')->name('site.events.index');
Route::get('/events/educational', 'ContentCategoryController@site_Events')->name('site.events.educational.index');

Route::post('/events/get', 'ContentCategoryController@site_Events_get')->name('site.events.get');
Route::post('/events/educational/get', 'ContentCategoryController@site_Events_get')->name('site.events.edu.get');



Route::get('/events/{event}', 'ContentController@show_event')->name('site.events.show');
Route::get('/blog', 'ContentCategoryController@site_Blog')->name('site.blog.index');
Route::get('/blog/{blog}', 'ContentController@show_blog')->name('site.blog.show');
Route::post('/blog/postvote', 'ContentController@vote')->name('site.blog.vote');
Route::post('/blog/{blog}', 'ContentCommentController@store')->name('site.blog.post.comment');
Route::get('/news', 'ContentCategoryController@site_News')->name('site.news.index');
Route::get('/news/group/{group_name}', 'ContentCategoryController@show_news_in_group')->name('site.news.index.in.group');
Route::get('/news/{news}', 'ContentController@show_news')->name('site.news.show');
Route::get('/jobs', 'JobController@site_index')->name('site.jobs.index');
Route::post('/jobs', 'JobController@site_index')->name('site.jobs.index.post');
Route::post('/newsletter/register', 'NewsletterMailController@store')->name('site.newsletter.post');

Route::get('/about-us','TimeLineController@site_index_about')->name('aboutUs');

Route::get('/route',function (){
    return view ('site.pages.route');
} )->name('route');

Route::post('/contactus','ContactUSController@store')->name('contact.store');
Route::get('/contact-us','ContactUSController@create')->name('contact.create');


Route::get('/user/profile/{id?}', 'SiteUserController@profile')->name('site.user.profile');
Route::get('/send-verification-email', 'SiteUserController@send_verification_email')->name('user.email.verification');
Route::get('/profile/reset_password', function (){
    return view('site.pages.user.reset_password');
})->name('site.user.profile.reset.password')->middleware('auth');
Route::post('/profile/reset_password','SiteUserController@reset_password')->name('site.user.profile.reset.password.post');

Route::put('/profile', 'SiteUserController@profileUpdate')->name('site.user.profile.put');

Route::post('/golrang-hr/upload','uploaderController@imageUpload')->name('uploader');
Route::post('/golrang-hr/remove','uploaderController@imageRemove')->name('remover');

Route::put('/profile/resume/job-detail','resumeController@store_job_detail')->name('user.resume.1.store');
Route::put('/profile/resume/skills','resumeController@store_skills')->name('user.resume.4.store');
Route::put('/profile/resume/educations','resumeController@store_educations')->name('user.resume.2.store');
Route::put('/profile/resume/work-experience','resumeController@store_work_experience')->name('user.resume.3.store');
Route::put('/profile/resume/questions','resumeController@store_questions')->name('user.resume.5.store');
Route::post('/profile/resume/questions', 'SiteUserController@profileUpdateLinkdin')->name('site.user.profile.update_linkdin_address');

Route::put('/profile/resume/further_information','resumeController@store_further_information')->name('user.resume.further_information.store');

Route::post('/profile/resume/job-exp','resumeController@ajax_resume_work_exp_update')->name('user.resume.job_exp.update');
Route::post('/profile/resume/job-exp/delete','resumeController@ajax_resume_work_exp_delete')->name('user.resume.job_exp.delete');
Route::post('/profile/resume/job-exp-create','resumeController@ajax_resume_work_exp_create')->name('user.resume.job_exp.create');

Route::post('/profile/resume/education-create','resumeController@ajax_resume_education_create')->name('user.resume.education.create');

Route::get('/profile/resume/ajax-get-education-name-by-id','resumeController@ajax_get_education_field_name_by_id')->name('ajax.get.education.name.by.id');

Route::post('/profile/resume/education-edit','resumeController@ajax_resume_education_edit')->name('user.resume.education.edit');
Route::post('/profile/resume/education-delete','resumeController@ajax_resume_education_delete')->name('user.resume.education.delete');

Route::get('/profile/resume/job-detail','resumeController@job_detail')->name('user.resume.1');
Route::get('/profile/resume/educations','resumeController@educations')->name('user.resume.2');
Route::post('/profile/resume/ajax-educations-fields','resumeController@ajax_educations_fields');
Route::post('/profile/resume/ajax-educations-orientations','resumeController@ajax_educations_orientations');
Route::post('/profile/resume/ajax-institute','resumeController@ajax_institute');
Route::get('/profile/resume/skills','resumeController@skills')->name('user.resume.4');
Route::get('/profile/resume/work-experience','resumeController@work_experience')->name('user.resume.3');
Route::get('/profile/resume/questions','resumeController@questions')->name('user.resume.5');
Route::get('/profile/resume/further_information','resumeController@further_information')->name('user.resume.further_information');
Route::get('/profile/resume/final_step','resumeController@final_step')->name('user.resume.6');
Route::get('/profile/resumes/pdf','resumeController@pdf')->name('resumes.pdf');

//Route::get('/profile/resumes/pdf','resumeController@master_import');

Route::get('/profile/resumes/get-resume-pdf','resumeController@get_resume_pdf')->name('resumes.get_resume_pdf');
Route::get('/profile/resumes/one-time/{access_token}','resumeController@one_time')->name('resumes.one_time');

Route::get('/profile/resume/preview/{test}',function (){
    $id = Auth::user()->id;
    $user = \HR\User::find($id);
    $resume = \HR\Resume::find($user->resume->id);
    //dd($user->id);
    $this->degrees_array = array();
    $Degrees = DB::table('degrees')->get();
    foreach($Degrees as $deg){
        $degrees_array[$deg->id] = $deg->name;
    }

    $khedmat_status = DB::table('user_profiles')->where('user_id','=',$user->id)->get();

    $user_khedmat_status = DB::table('khedmatmap')->where('site_id','=',$khedmat_status[0]->military_status)->get();
    $user_khedmat_moaf_status = DB::table('khedmatmoafmap')->where('id','=',$khedmat_status[0]->reason_exemption)->get();

    $user_khedmat_status = $user_khedmat_status[0];
    $user_khedmat_moaf_status = $user_khedmat_moaf_status[0];

    $age = substr($resume->user->profile->born_date, 0, 4); // sample : 1361
    $year = \p3ym4n\JDate\JDate::now()->year;// sample : 1397
    $years_old = $year - $age;

    $view = \Illuminate\Support\Facades\View::make('site.resume.pdf', compact(['resume','degrees_array','user_khedmat_status','user_khedmat_moaf_status','years_old']));
    $contents = $view->render();
    //echo $contents;exit;

    return \Barryvdh\Snappy\Facades\SnappyPdf::loadHtml($contents)
        ->setPaper('A4')
        ->setOrientation('portrait')
        ->setOption('margin-bottom', 30)
        ->setOption('dpi', 300)
        ->setOption('footer-html', 'https://hr.gmiserver.net/resume/footer.html')
        ->inline(\HR\myDate::now()->timezone('Asia/Tehran')->format('Y-m-d').'_'.$user->first_name . '_' . $user->last_name . '.pdf');
})->name('user.resume.preview');


Route::get('/profile/applies', 'ApplyController@site_index')->name('user.applies.list');

Route::get('/page/{page_name}','staticPagesController@index')->name('site.statics.pages');

Route::get('/site/captcha/{ref}','captchaController@index')->name('site.captcha');

Route::get('/profile/messages/inbox','UserMessagesController@inbox')->name('user.messages.inbox');
Route::get('/profile/messages/sent','UserMessagesController@sent')->name('user.messages.sent');
Route::get('/profile/messages/trash','UserMessagesController@trash')->name('user.messages.trash');
Route::get('/profile/messages/{message}/show','UserMessagesController@show')->name('user.messages.show');
Route::delete('/profile/messages/{message}','UserMessagesController@destroy')->name('user.messages.destroy');
Route::post('/profile/messages/{message}','UserMessagesController@restore')->name('user.messages.restore');
Route::get('/profile/messages/{message}/reply','UserMessagesController@reply')->name('user.messages.reply');
Route::post('/profile/messages','UserMessagesController@store')->name('user.messages.store');
Route::post('/messages/compose','UserMessagesController@compose')->name('user.messages.compose');

Route::get('/search','SearchHoleSiteController@Search_all')->name('site.search');
Route::get('/search/blog','SearchHoleSiteController@Search_blog')->name('site.search.blog');
Route::get('/search/books','SearchHoleSiteController@Search_books')->name('site.search.books');
Route::get('/search/events','SearchHoleSiteController@Search_event')->name('site.search.events');
Route::get('/search/news','SearchHoleSiteController@Search_news')->name('site.search.news');
Route::get('/search/static-pages','SearchHoleSiteController@Search_static_pages')->name('site.search.static_pages');
Route::get('tags/{tag}','SearchHoleSiteController@Search_tags')->name('site.search.tags');
Route::get('/tags/blog/{tag}','SearchHoleSiteController@Search_blog_tags')->name('site.search.blog.tags');
Route::get('/tags/books/{tag}','SearchHoleSiteController@Search_book_tags')->name('site.search.books.tags');
Route::get('/tags/events/{tag}','SearchHoleSiteController@Search_event_tags')->name('site.search.events.tags');
Route::get('/tags/news/{tag}','SearchHoleSiteController@Search_news_tags')->name('site.search.news.tags');
Route::get('/tags/static-pages/{tag}','SearchHoleSiteController@Search_static_pages_tags')->name('site.search.static_pages.tags');
Route::get('/jobs/search-by-tag/search','SearchHoleSiteController@JobTagAutoComplete')->name('site.jobs.search.by.tags');
Route::get('/merites/search-by-name/search','SearchHoleSiteController@professionalMerit')->name('site.merites.search.by.name');

Route::get('/profile/favorite-jobs', 'SiteUserController@get_all_favorite')->name('user.favorite.jobs');
Route::get('/absorption-process',function (){
    $boxes = \HR\Setting\AbsorptionProcess::all()->first()->boxes;
    return view('site.pages.statics.absorption_process',compact('boxes'));
} )->name('pages.absorption_process');

Route::get('/gallery', 'GalleryController@site_index')->name('site.pages.gallery');
Route::post('/gallery/load-more', 'GalleryController@site_index_load_more')->name('site.pages.gallery.load.more');

Route::get('/videos',function (){

    return view('site.pages.gallery.videos');
} )->name('site.pages.videos');

Route::get("/videos/{id}/all",'VideoGalleryController@show')->name('site.pages.videos.show');

Route::get('/video-tutorial','VideoGalleryController@site_index_tut' )->name('site.pages.learning_movie');

Route::get('/videos/{video}','VideosController@show' )->name('site.pages.videos.single_page');

Route::get('/books','BookIntroductionController@site_index' )->name('site.books.index');
Route::get('/books/{book}','BookIntroductionController@show' )->name('site.books.show');


Route::get('/tickets/{id}','TicketController@site_show' )->name('site.tickets.show');
Route::get('/tickets/close/{ticket_id}', 'TicketController@site_close')->name('site.tickets.close');
Route::get('/tickets','TicketController@site_index' )->name('site.tickets.index');
Route::post('/tickets','TicketController@site_store')->name('tickets.site_store');

Route::post('/festival-form','uniFormController@store')->name('uniForm.store');
Route::get('/festival-form','uniFormController@create')->name('uniForm.create');

Route::get('/help','PagesController@help')->name('pages.help');
Route::get('/help/video-aparat','PagesController@aparat_video')->name('pages.help.video');
Route::get('/faq','FaqController@show')->name('pages.faq');

Route::get('/company/{id}/{url}','CompanyController@show');
Route::get('/company/{id}','CompanyController@show');
Route::get('/company-jobs/{alias}','CompanyController@job')->name('site.company.job');

Route::get('/email/verification-email/{key}', function($key)
{
    $user_id = DB::table('users')->where(DB::raw('MD5(`is_email_verified`)'),$key)->first()->id;
    if($user_id)
        $user = \HR\User::find($user_id);
    else
        return redirect(route('site.user.profile'))->withErrors(['ایمیل منقضی شده یا لینک اشتباه است']);

    $web = true;
    return view('emails.users.verification_email', compact(['user','web']));
})->name('emails.verification_email');


Route::get('/email/new-message/{id}', function($id)
{
    $ticket = \HR\Ticket::findOrFail($id);
    $web = true;
    return view('emails.tickets.new_message', compact(['ticket','web']));
})->name('emails.new_message');


Route::get('/email/apply-seen/{id}', function($id)
{
    $apply = \HR\Apply::findOrFail($id);
    $web = true;
    return view('emails.applies.seen', compact(['web','apply']));
})->name('emails.apply_seen');

Route::get('/email/apply-reject/{id}', function($id)
{
    $apply = \HR\Apply::findOrFail($id);
    $web = true;
    return view('emails.applies.reject', compact(['web','apply']));
})->name('emails.apply_reject');

Route::get('/sharif-fair', 'FormController@index')->name('forms.index');
Route::post('/sharif-fair', 'FormController@store')->name('forms.store');


Route::prefix('/api')->middleware('checkApi')->group(function () {

   // Route::get('/resumes/{resume}/show','resumeController@show')->name('resumes.show');
       Route::post('/user_history_without_any_id/','ApiController@userHistoryWithoutAnyId');


    Route::post('/test','ApiController@test');
    Route::post('/apply-status','ApiController@apply_status');
    Route::get('/get-job-posts','ApiController@get_job_posts');
    Route::get('/get-institute-structure','ApiController@get_institute_structure');
    Route::get('/get-job-departments','ApiController@get_job_departments');
    Route::get('/get-job-organizational-category','ApiController@get_job_organizational_category');
    Route::get('/get-job-general-skills','ApiController@get_job_general_skills');
    Route::get('/get-job-special-skills','ApiController@get_job_special_skills');
    Route::get('/get-cities','ApiController@get_cities');
    Route::get('/get-provinces','ApiController@get_provinces');
    Route::get('/get-industries','ApiController@get_industries');
    Route::get('/get-companies','ApiController@get_companies');
    Route::get('/get-min-education','ApiController@get_min_education');
    Route::get('/get-cooperation-types','ApiController@get_cooperation_types');
    Route::get('/get-job-exp','ApiController@get_job_exp');
    Route::post('/post-create-job','ApiController@post_create_job');
    Route::post('/post-create-job-using-gng','ApiController@post_create_job_using_gng');
    Route::post('/post-edit-job/{id}','ApiController@post_edit_job');
    Route::get('/get-confirmed-users','ApiController@get_confirmed_users');
    Route::post('/post-view-resume','ApiController@post_view_resume');
    Route::get('/get-reject-reasons','ApiController@get_reject_reasons');
    Route::post('/get-user-history','ApiController@getUserHistory');
    Route::post('/test-get-user-history','ApiController@testGetUserHistory');
    Route::post('/generate_token','ApiController@generateToken');
    Route::post('/update_recruitment_status','ApiController@updateRecruitmentStatus');


});


Route::get('/clear-cache', function() {
	Artisan::call('cache:clear');
	return "Cache is cleared";
});

Route::get('/test',function (){

    $applies = \HR\Apply
        ::leftjoin('users', 'applies.user_id', '=', 'users.id')
        ->leftjoin('resumes', 'resumes.user_id', '=', 'users.id')
        ->leftjoin('resume_educational_details', 'resume_educational_details.resume_id', '=', 'resumes.id')
        ->select('users.id as user_id',
            'applies.id as apply_id',
            'applies.created_at as apply_date',
            'users.first_name',
            'users.last_name',
            'resume_educational_details.grade as level',
            'resume_educational_details.field',
            'resume_educational_details.institute'
        )
        ->where('applies.job_id', request('job_id'))
        ->where('applies.status', 4)
        ->groupBy('users.id')
        ->havingRaw('resume_educational_details.grade = MAX(resume_educational_details.grade)')
        ->get();
    foreach ($applies as $apply){
        $apply->level = config('app.enum_last_degree')[$apply->level];
    }

    dd($applies->toArray());
});







