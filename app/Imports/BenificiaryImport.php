<?php

namespace App\Imports;

use App\Models\Beneficiary;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Validators\Failure;
use Throwable;

class BenificiaryImport implements
    ToCollection, 
    WithHeadingRow, 
    WithValidation, 
    WithBatchInserts,
    SkipsEmptyRows
{
    use Importable;

    public function __construct($input)
    {
        $this->input = $input;
    }
    
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Beneficiary::create([
                'project_id'            => $this->input['project_id'],
                'name'                  => $row['name'],
                'father_name'           => $row['father_name'],
                'gender'                => $row['gender'],
                'marital_status'        => $row['marital_status'],
                'province'              => $row['province'],
                'district'              => $row['district'],
                'village'               => $row['village'],
                'contact'               => $row['contact'],
                'type_of_assistance'    => $row['type_of_assistance'],
                'residential_type'      => $row['residential_type'],
                'remarks'               => $row['remarks']
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.name'              => ['required'],
            '*.father_name'       => ['required'],
            '*.gender'            => ['required','in:Male,Female'],
            '*.marital_status'    => ['required','in:Single,Engaged,Married,Divorced,Widow'],
            '*.province'          => ['required'],
            '*.district'          => ['required'],
            '*.village'           => ['required'],
            '*.contact'           => ['required'],
            '*.type_of_assistance'=> ['required'],
            '*.residential_type'  => ['required','in:Local Resident,Kochi,IDP,Refugee']
            
        ];
    }

    public function batchSize(): int
    {
        return 50;
    }
}
