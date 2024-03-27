<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ContractController extends Controller
{
    public function index($userid)
    {
        $pattern = storage_path("app/public/contracts/*contract-$userid.pdf");
        $contracts = glob($pattern);

        return view('contract', compact('contracts', 'userid'));
    }

    public function downloadContract()
    {
        $filePath = storage_path('app\public\contracts\contract.pdf');
        $fileName = 'contract.pdf';
        $headers = ['Content-Type: application/pdf'];

        return Response::download($filePath, $fileName, $headers);
    }

    public function uploadContract(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/contracts', $fileName);

            return back()->with('success', 'File uploaded successfully.');
        } else {
            return back()->with('error', 'No file uploaded.');
        }
    }
}
