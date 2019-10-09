

<div class="col">
    <div class="row">
        <div class="col table-responsive">
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
    </div>
</div><!--table-responsive-->
