@extends('backend.layouts.app')

@section('title', 'Service Management' . ' | ' . 'Create Service')

@section('content')
{{ html()->form('POST', route('admin.record.service.store'))->class('form-horizontal')->attribute("enctype","multipart/form-data")->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                    Service Management
                        <small class="text-muted">Create Service</small>
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
                <div class="col col-md-6 col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Price")->for('price') }}
                        <select name="category" id="category" class="form-control">
                            <option value="" selected>Choose Category</option>
                            <option value="Body Massage">Body Massage</option>
                            <option value="Express Massage">Express Massage</option>
                            <option value="Pregnancy Massage">Pregnancy Massage</option>
                            <option value="Waxing Services">Waxing Services</option>
                            <option value="Body Works">Body Works</option>
                            <option value="Hand Works">Hand Works</option>
                            <option value="Foot Works">Foot Works</option>
                        </select>
                    </div>
                </div>  
                <div class="col col-md-6 col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Duration in minutes")->for('duration') }}
                        <input type="number" name="duration" id="duration" class="form-control" >
                    </div>
                </div>  
            </div>

            <div class="row" id="section-normal-price" style="display:none;"> 
                <div class="col col-md-6 col-sm-12" >
                    <div class="form-group">
                        {{ html()->label("Price")->for('price') }}
                        <input type="number" name="price" id="price" class="form-control" >
                    </div>
                </div>  
            </div>
            <div class="row" id="section-body-price"  style="display:none;">
            
                <div class="col col-md-6 col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Non Member Price")->for('non_member_price') }}
                        <input type="number" name="non_member_price" id="non_member_price" class="form-control" >
                    </div>
                </div>  
                <div class="col col-md-6 col-sm-12" >
                    <div class="form-group">
                        {{ html()->label("Member Price")->for('member_price') }}
                        <input type="number" name="member_price" id="member_price" class="form-control" >
                    </div>
                </div>  
            </div>
            
            <div class="row" id="section-waxing-price"  style="display:none;">
            
                <div class="col col-md-6 col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Male Price")->for('male_price') }}
                        <input type="number" name="male_price" id="male_price" class="form-control" >
                    </div>
                </div>  
                <div class="col col-md-6 col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Female Price")->for('female_price') }}
                        <input type="number" name="female_price" id="female_price" class="form-control" >
                    </div>
                </div>  
            </div>
            
            <div class="row">
                <div class="col">
                    <div class="form-group">
                            {{ html()->label("Upload File")->for('upload_file') }}
                        <input type="file" name="upload_file" id="upload_file" class="form-control">
                    </div> 
                </div>
            </div>

            <div class="row">
                <div class="col col-sm-12">
                    <div class="form-group">
                        {{ html()->label("Description")->for('description') }}
                        {{ html()->textarea('description')
                                ->class('form-control')
                                ->placeholder('Description')
                                ->attribute('rows', 15)
                                ->required() }}  
                    </div>
                </div> 
            </div>

 

        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.record.service.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.create')) }}
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->form()->close() }}
@endsection

@push('after-scripts')
<script>
    $("#category").change(function(e){
        var category = $(this).val();
        if(category == "Body Massage"){
            $("#section-body-price").show();
            $("#section-waxing-price").hide();
            $("#section-normal-price").hide();
        }
        else if(category == "Waxing Services"){
            $("#section-body-price").hide();
            $("#section-waxing-price").show();
            $("#section-normal-price").hide();
        }
        else{ 
            $("#section-body-price").hide();
            $("#section-waxing-price").hide();
            $("#section-normal-price").show();
        }
    });
</script>
@endpush