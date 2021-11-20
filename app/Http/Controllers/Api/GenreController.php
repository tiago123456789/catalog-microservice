<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenreRequest;
use App\Model\Genre;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class GenreController extends Controller
{
    
    public function findAll() {
        return Genre::all();
    }

    public function findById($id) {
        $genre = Genre::where("id", "=", $id)->first();
        if (!$genre) {
            return response()->json(null, 404);
        }
        return $genre;
    }

    public function delete($id) {
        $genre = Genre::where("id", "=", $id)->first();
        if (!$genre) {
            return response()->json(null, 404);
        }

        Genre::destroy($genre->id);
        return response()->json(null, 204);
    }

    public function create(GenreRequest $request) {
        Genre::create($request->all());
        return response()->json(null, 201);
    }

    public function update(GenreRequest $request, $id) {
        $genre = Genre::where("id", "=", $id)->first();
        if (!$genre) {
            return response()->json(null, 404);
        }

        Genre::where("id", "=", $id)->update($request->all());
        return response()->json(null, 204);
    }
}
