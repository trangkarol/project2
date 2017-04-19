<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ReportController extends Controller
{
    /**
    * importFileExcel.
     *
     * @return void
     */
    public static function importFileExcel($nameFile)
    {
        $url = config('setting.path.file') . $nameFile;

        return Excel::selectSheetsByIndex(0)->load($url, function($reader) {
            $reader->all();
        })->get();
    }

    /**
    * exportFileExcel.
     *
     * @return void
     */
    public static function exportFileExcel($data, $type, $nameFile)
    {
        return Excel::create($nameFile, function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->loadView('admin.user.export_user', compact('data'));
            });

        })->export($type);
    }

}
