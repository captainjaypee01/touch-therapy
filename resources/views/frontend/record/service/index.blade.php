@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . 'Services' )

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Services - {{ $services->total() . ' current available'}}
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    @foreach($services as $service)
                    <div class="row mt-4">
                        <div class="col col-md-3">
                            <img src="{{ asset('img/frontend/ortiz-clinic-logo.png') }}" class="d-block w-100 h-50" alt="...">
                        </div>
                        <div class="col">
                            <div class="card p-4">
                                <h3>{{ $service->name }}</h3>
                                @if($service->category == "Body Massage") 
                                <p>{!! '<strong>Member Price</strong> : ' . $service->member_price !!}</p>
                                <p>{!! '<strong>Non-member Price</strong> : ' . $service->non_member_price !!}</p>
                                @elseif($service->category == "Waxing Services") 
                                <p>{!! '<strong>Male Price</strong> : ' . $service->male_price !!}</p>
                                <p>{!! '<strong>Female Price</strong> : ' . $service->female_price !!}</p>
                                @else 
                                <p>{!! '<strong>' . $service->format_price . '</strong>' !!}</p>
                                @endif
                                <p>{{ $service->description }}</p> 
                                @auth
                                <a href="{{ route('frontend.record.service.show', $service) }}" class="btn btn-info btn-sm w-25">View Service</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            {!! $services->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
