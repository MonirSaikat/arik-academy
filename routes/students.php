<?php 

use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentDashhboard;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'auth',
    'as' => 'students.',
    'prefix' => 'student'
],function() {
    Route::get('/dashboard', [StudentDashhboard::class, 'index'])->name('dashboard.index'); 
    Route::get('/profile', [StudentDashhboard::class, 'profile'])->name('dashboard.profile'); 
    Route::get('/fees', [StudentDashhboard::class, 'fee_list'])->name('dashboard.fee_list'); 
    Route::put('/update_password', [StudentDashhboard::class, 'update_password'])->name('update_password');
    
});


?>