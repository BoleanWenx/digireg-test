<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $todo = Todo::all();

            return response()->json($todo);
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];

            return response()->json($error);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'desc'  => 'required'
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ]);
            }
            
            $todo = Todo::create([
                'title' => $request->title,
                'desc'  => $request->desc
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Sukses membuat data baru',
                'data'    => $todo
            ]);
    
        } catch (QueryException $e) {
            $error = [
                'error' => $e->getMessage()
            ];
            return response()->json($error);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $todo = Todo::findOrFail($id);

            return response()->json([
                'status'  => 200,
                'message' => 'Sukses mendapatkan data',
                'data'    => $todo 
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Data tidak ditemukan'
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'desc'  => 'required'
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors(),
                ]);
            }

            $todo = Todo::find($id);

            if ($todo == null) {
                return response()->json([
                    'error' => 'Data tidak ditemukan' 
                ]);
            }

            $todo->update([
                'title' => $request->title,
                'desc'  => $request->desc 
            ]);

            return response()->json([
                'status'  => 200,
                'message' => 'Sukes mengubah data',
                'data'    => $todo
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Data tidak ditemukan'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Todo::findOrFail($id)->delete();

            return response()->json([
                'status'  => 200,
                'message' => 'Sukses menghapus data'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Data tidak ditemukan'
            ]);
        }
    }
}
