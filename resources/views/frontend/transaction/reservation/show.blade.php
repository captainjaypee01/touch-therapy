@extends('frontend.layouts.app')

@section('title', app_name() . ' | ' . 'Reservations' )

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <strong>
                        Show Reservation
                    </strong>
                </div><!--card-header-->

                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover"> 
                                    <tr>
                                        <th>Reference</th>
                                        <td>{{ $reservation->reference_number }}</td>
                                    </tr>
                        
                                    <tr>
                                        <th>Customer Name</th>
                                        <td>{{ $reservation->user->full_name }}</td>
                                    </tr>
                         
                                    <tr>
                                        <th>Reservation Date </th>
                                        <td>{{ $reservation->format_reservation_date }}</td>
                                    </tr>

                                    <tr>
                                        <th>Reservation Time</th>
                                        <td>{{ $reservation->format_reservation_time }}</td>
                                    </tr> 
                                    <tr>
                                        <th>Last Updated At</th>
                                        <td>
                                            @if($reservation->updated_at)
                                                {{ timezone()->convertToLocal($reservation->updated_at) }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                            
                                </table>
                            </div>
                        </div><!--table-responsive-->
                    </div>
                    <hr>
                    @if($reservation->service_id && $reservation->service_id > 0)
                    <h3 class="text-title">Service Details</h3>
                    
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover"> 
                                    <tr>
                                        <th>Service Name</th>
                                        <td>{{ $service->name }}</td>
                                    </tr>
                        
                                    <tr>
                                        <th>Service Price</th>
                                        <td>{{ $service->format_price }}</td>
                                    </tr>
                            
                                    <tr>
                                        <th>Details</th>
                                        <td>{{ $service->description }}</td>
                                    </tr>
 
                            
                                </table>
                            </div>
                        </div><!--table-responsive-->\
                    </div>
                    
                    @elseif($reservation->package_id && $reservation->package_id > 0)
                    <h3 class="text-title">Package Details</h3>
                    
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table class="table table-hover"> 
                                    <tr>
                                        <th>Package Name</th>
                                        <td>{{ $package->name }}</td>
                                    </tr>
                        
                                    <tr>
                                        <th>Package Price</th>
                                        <td>{{ $package->format_price }}</td>
                                    </tr>
                            
                                </table>
                            </div>
                        </div><!--table-responsive-->\
                    </div>
                    @endif
                    <hr>
                    
                    <h3 class="text-title">Payment Details</h3>
                    <div class="row">
                        <div class="col">
                    <img src="{{ url('uploads/' . $reservation->payment_location) }}" alt="No image uploaded">
                        </div>
                    </div>
                        
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <a href="{{route('frontend.transaction.reservation.index')}}" class="btn btn-info btn-sm">Go Back</a>
                        </div>
                        <div class="col text-right">
                            
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#upload-payment-modal">
                                Upload Payment
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@include('frontend.transaction.reservation.includes.modals.upload-payment-modal')

 @endsection