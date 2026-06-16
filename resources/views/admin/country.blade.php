@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Countries')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Countries')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.country.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>{{__('admin.Country')}}</th>

                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $index => $country)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $country->name }}</td>

                                        <td>
                                            <a href="{{ route('admin.country.edit',$country->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>


                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $country->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>

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
        $("#deleteForm").attr("action",'{{ url("admin/country/") }}'+"/"+id)
    }
</script>
@endsection
