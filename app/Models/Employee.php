<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    const BADGE_SIZE = 500; // This can be changes as per requirements. For now, I will keep it to 500

    protected $fillable = [
        'employee_id',
        'user_name',
        'name_prefix',
        'first_name',
        'middle_initial',
        'last_name',
        'gender',
        'email',
        'date_of_birth',
        'time_of_birth',
        'age_in_years',
        'date_of_joining',
        'age_in_company',
        'phone_no',
        'place_name',
        'county',
        'city',
        'zip',
        'region',
    ];

    public static function returnCSVFiles($request)
    {
        $file = $request->file('file');
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);

        $save_data=[];
        foreach ($csv as $record) {
            // dd($record);
            $save_data[]=[
                'employee_id' => $record['Emp ID'],
                'user_name' => $record['User Name'],
                'name_prefix' => $record['Name Prefix'],
                'first_name' => $record['First Name'],
                'middle_initial' => $record['Middle Initial'],
                'last_name' => $record['Last Name'],
                'gender' => $record['Gender'],
                'email' => $record['E Mail'],
                'date_of_birth' => $record['Date of Birth'],
                'time_of_birth' => $record['Time of Birth'],
                'age_in_years' => $record['Age in Yrs.'],
                'date_of_joining' => $record['Date of Joining'],
                'age_in_company' => $record['Age in Company (Years)'],
                'phone_no' => $record['Phone No. '],
                'place_name' => $record['Place Name'],
                'county' => $record['County'],
                'city' => $record['City'],
                'zip' => $record['Zip'],
                'region' => $record['Region']
            ];
        }

        // Let's start DB transaction and try to insert data in badges for optimize performance
        // rollback the changes if anything went wrong
        DB::transaction(function () use ($save_data) {
            try {
                foreach (array_chunk($save_data, self::BADGE_SIZE) as $batch) {
                    DB::table('employees')->insert($batch);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        });
    }
}
