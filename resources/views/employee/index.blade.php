@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Employees</h5>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary">Add</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('layouts.errors')

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="companies" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover dataTable dtr-inline">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Company</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($employees as $employee)
                                                    <tr>
                                                        <td>{{ $employee->id }}</td>
                                                        <td>{{ $employee->name }}</td>
                                                        <td>{{ $employee->email }}</td>
                                                        <td>{{ $employee->phone }}</td>
                                                        <td>
                                                            <a href="{{ route('company.show', $employee->company->id) }}">{{ $employee->company->name }}</a>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="{{ route('employee.destroy', $employee->id) }}" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{ $employees->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

