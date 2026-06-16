@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Counter')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Counter')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item active"><a href="{{ route('admin.counter.index') }}">{{__('admin.Counter')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Edit Counter')}}</div>
            </div>
          </div>

          @include('template-part.admin_lang_switcer')

          <div class="section-body">
            <a href="{{ route('admin.counter.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Counter')}}</a>
            <div class="row mt-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.counter.update',$counter->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code"
                                    value="{{ request('lang_code') ?? admin_lang() }}">
                                    
                            <div class="row">

                              @if (admin_lang() === 'en')
                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing Icon')}}</label>
                                    <div>
                                        <img src="{{ asset($counter->icon) }}" alt="" class="w_80">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Icon')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file"  name="icon">
                                </div>

                                <div class="form-group col-12">
                                  <label>{{__('admin.Number')}} <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control"  name="number" value="{{ $counter->number }}">
                              </div>
                              
                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                    <input type="text" id="title" class="form-control"  name="title" value="{{ $counter->title }}">
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
        </section>
      </div>

@endsection
