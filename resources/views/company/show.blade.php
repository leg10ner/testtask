@extends('layouts.app')

@push('styles')
    <style>
        html, body, #map {
            width: 100%; height: 100%; padding: 0; margin: 0;
        }
    </style>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Profile Company</h5>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('company.edit', $company->id) }}" class="btn btn-primary mr-2">Edit</a>
                    <a href="{{ route('companies') }}" class="btn btn-default">Go Back</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            @include('layouts.errors')

            <div class="row">
                <div class="col-md-3">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            @if($company->logo)
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ $company->logo }}" alt="Logo picture">
                            </div>
                            @endif
                            <h3 class="profile-username text-center">{{ $company->name }}</h3>
                            <hr class="border-bottom">
                            <strong><i class="fas fa-users mr-1"></i> Employees - {{ $company->employees->count() }}</strong>
                            <hr class="border-bottom">
                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                            <p class="text-muted">{{ $company->email }}</p>
                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                            <p class="text-muted">{{ $company->address }}</p>
                        </div>

                    </div>
                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#employees" data-toggle="tab">Employees</a></li>
                                @if($company->address)
                                    <li class="nav-item"><a class="nav-link" href="#map" data-toggle="tab">Yandex Map</a></li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="employees">
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
                                @if($company->address)
                                    <div class="tab-pane" id="map">
                                        <div class="card">
                                            <div id="map-yandex" style="height: 400px"></div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    @if($company->address)
        <script>
            if ($('section div').is('#map-yandex')) {
                var script = document.createElement("script");
                script.src = "{{ env('yandex_url').''.env('yandex_apikey') }}";
                script.type = "text/javascript";
                script.onload = function () {
                    ymaps.ready(function () {
                        myMap = new ymaps.Map("map-yandex", {
                            center: [{{ $coordinates }}],
                            zoom: 17.5
                        });
                        myPlacemark = new ymaps.Placemark([{{ $coordinates }}], {
                            hintContent: '{{ $company->name }}',
                            balloonContent: '{{ $company->name.': '.$company->address }}'
                        },{
                            iconColor: '#ef7f1a'
                        });
                        myMap.geoObjects.add(myPlacemark);
                    })
                };
                document.getElementsByTagName("head")[0].appendChild(script);
            }
        </script>
    @endif
@endpush
