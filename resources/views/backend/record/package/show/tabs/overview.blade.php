<div class="col">
    <div class="table-responsive">
        <table class="table table-hover"> 
            <tr>
                <th>Name</th>
                <td>{{ $service->name }}</td>
            </tr>
            
            <tr>
                <th>Category</th>
                <td>{{ $service->category }}</td>
            </tr>

            @if($service->category == "Body Massage") 
            <tr>
                <th>Member Price</th>
                <td>{{ $service->member_price }}</td>
            </tr>
            <tr>
                <th>Non-member Price</th>
                <td>{{ $service->non_member_price }}</td>
            </tr>
            @elseif($service->category == "Waxing Services")
            <tr>
                <th>Male Price</th>
                <td>{{ $service->male_price }}</td>
            </tr>
            <tr>
                <th>Female Price</th>
                <td>{{ $service->female_price }}</td>
            </tr>
            @else
            <tr>
                <th>Price</th>
                <td>{{ $service->price }}</td>
            </tr>
            @endif
 
            <tr>
                <th>Description</th>
                <td>{{ $service->description }}</td>
            </tr> 

            <tr>
                <th>Last Updated At</th>
                <td>
                    @if($service->updated_at)
                        {{ timezone()->convertToLocal($service->updated_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>
 
        </table>
    </div>
</div><!--table-responsive-->
