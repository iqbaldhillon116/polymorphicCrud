<?php

use Illuminate\Support\Facades\Route;
use App\Staff;
use App\Photo;
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

Route::get('/create',function(){

    // Note:imageable id is storing the id of local table that we are trying to insert the value for.
    // imageable type is telling us for which table we are inserting the photo path value.

    $staff = Staff::find(2);
    
    // dd($staff->photos());
    $staff->photos()->create(['path'=>'example2.jpg']);

});

Route::get('/read',function(){

    $staff = Staff::findOrFail(2);

    foreach($staff->photos as $photo){
        return $photo->path;
    }

});

Route::get('/update' , function(){

    $staff = Staff::findOrFail(1);

    $photo = $staff->photos()->whereId(1)->first();

    $photo->path = "update example.jpg";

    $photo->save();

});

Route::get('/delete' , function(){

    $staff = Staff::findOrFail(1);

     $staff->photos()->whereId(1)->delete();

   

    return "deleted";
});

//below two funcitons are used to fill or empty coulmns inside photo table
Route::get('/assign' , function(){

    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(3);//assigning the imageable id and imageable type of staff 1 where photo id is 3

    $staff->photos()->save($photo);

    return "assigned";
});

Route::get('/un-assign' , function(){

    $staff = Staff::findOrFail(1);
    
    $staff->photos()->whereId(3)->update(['imageable_id'=>0,'imageable_type'=>'']);//un-assigning the imageable id and imageable type of staff 1 where photo id is 3


    return "un-assigned";
});