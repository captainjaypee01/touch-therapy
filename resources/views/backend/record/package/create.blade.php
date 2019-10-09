@extends('backend.layouts.app')

@section('title', 'Package Management' . ' | ' . 'Create Package')

@section('content')
{{ html()->form('POST', route('admin.record.package.store'))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                    Package Management
                        <small class="text-muted">Create Package</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>
            
            <div class="row">
                <div class="col col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Name")->for('name') }}
                        
                        {{ html()->text('name')
                                ->class('form-control')
                                ->placeholder('Name')
                                ->attribute('maxlength', 191)
                                ->required() }} 
                    </div>
                </div> 
            </div>

            <div class="row"> 
                <div class="col col-sm-12" >
                    <div class="form-group">
                        {{ html()->label("Price")->for('price') }}
                        <input type="number" name="price" id="price" class="form-control" >
                    </div>
                </div>  
            </div>
 
            
            <div class="row">
                <div class="col col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Services")->for('services') }}
                        <select name="services[]" id="services" class="selectpicker form-control" multiple="multiple"  data-live-search="true">

                            @foreach($services as $service)
                                <option value="{{ $service->id }}"> {{ $service->category . " | " . $service->name }} </option>
                            @endforeach
                            
                        </select>
                    </div>
                </div> 
            </div>


        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.record.package.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
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
    $('#services').selectpicker();
</script>
@endpush
