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
                    <div class="w-25 box2 bg-danger d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/family-4-people-svgrepo-com.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">Families</span>
                            <span class="fs-1">200</span>
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
            <div class="col-md-4">
                <div class="box border bg-light d-flex align-items-center rounded">
                    <div class="w-25 box2 bg-success d-flex align-items-center justify-content-center rounded-start">
                        <div class="fs-3 text-center">
                            <img src="{{ asset('images/woman-in-motorized-wheelchair-light-skin-tone-svgrepo-com.svg')}}" alt="pensioner-svgrepo-com.svg" class="mx-auto d-block img w-75">
                        </div>
                    </div>
                    <div class="w-75 p-4">
                        <div class="d-flex flex-column">
                            <span class="border-bottom">PWD's</span>
                            <span class="fs-1">{{ $pwd }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
