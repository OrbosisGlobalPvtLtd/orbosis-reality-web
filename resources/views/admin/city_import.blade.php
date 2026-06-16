@extends('admin.master_layout')
@section('title')
<title>{{__('admin.City bulk import')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.City bulk import')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.city.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('City List')}}</a>

            <a href="{{ route('admin.city-export') }}" class="btn btn-success"><i class="fas fa-file-export"></i> {{__('Export City List')}}</a>

            <a href="{{ route('admin.city-demo-export') }}" class="btn btn-primary"><i class="fas fa-file-export"></i> {{__('Demo Export')}}</a>

            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.store-import-city') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label>{{__('admin.File')}} <span class="text-danger">*</span></label>
                                    <input type="file" id="file" class="form-control-file"  name="file">
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
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>{{__('Country Id')}}</td>
                            <td>{{__('Required Field. Please make sure that you put in valid country id from country table')}}</td>
                        </tr>

                        <tr>
                            <td>{{__('Name')}}</td>
                            <td>{{__('Required Field')}}</td>
                        </tr>

                        <tr>
                            <td>{{__('Slug')}}</td>
                            <td>{{__('Slug will be always small latter and without space. Also you can not use duplicate')}}</td>
                        </tr>

                    </table>
                </div>
            </div>
          </div>


        </section>
      </div>
@endsection
