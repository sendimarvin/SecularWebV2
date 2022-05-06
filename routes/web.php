<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\ApplicationMeetingController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EasyPayHelper;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KadaamaApplicationsController;
use App\Http\Controllers\KadaamaPaymentsController;
use App\Http\Controllers\KadaamaRescueRequestsController;
use App\Http\Controllers\LifetimeSubscriptionsController;
use App\Http\Controllers\LoanPaymentsController;
use App\Http\Controllers\LoanQuestionsOptionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\LoanPackageController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('layouts/app');
// });


Route::get('/',[HomeController::class, 'showDashboard'])->name('dashboard');

Route::get('/nationality', [AddressController::class, 'getNationality']);

Route::get('/country', [AddressController::class, 'getCountries']);

Route::get('/region', [AddressController::class, 'getRegions']);

Route::get('/district', [AddressController::class, 'getDistricts']);

Route::get('/subcounty', [AddressController::class, 'getSubcounties']);

Route::get('/parish', [AddressController::class, 'getParishes']);

Route::get('/village', [AddressController::class, 'getVillages']);

Route::get('/users', [UserController::class, 'index']);

Route::get('/admins', [UserController::class, 'admins'])->name('admins');

Route::get('/admins/create', [UserController::class, 'create_admin']);

Route::post('/admins/save', [UserController::class, 'create']);

Route::put('/admins/update/{id}', [UserController::class, 'update'])->name('/admins/update');

Route::get('/admins/delete/{id}', [UserController::class, 'destroy']);

Route::get('/admins/edit/{id}', [UserController::class, 'edit']);

// BEGON SECTION QUESTION CATEGORY ROUTES
Route::get('/question/categories', [QuestionController::class, 'categories'])->name('/question/categories');

Route::get('/question/new_category', function () {
    return view('pages/new_question_category');
})->name('/question/new_category');

Route::post('/question/save_category', [QuestionController::class, 'create_category']);

Route::get('/question/edit_category/{id}', [QuestionController::class, 'edit_category']);

Route::put('/question/update_category/{id}', [QuestionController::class, 'update_category'])->name('/question/update_category');

Route::get('/question/delete_category/{id}', [QuestionController::class, 'delete_category']);
// END SECTION QUESTION CATEGORY ROUTES


Route::get('/question/options', [LoanQuestionsOptionsController::class, 'index']);
Route::get('/question/options/create', [LoanQuestionsOptionsController::class, 'create']);
Route::post('/question/options/store', [LoanQuestionsOptionsController::class, 'store']);
Route::get('/question/options/{id}/delete', [LoanQuestionsOptionsController::class, 'delete']);
Route::get('/question/options/{id}/edit', [LoanQuestionsOptionsController::class, 'edit']);
Route::put('/question/options/{id}/update', [LoanQuestionsOptionsController::class, 'update']);

Route::get('/question/questions', [QuestionController::class, 'questions'])->name('/question/questions');

Route::get('/question/new_question',[QuestionController::class, 'new_question'])->name('/question/new_question');

Route::post('/question/save_question', [QuestionController::class, 'create_question']);

Route::get('/question/edit_question/{id}', [QuestionController::class, 'edit_question']);

Route::put('/question/update_question/{id}', [QuestionController::class, 'update_question'])->name('/question/update_question');

Route::get('/question/delete_question/{id}', [QuestionController::class, 'delete_question']);

//MAPPINGS

Route::get('/question/question_mappings', [QuestionController::class, 'question_mappings'])->name('/question/question_mappings');

Route::get('/question/new_question_mapping',[QuestionController::class, 'new_question_mapping'])->name('/question/new_question_mapping');

Route::post('/question/save_question_mapping', [QuestionController::class, 'create_question_mapping']);

Route::get('/question/edit_question_mapping/{id}', [QuestionController::class, 'edit_question_mapping']);

Route::put('/question/update_question_mapping/{id}', [QuestionController::class, 'update_question_mapping'])->name('/question/update_question_mapping');

Route::get('/question/delete_question_mapping/{id}', [QuestionController::class, 'delete_question_mapping']);

Route::get('/terms', [SettingController::class, 'terms'])->name('/terms');

Route::put('/update_terms/{id}', [SettingController::class, 'update_terms'])->name('/update_terms');

Route::get('/policy', [SettingController::class, 'policy'])->name('/policy');
Route::get('/users/{id}', [UserController::class, 'viewUser']);
Route::post('/users/{id}/approve', [UserController::class, 'approveUser']);

Route::put('/update_policy/{id}', [SettingController::class, 'update_policy'])->name('/update_policy');

Route::get('/kadama_terms', [SettingController::class, 'kadama_terms'])->name('/kadama_terms');
Route::put('/update_kadama_terms/{id}', [SettingController::class, 'update_kadama_terms'])->name('/update_kadama_terms');

Route::get('/application_fee', [SettingController::class, 'application_fee'])->name('/application_fee');
Route::put('/update_application_fee/{id}', [SettingController::class, 'update_application_fee'])->name('/update_application_fee');

Route::get('/payments_setup', [SettingController::class, 'payments_setup'])->name('/payments_setup');
Route::put('/update_payments_setup/{id}', [SettingController::class, 'update_payments_setup'])->name('/update_payments_setup');


// BEGIN SECTION SUBSCRIPTION //
Route::get('/subscription/subscription_packages', [SubscriptionController::class, 'subscription_packages'])->name('/subscription/subscription_packages');

Route::get('/subscription/new_subscription_package', function () {
    return view('pages/new_subscription_package');
})->name('/subscription/new_subscription_package');

Route::post('/subscription/save_subscription_package', [SubscriptionController::class, 'create_subscription_package']);

Route::get('/subscription/edit_subscription_package/{id}', [SubscriptionController::class, 'edit_subscription_package']);

Route::put('/subscription/update_subscription_package/{id}', [SubscriptionController::class, 'update_subscription_package'])->name('/subscription/update_subscription_package');

Route::get('/subscription/delete_subscription_package/{id}', [SubscriptionController::class, 'delete_subscription_package']);
///////


// BEGIN SECTION LoanPackage //
Route::get('/loans/packages', [LoanPackageController::class, 'loanPackages'])->name('/loans/packages');

Route::get('/loans/new_package', function () {
    return view('pages/new_loan_package');
})->name('/loans/new_package');

Route::post('/loans/save_package', [LoanPackageController::class, 'create_package']);

Route::get('/loans/edit_package/{id}', [LoanPackageController::class, 'edit_package']);

Route::put('/loans/update_package/{id}', [LoanPackageController::class, 'update_package'])->name('/loans/update_package');

Route::get('/loans/delete_package/{id}', [LoanPackageController::class, 'delete_package']);

/////////////
Route::get('/loans/sub_packages', [LoanPackageController::class, 'sub_packages'])->name('/loans/sub_packages');

Route::get('/loans/new_sub_package', [LoanPackageController::class, 'new_sub_package'])->name('/loans/new_sub_package');

Route::post('/loans/save_sub_package', [LoanPackageController::class, 'create_sub_package']);

Route::get('/loans/edit_sub_package/{id}', [LoanPackageController::class, 'edit_sub_package']);

Route::put('/loans/update_sub_package/{id}', [LoanPackageController::class, 'update_sub_package'])->name('/loans/update_sub_package');

Route::get('/loans/delete_sub_package/{id}', [LoanPackageController::class, 'delete_sub_package']);
///////


///////EVENTS SECTION
Route::get('/events', [EventController::class, 'events'])->name('/events');

Route::get('/events/new_event', function () {
    return view('pages/new_event');
})->name('/events/new_event');

Route::post('/events/save_event', [EventController::class, 'create_event']);

Route::get('/events/edit_event/{id}', [EventController::class, 'edit_event']);
Route::get('/events/{id}', [EventController::class, 'viewEvent']);

Route::put('/events/update_event/{id}', [EventController::class, 'update_event'])->name('/events/update_event');

Route::get('/events/delete_event/{id}', [EventController::class, 'delete_event']);
////////////////


//////////////FEEDBACK/////////////
Route::get('/feedback', [FeedbackController::class, 'feedback'])->name('/feedback');
Route::get('/feedback/{id}/delete', [FeedbackController::class, 'deleteFeedback']);
//////////////////

//////////////Loan Applications/////////////
Route::get('/loan_applications', [LoanApplicationController::class, 'loan_applications'])->name('/loan_applications');

Route::get('/loan_applications/review_loan/{id}', [LoanApplicationController::class, 'review_loan']);

Route::put('/loan_applications/update_loan_application/{id}', [LoanApplicationController::class, 'update_loan_application'])->name('/loan_applications/update_loan_application');
Route::post('/loan_applications_fees/{id}/payment', [LoanApplicationController::class, 'loan_applications_fees_payment'])->name('/loan_applications/update_loan_application');

//////////////////

////////////////////////////LOANS///////////////////////////

Route::get('/loans/applications/{status}', [LoanApplicationController::class, 'index'])->name('/loans');
Route::get('/loans/applications/review/{id}', [LoanApplicationController::class, 'review']);
Route::post('/loans/applications/review/{id}/submit', [LoanApplicationController::class, 'reviewSubmit']);
Route::get('/loans/applications/approve/{id}', [LoanApplicationController::class, 'approve']);
Route::get('/loans/applications/clear/{id}', [LoanApplicationController::class, 'clear']);
Route::post('/loans/applications/clear/{id}/submit', [LoanApplicationController::class, 'clearSubmit']);
Route::post('/loans/applications/approve/{id}/submit', [LoanApplicationController::class, 'approveSubmit']);
Route::post('/loans/applications/disburse/{id}/submit', [LoanApplicationController::class, 'disburseSubmit']);
Route::get('/loans/applications/preview/{id}', [LoanApplicationController::class, 'preview']);
Route::post('/loans/applications/meeting/{id}/submit', [ApplicationMeetingController::class, 'meetingEdit']);
Route::get('/loans/applications/disburse_more/{id}', [LoanApplicationController::class, 'disburseMore']);
Route::post('/loans/applications/disburse_more/{id}/submit', [LoanApplicationController::class, 'disburseMoreSubmit']);

Route::get('/loans/payments', [LoanPaymentsController::class, 'index']);
Route::get('/loans/payments/{id}/edit', [LoanPaymentsController::class, 'edit']);
Route::post('/loans/payments/{id}/editSubmit', [LoanPaymentsController::class, 'editSubmit']);

///

////////////////////////////KADAAMA/////////////////////////

Route::get('/kadaama/applications', [KadaamaApplicationsController::class, 'index'])->name('/kadaama_applications');
Route::get('/kadaama/applications/accept/{id}', [KadaamaApplicationsController::class, 'accept']);
Route::post('/kadaama/applications/accept/{id}/save', [KadaamaApplicationsController::class, 'acceptStore']);
Route::get('/kadaama/applications/review/{id}', [KadaamaApplicationsController::class, 'review']);
Route::get('/kadaama/applications/approve/{id}', [KadaamaApplicationsController::class, 'approve']);
Route::post('/kadaama/applications/approve/{id}/save', [KadaamaApplicationsController::class, 'approveStore']);
Route::get('/kadaama/applications/decline/{id}', [KadaamaApplicationsController::class, 'decline']);
Route::post('/kadaama/applications/decline/{id}/save', [KadaamaApplicationsController::class, 'declineStore']);
Route::get('/kadaama/applications/preview/{id}', [KadaamaApplicationsController::class, 'preview']);

Route::get('/kadaama/rescue_requests', [KadaamaRescueRequestsController::class, 'index']);
Route::get('/kadaama/rescue_requests/{id}', [KadaamaRescueRequestsController::class, 'preview']);
Route::post('/kadaama/rescue_requests/{id}/update', [KadaamaRescueRequestsController::class, 'update']);

Route::get('/kadaama/payments', [KadaamaPaymentsController::class, 'index'])->name('/kadaama_payments');
Route::get('/kadaama/payments/review/{id}', [KadaamaPaymentsController::class, 'review']);
Route::post('/kadaama/payments/review/{id}/accept', [KadaamaPaymentsController::class, 'accept']);
Route::post('/kadaama/payments/review/{id}/decline', [KadaamaPaymentsController::class, 'decline']);
Route::post('/kadaama/payments/review/{id}/pending', [KadaamaPaymentsController::class, 'pending']);

///////////////////////////////////////////////////////////


//////////////////PAYMENTS///////////////////////
Route::get('/payments/events_tickets', [PaymentController::class, 'events_tickets'])->name('/payments/events_tickets');
Route::get('/payments/application_fees', [PaymentController::class, 'application_fees'])->name('/payments/application_fees');
Route::get('/payments/application_fees/{id}/edit', [PaymentController::class, 'applicationFeesEdit']);
Route::post('/payments/application_fees/{id}/editSubmit', [PaymentController::class, 'applicationFeesEditSubmit']);
Route::get('/payments/loan_payments', [PaymentController::class, 'loan_payments'])->name('/payments/loan_payments');

Route::get('/payments/subscriptions', [PaymentController::class, 'subscriptions'])->name('/payments/subscriptions');
Route::get('/subscriptions/payments', [PaymentController::class, 'indexSubscription']);

Route::get('/subscriptions/lifetime', [LifetimeSubscriptionsController::class, 'index']);
Route::get('/subscriptions/lifetime/{id}', [LifetimeSubscriptionsController::class, 'preview']);
Route::get('/subscriptions/lifetime_beneficiary/{id}/add_examination', [LifetimeSubscriptionsController::class, 'add_beneficiary_examination']);
Route::post('/subscriptions/lifetime_beneficiary/{id}/save_examination', [LifetimeSubscriptionsController::class, 'save_beneficiary_examination']);

Route::get('/subscriptions/payments/{id}/edit', [PaymentController::class, 'indexSubscriptionEdit']);
Route::post('/subscriptions/payments/{id}/editSubmit', [PaymentController::class, 'indexSubscriptionSubmitEdit']);

Route::get('/payments/disbursments', [PaymentController::class, 'disbursments'])->name('/payments/disbursments');
////////////////////////////////////////////////



//////////////////AUTH///////////////////////
Route::get('/login', [CustomAuthController::class, 'login'])->name('login');
Route::post('/authenticate', [CustomAuthController::class, 'authenticate'])->name('authenticate');
Route::get('/logout', [CustomAuthController::class, 'signOut'])->name('logout');
////////////////////////////////////////////////

/*Loan Notification */
Route::get('/notifications/send', [\App\Http\Controllers\NotificationsController::class, 'send_notification_to_person']);
Route::post('/notifications/send', [\App\Http\Controllers\NotificationsController::class, 'send_notification_to_person']);

