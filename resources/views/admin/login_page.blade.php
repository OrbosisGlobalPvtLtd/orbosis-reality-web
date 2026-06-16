@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Login page')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Login page')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Login page')}}</div>
            </div>
          </div>

          @include('template-part.admin_lang_switcer')
        

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.update-login-page') }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ admin_lang() }}"> 

                            @if (admin_lang() === 'en')
                            <div class="form-group">
                                <label for="">{{__('admin.Existing logo')}}</label>
                                <div>
                                    <img class="default-avatar" src="{{ asset($login_page->login_page_logo) }}" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.New logo')}}</label>
                                <input type="file" name="logo" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Existing Image')}}</label>
                                <div>
                                    <img class="default-avatar" src="{{ asset($login_page->image) }}" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.New Avatar')}}</label>
                                <input type="file" name="image" class="form-control-file">
                            </div>

                            <div class="form-group">
                                <label for="">{{__('admin.Existing Background')}}</label>
                                <div>
                                    <img class="default-avatar" src="{{ asset($login_page->login_bg_image) }}" alt="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">{{__('admin.New Background')}}</label>
                                <input type="file" name="login_bg_image" class="form-control-file">
                            </div>

                            @endif




                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Top item')}}</label>
                                        <input type="text" name="login_top_item" class="form-control" value="{{ $login_page->login_top_item }}">
                                    </div>
                                </div>

                                @if (admin_lang() === 'en')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Top item quantity')}}</label>
                                        <input type="text" name="login_top_item_qty" class="form-control" value="{{ $login_page->login_top_item_qty }}">
                                    </div>
                                </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Footer item')}}</label>
                                        <input type="text" name="login_footer_item" class="form-control" value="{{ $login_page->login_footer_item }}">
                                    </div>
                                </div>

                                @if (admin_lang() === 'en')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Footer item quantity')}}</label>
                                        <input type="text" name="login_footer_item_qty" class="form-control" value="{{ $login_page->login_footer_item_qty }}">
                                    </div>
                                </div>

                                @endif
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
