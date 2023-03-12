<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Http\Controllers\HomeController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

Route::get("/", [HomeController::class, 'index'])->name('home');
Route::post("/upload", [PdfController::class, 'upload'])->name('upload');


Route::get("/amir", function () {

    $file = storage_path('app/public/hello.xlsx');
    $spreadsheet = IOFactory::load($file);
//        $spreadsheet->getActiveSheet()->setRightToLeft(false);

    // $spreadsheet->getActiveSheet()->getStyle('C1:C10')->getAlignment();


    $writer = IOFactory::createWriter($spreadsheet, 'Mpdf');
    $writer->setPaperSize(1);

    $pdfFileName = Str::random(15) . Carbon::now()->timestamp . ".pdf";
    $writer->save(public_path('/files/' . $pdfFileName));

    return $pdfFileName;
});
