@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Why choose us')}}</title>
@endsection
@section('admin-content')
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Why choose us')}}</h1>
          </div>

          @include('template-part.admin_lang_switcer')

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.why-choose-us.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code"
                                    value="{{ request('lang_code') ?? admin_lang() }}">

                            <div class="row">

                              @if (admin_lang() === 'en')
                                <div class="form-group col-12">
                                    <label>{{__('admin.Existing icon')}}</label>
                                    <div>
                                        <img src="{{ asset($item->icon) }}" alt="" class="w_80">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label>{{__('admin.New icon')}} <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file"  name="icon">
                                </div>

                                @endif

                                <div class="form-group col-12">
                                    <label>{{__('admin.Title')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="title" value="{{ $item->title }}">
                                </div>

                                <div class="form-group col-12">
                                    <label>{{__('admin.Description')}} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  name="description" value="{{ $item->description }}">
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
