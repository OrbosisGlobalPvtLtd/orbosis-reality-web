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

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('admin.Title')}}</th>
                                    <th>{{__('admin.Icon')}}</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $item)
                                    <tr>
                                        <td>{{ $item->title }}</td>
                                        <td><img src="{{ asset($item->icon) }}" alt="" class="w_80"></td>

                                        <td>
                                            <a href="{{ route('admin.why-choose-us.edit', ['why_choose_u' => $item->id, 'lang_code' => admin_lang()]) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
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
@endsection
