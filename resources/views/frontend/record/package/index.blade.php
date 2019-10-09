@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . 'Packages' )

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Packages - {{ $packages->total() . ' current available'}}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    @foreach($packages as $package)
                    <div class="row mt-4">
                        <div class="col col-md-3">
                            <img src="{{ asset('img/frontend/ortiz-clinic-logo.png') }}" class="d-block w-100 h-50" alt="...">
                        </div>
                        <div class="col">
                            <div class="card p-4">
                                <h3>{{ $package->name }}</h3> 
                                <p>{!! '<strong>' . $package->format_price . '</strong>' !!}</p> 
                                <p>{{ $package->description }}</p> 
                                @auth
                                <a href="{{ route('frontend.record.package.show', $package) }}" class="btn btn-info btn-sm w-25">View Package</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            {!! $packages->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
