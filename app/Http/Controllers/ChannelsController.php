<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Channel;
use Illuminate\Support\Facades\Session;

class ChannelsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('channels.index', [
            'channels' => Channel::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required'
        ]);

        Channel::create([
            'title' => $request->title,
            'slug' => str_slug($request->title),
        ]);

        Session::flash('success', 'channel created.');

        return redirect()->route('channels.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('channels.edit', [
            'channel' => Channel::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $channel = Channel::find($id);

        $channel->title = $request->title;
        $channel->slug = str_slug($request->title);

        $channel->save();

        Session::flash('success', 'channel edited successfully.');

        return redirect()->route('channels.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Channel::destroy($id);

        Session::flash('success', 'channel Deleted.');

        return redirect()->route('channels.index');
    }
}
