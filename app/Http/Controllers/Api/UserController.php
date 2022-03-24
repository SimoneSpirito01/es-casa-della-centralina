<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {

        $technicians = User::with(['workGroups' => function($query) {
            $query->with('categories');
        }])->get();

        return response()->json($technicians, 200);
    }

    public function free() {

        // tecnici che hanno terminato l'ultimo intervento
        $technicians = User::whereHas('interventions', function($query) {
            $query->where('end_date', '!=', null);
        })->with(['workshop', 'workGroups' => function($q) {
            $q->with('categories');
        }])->get();


        $allTechnicians = User::with(['workshop', 'workGroups' => function($query) {
            $query->with('categories');
        }])->get();

        // tecnici che non hanno mai svolto un intervento
        $noInterventionTechnicians = $allTechnicians->filter(function($value){
            return !count($value->interventions);
        });

        // merge delle 2 collection
        $resultTechnicians = $technicians->merge($noInterventionTechnicians);

        if (!count($resultTechnicians)) {
            return response()->json(["message" => "Nessun risultato trovato"], 404);
        }

        $data = [
            'success' => true,
            'technicians' => $resultTechnicians
        ];

        return response()->json($data, 200);
    }
}
