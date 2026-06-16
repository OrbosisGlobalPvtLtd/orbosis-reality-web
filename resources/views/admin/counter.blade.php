@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Counter')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Counter')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.Counter')}}</div>
            </div>
          </div>


          @include('template-part.admin_lang_switcer')

            <div class="section-body">
                <div class="row mt-4">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('admin.update-counter-bg') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="lang_code"
                                    value="{{ request('lang_code') ?? admin_lang() }}">

                                    @if (admin_lang() === 'en')
                                    <div class="form-group">
                                        <label for="">{{__('admin.Existing Banner')}}</label>
                                        <div>
                                            <img class="w_180_h_100" src="{{ asset($fun_content->fun_bg) }}" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.New Banner')}}</label>
                                        <input type="file" name="image" class="form-control-file">
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="">{{__('admin.Title')}}</label>
                                        <input type="text" name="fun_title" class="form-control" value="{{ $fun_content->fun_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Description')}}</label>
                                        <input type="text" name="fun_description" class="form-control" value="{{ $fun_content->fun_description }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Item one')}}</label>
                                        <input type="text" name="item_1" class="form-control" value="{{ $fun_content->item_1 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Item two')}}</label>
                                        <input type="text" name="item_2" class="form-control" value="{{ $fun_content->item_2 }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="">{{__('admin.Item three')}}</label>
                                        <input type="text" name="item_3" class="form-control" value="{{ $fun_content->item_3 }}">
                                    </div>




                                    <button type="submit" class="btn btn-success">{{__('admin.Update')}}</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th >{{__('admin.Title')}}</th>
                                    <th>{{__('admin.Icon')}}</th>
                                    <th >{{__('admin.Number')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($counters as $index => $counter)
                                    <tr>
                                        <td>{{ $counter->title }}</td>
                                        <td>
                                            <img src="{{ asset($counter->icon) }}" alt="" class="w_80">
                                        </td>
                                        <td>{{ $counter->number }}</td>

                                        <td>
                                            <a href="{{ route('admin.counter.edit', ['counter' => $counter->id, 'lang_code' => admin_lang()]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                  @endforeach
                            </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>

<script>
    function deleteData(id){
        $("#deleteForm").attr("action",'{{ url("admin/counter/") }}'+"/"+id)
    }
    function changeServiceStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/counter-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
