@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Edit Company</h5>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('companies') }}" class="btn btn-sm btn-default">Go Back</a>
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
                        <form action="{{ route('company.update', $company->id) }}" role="form"
                              method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Company name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" placeholder="Enter company name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $company->address }}" placeholder="Enter address">
                                </div>
                                <div class="form-group">
                                    <img class="profile-user-img img-fluid img-circle d-block text-left"
                                         src="{{ $company->logo }}" alt="Logo picture">
                                    <label for="logo">Logo</label>
                                    <input type="file" class="form-control" id="logo" name="logo">
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
