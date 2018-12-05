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
                        @php $pro = Modules\Properties\Entities\PropertyList::find($property->property_id); @endphp
                        <tr>
                            <td>{{$property->pro_unique_id}}</td>
                            <td>{{@$pro->name}}</td>
                            <td>{{$property->start}} - {{$property->end}}</td>
                            <td>{{$property->amount}}</td>
                            <td>{{$property->payment}}</td>
                            <td>{{$property->amount}}</td>
                        </tr>
                        @endforeach
                   </tbody>
            </table> 
