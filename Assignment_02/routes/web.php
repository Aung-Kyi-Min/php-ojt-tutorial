<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Majors\MajorController;
use App\Http\Controllers\SearchController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::redirect('/', 'students');
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students.destroy/{id}', [StudentController::class, 'destroy']);


Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
Route::get('/majors/create', [MajorController::class, 'create'])->name('majors.create');
Route::post('/majors', [MajorController::class, 'store'])->name('majors.store');
Route::get('/majors/{id}/edit', [MajorController::class, 'edit'])->name('majors.edit');
Route::put('/majors/{id}', [MajorController::class, 'update'])->name('majors.update');
Route::delete('/majors.destroy/{id}', [MajorController::class, 'destroy']);


Route::get('/file-import',[StudentController::class,'importView'])->name('import-view');
Route::post('/import',[StudentController::class,'import'])->name('import');
Route::get('/export-students',[StudentController::class,'exportStudents'])->name('export.students');


