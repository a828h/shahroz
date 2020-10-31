<?php

use App\Campaign;
use App\Content;
use App\ContentPublisher;
use App\ContentRow;
use App\Document;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('storage/{filename}', function ($filename) {
    $path = storage_path($filename);

    if (!Storage::exists($path)) {
        abort(404);
    }

    $file = Storage::get($path);
    $type = Storage::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

// Route::get('fff/{index?}', function ($index = 0) {
//     $contents = Content::all();
//     $contents = $contents->slice($index * 500, 500);
//     $x = 0;
//     foreach ($contents as $content) {
//         $contentRows = $content->contentRows;
//         if (count($contentRows) === 1) {
//             $content->update([
//                 'media_type' => 'content'
//             ]);

//             $document = Document::where('documentable_type', 'App\ContentRow')->where('documentable_id', $contentRows[0]->id);

//             $document->update([
//                 'type' => 'content_media',
//                 'documentable_id' => $content->id,
//                 'documentable_type' => 'App\Http\Controllers\Admin\Content',
//             ]);
//             $x++;
//         }
//     }
//     dd('done', $x);
// });

Route::get('storage/{id}', function ($id) {
    $document = Document::find($id);
    $path = $document->path;

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Auth::routes();

Route::get('/', function () {
    if (!auth()->check()) {
        return redirect('/login');
    } else if (auth()->user()->isAdmin) {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/dashboard');
    }
})->name('home');

Route::middleware(['web', 'auth'])->group(
    function () {
        Route::get('/profile', 'UserController@profile')->name('profile');
        Route::put('/profile', 'UserController@update')->name('profile.update');
    }
);

Route::middleware(['web', 'auth', 'admin'])->namespace('Admin')->name('admin.')->prefix('admin')->group(
    function () {
        Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
        Route::resource('users', 'UserController');
        Route::resource('campaigns', 'CampaignController')->except(['edit', 'update']);

        Route::get('campaigns/{campaign}/edit/{tab?}', 'CampaignController@edit')->name('campaigns.edit');
        Route::put('campaigns/{campaign}/update', 'CampaignController@update')->name('campaigns.update');
        Route::put('campaigns/{campaign}/update/contents', 'CampaignController@updateContents')->name('campaigns.updateContents');

        Route::put('campaigns/{campaign}/updateCampaignPublishers', 'CampaignController@updateCampaignPublishers')
            ->name('campaigns.updateCampaignPublishers');
        Route::put('campaigns/{campaign}/updateNewPublishers', 'CampaignController@updateNewPublishers')
            ->name('campaigns.updateNewPublishers');
        Route::get('drafts', 'CampaignController@drafts')->name('drafts.index');
        Route::get('drafts/create', 'CampaignController@createDrafts')->name('drafts.create');
        Route::post('drafts/store', 'CampaignController@storeDrafts')->name('drafts.store');
        Route::resource('publishers', 'PublisherController');
        Route::resource('categories', 'CategoryController');
        Route::resource('brands', 'BrandController');

        Route::get('dropzone/fetch/{type}/{id}', 'DropzoneController@fetch')->name('dropzone.fetch');
        Route::get('dropzone/{type}/{id}', 'DropzoneController@index')->name('dropzone.index');
        Route::post('dropzone/upload/{type}/{id}', 'DropzoneController@upload')->name('dropzone.upload');
        Route::get('dropzone/delete', 'DropzoneController@delete')->name('dropzone.delete');
    }
);


Route::middleware(['web', 'auth', 'notAmin'])->namespace('Client')->group(
    function () {
        Route::get('/dashboard', 'PagesController@dashboard')->name('dashboard');
        // Route::resource('users', 'UserController');
        Route::resource('campaigns', 'CampaignController');
        Route::get('dropzone/fetch/{type}/{id}', 'DropzoneController@fetch')->name('dropzone.fetch');
        Route::get('/campaigns/{campaign}/excel-download', 'CampaignController@downloadExcel')->name('campaigns.downloadExcel');
    }
);
