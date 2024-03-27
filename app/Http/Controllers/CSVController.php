<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\advertisement\Advertisement;
use Illuminate\Support\Facades\Response;

class CSVController
{
    public function createcsv($userid){
        $advertisements = Advertisement::where('user_id', $userid)->get();
        $data = array(
            array('title', 'description', 'type', 'expires_at'),
        );

        foreach($advertisements as $advertisement){
            $data[] = array($advertisement->title, $advertisement->description, $advertisement->type, $advertisement->expires_at);
        }
        $csvFilePath = 'advertisementsUserid' . $userid . '.csv';
        $csvFile = fopen($csvFilePath, 'w');
        foreach ($data as $row) {
            fputcsv($csvFile, $row);
        }

        fclose($csvFile);

        $headers = [
            'Content-Type' => 'text/csv',
        ];

        $response = Response::download($csvFilePath, 'data.csv', $headers);

        return $response;
    }
    public function importcsv(Request $request, $userid)
    {
        // Validate the uploaded file
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Check if file was uploaded successfully
        if ($request->hasFile('csv_file')) {
            $csvFile = $request->file('csv_file');
            $csvFileName = 'advertisementsUserid_' . $userid . '_' . time() . '.' . $csvFile->getClientOriginalExtension();
            $csvFile->storeAs('csv_imports', $csvFileName);
            $file = fopen(storage_path('app/csv_imports/' . $csvFileName), 'r');
            fgetcsv($file);

            while (($row = fgetcsv($file)) !== false) {
                $advertisement = new Advertisement();
                $advertisement->title = $row[0];
                $advertisement->description = $row[1];
                $advertisement->type = $row[2];
                $advertisement->expires_at = $row[3];
                $advertisement->user_id = $userid;
                $advertisement->save();
            }
            fclose($file);

            return redirect()->route('sellerprofile', ['userId' => $userid]);
        }

        return response()->json(['error' => 'Failed to upload or process CSV file.'], 400);
    }
}
