<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function saveCsvData(Request $request)
    {
        $data = $request->input('data');
        
        // Prepare CSV data
        $csvData = implode(",", $data) . "\n";

        // Save CSV data to file
        $csvFilePath = storage_path('logs/request_traffic.csv');
        Storage::append($csvFilePath, $csvData);

        return response()->json(['message' => 'CSV data saved successfully.']);
    }
}

