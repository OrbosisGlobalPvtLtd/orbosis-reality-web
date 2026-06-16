@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Error Page')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Error Page')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Error Page')}}</div>
            </div>
          </div>


          @include('template-part.admin_lang_switcer')

          <div class="section-body">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.error-page.update',$errorpage->id) }}" method="POST" enctype="multipart/form-data">
                            @method('PATCH')
                            @csrf

                            <input type="hidden" name="lang_code"
                            value="{{ request('lang_code') ?? admin_lang() }}">


                            <div class="row">

                                @if (admin_lang() === 'en')
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Image')}}</label>
                                        <div>
                                            <img class="w_300" src="{{ asset($errorpage->image) }}" alt="">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">{{__('admin.New Image')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>
                                </div>

                                @endif

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="header" class="form-control" value="{{ $errorpage->header }}">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Button Text')}}</label>
                                        <input type="text" name="button_text" class="form-control" value="{{ $errorpage->button_text }}">
                                    </div>
                                </div>
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
