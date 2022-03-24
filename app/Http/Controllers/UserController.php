<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function freeExportCSV(Request $request)
    {
        $fileName = 'technician-free.csv';

        // tecnici che hanno terminato l'ultimo intervento
        $technicians = User::whereHas('interventions', function ($query) {
            $query->where('end_date', '!=', null);
        })->with(['workshop', 'workGroups' => function ($q) {
            $q->with('categories');
        }])->get();


        $allTechnicians = User::with(['workshop', 'workGroups' => function ($query) {
            $query->with('categories');
        }])->get();

        // tecnici che non hanno mai svolto un intervento
        $noInterventionTechnicians = $allTechnicians->filter(function ($value) {
            return !count($value->interventions);
        });

        // merge delle 2 collection
        $resultTechnicians = $technicians->merge($noInterventionTechnicians);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('nome e cognome', 'officina', 'permessi', 'email', 'data di assunzione');

        $callback = function () use ($resultTechnicians, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($resultTechnicians as $technician) {
                $row['nome e cognome']  = $technician->name . ' ' . $technician->surname;
                $row['officina']    = $technician->workshop->name;

                $categories = [];

                //ciclo sui gruppi e sulle categorie associate ai gruppi
                foreach ($technician->workGroups as $workGroup) {
                    foreach ($workGroup->categories as $category) {
                        if (!in_array($category->name, $categories)) $categories[] = $category->name;
                    }
                }

                //  concateno le categorie e aggiungo la virgola
                $strCategories = '';
                for ($i = 0; $i < count($categories); $i++) {
                    $strCategories .= $categories[$i];

                    if ($i != count($categories) - 1) $strCategories .= ', ';
                }

                $row['permessi'] = $strCategories;

                $row['email']    = $technician->email;
                $row['data di assunzione']  = $technician->hire_date;

                fputcsv($file, array($row['nome e cognome'], $row['officina'], $row['permessi'], $row['email'], $row['data di assunzione']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function freeExportJSON()
    {

        // tecnici che hanno terminato l'ultimo intervento
        $technicians = User::whereHas('interventions', function ($query) {
            $query->where('end_date', '!=', null);
        })->with(['workshop', 'workGroups' => function ($q) {
            $q->with('categories');
        }])->get();


        $allTechnicians = User::with(['workshop', 'workGroups' => function ($query) {
            $query->with('categories');
        }])->get();

        // tecnici che non hanno mai svolto un intervento
        $noInterventionTechnicians = $allTechnicians->filter(function ($value) {
            return !count($value->interventions);
        });

        // merge delle 2 collection
        $resultTechnicians = $technicians->merge($noInterventionTechnicians);

        $filename = "technician-free.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $resultTechnicians->toJson(JSON_PRETTY_PRINT));
        fclose($handle);
        $headers = array('Content-type' => 'application/json');
        return response()->download($filename, 'technician-free.json', $headers);
    }
}
