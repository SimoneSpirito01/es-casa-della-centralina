<?php

namespace App\Http\Controllers;

use App\Intervention;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function openExportCSV(Request $request)
    {
        $fileName = 'interventions-open.csv';
        $interventions = Intervention::where('end_date', null)->with(['user', 'category', 'workshop'])->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('titolo', 'tecnico', 'categoria', 'officina', 'prezzo', 'descrizione', 'durata prevista', 'data inizio');

        $callback = function () use ($interventions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($interventions as $intervention) {
                $row['titolo']  = $intervention->name;
                $row['tecnico']    = $intervention->user->name . ' ' . $intervention->user->surname;
                $row['categoria']    = $intervention->category->name;
                $row['officina']    = $intervention->workshop->name;
                $row['prezzo']  = $intervention->price;
                $row['descrizione']  = $intervention->description;
                $row['durata prevista']  = $intervention->estimated_duration;
                $row['data inizio']  = $intervention->start_date;

                fputcsv($file, array($row['titolo'], $row['tecnico'], $row['categoria'], $row['officina'], $row['prezzo'], $row['descrizione'], $row['durata prevista'], $row['data inizio']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function openExportJSON()
    {

        $interventions = Intervention::where('end_date', null)->with(['user', 'category', 'workshop'])->get();
        $filename = "interventions-open.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $interventions->toJson(JSON_PRETTY_PRINT));
        fclose($handle);
        $headers = array('Content-type' => 'application/json');
        return response()->download($filename, 'interventions-open.json', $headers);
    }

    public function latestsExportCSV(Request $request)
    {
        $fileName = 'interventions-latests.csv';
        $interventions = Intervention::where('end_date', '>', now()->subDays(30))->with(['user', 'category', 'workshop'])->orderBy('end_date', 'desc')->orderBy('price', 'desc')->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('titolo', 'tecnico', 'categoria', 'officina', 'prezzo', 'descrizione', 'durata prevista', 'data inizio', 'data fine');

        $callback = function () use ($interventions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($interventions as $intervention) {
                $row['titolo']  = $intervention->name;
                $row['tecnico']    = $intervention->user->name . ' ' . $intervention->user->surname;
                $row['categoria']    = $intervention->category->name;
                $row['officina']    = $intervention->workshop->name;
                $row['prezzo']  = $intervention->price;
                $row['descrizione']  = $intervention->description;
                $row['durata prevista']  = $intervention->estimated_duration;
                $row['data inizio']  = $intervention->start_date;
                $row['data fine']  = $intervention->end_date;

                fputcsv($file, array($row['titolo'], $row['tecnico'], $row['categoria'], $row['officina'], $row['prezzo'], $row['descrizione'], $row['durata prevista'], $row['data inizio'], $row['data fine']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function latestsExportJSON()
    {

        $interventions = Intervention::where('end_date', '>', now()->subDays(30))->with(['user', 'category', 'workshop'])->orderBy('end_date', 'desc')->orderBy('price', 'desc')->get();
        $filename = "interventions-latests.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $interventions->toJson(JSON_PRETTY_PRINT));
        fclose($handle);
        $headers = array('Content-type' => 'application/json');
        return response()->download($filename, 'interventions-latests.json', $headers);
    }

    public function dateExportCSV($date)
    {
        $fileName = 'interventions-date.csv';
        $interventions = Intervention::where('start_date', $date)->orWhere('end_date', $date)->with(['user', 'category', 'workshop'])->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('titolo', 'tecnico', 'categoria', 'officina', 'prezzo', 'descrizione', 'durata prevista', 'data inizio', 'data fine');

        $callback = function () use ($interventions, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($interventions as $intervention) {
                $row['titolo']  = $intervention->name;
                $row['tecnico']    = $intervention->user->name . ' ' . $intervention->user->surname;
                $row['categoria']    = $intervention->category->name;
                $row['officina']    = $intervention->workshop->name;
                $row['prezzo']  = $intervention->price;
                $row['descrizione']  = $intervention->description;
                $row['durata prevista']  = $intervention->estimated_duration;
                $row['data inizio']  = $intervention->start_date;
                $row['data fine']  = $intervention->end_date;

                fputcsv($file, array($row['titolo'], $row['tecnico'], $row['categoria'], $row['officina'], $row['prezzo'], $row['descrizione'], $row['durata prevista'], $row['data inizio'], $row['data fine']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function dateExportJSON($date)
    {

        $interventions = Intervention::where('start_date', $date)->orWhere('end_date', $date)->with(['user', 'category', 'workshop'])->get();
        $filename = "interventions-date.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $interventions->toJson(JSON_PRETTY_PRINT));
        fclose($handle);
        $headers = array('Content-type' => 'application/json');
        return response()->download($filename, 'interventions-date.json', $headers);
    }
}
