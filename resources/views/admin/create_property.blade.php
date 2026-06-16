@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Create Property')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Create Property')}}</h1>
          </div>

          @include('template-part.admin_lang_switcer')


          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-create-property') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ admin_lang() }}"> 


                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Rent logo')}}</label>
                                <div>
                                    <img width="200px" src="{{ asset($setting->rent_logo) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New logo')}}</label>
                                <input type="file" name="rent_logo" class="form-control-file">
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Rent title')}}</label>
                                <input type="text" name="rent_title" class="form-control" value="{{ $setting->rent_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Rent description')}}</label>
                                <textarea name="rent_description" id="" class="form-control text-area-5" cols="30" rows="10">{{ $setting->rent_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Rent button text')}}</label>
                                <input type="text" name="rent_btn_text" class="form-control" value="{{ $setting->rent_btn_text }}">
                            </div>

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Sale logo')}}</label>
                                <div>
                                    <img width="200px" src="{{ asset($setting->sale_logo) }}" alt="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.New logo')}}</label>
                                <input type="file" name="sale_logo" class="form-control-file">
                            </div>

                            @endif

                            <div class="form-group">
                                <label for="">{{__('admin.Sale title')}}</label>
                                <input type="text" name="sale_title" class="form-control" value="{{ $setting->sale_title }}">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Sale description')}}</label>
                                <textarea name="sale_description" id="" class="form-control text-area-5" cols="30" rows="10">{{ $setting->sale_description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Sale button text')}}</label>
                                <input type="text" name="sale_btn_text" class="form-control" value="{{ $setting->sale_btn_text }}">
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
