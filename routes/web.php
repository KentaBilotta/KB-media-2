<?php

use App\Like;
use App\Post;
use App\User;
use App\Video;
use App\Comment;
use App\Dislike;
use App\Playlist;
use App\Postcomment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\VideoController;

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
    $videos = Video::select("*")
        ->orderBy("updated_at", "desc")
        ->get();
    $posts = Post::select("*")
        ->orderBy("updated_at", "desc")
        ->get();
    return view('welcome', compact('videos', 'posts'));
})->name('welcome');

Auth::routes();

Route::get('/watch/{video}', function (Video $video, Playlist $playlist) {
    $videos = Video::select("*")
        ->orderBy("updated_at", "desc")
        ->get();

    $comments = Comment::select("*")
        ->where('video_id', $video->id)
        ->orderBy("updated_at", "desc")
        ->get();

    $playlists = Playlist::select('*')
        ->get();

    $likes = Like::select('*')
        ->where('video_id', $video->id)
        ->get();

    $dislikes = Dislike::select('*')
        ->where('video_id', $video->id)
        ->get();

    // dd(str_contains(strval(json_encode($likes)), '"user_id":' . Auth::user()->id));

    return view('watch', compact('videos', 'comments', 'playlists', 'likes', 'dislikes'), compact('video'));
})->name('watch');

Route::get('/channel/videos', function () {
    $videos = Video::select("*")
        ->where('user_id', Auth::user()->id)
        ->orderBy("updated_at", "desc")
        ->get();
    return view('channel', compact('videos'));
})->name('channel');

Route::get('/channel/posts', function () {
    $posts = Post::select("*")
        ->where('user_id', Auth::user()->id)
        ->orderBy("updated_at", "desc")
        ->get();
    return view('ch-posts', compact('posts'));
})->name('ch-posts');

Route::get('/public/channel/{user}', function (User $user) {
    $videos = Video::select("*")
        ->where('user_id', $user->id)
        ->orderBy("updated_at", "desc")
        ->get();
    return view('ch-public', compact('user', 'videos'));
})->name('ch-public');

Route::get('/public/channel/posts/{user}', function (User $user) {
    $posts = Post::select("*")
        ->where('user_id', $user->id)
        ->orderBy("updated_at", "desc")
        ->get();
    return view('ch-posts-public', compact('user', 'posts'));
})->name('ch-posts-public');

Route::get('/posts', function () {
    $posts = Post::select("*")
        ->orderBy("updated_at", "desc")
        ->get();
    return view('posts-index', compact('posts'));
})->name('posts-index');

Route::get('/posts/{post}', function (Post $post) {
    $postcomments = Postcomment::select("*")
        ->where('post_id', $post->id)
        ->orderBy("updated_at", "desc")
        ->get();
    return view('post-show', compact('post'), compact('postcomments'));
})->name('post-show');

Route::get('/channel/videos/create', function() {
    return view('video-create');
})->name('video-create');

Route::post('/channel/videos/store', function(Request $request) {
    $data = $request->all();

    $cover_path = Storage::put('uploads/images', $data['thumbnail']);
    $videofile_path = Storage::put('uploads/videos', $data['video_path']);

    $video = new Video();
    $video->user_id = Auth::user()->id;
    $video->title = $data['title'];
    $video->description = $data['description'];
    $video->thumbnail = $cover_path;
    $video->video_path = $videofile_path;
    $video->save();

    return redirect()->route('channel');
})->name('video-store');

Route::get('/channel/videos/{video}', function(Video $video) {
    $comments = Comment::select("*")
        ->where('video_id', $video->id)
        ->orderBy("updated_at", "desc")
        ->get();
    return view('video-show', compact('video'), compact('comments'));
})->name('video-show');

Route::delete('/channel/videos/{video}/destroy', function(Video $video) {
    $video->delete();
    return redirect()->route('channel')->with('success_delete', $video);
})->name('video-destroy');

Route::get('/channel/posts/create', function() {
    return view('post-create');
})->name('post-create');

Route::post('/channel/posts/store', function(Request $request) {
    $data = $request->all();

    $image_path = isset($data['image']) ? Storage::put('uploads/images', $data['image']) : null;

    $post = new Post();
    $post->user_id = Auth::user()->id;
    $post->description = $data['description'];
    $post->image = $image_path;
    $post->save();

    return redirect()->route('ch-posts');
})->name('post-store');

Route::get('/channel/posts/{post}', function(Post $post) {
    $postcomments = Postcomment::select("*")
        ->where('post_id', $post->id)
        ->orderBy("updated_at", "desc")
        ->get();
    return view('user-post-show', compact('post'), compact('postcomments'));
})->name('user-post-show');

Route::delete('/channel/posts/{post}/destroy', function(Post $post) {
    $post->delete();
    return redirect()->route('ch-posts')->with('success_delete', $post);
})->name('post-destroy');

Route::post('/watch/{video}/store', function(Request $request, Video $video) {
    $data = $request->all();

    $comment = new Comment();
    $comment->user_id = Auth::user()->id;
    $comment->video_id = $video->id;
    $comment->description = $data['description'];
    $comment->save();

    return redirect()->route('watch', ['video' => $video]);
})->name('comment-store');

// Route::delete('/watch/{video}/destroy', function(Comment $comment) {
//     $comment->delete();
//     return redirect()->route('watch', ['video' => $video])->with('success_delete', $comment);
// })->name('comment-destroy');

Route::post('/posts/{post}/store', function(Request $request, Post $post) {
    $data = $request->all();

    $postcomment = new Postcomment();
    $postcomment->user_id = Auth::user()->id;
    $postcomment->post_id = $post->id;
    $postcomment->description = $data['description'];
    $postcomment->save();

    return redirect()->route('post-show', ['post' => $post]);
})->name('postcomment-store');

Route::get('/playlists', function () {
    $playlists = Playlist::select('*')
        ->where('user_id', Auth::user()->id)
        ->get();
    return view('playlists-index', compact('playlists'));
})->name('playlists-index');

Route::get('/playlists/{playlist}', function (Playlist $playlist, Video $video) {
    $playlists = Playlist::select('*');
    return view('playlist-videos', compact('playlists', 'playlist', 'video'));
})->name('playlist-videos');

Route::post('/watch/{video}/{playlist}', function (Video $video, Playlist $playlist) {
    $record = DB::table('playlist_video')
    ->select('*')
    ->where('playlist_id','=',$playlist->id)
    ->where('video_id','=',$video->id);

    if ($record->exists()) {
        return redirect()->route('watch', ['video' => $video])->with('already_exist', $playlist);
    } else {
        DB::table('playlist_video')->insert(
            [
                'playlist_id' => $playlist->id,
                'video_id' => $video->id,
            ],
        );
        return redirect()->route('watch', ['video' => $video]);
    }
})->name('save-on-watch-later');

Route::delete('/playlists/{playlist}/{video}/delete', function (Playlist $playlist, Video $video) {
    DB::table('playlist_video')
    ->select('*')
    ->where('playlist_id','=',$playlist->id)
    ->where('video_id','=',$video->id)
    ->delete();

    return redirect()->route('playlist-videos', ['playlist' => $playlist])->with('success_remove', $playlist);
})->name('remove-from-platlist');

Route::post('playlists/store', function (Request $request) {
    $data = $request->all();

    $playlist = new Playlist();
    $playlist->user_id = Auth::user()->id;
    $playlist->name = $data['name'];
    $playlist->save();

    return redirect()->route('playlists-index');
})->name('playlist-store');

Route::delete('playlists/{playlist}/delete', function (Playlist $playlist) {
    $playlist->videos()->detach();
    $playlist->delete();
    return redirect()->route('playlists-index');
})->name('playlist-destroy');

Route::post('/public/channel/{user}/subscribe', function (Request $request, User $user) {
    $data = $request->all();

    $user->subscribers = $user->subscribers . Auth::user()->id . ', ';
    $user->update();
    return redirect()->route('ch-public', ['user' => $user]);
})->name('subscribe');

Route::post('/public/channel/{user}/unsubscribe', function (Request $request, User $user) {
    $data = $request->all();

    $user->subscribers = str_replace(Auth::user()->id . ', ', "",$user->subscribers);
    $user->update();
    return redirect()->route('ch-public', ['user' => $user]);
})->name('unsubscribe');

Route::get('/watch/{video}/liked', function(Video $video) {
    $record = DB::table('likes')
    ->select('*')
    ->where('user_id','=',Auth::user()->id)
    ->where('video_id','=',$video->id);

    $record2 = DB::table('dislikes')
    ->select('*')
    ->where('user_id','=',Auth::user()->id)
    ->where('video_id','=',$video->id);

    if ($record->exists()) {
        DB::table('likes')
            ->select('*')
            ->where('user_id','=',Auth::user()->id)
            ->where('video_id','=',$video->id)
            ->delete();
        return redirect()->route('watch', ['video' => $video]);
    } else {
        DB::table('likes')->insert(
            [
                'user_id' => Auth::user()->id,
                'video_id' => $video->id,
                'created_at' => date('Y/m/d h:i:s', time()),
                'updated_at' => date('Y/m/d h:i:s', time()),
            ],
        );
        DB::table('dislikes')
            ->select('*')
            ->where('user_id','=',Auth::user()->id)
            ->where('video_id','=',$video->id)
            ->delete();
        return redirect()->route('watch', ['video' => $video]);
    }
})->name('liked');

Route::get('/watch/{video}/unliked', function(Video $video) {
    $record = DB::table('likes')
    ->select('*')
    ->where('user_id','=',Auth::user()->id)
    ->where('video_id','=',$video->id);


    $record2 = DB::table('dislikes')
    ->select('*')
    ->where('user_id','=',Auth::user()->id)
    ->where('video_id','=',$video->id);

    if($record2->exists()) {
        DB::table('dislikes')
            ->select('*')
            ->where('user_id','=',Auth::user()->id)
            ->where('video_id','=',$video->id)
            ->delete();
        return redirect()->route('watch', ['video' => $video]);
    } else{
        DB::table('dislikes')->insert(
            [
                'user_id' => Auth::user()->id,
                'video_id' => $video->id,
                'created_at' => date('Y/m/d h:i:s', time()),
                'updated_at' => date('Y/m/d h:i:s', time()),
            ],
        );
        DB::table('likes')
            ->select('*')
            ->where('user_id','=',Auth::user()->id)
            ->where('video_id','=',$video->id)
            ->delete();
        return redirect()->route('watch', ['video' => $video]);
    }
})->name('unliked');

Route::get('/subscribed-channels', function() {
    $users = User::select('*')
        ->get();
    return view('subscribed-channels', compact('users'));
})->name('subscribed-channels');


Route::get('/liked-videos', function() {
    $videos = Video::select('*')
        ->get();

    $likes = Like::select('*')
        ->where('user_id', Auth::user()->id)
        ->get();
    return view('liked-videos', compact('videos', 'likes'));
})->name('liked-videos');

Route::get('/search', function(Request $request) {
    $query = $request->query('query','');
    $users = User::select('*')
        ->where('name', 'like', '%'.$query.'%')
        ->get();
    $videos = Video::select('*')
        ->where('title', 'like', '%'.$query.'%')
        ->get();
    return view('searching-page', compact('query', 'users', 'videos'));
})->name('searching-page');

Route::get('/create-user', 'UserController@create')->name('user-create');
Route::post('/save-user', 'UserController@store')->name('save-user');

Route::get('/edit-profile/{user}', function(User $user) {
    return view('edit-profile', compact('user'));
})->name('edit-profile');

Route::put('/update-profile/{user}', function(Request $request, User $user) {
    $data = $request->all();

    $logoimage_path = isset($data['logo']) ? Storage::put('uploads/images', $data['logo']) : null;
    $coverimage_path = isset($data['cover_img']) ? Storage::put('uploads/images', $data['cover_img']) : null;

    $user->name = $data['name'];
    $user->slug = Str::slug($data['name'], '-');
    $user->logo = $logoimage_path;
    $user->cover_img = $coverimage_path;
    $user->update();

    return redirect()->route('channel');
})->name('update-profile');
