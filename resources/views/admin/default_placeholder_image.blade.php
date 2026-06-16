@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Default Placeholder')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Default Placeholder')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Default Placeholder')}}</div>
            </div>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-default-placeholder') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="">{{__('admin.Existing Placeholder')}}</label>
                                <div>
                                    <img class="default-placeholder" width="90" height="100" src="{{ asset($default_placeholder->image) }}" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.New Placeholder')}}</label>
                                <input type="file" name="placeholder" class="form-control-file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('admin.Update')}}</button>
                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

@endsection
