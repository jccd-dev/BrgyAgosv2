@extends('main-layout')

@section('title', 'Dashboard')

@section('content')
    <div class="col">
        <div class="row gy-4 mt-1">
            <div class="col-md-4">
                <div class="box border bg-light d-flex align-items-center rounded">
                    <div class="w-25 box2 bg-teal d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/reshot-icon-workforce-TX8JMLNVRS.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">Total Residents</span>
                            <span class="fs-1">{{ $total}}</span>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="box border bg-light d-flex align-items-center rounded">
                    <div class="w-25 box2 bg-danger d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/family-4-people-svgrepo-com.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">Families</span>
                            <span class="fs-1">{{$families}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box border bg-light d-flex align-items-center rounded">
                    <div class="w-25 box2 bg-success d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/house-svgrepo-com.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">Household</span>
                            <span class="fs-1">{{ $household }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box border bg-light d-flex align-items-center rounded">
                    <div class="w-25 box2 bg-pink d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/person-girl-svgrepo-com.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">Female</span>
                            <span class="fs-1">{{ $female }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box border bg-light d-flex align-items-center rounded">
                    <div class="w-25 box2 bg-darkBlue d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/person-boy-svgrepo-com.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">Male</span>
                            <span class="fs-1">{{ $male }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box border bg-light d-flex align-items-center rounded">
                    <div class="w-25 box2 bg-warning d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/pensioner-svgrepo-com.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">Senior Citizen</span>
                            <span class="fs-1">{{ $senior }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
            <div class="col-10">
                <table class="table table-striped table-bordered caption-top table-sm border-dark">
                    <caption class="fw-semibold text-uppercase fs-4">Age Population</caption>
                    <thead class="text-center">
                        <tr>
                        <th scope="col">Age</th>
                        <th scope="col">Female</th>
                        <th scope="col">Male</th>
                        <th scope="col">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ages as $summary)
                        @if ($summary->age_bracket == 'Total')
                            <tr>
                                <th scope="row" class="text-left">TOTAL</th>
                                <td class="text-center fw-bolder fs-5">{{$summary->female}}</td>
                                <td class="text-center fw-bolder fs-5">{{$summary->male}}</td>
                                <td class="text-center fw-bolder fs-5">{{$summary->total}}</td>
                            </tr>
                        @else
                            <tr class="text-center">
                                <th scope="row">{{$summary->age_bracket}}</th>
                                <td>{{$summary->female ? $summary->female : '-'}}</td>
                                <td>{{$summary->male ? $summary->male : '-'}}</td>
                                <td>{{$summary->female + $summary->male ? $summary->female + $summary->male : '-'}}</td>
                            </tr>
                        @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- {{dd($structure)}} --}}
    <div class="row mt-5 justify-content-center">
        <div class="col-10">
            <table class="table table-striped table-bordered caption-top table-sm border-dark">
                <caption class="fw-semibold text-uppercase fs-4">House Structures Summary</caption>
                <thead class="text-center">
                    <tr class="text-uppercase">
                        <th >House Structures Type</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($structure as $row)
                    <tr>
                        @if ($row->house_structure == 'Total')
                            <th scope="row" class="text-uppercase">{{ $row->house_structure }}</th>
                            <td class="text-center fw-bolder fs-5">{{ $row->count }}</td>
                        @else
                            <td>{{ $row->house_structure }}</td>
                            <td class="text-center">{{ $row->count ? $row->count : '-'}}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-10">
            <table class="table table-striped table-bordered caption-top table-sm border-dark">
                <caption class="fw-semibold text-uppercase fs-4">House Ownership</caption>
                <thead class="text-center">
                    <tr>
                        <th class="text-uppercase">House Ownership Type</th>
                        <th class="text-uppercase">Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ownership as $row)
                    <tr>
                        @if ($row->house_ownership == 'Total')
                            <th scope="row" class="text-uppercase">{{ $row->house_ownership }}</th>
                            <td class="text-center fw-bolder fs-5">{{ $row->count }}</td>
                        @else
                            <td>{{ $row->house_ownership }}</td>
                            <td class="text-center">{{ $row->count ? $row->count : '-' }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-10">
            <table class="table table-striped table-bordered caption-top table-sm border-dark">
                <caption class="fw-semibold text-uppercase fs-4">Resident's Occupations</caption>
                <thead class="text-center">
                    <tr>
                    <th scope="col" class="text-uppercase">Occupation Lists</th>
                    <th class="text-uppercase">Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($occupation as $row)
                    <tr>
                        @if ($row->occupation == 'Total')
                            <th scope="row" class="text-uppercase">{{ $row->occupation }}</th>
                            <td class="text-center fw-bolder fs-5">{{ $row->count }}</td>
                        @else
                            <td>{{ $row->occupation }}</td>
                            <td class="text-center">{{ $row->count ? $row->count : '-' }}</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-5 justify-content-center mb-5">
        <div class="col-10">
            <table class="table table-bordered caption-top table-sm border-dark">
                <caption class="fw-semibold text-uppercase fs-4">House Facilities</caption>
                {{-- <thead class="text-center">
                    <tr>
                    <th scope="col"></th>
                    <th>Count</th>
                    </tr>
                </thead> --}}
                <tbody>
                    @foreach ($facility as $row)
                        @foreach ($row as $data)
                        <tr>
                            @if ($data->facility == 'Head')
                                <th scope="row" class="text-uppercase fs-5 bg-teal bg-opacity-25">{{ $data->head }}</th>
                                <th class="text-center fw-bolder fs-5 bg-teal bg-opacity-25">Count</td>
                            @else
                                <td>{{ $data->facility }}</td>
                                <td class="text-center">{{ $data->count ? $data->count : '-' }}</td>
                            @endif
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- {{dd($facility)}} --}}
@endsection
