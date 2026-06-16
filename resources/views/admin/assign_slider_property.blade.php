@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Assign Slider Property')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Assign Slider Property')}}</h1>

          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.store-slider-property') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Property')}} <span class="text-danger">*</span></label>
                                    <select name="property_id" id="" class="form-control select2">
                                        <option value="">{{__('admin.Select')}}</option>
                                        @foreach ($properties as $property)
                                        <option value="{{ $property->id }}">{{ $property->title }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                    <input type="number" id="serial" class="form-control"  name="serial">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Save')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
                </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Property')}}</th>
                                    <th>{{__('admin.Image')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties->where('show_slider', 'enable') as $index => $property)
                                    <tr>
                                        <td>{{ $property->serial }}</td>
                                        <td>
                                            <a href="">{{ $property->title }}</a>
                                        </td>

                                        <td>
                                            <img class="w_120" src="{{ ($property->thumbnail_image)? asset($property->thumbnail_image) : asset($setting->default_placeholder)}}" alt="">
                                        </td>

                                        <td>
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
        </section>
      </div>


<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/remove-slider-property/") }}'+"/"+id)
    }
</script>
@endsection
