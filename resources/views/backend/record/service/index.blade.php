@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    Service Management <small class="text-muted">Active Services</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.record.service.includes.header-buttons')
            </div><!--col-->
        </div><!--row-->

        <div class="row">
            <div class="col-sm-5">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="{!! $search !!}" name="search"  aria-label="Search">
                      
                    <button class="btn btn-outline-success my-2 my-sm-0 mr-2"  type="submit">Search</button>
                    <button class="btn btn-outline-info my-2 my-sm-0" type="">Clear</button>
                </form>
            </div><!--col-->

        </div><!--row-->

        @if(count($services) > 0)
        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table id="service-table" class="table">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Price</th>  
                            <th>Status</th>
                            <th>Date Created</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($services as $index => $service)
                            <?php $index = ($service->page - 1) * $service->per_page + 1; ?>
                            <tr>
                                <td>{{  ($services->perPage() * $services->currentPage() - $services->perPage()) + ($loop->iteration) }}</td>
                                <td>{{ $service->name }}</td>
                                <td> 
                                @if($service->category == "Body Massage") 
                                {!! "<strong>Member</strong> : " . $service->format_member_price !!}
                                <br>
                                {!! "<strong>Non-Member</strong> : " . $service->format_non_member_price !!}
                                
                                @elseif($service->category == "Waxing Services") 
                                {!! "<strong>Male</strong> : " . $service->format_male_price !!}
                                <br>
                                {!! "<strong>Female</strong> : " . $service->format_female_price !!}
                                
                                @else 
                                {!! "<strong>Price</strong> : " . $service->format_price !!} 
                                @endif
                                </td> 
                                <td>{!! $service->status_label !!}</td>
                                <td>{{ $service->created_at }}</td>
                                <td>{!! $service->action_buttons !!}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $services->total() !!} {{ "Services Total" }}
                </div>
            </div><!--col-->

            <div class="col-5">
                <div class="float-right"> 
                    {!! $services->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
        @else
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-3 col-xl-2 text-center">
                    <img src="{{ asset('img/frontend/no_data.png') }}" height="200" class="mt-4">
                </div>
                <div class="col-lg-3 text-center">
                    <h1 class="display-4">Oops..</h1>
                    <p class="lead"><strong>No data in here. Try to modify filters to search records.</strong></p>
                </div>
            </div>
        @endif
    </div><!--card-body-->
</div><!--card-->
 
@endsection