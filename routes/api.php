<?php


use App\Http\Controllers\QuizController;
//use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MobileApiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizQuestionController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TelemetryController;
use App\Http\Controllers\WebsiteMessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Grouping all API routes under the 'v1' prefix
Route::group(['prefix' => 'v1'], function () {
    Route::post('/mobile/login', [MobileApiController::class, 'login'])->name('mobile.login');
    Route::post('/mobile/register', [MobileApiController::class, 'register'])->name('mobile.register');

//    Route::get('/quiz-questions', [QuizQuestionController::class, 'index']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/telemetry', [TelemetryController::class, 'log'])->name('telemetry');

        Route::get('/website-messages', [WebsiteMessagesController::class, 'fetchMessage'])->name('website.messages.fetch');
        Route::post('/website-messages/batch', [WebsiteMessagesController::class, 'batchFetchMessages'])->name('website.messages.batchFetch');
        
        Route::post('/mobile/logout', [MobileApiController::class, 'logout'])->name('mobile.logout');
        Route::get('/mobile/profile', [MobileApiController::class, 'currentUser'])->name('mobile.profile');
        Route::post('/mobile/profile', [MobileApiController::class, 'updateUser'])->name('mobile.updateUser');
        Route::post('/mobile/profile/photo', [MobileApiController::class, 'updatePhoto'])->name('mobile.updatePhoto');

        Route::prefix('/mobile/quizzes')->name('mobile.quizzes.')->group(function () {
            Route::post('/submit', [QuizQuestionController::class, 'submitQuiz'])->name('submit');
            Route::get('/generate', [QuizQuestionController::class, 'generateQuiz'])->name('generate');
            Route::get('/quiz/{quiz}', [QuizQuestionController::class, 'fetchQuizInfo'])->name('quiz');
            Route::get('/', [QuizQuestionController::class, 'fetchAllQuizzes'])->name('index');
        });

        Route::prefix('/mobile/courses')->name('mobile.courses.')->group(function () {
            Route::get('/', [CourseController::class, 'index'])->name('index');
            Route::post('/', [CourseController::class, 'store'])->name('store');
            Route::get('/{course}', [CourseController::class, 'show'])->name('show');
            Route::put('/{course}', [CourseController::class, 'update'])->name('update');
            Route::delete('/{course}', [CourseController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/mobile/certificates')->name('mobile.certificates.')->group(function () {
            Route::get('/', [CertificateController::class, 'index'])->name('index');
            Route::post('/', [CertificateController::class, 'store'])->name('store');
            Route::get('/{certificate}', [CertificateController::class, 'show'])->name('show');
            Route::put('/{certificate}', [CertificateController::class, 'update'])->name('update');
            Route::delete('/{certificate}', [CertificateController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/mobile/sections')->name('mobile.sections.')->group(function () {
            Route::get('/', [SectionController::class, 'index'])->name('index');
            Route::post('/', [SectionController::class, 'store'])->name('store');
            Route::get('/{section}', [SectionController::class, 'show'])->name('show');
            Route::put('/{section}', [SectionController::class, 'update'])->name('update');
            Route::delete('/{section}', [SectionController::class, 'destroy'])->name('destroy');
        });

//        Route::prefix('/mobile/questions')->name('mobile.questions.')->group(function () {
//            Route::get('/', [QuestionController::class, 'index'])->name('index');
//            Route::post('/', [QuestionController::class, 'store'])->name('store');
//            Route::get('/{question}', [QuestionController::class, 'show'])->name('show');
//            Route::put('/{question}', [QuestionController::class, 'update'])->name('update');
//            Route::delete('/{question}', [QuestionController::class, 'destroy'])->name('destroy');
//        });
    });
});
