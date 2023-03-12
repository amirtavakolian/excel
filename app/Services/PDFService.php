<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class PDFService
{
    public static function createPDF($request, $excelFile)
    {
        $file = storage_path('app/public/' . $excelFile);
        $spreadsheet = IOFactory::load($file);

        $writer = IOFactory::createWriter($spreadsheet, 'Mpdf');
        $writer->setPaperSize($request->pagesize);

        $pdfFileName = Str::random(15) . Carbon::now()->timestamp . ".pdf";
        $writer->save(public_path('/files/' . $pdfFileName));

        return $pdfFileName;
    }
}
