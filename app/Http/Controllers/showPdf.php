<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class showPdf extends Controller{
    public function pdfView($filename)
{
    $path = '/public/contracts/' . $filename; // Adjust the path to match your storage structure
    if (Storage::disk('local')->exists($path)) {
        $file = Storage::disk('local')->get($path);
        
        // Set the appropriate HTTP response headers
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ];
        return response($file, 200, $headers);
    } else {
    }
}
}
