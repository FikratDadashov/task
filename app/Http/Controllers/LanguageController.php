<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Status;
use Exception;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    public function __construct()
    {

        $this->languages = Language::all();
        $this->statuses = Status::all();

        $this->data = [
            'languages' => $this->languages,
            'statuses' => $this->statuses
        ];
    }

    // url
    // http://localhost/task/public/language
    // method -- get
    public function index()
    {
        return response()->json($this->data);
    }

    // url --
    // http://localhost/task/public/language/store
    // method -- post
    // data --
    //{
    //    "name" : "Ruski yazik",
    //    "code" : "ru",
    //    "status_id" : 1
    //}
    public function store(Request $request)
    {
        $request = $request->json()->all();

        // validate form inputs with some rules
        if (!$request['name'] || strlen($request['name']) == 0)
            return response()->json(['message' => "Name is required"]);
        if (!$request['code'] || strlen($request['code']) == 0)
            return response()->json(['message' => "Code is required"]);

        // create model entry with given inputs
        try {
            $language = new Language();
            $language->status_id = $request['status_id'];
            $language->name = $request['name'];
            $language->code = $request['code'];
            $language->save();

            return response()->json(['message' => "Language added successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "Language couldn't be added". $e]);
        }
    }


    // urls ---
    // http://localhost/task/public/language/3/update
    // method -- put
    // data
    // {
    //    "name" : "Russky yazik",
    //    "code" : "ru",
    //    "status_id" : 1
    // }

    public function update(Request $request, $id)
    {
        $request = $request->json()->all();

        if (!$request['name'] || strlen($request['name']) == 0)
            return response()->json(['message' => "Name is required"]);
        if (!$request['code'] || strlen($request['code']) == 0)
            return response()->json(['message' => "Code is required"]);

        $language = Language::query()->findOrFail($id);

        try {
            $language->status_id = $request['status_id'];
            $language->name = $request['name'];
            $language->code = $request['code'];
            $language->save();

            return response()->json(['message' => "Language updated successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "Language couldn't be updated". $e->getMessage()]);
        }
    }

    // url ---
    // http://localhost/task/public/language/1
    // method -- delete

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        try {
            Language::destroy($id);
            return response()->json(['message' => "Language deleted successfully"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => "Language couldn't be deleted". $e]);
        }
    }

}
