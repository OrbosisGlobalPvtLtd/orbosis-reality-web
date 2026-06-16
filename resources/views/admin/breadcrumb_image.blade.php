@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Banner Image')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Banner Image')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Banner Image')}}</div>
            </div>
          </div>

          <div class="section-body">

            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.banner-image.update',$image->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Image')}}</label>
                                <div>
                                    <img class="w_300" src="{{ ($image->image)? asset($image->image) : asset($setting->default_placeholder)}}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New Image')}}</label>
                                <input type="file" class="form-control-file" name="image">
                            </div>

                            <button class="btn btn-success">{{__('admin.Update')}}</button>
                        </form>

                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
