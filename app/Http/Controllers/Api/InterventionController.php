<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Intervention;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\ValidateCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class InterventionController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:150',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,9999999.99',
            'estimated_duration' => 'required|numeric|max:255',
            'category' => ['required', 'exists:categories,id', new ValidateCategory($data['technician'])],
            'technician' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $newIntervention = new Intervention();
        $newIntervention->name = $data['name'];
        $newIntervention->description = $data['description'];
        $newIntervention->price = $data['price'];
        $newIntervention->estimated_duration = $data['estimated_duration'];
        $newIntervention->user_id = $data['technician'];
        $newIntervention->workshop_id = User::find($data['technician'])->workshop->id;
        $newIntervention->category_id = $data['category'];
        $newIntervention->start_date = $data['start_date'];
        $newIntervention->end_date = $data['end_date'];
        $newIntervention->save();


        return response()->json([
            'success' => true
        ]);
    }

    public function open()
    {
        $interventions = Intervention::where('end_date', null)->with(['user', 'category', 'workshop'])->get();

        if (!count($interventions)) {
            return response()->json(["message" => "Nessun risultato trovato"], 404);
        }

        $data = [
            'success' => true,
            'interventions' => $interventions
        ];

        return response()->json($data, 200);
    }

    public function latests()
    {

        $interventions = Intervention::where('end_date', '>', now()->subDays(30))->with(['user', 'category', 'workshop'])->orderBy('end_date', 'desc')->orderBy('price', 'desc')->get();

        if (!count($interventions)) {
            return response()->json(["message" => "Nessun risultato trovato"], 404);
        }

        $data = [
            'success' => true,
            'interventions' => $interventions
        ];

        return response()->json($data, 200);
    }

    public function date($date)
    {

        $interventions = Intervention::where('start_date', $date)->orWhere('end_date', $date)->with(['user', 'category', 'workshop'])->get();

        if (!count($interventions)) {
            return response()->json(["message" => "Nessun risultato trovato"], 404);
        }

        $data = [
            'success' => true,
            'interventions' => $interventions
        ];

        return response()->json($data, 200);
    }
}
