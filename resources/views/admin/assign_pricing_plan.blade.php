@extends('admin.master_layout')
@section('title')
<title>{{__('admin.Assign Pricing Plan')}}</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>{{__('admin.Assign Pricing Plan')}}</h1>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.store-assign-pricing-plan') }}" method="post">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Select Plan')}} <span class="text-danger">*</span></label>
                                        <select name="plan_id" id="plan_id" class="form-control">
                                            @foreach ($items as $item)
                                            <option value="{{ $item->id }}">{{ $item->plan_name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="">{{__('admin.Select Agent')}} <span class="text-danger">*</span></label>
                                        <select name="agent_id" id="agent_id" class="form-control select2">
                                            @foreach ($agents as $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }} - {{ $agent->phone }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary">{{__('admin.Save')}}</button>

                        </form>
                    </div>
                  </div>
                </div>
          </div>
        </section>
      </div>
@endsection

