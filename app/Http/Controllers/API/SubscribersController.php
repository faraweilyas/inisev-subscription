<?php

namespace App\Http\Controllers\API;

use App\Models\Website;
use App\Models\Subscribers;
use Illuminate\Http\Request;
use App\Events\UserSubscribed;
use App\Http\Controllers\Controller;

class SubscribersController extends Controller
{
    public function getAllSubscribers()
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => 'Found all subscribers',
            'data'      => Subscribers::all(),
        ]);
    }

    public function create_subscriber(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
        ]);

        $subscriber = Subscribers::create($request->all());

        return response()->json([
            'code'      => 201,
            'status'    => 'success',
            'message'   => 'Successfully created subscriber',
            'data'      => $subscriber,
        ]);
    }

    public function update_subscriber(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
        ]);

        if (!$subscriber = Subscribers::find($id)) {
            return response()->json([
                'code'      => 404,
                'status'    => 'error',
                'message'   => "Subscriber wasn't found",
                'data'      => "",
            ]);
        }

        $subscriber->update($request->all());

        return response()->json([
            'code'      => 201,
            'status'    => 'success',
            'message'   => 'Successfully updated subscriber',
            'data'      => $subscriber,
        ]);
    }

    public function delete_subscriber($id)
    {
        if (!$subscriber = Subscribers::find($id)) {
            return response()->json([
                'code'      => 404,
                'status'    => 'error',
                'message'   => "Subscriber wasn't found",
                'data'      => "",
            ]);
        }

        Subscribers::destroy($id);

        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => 'Successfully deleted subscriber',
            'data'      => $subscriber,
        ]);
    }

    public function search_subscriber(string $name)
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => 'Successfully searched for subscriber',
            'data'      => Subscribers::where('name', 'like', "%{$name}%")->get(),
        ]);
    }

    public function subscribe_to_website(Request $request)
    {
        $request->validate([
            'website_id'        => 'required|numeric',
            'subscriber_id'     => 'required|numeric',
        ]);

        $website = Website::find($_POST['website_id']);
        $subscriber = Subscribers::find($_POST['subscriber_id']);

        if (!$website || !$subscriber)
        {
            return response()->json([
                'code'      => 404,
                'status'    => 'error',
                'message'   => "Subscriber or website wasn't found",
                'data'      => "",
            ]);
        }

        $subscriber->subscribe($website);

        UserSubscribed::dispatch($subscriber, $website);

        return response()->json([
            'code'      => 201,
            'status'    => 'success',
            'message'   => "{$subscriber->name} successfully subscribed to {$website->name}",
            'data'      => [
                "website"       => $website,
                "subscriber"    => $subscriber,
            ],
        ]);
    }

    public function get_websites_subscribed_to(Request $request, int $subscriber_id)
    {
        if (!$subscriber = Subscribers::find($subscriber_id))
        {
            return response()->json([
                'code'      => 404,
                'status'    => 'error',
                'message'   => "Subscriber wasn't found",
                'data'      => "",
            ]);
        }

        $subscriber->websites;

        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => "Successfully got all websites subscribed to",
            'data'      => [
                "subscriber" => $subscriber,
            ],
        ]);
    }
}
