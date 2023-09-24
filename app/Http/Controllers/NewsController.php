<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\News;
use App\Models\NewsText;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->all_news = News::query()->where('status_id', 1)->get();
        $this->statuses = Status::all();
        $this->languages = Language::all();

        $this->data = [
            'all_news' => $this->all_news,
            'languages' => $this->languages,
            'statuses' => $this->statuses
        ];
    }

    //urls ---
    //http://localhost/task/public/
    //http://localhost/task/public/news

    // method --- get
    public function index()
    {
        $all_news = [];

        foreach ($this->all_news as $news)
        {
            $news_text = $news->text->where('language_code', 'az')->first();

            $all_news += [
                $news->id => [
                    'status' => $news->status->name,
                    'view_count' => $news->view_count,
                    'title' => ($news_text ? $news_text->title : ''),
                    'description' => ($news_text ? $news_text->description : '')
                ]
            ];
        }
        return response()->json($all_news);
    }

    //url --
    // http://localhost/task/public/news/12

    // method --- get
    public function show($id)
    {
        $news = News::find($id);
        if ($news){
            $view_count = $news->view_count;
            $view_count++;

            $news->view_count = $view_count;
            $news->save();

            return response()->json($news);
        }
        else
            return response()->json(['message' => "No data found"], 404);
    }

    //urls ----
    // http://localhost/task/public/news/store
    // data ----
    // {
    //    "status_id" : 1,
    //    "title" : "Test title",
    //    "description" : "Lorem Ipsum test description",
    //    "language_code" : "en"
    // }

    // method -- post
    public function store(Request $request)
    {
        $request = $request->json()->all();

        if (!$request['title'] || strlen($request['title']) == 0)
            return response()->json(['message' => "Title is required"]);
        if (!$request['description'] || strlen($request['description']) == 0)
            return response()->json(['message' => "Description is required"]);

        try {
            $news = new News();
            $news->status_id = $request['status_id'];
            $news->view_count = 0;
            $news->save();
            $last_id = DB::getPdo()->lastInsertId();

            $news_text = new NewsText();
            $news_text->title = $request['title'];
            $news_text->description = $request['description'];
            $news_text->news_id = $last_id;
            $news_text->language_code = $request['language_code'];
            $news_text->save();

            return response()->json(['message' => "News added successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "News couldn't be added". $e]);
        }
    }

    // url --
    // http://localhost/task/public/news/1/update
    // data ---
    // {
    //    "status_id" : 2,
    //    "title" : "ads",
    //    "description" : "",
    //    "language_code" : "en"
    // }

    // method --- put

    public function update(Request $request, $id)
    {
        $request = $request->json()->all();

        if (!$request['title'] || strlen($request['title']) == 0)
            return response()->json(['message' => "Title is required"]);
        if (!$request['description'] || strlen($request['description']) == 0)
            return response()->json(['message' => "Description is required"]);

        $news = News::query()->findOrFail($id);
        $news_text = NewsText::query()->where(
            [
                'news_id' => $id,
                'language_code' => $request['language_code']
            ])->first();

        try {
            $news->status_id = $request['status_id'];
            $news->save();

            $news_text->title = $request['title'];
            $news_text->description = $request['description'];
            $news_text->save();

            return response()->json(['message' => "News updated successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "News couldn't be updated". $e->getMessage()]);
        }
    }

    // url ---
    // http://localhost/task/public/news/1
    // method -- delete

    public function destroy($id)
    {
        try {
            NewsText::where('news_id', $id)->delete();
            News::destroy($id);
            return response()->json(['message' => "News deleted successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "News couldn't be deleted". $e]);
        }
    }

}
