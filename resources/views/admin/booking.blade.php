@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Booking')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Booking')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Booking')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="5%">{{__('admin.SN')}}</th>
                                    <th width="30%">{{__('admin.Property')}}</th>
                                    <th width="10%">{{__('admin.Name')}}</th>
                                    <th width="15%">{{__('admin.Time')}}</th>
                                    <th width="10%">{{__('admin.Email')}}</th>
                                    <th width="10%">{{__('admin.Phone')}}</th>
                                    <th width="10%">{{__('admin.Address')}}</th>
                                    <th width="15%">{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking as $index => $booking)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><a href="{{ route('property', $booking?->property_name?->slug) }}" target="_blank">{{ $booking?->property_name?->title }}</a></td>
                                        <td>{{ $booking->name }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('j M Y') }}
                                            {{ \Carbon\Carbon::parse($booking->booking_time)->format('g:i A') }}
                                        </td>
                                        <td>{{ $booking->email }}</td>
                                        <td>{{ $booking->phone }}</td>
                                        <td>
                                            {{ $booking->city }},{{ $booking->state }},{{ $booking->zip_code }},{{ $booking->country }}
                                        </td>
                                        <td>
                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $booking->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a href="{{ route('admin.property-booking-show',$booking->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>

                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("/admin/property-booking/delete/") }}'+"/"+id)
    }
    function changeBlogStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/property-booking-edit')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
