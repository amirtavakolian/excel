<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PDFService;
use App\Services\UploadService;
use Illuminate\Support\Facades\Validator;

class PdfController extends Controller
{
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userfile' => 'required|file|mimes:xlsx,xls,xlsb,xlsm.xlm,xla,xlc,xlw,xlt',
            'pagesize' => 'required|between:1,66'
        ]);

        if ($validator->fails()) {
            return redirect()->route('home')->with('bad-file-extension', 'file extension is not correct');
        }

        $excelFile = UploadService::upload($request->userfile);
        $pdfFileName = PDFService::createPDF($request, $excelFile);

        return redirect()->back()->with('filename', $pdfFileName);
    }
}
