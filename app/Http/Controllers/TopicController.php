<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topic;
use Session;

class TopicController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::all();
        return view('topics.index')->withTopics($topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array('topic_name' => 'required|max:255'));
        $topic = new Topic;
        $topic->topic_name = $request->topic_name;
        $topic->save();

        Session::flash('success', 'New Topic was successfully created!');

        return redirect()->route('topics.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $topic = Topic::find($id);
        return view('topics.single')->withTopic($topic);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $topic = Topic::find($id);
        $topic->topic_name = $request->topic_name;
        $topic->save();

        Session::flash('success', 'New Topic was successfully updated!');

        return redirect()->route('topics.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic = Topic::find($id);
        $topic->news()->detach();

        $topic->delete();

        Session::flash('success', 'The topic was successfully deleted.');
        return redirect()->route('topics.index');
    }
}
