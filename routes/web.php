<?php
use App\Post;
use App\User;
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

// Route::get('/hr/{id}', function () {
//     // return view('welcome');
//     echo"Text data";
// });
    

// Route::get('/hello/{id}/{name}',function($id, $name){
//     echo"Text Data = ".$id."  ".$name."";
// });


// Route::get('/list/files/data', array('as'=>'list.home' ,function(){

//     $url = route('list.home');
//   echo "hey bunny your url is ".$url;
// //    return view('welcome');
// })); 

Route::get('/blog/{id}','CrudController@index');

Route::get('/contact','CrudController@contact');

Route::get('/king/{id}', 'CrudController@kings');


// insert data into database table
Route::get('/insert',function(){
    DB::insert('insert into posts(title,content,is_admin) values(?,?,?)',['Php Language','Its Laravel Php','0']);
});

// retrive specific data from table 
Route::get('/read',function(){
$result = DB::select('select * from posts where id=?',[1]);

  // return ($result);
    // return var_dump($result);

foreach($result as $post){
    // return $post->content;
    return $post->title;
}
});

// updAte data of table
Route::get('/update',function(){
$update= DB::update('update posts set title="Update title" where id=?',[1]);
return $update;

});

// delete row from table 
Route::get('/delete',function(){
    $delete = DB::delete('delete from posts where id=?',[3]);

    return $delete;
});




// =============Eloquent===========
Route::get('/read',function(){

$posts = Post::all();

foreach($posts as $post){
    return $post->title;
}
});

// =============Eloquent find===========
Route::get('/find',function(){

    $post = Post::find(1);
    
        return $post->title;

    });




// =============Eloquent ORM (obj rel. model) use App\Post; mention at top to get daata post===========
Route::get('/findwhere',function(){

    $findwhere = Post::where('id',4)->orderBy('id','desc')->take(2)->get();
    return $findwhere;

});


// =============Eloquent find===========
Route::get('/find',function(){

    $posts = Post::where('users_count','<',50)->firstOrFail();
    
        // return $post->title;

    });

    
// hello testing new data 

    /////////basic insert data another method
    Route::get('/basicinsert',function(){
$post = new Post;

$post->title='Test new way of insertion';

$post->content='Test new way of insertion';
$post->users_count='1';
$post->is_admin='1';
//    sbdbsd 
  
$post->save();
    });


        /////////basic Upate data another method
        Route::get('/basicinsert2',function(){
            $post =Post::find(1);
            
            $post->title='Test new way of insertion 2';
            
            $post->content='Test new way of insertion 2';
            $post->users_count='1';
            $post->is_admin='1';
            $post->save();
                });



Route::get('/createnew',function(){
// with model post 
Post::create(['title'=>'title here','content'=>'yo content','users_count'=>'1','is_admin'=>'1']);
            }); 


 // update data with content conditions
 Route::get('/updatenew',function(){
Post::where('id',6)->where('is_admin',1)->update(['title'=>'updating title', 'content'=>'updating content', 'users_count'=>'2','is_admin'=>'0']);
            });


            // delete specific data 
Route::get('/delete',function(){
$post = Post::find(4);

$post->delete();

});


Route::get('/delete2',function(){
    // Post::destroy(6)
    Post::destroy([6,7]);
    // Post::where('id',8)->delete();
});


// delete but not permanently method update the deleted at time
Route::get('/softdelete',function(){
Post::all(11)->delete();
});
// lcture 55
// withtrashed & onlytrashed are use to show the softdeleted datas 
// lcture 56
// and with trashed then restore to restore from time to NULL value in is_deleted section 



// forcedelete is used  to delete the data prmanently 
// onlytrashed find all trashed  data then forcedelete deletes data prmanantly  



// =======================ELOQUENT RELATIONSHIPS===================
// ============================SECTION 2 of learning ====================
// deleted at must be null 


// this is one to one relation 
Route::get('/user/{id}/post',function($id){
    // return User::find($id)->post; 
return User::find($id)->post->title;
});


// inverse one to one relation 
Route::get('/post/{id}/user',function($id){
return Post::find($id)->user->name;

});


// multile data fetch (show all blogs post of single user )
Route::get('/posts',function(){
$user =  User::find(1);
foreach($user->posts as $post){

    echo $post->title."<br>";

}

});