@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Own Properties')}}</title>
@endsection
@section('admin-content')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1>{{__('admin.Own Properties')}}</h1>
        </div>


        <div class="section-body">
            <a href="{{ route('admin.property.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="table-responsive table-invoice">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th width="5%">{{__('admin.SN')}}</th>
                                        <th width="25%">{{__('admin.Property')}}</th>
                                        <th width="10%">{{__('admin.Price')}}</th>
                                        <th width="15%">{{__('admin.Type')}}</th>
                                        <th width="10%">{{__('admin.Purpose')}}</th>
                                        <th width="10%">{{__('admin.Highlight')}}</th>
                                        <th width="10%">{{__('admin.Status')}}</th>
                                        <th width="15%">{{__('admin.Action')}}</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $index => $property)
                                        <tr>
                                            <td>{{ ++$index }}</td>
                                            <td>
                                                <a target="_blank" href="{{ route('property', $property->slug) }}">{{ html_decode($property->title) }}</a>
                                            </td>
                                            <td>{{ html_decode(num_format($property->price ?? 0)) }}</td>

                                            <td>{{ $property->property_type->name ?? '' }}</td>
                                            <td>
                                                @if ($property->purpose == 'rent')
                                                    {{__('admin.For Rent')}}
                                                @else
                                                    {{__('admin.For Sale')}}
                                                @endif
                                            </td>

                                            <td>
                                                @if ($property->is_featured == 'enable')
                                                    <span class="badge badge-success mb-1">{{__('admin.Featured')}}</span>
                                                @endif

                                                @if ($property->is_top == 'enable')
                                                    <span class="badge badge-primary mb-1">{{__('admin.Top')}}</span>
                                                @endif

                                                @if ($property->is_urgent == 'enable')
                                                    <span class="badge badge-warning mb-1">{{__('admin.Urgent')}}</span>
                                                @endif

                                            </td>

                                            <td>
                                                @if ($property->status == 'enable')
                                                    <span class="badge badge-success">{{__('admin.Enable')}}</span>
                                                @else
                                                    <span class="badge badge-danger">{{__('admin.Disable')}}</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{ route('admin.property.edit',$property->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                                <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $property->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        </div>
    </section>
</div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/property/") }}'+"/"+id)
    }
</script>
@endsection
