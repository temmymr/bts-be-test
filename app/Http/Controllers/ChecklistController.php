<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();
        $checklist = Checklist::query()->where('user_id', $user->id)->get();

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $checklist
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = request()->user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $data = Checklist::query()->create([
            'name' => $request->name,
            'user_id' => $user->id
        ]);

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'data' => $data,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $checklist = Checklist::query()->where('id', $id)->first();

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $checklist
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Checklist::query()->where('id', $id)->first()->delete();
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json([
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
