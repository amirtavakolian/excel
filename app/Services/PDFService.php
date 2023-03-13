<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PDFService
{
    public static function createPDF($request, $excelFile)
    {
        $file = storage_path('app/public/' . $excelFile);
        $spreadsheet = IOFactory::load($file);

        $writer = IOFactory::createWriter($spreadsheet, 'Mpdf');
        $writer->setPaperSize($request->pagesize);

        $pdfFileName = explode('.', $request->file('userfile')->getClientOriginalName())[0];

        if(file_exists(public_path('/files/').$pdfFileName.".pdf")) {
            $pdfFileName = Carbon::now()->timestamp . "_" . $pdfFileName;
        }

        $writer->save(public_path('/files/' . $pdfFileName . ".pdf"));

        return $pdfFileName . ".pdf";
    }
}
