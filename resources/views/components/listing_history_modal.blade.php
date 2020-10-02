<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 90%;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Listing History</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered border-top m-0">
                <thead>
                    <tr class="text-nowrap">
                        <th scope="col" class="font-weight-600">No.</th>
                        <th scope="col" class="font-weight-600">Listing ID</th>
                        <th scope="col" class="font-weight-600">Listing sale price</th>
                        <th scope="col" class="font-weight-600">Sold price</th>
                        <th scope="col" class="font-weight-600">Listing Rental Price</th>
                        <th scope="col" class="font-weight-600">Rented Price</th>
                        <th scope="col" class="font-weight-600 text-nowrap">Owner Name</th>
                        <th scope="col" class="font-weight-600 text-nowrap">Land Specialist Name</th>
                        <th scope="col" class="font-weight-600 text-nowrap">Status</th>
                        <th scope="col" class="font-weight-600">Transaction Date</th>
                        <th scope="col" class="font-weight-600">Customer Name</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @php
                            $no=1;
                        @endphp
                        @foreach ($entry->listing()->orderBy('id','desc')->get() as $item)
                            @if($item->id!=$entry->listing()->orderBy('id','desc')->first()->id)

                            <tr class="text-nowrap">
                                <td scope="col" class="font-weight-600">{{$no}}</td>
                                <td scope="col" class="font-weight-600"><a href='/admin/listing/{{$item->id}}/show'>{{(str_pad($item->id, 6, 0, STR_PAD_LEFT))}}</a></td>
                                <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->sale_price))-@else{{"$ ".number_format($item->sale_price, 2)}}@endif</td>
                                <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->sold_price))-@else{{"$ ".number_format($item->sold_price, 2)}}@endif</td>
                                <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->rental_price))-@else{{"$ ".number_format($item->rental_price, 2)}}@endif</td>
                                <td scope="col" class="font-weight-600" style="color: #7c69ef">@if(!isset($item->rented_price))-@else{{"$ ".number_format($item->rented_price, 2)}}@endif</td>
                                <td scope="col" class="font-weight-600 text-nowrap">
                                    @if(isset($item->owner->last_name))
                                        {{$item->owner->FullName}}
                                    @endif
                                </td>
                                <td scope="col" class="font-weight-600 text-nowrap">
                                    @if(isset($item->contact->last_name))
                                        {{$item->contact->FullName}}
                                    @endif
                                </td>
                                <td scope="col" class="font-weight-600 text-nowrap">{{$item->status}}</td>
                                <td scope="col" class="font-weight-600">{{$item->sold_price_date}}</td>
                                <td scope="col" class="font-weight-600">{{$item->customer_id}}</td>
                            </tr>
                            @php
                                $no++;
                            @endphp
                            @endif
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
