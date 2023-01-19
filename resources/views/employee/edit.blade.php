@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Edit Employee</h5>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('employees') }}" class="btn btn-sm btn-default">Go Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('layouts.errors')

            <div class="row">
                <div class="col-sm-3"></div>

                <div class="col-md-6">
                    <div class="card">
                        <form action="{{ route('employee.update', $employee->id) }}" method="post">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $employee->name }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone" value="{{ $employee->phone }}" placeholder="Enter phone">
                                </div>
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <select class="form-control" id="company" name="company">
                                        <option value="" hidden>Choose company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{$employee->company_id == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-sm-3"></div>
            </div>
        </div>
    </section>
@endsection
