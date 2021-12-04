<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Video;
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

    public function create() {
        // $video = Video::where("id", $id)->first();
        // if (!$video) {
        //     return response()->json(null, 404);
        // }

        // Video::destroy($video->id);
        // return response()->json(null, 204);
    }
}
