<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Model\Video;
use DB;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function findAll() {
        return Video::all();
    }

    public function findById($id) {
        $video = Video::where("id", $id)->first();
        if (!$video) {
            return response()->json(null, 404);
        }
        return response()->json($video, 200);
    }

    public function destroy($id) {
        $video = Video::where("id", $id)->first();
        if (!$video) {
            return response()->json(null, 404);
        }

        Video::destroy($video->id);
        return response()->json(null, 204);
    }

    public function create(VideoRequest $request) {
        DB::transaction(function () use ($request) {
            $video = Video::create($request->all());
            $video->categories()->sync($request->get("categories_id"));
            $video->genres()->sync($request->get("genres_id"));
        });
       
        return response()->json(null, 201);
    }

    public function update($id, VideoRequest $request) {
        $video = Video::where("id", "=", $id)->first();
        if (!$video) {
            return response()->json(null, 404);
        }

        Video::where("id", "=", $id)->update($request->all());
        return response()->json(null, 204);
    }
}
