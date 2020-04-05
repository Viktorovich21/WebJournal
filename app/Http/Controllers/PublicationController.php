<?php

namespace App\Http\Controllers;

use App\Publication;
use App\User;
use Validator;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function getPublications(Request $request){
        if ($request['creator']) {
            $publ = Publication::where('creator_id', $request['creator'])->get();
        } else {
            $publ = Publication::orderBy('updated_at', 'desc')->get()->take(10);
        }
        return response()->json(['publications' => $publ, 'count_of_publications' => count($publ)]);
    }

    public function getPublicationById($id){
        $publ = Publication::where('id', $id)->firstOrFail();
        return response()->json(['publication' => $publ]);
    }

    public function createPublication(Request $request){
        $validate = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required|max:500',
            'text' => 'required|max:1500',
            'token' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'error' => $validate->errors()
            ]);
        }

        $creator_user = User::where('token', $request['token'])->firstOrFail();

        $publication_data = $request->all();
        $publication_data['creator_id'] = $creator_user->id;
        $publication_data['stars'] = 0;
        $publication = Publication::create($publication_data);
        return response()->json([
            'publication' => $publication
        ]);
    }
}
