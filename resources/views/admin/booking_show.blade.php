@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Booking Details')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Booking Details')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.property.booking') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Booking List')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped table-bordered">
                           <tr>
                               <td>{{__('admin.Name')}}</td>
                               <td><a href="#">{{ html_decode($booking->name) }}</a></td>
                           </tr>
                           <tr>
                               <td>{{__('admin.Email')}}</td>
                               <td>{{ html_decode($booking->email) }}</td>
                           </tr>
                           <tr>
                                <td>{{__('admin.Phone')}}</td>
                                <td>{{ html_decode($booking->phone) }}</td>
                            </tr>
                           <tr>
                               <td>{{__('admin.Property')}}</td>
                               <td><a href="{{ route('admin.property.edit', $booking->property_id) }}">{{ html_decode($booking->property->title) }}</a></td>
                           </tr>

                           <tr>
                                <td>{{__('admin.Country')}}</td>
                                <td>{{ html_decode($booking->country) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.City')}}</td>
                                <td>{{ html_decode($booking->city) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Zip Code')}}</td>
                                <td>{{ html_decode($booking->zip_code) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Message')}}</td>
                                <td>{{ html_decode($booking->comment) }}</td>
                            </tr>

                           <tr>
                               <td>{{__('admin.Booking Date')}}</td>
                               <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('H:i A, d-m-Y') }}</td>
                           </tr>
                           <tr>
                               <td>{{__('admin.Status')}}</td>
                               <td>
                                    @if ($booking->status==1)
                                        <span class="badge badge-success">{{__('admin.Confirmed')}}</span>
                                    @else
                                        <span class="badge badge-danger">{{__('admin.Pending')}}</span>
                                    @endif
                               </td>
                           </tr>

                           <tr>
                               <td>{{__('admin.Change Status')}}</td>
                               <form id="updateBooking" action="{{ route('admin.property-booking-edit', $booking->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <td>
                                    <select name="status" id="" class="form-control">
                                        <option {{ $booking->status == 1 ? 'selected' : '' }} value="1">{{__('admin.Confirmed')}}</option>
                                        <option {{ $booking->status == 0 ? 'selected' : '' }} value="0">{{__('admin.Pending')}}</option>
                                    </select>
                                </td>
                                </form>
                           </tr>


                        </table>

                        <a href="javascript:;" id="updateBtn" onclick="changeStatus({{ $booking->id }})" class="btn btn-primary">{{__('admin.Update Status')}}</a>

                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
<script>

    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/delete-property-review/") }}'+"/"+id)
    }

    function changeStatus(id) {
        const isDemo = "{{ env('APP_MODE') }}";

        if (isDemo === 'DEMO') {
            toastr.error('This Is Demo Version. You Cannot Change Anything');
            return;
        }

        $.ajax({
            type: "PUT",
            url: `{{ url('/admin/property-booking-edit') }}/${id}`,
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                toastr.success(response);
                location.reload();
            },
            error: function(err) {
                if (err.responseJSON && err.responseJSON.message) {
                    toastr.error(err.responseJSON.message);
                } else {
                    toastr.error('An error occurred. Please try again.');
                }
            }
        });
    }

</script>




</script>
@endsection
