@extends('admin.master_layout')
@section('title')
<title>Pending Agent Requests</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pending Agent Requests</h1>
          </div>

          <div class="section-body">
            <div class="row mt-4">
                <div class="col">
                  <div class="card">
                    <div class="card-body">
                      <div class="table-responsive table-invoice">
                        <table class="table table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>{{__('admin.SN')}}</th>
                                    <th>User Name</th>
                                    <th>Company Name</th>
                                    <th>Agency Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>{{__('admin.Action')}}</th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests as $index => $req)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td>{{ html_decode($req->name) }}</td>
                                        <td>{{ html_decode($req?->profile?->company_name) }}</td>
                                        <td>{{ html_decode($req?->profile?->tag_line) }}</td>
                                        <td>{{ html_decode($req->email) }}</td>
                                        <td>{{ html_decode($req?->profile?->phone) }}</td>
                                        <td>
                                            <a href="{{ route('admin.pending-agent-requests.show', $req->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View Request</a>
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
