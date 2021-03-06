@extends('backend.layouts.app')

@section('title', 'Order Management' . ' | ' . 'Create Order')

@section('content')
{{ html()->form('POST', route('admin.transaction.order.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                    Order Management
                        <small class="text-muted">Create Order</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            

            <div class="row">
                <div class="col col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Customer")->for('customer') }}
                        <select name="customer" id="customers" class="selectpicker form-control" data-live-search="true">
                            @foreach($customers as $customer)
                                @if($customer->hasRole("user"))
                                <option value="{{ $customer->id }}" >{{ $customer->full_name  . " | " . $customer->email }}</option>
                                @endif
                            @endforeach
                            
                        </select>
                    </div>
                </div> 
            </div> 
            <div class="row">
                <div class="col col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Products")->for('products') }}
                        <select name="products[]" id="products" class="selectpicker form-control" multiple data-live-search="true">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price }}" data-name="{{ $product->name  . " | " . $product->format_price }}">{{ $product->name  . " | " . $product->format_price }}</option>
                            @endforeach
                            
                        </select>
                    </div>
                </div> 
            </div>
            <div id="section-quantity" style="display:none;" class="row"> 
            </div>
            <div class="row" id="section-btn-compute" style="display:none;">
                <div class="col">
                    <button type="button" class="btn btn-info" id="btn-amount">Compute Total Amount</button>
                </div>
            </div>
            <div class="row" id="section-amount" style="display:none;">
                <div class="col">
                    <div class="form-group">
                        {{ html()->label("Total Orders")->for('total_orders') }}
                        <input type="text" name="total_orders" id="total_orders" class="form-control" readonly>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {{ html()->label("Total Amount")->for('total_amount') }}
                        <input type="text" name="total_amount" id="total_amount" class="form-control" readonly>
                    </div>
                </div>
            </div> 


        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.transaction.order.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create'))->id("btn-submit")->attribute('disabled') }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection

@push('after-styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('after-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    
    var total_amount = 0;
    $('#customers').selectpicker();
    $('#products').selectpicker();
    $("#products").change(function(e){
        console.log($("#products").val());
        total_amount = 0;
        var products = $("#products").val();
        var html = '';
        products.forEach(product => { 
            var product = $("#products option[value='"+ product +"']");
            var price = product.data("price");
            var name = product.data("name");
            total_amount += price;
            html += '<div class="col col-md-6">' +
                        '<div class="form-group">' +
                            '<label>Quantity of ' + name + '</label>' + 
                            '<input type="number" class="form-control quantity-number" name="quantity[]" data-price="' + price + '">' +
                        '</div>' +
                    '</div>';
        }); 
        // console.log(html);
        $("#section-btn-compute").show();
        $("#section-amount").hide();
        $("#section-quantity").html(html).show();
        $("#total_orders").val( products.length ); 
    });

    $("#btn-amount").click(function(e){
        var total_amount = $("input[name='quantity[]']").map(function(){return ($(this).val() * $(this).data('price')) ;}).get().reduce((a, b) => a + b, 0);
        
        $("#section-amount").show();
        $("#total_amount").val( formatNumber(total_amount) ); 
        $("#btn-submit").prop("disabled", false);

        
    }); 
    function formatNumber(x) {
        const options = { 
            minimumFractionDigits: 2,
            maximumFractionDigits: 2 
        };
        return Number(x).toLocaleString('en', options);
    }
</script>
@endpush
