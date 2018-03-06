<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Topic;
use Session;
use Response;
use Illuminate\Support\Str;

class NewsController extends Controller
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
        $news = News::all();
        // return Response::json(['news' => $news], 200);
        // return $news;
        return view('news.index')->withNews($news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $topics = Topic::all();
        return view('news.create')->withTopics($topics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $this->validate($request, array('title' => 'required|max:255','body' => 'required|max:255'));
        $news = new News;
        $news->title = $request->title;
        $news->title_slug = Str::slug($request->get('title'));
        $news->body = $request->body;
        $news->save();

        $news->topics()->sync($request->topics,false);

        Session::flash('success', 'New News was successfully created!');

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return view('news.single')->withNews($news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $topics = Topic::all();
        return view('news.edit')->withNews($news)->withTopics($topics);
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
        $news = News::find($id);
        $news->title = $request->title;
        $news->title_slug = Str::slug($request->get('title'));
        $news->body = $request->body;
        $news->save();

        $news->topics()->sync($request->topics);

        Session::flash('success', 'New News was successfully created!');

        return redirect()->route('news.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);
        $news->topics()->detach();

        $news->delete();

        Session::flash('success', 'The topic was successfully deleted.');
        return redirect()->route('news.index');
    }
}
