<?php

namespace App\Http\Controllers;

use App\Models\Listitem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ListitemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        $item_name = Listitem::query()->where('checklist_id', $id)->get();

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $item_name
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id)
    {
        $request->validate([
            'itemName' => ['required', 'string', 'max:255'],
        ]);

        $data = Listitem::query()->create([
            'item_name' => $request->itemName,
            'checklist_id' => $id
        ]);

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'data' => $data,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, string $item_id)
    {
        $item = Listitem::query()->where('checklist_id', $id)->where('id', $item_id)->first();

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $item
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $checklistId, string $checklistItemId)
    {
        $request->validate([
            'itemName' => ['required', 'string', 'max:255'],
        ]);

        $item = Listitem::query()->where('checklist_id', $checklistId)->where('id', $checklistItemId)->first();

        $item->query()->update([
            'item_name' => $request->itemName,
        ]);

        return response()->json([
            'code' => Response::HTTP_CREATED,
            'data' => $item,
        ], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $checklistId, string $checklistItemId)
    {
        try {
            Listitem::query()->where('checklist_id', $checklistId)->where('id', $checklistItemId)->first()->delete();
            return response()->noContent();
        } catch (\Exception $e) {
            return response()->json([
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => $e
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
