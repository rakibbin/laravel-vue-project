<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class YearController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years=Year::orderBy('id','desc')->get();
        return $this->sendResponse($years,'year list fetched successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'current_year' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(),422);
        }

        $yearAll = Year::all();
        if (!$yearAll->isEmpty()) {
            $latestYear = Year::latest()->first();
            $latestYear->update(['current_year' => 'no']);
        }

        $input = $request->all();
        $year = Year::create($input);
        return $this->sendResponse($year, 'year created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $years=Year::find($id);
        return $this->sendResponse($years,'Year fetched successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'current_year' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(),422);
        }
        $input = $request->all();
        $year = Year::find($id)->update($input);
        return $this->sendResponse($year, 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $years=Year::find($id)->delete();
        return $this->sendResponse($years,'Year deleted successfully!');
    }
}
