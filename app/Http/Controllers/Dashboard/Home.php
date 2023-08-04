<?php

namespace App\Http\Controllers\Dashboard;
use App\Models\Dashboard\Families;
use App\Models\Dashboard\Household;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Dashboard\ProfilingModel;

class Home extends Controller{

    public function render(){
        $counts = $this->dashboard_counting();
        return view('dashboard.home', $counts);
    }

    //send data to dashboard page
    public function dashboard_counting() {

        $profileModel = new ProfilingModel();

        return [
            'total'     => $profileModel::all()->count(),
            'female'    => $profileModel::where('sex', 'Female')->count(),
            'male'      => $profileModel::where('sex', 'Male')->count(),
            'senior'    => $profileModel::where('senior', 'sc')->count(),
            'household' => Household::all()->count(),
            'families'  => Families::all()->count(),
            'ages'      => $this->age_bracket(),
            'structure' => $this->house_structure(),
            'ownership' => $this->house_ownership(),
            'occupation'=> $this->occupations(),
            'facility'  => $this->house_facilities()
        ];
    }

    //summarize the age bracket of the residents in the database records
    public function age_bracket(){
        // Generate age brackets subquery
        $ageBracketsSubquery = DB::table(DB::raw('(
            SELECT "< 1" AS age_bracket
            UNION ALL
            SELECT "1-2" AS age_bracket
            UNION ALL
            SELECT "3-5" AS age_bracket
            UNION ALL
            SELECT "6-12" AS age_bracket
            UNION ALL
            SELECT "13-17" AS age_bracket
            UNION ALL
            SELECT "18-59" AS age_bracket
            UNION ALL
            SELECT "> 60" AS age_bracket
            UNION ALL
            SELECT "Total" AS age_bracket
        ) AS brackets_table'));

        // Calculate the male counts for each age bracket
        $malesQuery = ProfilingModel::selectRaw('
            CASE
                WHEN age < 1 THEN "< 1"
                WHEN age BETWEEN 1 AND 2 THEN "1-2"
                WHEN age BETWEEN 3 AND 5 THEN "3-5"
                WHEN age BETWEEN 6 AND 12 THEN "6-12"
                WHEN age BETWEEN 13 AND 17 THEN "13-17"
                WHEN age BETWEEN 18 AND 59 THEN "18-59"
                ELSE "> 60"
            END AS age_bracket,
            COUNT(*) AS total_male
        ')
            ->where('sex', '=', 'male')
            ->groupBy('age_bracket');

        // Calculate the female counts for each age bracket
        $femalesQuery = ProfilingModel::selectRaw('
            CASE
                WHEN age < 1 THEN "< 1"
                WHEN age BETWEEN 1 AND 2 THEN "1-2"
                WHEN age BETWEEN 3 AND 5 THEN "3-5"
                WHEN age BETWEEN 6 AND 12 THEN "6-12"
                WHEN age BETWEEN 13 AND 17 THEN "13-17"
                WHEN age BETWEEN 18 AND 59 THEN "18-59"
                ELSE "> 60"
            END AS age_bracket,
            COUNT(*) AS total_female
        ')
            ->where('sex', '=', 'female')
            ->groupBy('age_bracket');

        // Join the age brackets subquery with male and female counts
        $summary = $ageBracketsSubquery
            ->leftJoinSub($malesQuery, 'males', function ($join) {
                $join->on('brackets_table.age_bracket', '=', 'males.age_bracket');
            })
            ->leftJoinSub($femalesQuery, 'females', function ($join) {
                $join->on('brackets_table.age_bracket', '=', 'females.age_bracket');
            })
            ->selectRaw('
                brackets_table.age_bracket,
                COALESCE(males.total_male, 0) AS male,
                COALESCE(females.total_female, 0) AS female,
                0 AS total
            ')
            ->where('brackets_table.age_bracket', '<>', 'Total')
            ->orderByRaw('
                CASE
                    WHEN brackets_table.age_bracket = "< 1" THEN 1
                    WHEN brackets_table.age_bracket = "1-2" THEN 2
                    WHEN brackets_table.age_bracket = "3-5" THEN 3
                    WHEN brackets_table.age_bracket = "6-12" THEN 4
                    WHEN brackets_table.age_bracket = "13-17" THEN 5
                    WHEN brackets_table.age_bracket = "18-59" THEN 6
                    ELSE 7
                END
            ')
            ->get();

        // Calculate the overall male and female totals
        $overallMaleTotal = $summary->sum('male');
        $overallFemaleTotal = $summary->sum('female');

        // Combine age bracket summary with overall totals
        $summary = $summary->concat([
            (object) [
                'age_bracket' => 'Total',
                'male' => $overallMaleTotal,
                'female' => $overallFemaleTotal,
                'total' => $overallMaleTotal + $overallFemaleTotal,
            ],
        ]);


        return $summary;
    }

    //summarize house structure types for every household
    public function house_structure(){
        $houseStructures = [
            'Full Concrete',
            'Semi Concrete',
            'Light Material (Wood)',
            'Salvage House',
        ];

        // Retrieve the count of each house structure
        $structureCounts = Household::select('h_structure', DB::raw('COUNT(*) AS count'))
            ->groupBy('h_structure')
            ->whereIn('h_structure', $houseStructures)
            ->get();

        // Calculate the total count
        $totalCount = $structureCounts->sum('count');

        // Prepare the result object
        $result = [];
        foreach ($houseStructures as $structure) {
            $count = $structureCounts->firstWhere('h_structure', $structure);
            $count = $count ? $count->count : 0;
            $result[] = (object) [
                'house_structure' => $structure,
                'count' => $count,
            ];
        }
        $result[] = (object) [
            'house_structure' => 'Total',
            'count' => $totalCount,
        ];

        return $result;
    }

    //summarize house ownership
    public function house_ownership()
    {
        $ownership_types = [
            'Owned',
            'Rented',
            'Shared with Owner',
            'Shared with Renter',
            'Informal Setller'
        ];

        $ownershipCounts = Families::select('house_ownership', DB::raw('COUNT(*) AS count'))
            ->groupBy('house_ownership')
            ->whereIn('house_ownership', $ownership_types)
            ->get();

        // Calculate the total count
        $totalCount = $ownershipCounts->sum('count');

         // Prepare the result object
         $result = [];
         foreach ($ownership_types as $ownership) {
             $count = $ownershipCounts->firstWhere('house_ownership', $ownership);
             $count = $count ? $count->count : 0;
             $result[] = (object) [
                 'house_ownership' => $ownership,
                 'count' => $count,
             ];
         }
         $result[] = (object) [
             'house_ownership' => 'Total',
             'count' => $totalCount,
         ];

         return $result;
    }

    // get all listed occupation in database then count
    public function occupations(){
        $occupationCounts = ProfilingModel::select('occupation', DB::raw('COUNT(*) AS count'))
            ->groupBy('occupation')
            ->get();

        $totalCount = $occupationCounts->sum('count');

        // Prepare the result array
        $result = [];
        foreach ($occupationCounts as $occupation) {
            $result[] = (object) [
                'occupation' => $occupation->occupation,
                'count' => $occupation->count,
            ];
        }

        $result[] = (object) [
            'occupation' => 'Total',
            'count' => $totalCount,
        ];

        // Return the result
        return $result;
    }

    // summarized house facilities for every households
    public function house_facilities(){

        $results = [];
        $facilities = [
            'electricity' => [
                'With Electricity',
                'No Electricity'
            ],
            'water_source' => [
                'Deep Well (level 1)',
                'Common (level 2)',
                'Faucet (level 3)'
            ],
            'comfort_room' => [
                'Water Sealed',
                'Antipolo type',
                'No Latrine',
                'Using Others Toilet'
            ],
            'waste_management' => [
                'Burned',
                'Buried',
                'Recycled',
                'Owned Dumpsite',
                'Collected by Garbage Truck'
            ]
        ];

        foreach($facilities as $type_keys => $type_vals){
            // Retrieve the count of each house structure
            $faciltyCounts = Household::select($type_keys, DB::raw('COUNT(*) AS count'))
                ->groupBy($type_keys)
                ->whereIn($type_keys, $type_vals)
                ->get();

            // Calculate the total count
            $totalCount = $faciltyCounts->sum('count');

            // Prepare the result object
            $result = [];

            $result[] = (object) [
                    'facility' => 'Head',
                    'head'  => ucwords(str_replace("_", " ", $type_keys)),
            ];
            foreach ($type_vals as $types) {
                $count = $faciltyCounts->firstWhere($type_keys, $types);
                $count = $count ? $count->count : 0;
                $result[] = (object) [
                    'facility' => $types,
                    'count' => $count,
                ];
            }

            $results[] = $result;
        }

        return $results;

    }
}
