<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Topic;
use Session;
use Response;
use Illuminate\Support\Str;

class NewsApiController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::with(
            array('topics'=>function($query){
                $query->select('topic_name');
            })
            )->get(); 
        return Response::json(['news' => $news], 200);

    }

    public function published()
    {
        $news = News::where('status','Published')->with(
            array('topics'=>function($query){
                $query->select('topic_name');
            })
            )->get(); 
        return Response::json(['news' => $news], 200);

    }

    public function draft()
    {
        $news = News::where('status','Draft')->with(
            array('topics'=>function($query){
                $query->select('topic_name');
            })
            )->get(); 
        return Response::json(['news' => $news], 200);

    }

    public function deleted()
    {
        $news = News::where('status','Deleted')->with(
            array('topics'=>function($query){
                $query->select('topic_name');
            })
            )->get(); 
        return Response::json(['news' => $news], 200);

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
        $this->validate($request, array('title' => 'required|max:255','body' => 'required|max:255'));
        $news = new News;
        $news->title = $request->title;
        $news->status = $request->status;
        $news->title_slug = Str::slug($request->get('title'));
        $news->body = $request->body;
        $news->save();

        $news->topics()->sync($request->topics,false);

        return Response::json(['news' => $news], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::with(
            array('topics'=>function($query){
                $query->select('topic_name');
            })
            )->find($id); 
       
        return Response::json(['news' => $news], 200);
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
        $news = News::find($id);
        $news->title = $request->title;
        $news->status = $request->status;
        $news->title_slug = Str::slug($request->get('title'));
        $news->body = $request->body;
        $news->save();

        $news->topics()->sync($request->topics);

        return Response::json(['news' => $news->with(array('topics'=>function($query){
                $query->select('topic_name');
                }))->find($id)], 200);
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

        return ('Berhasil Dihapus');
    }
}
