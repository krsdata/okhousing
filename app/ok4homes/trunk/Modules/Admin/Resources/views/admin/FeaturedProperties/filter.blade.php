            <table class="table datatable-basic table-bordered table-hover" id="property_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                         <th>Date</th>
                        <th>Amount</th>  
                        <th>Payment</th>    
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                    <tbody>
                        @foreach($response as $property)
                        <tr>
                            <td>{{$property->id}}</td>
                            <td>{{$property->property_data->name}}</td>
                            <td>{{$property->start}} - {{$property->end}}</td>
                            <td>{{$property->amount}}</td>
                            <td>{{$property->payment}}</td>
                            <td>{{$property->amount}}</td>
                        </tr>
                        @endforeach
                   </tbody>
            </table> 
