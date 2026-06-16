@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Assign homepage city')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Assign homepage city')}}</h1>

          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.store-assign-homepage-city') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Image')}} <span class="text-danger">*</span></label>
                                    <input type="file" id="image" class="form-control-file"  name="image">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.City')}} <span class="text-danger">*</span></label>
                                    <select name="city_id" id="" class="form-control select2">
                                        <option value="">{{__('admin.Select')}}</option>
                                        @foreach ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
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
                                    <th>{{__('admin.City')}}</th>
                                    <th>{{__('admin.Image')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities->where('show_homepage', 1) as $index => $city)
                                    <tr>
                                        <td>{{ $city->serial }}</td>
                                        <td>{{ $city->name }}</td>

                                        <td>
                                            <img class="w_80" src="{{ ($city->image)? asset($city->image) : asset($setting->default_placeholder)}}" alt="">
                                        </td>

                                        <td>
                                            <a href="javascript:;" data-toggle="modal" data-target="#editCity-{{ $city->id }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $city->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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


      @foreach ($cities->where('show_homepage', 1) as $index => $city)
      <!-- Modal -->
      <div class="modal fade" id="editCity-{{ $city->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title">{{__('admin.Edit city')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ route('admin.update-assign-homepage-city', $city->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing Image')}}</label>
                                    <div>
                                        <img class="w_80" src="{{ ($city->image)? asset($city->image) : asset($setting->default_placeholder)}}" alt="">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Image')}}</label>
                                    <input type="file" id="image" class="form-control-file"  name="image">
                                </div>


                                <div class="form-group col-12">
                                    <label>{{__('admin.Serial')}} <span class="text-danger">*</span></label>
                                    <input type="number" id="serial" class="form-control"  name="serial" value="{{ $city->serial }}">
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-primary">{{__('admin.Update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
      </div>

     @endforeach

    <script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/remove-homepage-city/") }}'+"/"+id)
    }
</script>
@endsection
