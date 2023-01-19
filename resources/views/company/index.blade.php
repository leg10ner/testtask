@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Companies</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('company.create') }}" class="btn btn-primary">Add</a>
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
                                                <th>Logo</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($companies as $company)
                                                    <tr>
                                                        <td>{{ $company->id }}</td>
                                                        <td><img src="{{ $company->logo }}" height="50"></td>
                                                        <td>{{ $company->name }}</td>
                                                        <td>{{ $company->email }}</td>
                                                        <td>{{ $company->address }}</td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="{{ route('company.show', $company->id) }}" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <a href="{{ route('company.edit', $company->id) }}" class="btn btn-sm btn-default">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="{{ route('company.destroy', $company->id ) }}" class="btn btn-sm btn-default">
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
                                        {{ $companies->links() }}
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

