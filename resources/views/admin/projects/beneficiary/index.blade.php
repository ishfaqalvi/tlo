@extends('admin.layout.app')

@section('title')
    Project Beneficiary
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Project Beneficiary Management</span>
        </h4>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.projects.navigation')
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Project Beneficiary</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Marital Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($project->beneficiaries as $key => $beneficiary)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#viewDetail{{$beneficiary->id}}">
                            {{ $beneficiary->name }}    
                        </a>
                    </td>
                    <td>{{ $beneficiary->father_name }}</td>
                    <td>{{ $beneficiary->gender }}</td>
                    <td>{{ $beneficiary->contact }}</td>
                    <td>{{ $beneficiary->marital_status }}</td>
                </tr>
                @include('admin.projects.beneficiary.show')
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection