<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ShortLink;

class ShortLinkController extends Controller
{
    public $short;
     public function index()
    {
        $shortLinks = ShortLink::latest()->get();

        return view('shortenLink', compact('shortLinks'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
           'link' => 'required|url'
        ]);

        $input['link'] = $request->link;
        $input['code'] = Str::random(6);

        $short = new ShortLink;
		$short->link = $request->link;
        $short->code = $input['code'];
		$short->save();

        return redirect('generate-shorten-link')
             ->with('success', 'Shorten Link Generated Successfully!');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function shortenLink($code)
    {
        $find = ShortLink::where('code', $code)->first();

        return redirect($find->link);
    }
}
