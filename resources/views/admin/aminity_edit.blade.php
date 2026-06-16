@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Edit Aminity')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Edit Aminity')}}</h1>
          </div>

          @include('template-part.admin_lang_switcer')

          <div class="section-body">
            <a href="{{ route('admin.aminity.index') }}" class="btn btn-primary"><i class="fas fa-list"></i> {{__('admin.Aminities')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.aminity.update', $aminity->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="lang_code" value="{{ admin_lang() }}"> 


                            <div class="form-group">
                                <label for="">{{__('admin.Aminity')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="aminity" value="{{ $aminity->aminity }}">
                            </div>

                            <button class="btn btn-primary">{{__('admin.Update')}}</button>

                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection
