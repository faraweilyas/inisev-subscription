<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\API\PostsController;
use App\Http\Controllers\API\WebsiteController;
use App\Http\Controllers\API\SubscribersController;

/*
 * Endpoints for Websites
 */
Route::get('/websites', function(Request $request)
{
    return (new WebsiteController)->getAllWebsites();
});

Route::post('/websites', function(Request $request)
{
    return (new WebsiteController)->create_website($request);
});

Route::put('/websites/{id}', function(Request $request, $id)
{
    return (new WebsiteController)->update_website($request, $id);
});

Route::delete('/websites/{id}', function($id)
{
    return (new WebsiteController)->delete_website($id);
});

Route::get('/websites/search/{name}', function($name)
{
    return (new WebsiteController)->search_website($name);
});

Route::get('/websites:subscribers/{website_id}', function(Request $request, int $website_id)
{
    return (new WebsiteController)->get_subscribers($request, $website_id);
});

/*
 * Endpoints for Subscribers
 */
Route::get('/subscribers', function(Request $request)
{
    return (new SubscribersController)->getAllSubscribers();
});

Route::post('/subscribers', function(Request $request)
{
    return (new SubscribersController)->create_subscriber($request);
});

Route::put('/subscribers/{id}', function(Request $request, $id)
{
    return (new SubscribersController)->update_subscriber($request, $id);
});

Route::delete('/subscribers/{id}', function($id)
{
    return (new SubscribersController)->delete_subscriber($id);
});

Route::get('/subscribers/search/{name}', function($name)
{
    return (new SubscribersController)->search_subscriber($name);
});

Route::post('/subscribe:to:website', function(Request $request)
{
    return (new SubscribersController)->subscribe_to_website($request);
});

Route::get('/subscribers:websites/{subscriber_id}', function(Request $request, int $subscriber_id)
{
    return (new SubscribersController)->get_websites_subscribed_to($request, $subscriber_id);
});

/*
 * Endpoints for Posts
 */
Route::get('/posts', function(Request $request)
{
    return (new PostsController)->getAllPosts();
});

Route::post('/posts', function(Request $request)
{
    return (new PostsController)->create_post($request);
});
