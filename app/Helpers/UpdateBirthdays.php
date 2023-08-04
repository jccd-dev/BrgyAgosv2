<?php

namespace App\Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard\ProfilingModel;

class UpdateBirthdays {

    // update the age once a month
    public static function updateAge(){
        $update_date = DB::table('is_update')->where('id', 1)->first();
        if($update_date->update_date){
            $carbonDate = Carbon::parse($update_date->update_date);

            $formattedMonth = $carbonDate->format('Y-m');

            if($formattedMonth == Carbon::now()->format('Y-m')){
                return;
            }
        }

        $currentMonth = Carbon::now()->format('m');
        $residents = ProfilingModel::whereRaw("MONTH(dob) = {$currentMonth}")->get();

        foreach($residents as $resident){
            $resident->age = $resident->age + 1;
            $resident->save();
        }

        DB::table('is_update')->where('id', 1)->update([
            'update_date' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

    }
}
