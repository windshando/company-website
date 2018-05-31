<?php
namespace App\Http\Controllers\web;

use App\Models\Page;
use App\Models\Type;
use App\Models\Content;
use App\Models\Language;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = DB::table('pages')
        ->join('types', 'type_id', '=', 'types.id')
        ->join('pages_contents', 'pages.id', '=', 'pages_contents.page_id')
        ->join('contents', 'pages_contents.content_id', '=', 'contents.id')
        ->join('languages', 'contents.lang_id', '=', 'languages.id')
        ->select('pages.id','status', 'type', 'title')
        ->where('language', 'en')
        ->get();

        return view('content.index',['pages'=>$pages]);
    }

    /**
     * Disable the specified page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request)
    {
        $id = $request->id;
        $page = Page::find($id);
        $response = 'Page '.$id.' ';
        if($page->status) {
            $page->status = 0;
            $page->save();
            $response .= 'disabled!';
        } else {
            $page->status = 1;
            $page->save();
            $response .= 'enabled!';
        }
        return response()->json(['success' => $response], 200);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;

        $contents = DB::table('pages_contents')
        ->where('page_id', $id)->get();
        DB::table('pages_contents')
        ->where('page_id', $id)->delete();
        foreach ($contents as $content) {
            $contentID = $content->content_id;
            DB::table('contents')->where('id',  $contentID)->delete();
        }
        DB::table('pages')->where('id',  $id)->delete();

        $response = 'Page '.$id.' deleted!';
        return response()->json(['success' => $response], 200);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $pageId = DB::table('pages')->insertGetId(['type_id' => 1]);
        $contentId = DB::table('contents')->insertGetId(['lang_id' => 1]);
        DB::table('pages_contents')->insert(
            ['page_id' => $pageId, 'content_id' => $contentId]
        );
        $response = 'Page '.$pageId.' created!';
        return response()->json(['success' => $response], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show(Content $content)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        //
    }
}