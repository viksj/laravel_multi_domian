@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <p class="align-middle">
                    {{ __('Tanent Users') }}
                    <span class="float-end"><a href="{{ route('tenents.create') }}" class='btn btn-primary'>Create Tenant</a></span>
                </p>
            </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Domain</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach($tenents as $index => $tenent)
                            <tr>
                                <td>{{$index +1}}</td>
                                <td>{{$tenent->name}}</td>
                                <td>{{$tenent->email}}</td>
                                <td>
                                    @foreach($tenent->domains as $domain)
                                        {{$domain->domain}} {{$loop->last ? '': ','}}
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection