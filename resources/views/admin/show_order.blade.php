@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Purchase history')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>{{__('admin.Purchase history')}}</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>{{__('admin.Agent')}}</td>
                                <td>{{ $order->agent->name }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Plan name')}}</td>
                                <td>{{ $order->plan_name }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Plan type')}}</td>
                                <td>{{ $order->plan_type }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Plan price')}}</td>
                                <td>{{ num_format($order->plan_price) }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Expiration')}}</td>
                                <td>{{ $order->expired_time }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Expired date')}}</td>
                                <td>{{ $order->expiration_date }}</td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Remaining day')}}</td>
                                <td>
                                    @if ($order->order_status == 'active')
                                        @if ($order->expiration_date == 'lifetime')
                                            {{__('admin.Lifetime')}}
                                        @else
                                            @php
                                                $date1 = new DateTime(date('Y-m-d'));
                                                $date2 = new DateTime($order->expiration_date);
                                                $interval = $date1->diff($date2);
                                                $remaining = $interval->days;
                                            @endphp

                                            @if ($remaining > 0)
                                                {{ $remaining }} {{__('admin.Days')}}
                                            @else
                                                {{__('admin.Expired')}}
                                            @endif

                                        @endif
                                    @else
                                        {{__('admin.Expired')}}
                                    @endif

                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Number of property')}}</td>
                                <td>
                                    @if ($order->number_of_property == -1)
                                        {{__('admin.Unlimited')}}
                                    @else
                                        {{ $order->number_of_property }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Featured property')}}</td>
                                <td>
                                    {{ $order->featured_property }}
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Number of featured property')}}</td>
                                <td>
                                    @if ($order->featured_property_qty == -1)
                                        {{__('admin.Unlimited')}}
                                    @else
                                        {{ $order->featured_property_qty }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Top property')}}</td>
                                <td>
                                    {{ $order->top_property }}
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Number of top property')}}</td>
                                <td>
                                    @if ($order->top_property_qty == -1)
                                        {{__('admin.Unlimited')}}
                                    @else
                                        {{ $order->top_property_qty }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Urgent property')}}</td>
                                <td>
                                    {{ $order->urgent_property }}
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Number of urgent property')}}</td>
                                <td>
                                    @if ($order->urgent_property_qty == -1)
                                        {{__('admin.Unlimited')}}
                                    @else
                                        {{ $order->urgent_property_qty }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Order status')}}</td>
                                <td>
                                    @if ($order->order_status == 'active')
                                        <span class="badge badge-success">{{ $order->order_status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $order->order_status }}</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Payment status')}}</td>
                                <td>
                                    @if ($order->payment_status == 'success')
                                        <span class="badge badge-success">{{ $order->payment_status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $order->payment_status }}</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Payment method')}}</td>
                                <td>
                                    {{ $order->payment_method }}
                                </td>
                            </tr>

                            <tr>
                                <td>{{__('admin.Transaction Id')}}</td>
                                <td>
                                    {!! nl2br($order->transaction_id) !!}
                                </td>
                            </tr>

                        </table>

                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" onclick="deleteData({{ $order->id }})" class="btn btn-danger">{{__('admin.Delete')}}</a>

                        @if ($order->payment_status == 'pending')
                            <a href="javascript:;" data-toggle="modal" data-target="#approvedPayment" class="btn btn-primary">{{__('admin.Payment approved')}}</a>
                        @endif



                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
</div>

    <div class="modal fade" tabindex="-1" role="dialog" id="approvedPayment">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">{{__('admin.Payment Approved Confirmation')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p>{{__('admin.Are You sure approved this payment')}}</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('admin.payment-approved', $order->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('admin.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('admin.Yes, Approved')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteData(id){
            $("#deleteForm").attr("action",'{{ url("admin/delete-order/") }}'+"/"+id)
        }
    </script>
@endsection
