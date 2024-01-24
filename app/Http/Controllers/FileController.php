<?php

namespace App\Http\Controllers;

use App\Models\Award;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class FileController extends Controller
{

    public function __construct(private readonly FileService $fileService)
    {
    }

//    public function upload(Request $request)
//    {
//        $request->validate([
//            'file' => 'required|mimes:csv,txt',
//        ]);
//
//        $file = $request->file('file');
//
//        if ($file->isValid()) {
//            $filePath = Storage::disk('csvFiles')->putFileAs('/', $file, $file->getClientOriginalName());
//        }
//
//        $csvFile = File::create([
//            'file_path' => $filePath,
//            'stored_name' => $file->getClientOriginalName()
//        ]);
//
//        $csvFile->save();
//
//        return redirect('/dashboard');
//    }

    public function manualUpload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        if (!$file->isValid()) {
            Log::error('File is not valid');
            return redirect('/');
        }

        try {
            $awards = $this->fileService->parseCsvFile($file->path());
            Validator::make($awards, [
                Award::$validationRules
            ]);

            array_map(fn($awardData) => Award::create($awardData), $awards);

            $file = $this->fileService->storeFile($file);
            $this->fileService->logSuccess($file->file_path, count($awards));

        } catch (\Exception $e) {
            Log::error("Something wrong with data: " . $e->getMessage());
            $this->fileService->logError($file->path());
        }

        return redirect('/');
    }
}
