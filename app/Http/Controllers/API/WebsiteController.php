<?php

namespace App\Http\Controllers\API;

use App\Models\Website;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    public function getAllWebsites()
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => 'Found all websites',
            'data'      => Website::with("creator")->get(),
        ]);
    }

    public function create_website(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|numeric',
            'name'      => 'required',
        ]);

        $website = Website::create($request->all());

        return response()->json([
            'code'      => 201,
            'status'    => 'success',
            'message'   => 'Successfully created website',
            'data'      => $website,
        ]);
    }

    public function update_website(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        if (!$website = Website::find($id)) {
            return response()->json([
                'code'      => 404,
                'status'    => 'error',
                'message'   => "Website wasn't found",
                'data'      => "",
            ]);
        }

        $website->update($request->all());

        return response()->json([
            'code'      => 201,
            'status'    => 'success',
            'message'   => 'Successfully updated website',
            'data'      => $website,
        ]);
    }

    public function delete_website($id)
    {
        if (!$website = Website::find($id)) {
            return response()->json([
                'code'      => 404,
                'status'    => 'error',
                'message'   => "Website wasn't found",
                'data'      => "",
            ]);
        }

        Website::destroy($id);

        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => 'Successfully deleted website',
            'data'      => $website,
        ]);
    }

    public function search_website(string $name)
    {
        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => 'Successfully searched for website',
            'data'      => Website::where('name', 'like', "%{$name}%")->get(),
        ]);
    }

    public function get_subscribers(Request $request, int $website_id)
    {
        if (!$website = Website::find($website_id))
        {
            return response()->json([
                'code'      => 404,
                'status'    => 'error',
                'message'   => "Website wasn't found",
                'data'      => "",
            ]);
        }

        $website->subscribers;

        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'message'   => "Successfully got all subscribers",
            'data'      => [
                "website" => $website,
            ],
        ]);
    }
}
