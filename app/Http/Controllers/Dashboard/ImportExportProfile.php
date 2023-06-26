<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Dashboard\ProfilingModel;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;

class ImportExportProfile extends Controller
{

    private int $chunk_size = 500;
    public function __construct(
        public ProfilingModel $profilingModel
    ){
        $this->$profilingModel = $profilingModel;
    }

     /**
     * @uses IMPORT_EXCEL_FILE
     * @param Request $request : hanlde data sent by post from axios
     * @return JsonResponse
     * @description : this function is use to insert data from a excel file and
     *                when the data is already in the database it only updates
     */
    public function import_excel_file(Request $request): JsonResponse{

        $validator = Validator::make($request->all(),['file' => 'required|mimes:excel,csv|file']);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $excel_file = $request->file('file');
        $spreadsheet = IOFactory::load($excel_file);
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestRow();

        for($startRow = 2; $startRow <= $highestRow; $startRow += $this->chunk_size) {
            // adjust the chunk size for the remaining rows
            $remainingRows = $highestRow - $startRow + 1;
            $currentChunkSize = min($this->chunk_size, $remainingRows);

            $endRow = $startRow + $currentChunkSize - 1;

            $dataChunk = $sheet->rangeToArray('A' . $startRow . ':Z' . $endRow, null, true, true, true);

            $is_success = true;
            // dd($dataChunk);
            foreach ($dataChunk as $row){
                $rowData = [
                    'fname'     => $row['A'],
                    'mname'     => $row['B'],
                    'lname'     => $row['C'],
                    'suffix'    => $row['D'],
                    'dob'       => date('Y/m/d', strtotime($row['E'])),
                    'age'       => $row['F'],
                    'sex'       => $row['G'],
                    'cstatus'   => $row['H'],
                    'zone'      => $row['I'],
                    'bplace'    => $row['J'],
                    'cpnumber'  => $row['K'],
                    'email'     => $row['L'],
                    'pwd'       => $row['M'],
                    'senior'    => $row['N']
                ];

                $inserted = ProfilingModel::updateOrInsert(
                    ['fname' => $row['A'], 'lname'=> $row['C']],
                    $rowData
                );

                if(!$inserted){
                    $is_success = false;

                }
            }

            if(!$is_success){
                break;
            }
        }

        if($is_success){
            return response()->json(['success' => 'New Profile Inserted'], 200);
        }
        else{
            return response()->json(['errors' => "Server Error, Not all data Inserted"], 500);
        }
    }

    public function exportProfiles(){

        // spreadsheet object
        $spreedsheet = new Spreadsheet();
        $sheet = $spreedsheet->getActiveSheet();

        // header of the table on the first row of the sheet
        $sheet->fromArray([
            'First Name', 'Middle Name', 'Last Name',
            'Suffix', 'Date of Birth', 'Age', 'Sex',
            'Civil Status', 'Zone', 'Birth Place', 'Contact Number',
            'Email', 'PWD', 'Senior'
        ], null, 'A1');

        ProfilingModel::select('fname','mname','lname','suffix','dob','age','sex','cstatus','zone','bplace','cpnumber','email','pwd','senior')
            ->chunk($this->chunk_size, function ($data) use ($sheet){
                $next_row = $sheet->getHighestRow() + 1;

                foreach ($data as $item) {
                    $rowData = [
                        $item->fname,
                        $item->mname,
                        $item->lname,
                        $item->suffix,
                        date('m/d/Y', strtotime($item->dob)), // Assuming 'dob' is a DateTime instance
                        $item->age,
                        $item->sex,
                        $item->cstatus,
                        $item->zone,
                        $item->bplace,
                        $item->cpnumber,
                        $item->email,
                        $item->pwd ?? 0,
                        $item->senior ?? 0
                    ];

                    $sheet->fromArray($rowData, null, 'A'. $next_row);
                    $next_row++;
                }
            });

        $writer = new Xlsx($spreedsheet);

        $file_name = 'ResidentProfile_'.date('YmdHis').'.xlsx';

        // dd($file_name);
        return response()->streamDownload( function () use ($writer){
            $writer->save('php://output');
        }, $file_name);
    }
}
