@extends('admin.master_layout')
@section('title')
<title>{{__('admin.FAQ')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.FAQ')}}</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">{{__('admin.Dashboard')}}</a></div>
              <div class="breadcrumb-item">{{__('admin.FAQ')}}</div>
            </div>
          </div>

          @include('template-part.admin_lang_switcer')

          <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.faq-content') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <input type="hidden" name="lang_code" value="{{ admin_lang() }}"> 

                                @if (admin_lang() === 'en')
                                <div class="form-group">
                                    <label for="">{{__('admin.Support Image')}}</label>
                                    <div>
                                        <img class="w_220"  src="{{ ($content->support_image)? asset($content->support_image) : asset($setting->default_placeholder)}}" alt="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.New image')}}</label>
                                    <input type="file" name="support_image" class="form-control-file">
                                </div>
                                @endif

                                <div class="form-group">
                                    <label for="">{{__('admin.Short title')}}</label>
                                    <input type="text" class="form-control" name="faq_short_title" value="{{ $content->short_title }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Long title')}}</label>
                                    <input type="text" class="form-control" name="faq_long_title" value="{{ $content->long_title }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Support time')}}</label>
                                    <input type="text" class="form-control" name="faq_support_time" value="{{ $content->support_time }}">
                                </div>

                                <div class="form-group">
                                    <label for="">{{__('admin.Support title')}}</label>
                                    <input type="text" class="form-control" name="faq_support_title" value="{{ $content->support_title }}">
                                </div>

                                <button class="btn btn-primary">{{__('admin.Update')}}</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.faq.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> {{__('admin.Add New')}}</a>
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th width="5%">{{__('admin.SN')}}</th>
                                    <th width="20%">{{__('admin.Question')}}</th>
                                    <th width="55%">{{__('admin.Answer')}}</th>
                                    <th width="10%">{{__('admin.Status')}}</th>
                                    <th width="10%">{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($faqs as $index => $faq)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>{!! clean($faq->answer) !!}</td>
                                        <td>
                                            @if($faq->status == 1)
                                            <a href="javascript:;" onclick="changeBlogCategoryStatus({{ $faq->id }})">
                                                <input id="status_toggle" type="checkbox" checked data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>

                                            @else
                                            <a href="javascript:;" onclick="changeBlogCategoryStatus({{ $faq->id }})">
                                                <input id="status_toggle" type="checkbox" data-toggle="toggle" data-on="{{__('admin.Active')}}" data-off="{{__('admin.Inactive')}}" data-onstyle="success" data-offstyle="danger">
                                            </a>

                                            @endif
                                        </td>
                                        <td>

                                        <a href="{{ route('admin.faq.edit', ['faq' => $faq->id, 'lang_code' => admin_lang()]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                        <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteData({{ $faq->id }})"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
        $("#deleteForm").attr("action",'{{ url("admin/faq/") }}'+"/"+id)
    }
    function changeBlogCategoryStatus(id){
        var isDemo = "{{ env('APP_MODE') }}"
        if(isDemo == 'DEMO'){
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
        }
        $.ajax({
            type:"put",
            data: { _token : '{{ csrf_token() }}' },
            url:"{{url('/admin/faq-status/')}}"+"/"+id,
            success:function(response){
                toastr.success(response)
            },
            error:function(err){


            }
        })
    }
</script>
@endsection
