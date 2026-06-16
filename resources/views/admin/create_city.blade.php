@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create city')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create city')}}</h1>

          </div>

          <div class="section-body">
            <a href="{{ route('admin.city.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.City List')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.city.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>{{__('admin.Country')}} <span class="text-danger">*</span></label>
                                    <select name="country_id" class="form-control select2">
                                        <option disabled selected>{{__('admin.Select Country')}}</option>
                                        @foreach($countries ?? [] as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{__('admin.City')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control"  name="name">
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
        </section>
      </div>
@endsection
