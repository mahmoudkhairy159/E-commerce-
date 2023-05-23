<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| trainer Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "trainer" middleware group. Now create something great!
|
*/

Route::group([
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    'prefix' => LaravelLocalization::setLocale()
], function () {
    Route::get('/login/trainer', 'Auth\LoginController@showTrainerLoginForm');
    Route::post('/login/trainer', 'Auth\LoginController@trainerLogin');
    Route::get('/register/trainer', 'Auth\RegisterController@showTrainerRegisterForm');
    Route::post('/register/trainer', 'Auth\RegisterController@createTrainer');

    Route::middleware(['auth:trainer'])->prefix('trainer')->group(function () {
        Route::view('/home', 'trainer.home');
        Route::resource('courses', 'CourseController')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);
        Route::get('/courses/', 'CourseController@indexTrainer')->name('courses.indexTrainer');
        Route::get('/courses/{course}/', 'CourseController@showTrainer')->name('courses.showTrainer');
        Route::resource('lessons', 'LessonController')->only([
            'store', 'edit', 'update', 'destroy'
        ]);
        Route::get('/lessons/create/{courseId}', 'LessonController@create')->name('lessons.create');
        Route::get('/lessons/', 'LessonController@indexTrainer')->name('lessons.indexTrainer');
        Route::get('/lessons/{lesson}/', 'LessonController@showTrainer')->name('lessons.showTrainer');
        Route::resource('trainers','TrainerController')->only([
           'show','update',
        ]);

        Route::put('/changePassword/{id}', 'TrainerController@changePassword')->name('trainers.changePassword');
        Route::get('/users', 'UserController@index')->name('users.index');
        Route::get('/courses/{courseId}/users', 'CourseController@showCourseStudents')->name('courses.showCourseStudents');
        Route::get('/courses/{courseId}/users/{userId}/', 'UserController@showUserForTrainer')->name('users.showUserForTrainer');
        Route::delete('/courses/{courseId}/users/{userId}/', 'UserController@destroy')->name('users.removeUserFromCourse');
        Route::get('/courses/{courseId}/EnrollmentRequests/', 'CourseController@showCourseEnrollmentRequests')->name('courses.showCourseEnrollmentRequests');
        Route::get('/courses/{courseId}/acceptEnrollmentRequest/{userId}/', 'CourseController@acceptCourseEnrollmentRequests')->name('courses.acceptEnrollmentRequest');
        Route::get('/courses/{courseId}/refuseEnrollmentRequest/{userId}', 'CourseController@refuseCourseEnrollmentRequests')->name('courses.refuseEnrollmentRequest');

    });
});
