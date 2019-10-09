
<div class="row">
    <div class="col">
        @if($reservation->payment_location)
        
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve-payment-modal">
            Approve Payment
        </button>
        <br>
        @include('backend.transaction.reservation.includes.modals.approve-payment-modal')
        <img src="{{ url('uploads/' . $reservation->payment_location) }}" alt="No image uploaded">
        
        @else
            
                <h1 class="display-4">Oops..</h1>
                <p class="lead"><strong>Payment is not yet uploaded.</strong></p>
        @endif
    </div>
</div>