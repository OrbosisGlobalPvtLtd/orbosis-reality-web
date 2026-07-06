@extends('admin.master_layout')
@section('title')
<title>Pending Agent Request Details</title>
@endsection
@section('admin-content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pending Agent Request Details</h1>
          </div>

          <div class="section-body">
            <a href="{{ route('admin.pending-agent-requests') }}" class="btn btn-primary"><i class="fas fa-list"></i> Pending Request List</a>
            
            <div class="row mt-4">
                <div class="col-md-4">
                  <div class="card profile-widget">
                    <div class="profile-widget-header text-center pt-3">
                        @if ($user?->profile?->image && file_exists(public_path($user->profile->image)))
                        <img alt="image" src="{{ asset($user->profile->image) }}" class="rounded-circle profile-widget-picture" style="width:100px; height:100px; object-fit:cover; margin: 0 auto; display: block; border: 3px solid #f2f2f2;">
                        @else
                        <img alt="image" src="{{ asset($default_avatar) }}" class="rounded-circle profile-widget-picture" style="width:100px; height:100px; object-fit:cover; margin: 0 auto; display: block; border: 3px solid #f2f2f2;">
                        @endif
                    </div>
                    <div class="profile-widget-description">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td>User Name</td>
                                    <td>{{ html_decode($user->name) }}</td>
                                </tr>
                                <tr>
                                    <td>User Email</td>
                                    <td>{{ html_decode($user->email) }}</td>
                                </tr>
                                <tr>
                                    <td>User Phone</td>
                                    <td>
                                        @if($user?->profile?->phone)
                                            {{ html_decode($user->profile->phone) }}
                                        @elseif($user->phone)
                                            {{ html_decode($user->phone) }}
                                        @else
                                            Not Provided
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Registered At</td>
                                    <td>{{ $user->created_at->format('d M Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header">
                        <h4>Request Actions</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="row">
                            <div class="col-12">
                                <a href="javascript:;" onclick="approveRequest({{ $user->id }})" class="btn btn-success btn-block btn-lg my-2 text-white">Approve Request</a>
                            </div>
                            <div class="col-12">
                                <a href="javascript:;" onclick="rejectRequest({{ $user->id }})" class="btn btn-danger btn-block btn-lg my-2 text-white">Reject Request</a>
                            </div>

                            <form class="d-none" action="{{ route('admin.pending-agent-requests.approve', $user->id) }}" method="POST" id="approve-form-{{ $user->id }}">
                                @csrf
                            </form>
                            <form class="d-none" action="{{ route('admin.pending-agent-requests.reject', $user->id) }}" method="POST" id="reject-form-{{ $user->id }}">
                                @csrf
                            </form>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Agency Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->company_name) }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Agency Name</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->tag_line) }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->phone) }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->address) }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->city?->name) }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>State</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->state?->name) }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>RERA Number</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->rera_number) }}" readonly>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label>GST Number</label>
                                    <input type="text" class="form-control" value="{{ html_decode($user?->profile?->gst_number) }}" readonly>
                                </div>
                                <div class="col-12 form-group">
                                    <label>About Agency</label>
                                    <textarea class="form-control" style="height: 100px;" readonly>{{ html_decode($user?->profile?->about_us) }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4>Uploaded Documents</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- ID Proof Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="card-title mb-0">ID Proof</h6>
                                        </div>
                                        <div class="card-body text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                                            @if($user?->profile?->id_proof)
                                                @php
                                                    $id_proof_path = public_path($user->profile->id_proof);
                                                    $id_proof_exists = file_exists($id_proof_path);
                                                @endphp
                                                @if($id_proof_exists)
                                                    @php
                                                        $ext = strtolower(pathinfo($user->profile->id_proof, PATHINFO_EXTENSION));
                                                    @endphp
                                                    
                                                    <div class="mb-3">
                                                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                                            <img src="{{ route('admin.pending-agent-requests.document.view', ['id' => $user->id, 'type' => 'id_proof']) }}" class="img-thumbnail" style="max-height: 120px; object-fit: contain;">
                                                        @elseif($ext === 'pdf')
                                                            <i class="fas fa-file-pdf text-danger" style="font-size: 4rem;"></i>
                                                        @elseif(in_array($ext, ['doc', 'docx']))
                                                            <i class="fas fa-file-word text-primary" style="font-size: 4rem;"></i>
                                                        @else
                                                            <i class="fas fa-file text-secondary" style="font-size: 4rem;"></i>
                                                        @endif
                                                    </div>
                                                    <div class="text-muted small mb-3">File: {{ basename($user->profile->id_proof) }}</div>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.pending-agent-requests.document.view', ['id' => $user->id, 'type' => 'id_proof']) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        <a href="{{ route('admin.pending-agent-requests.document.download', ['id' => $user->id, 'type' => 'id_proof']) }}" class="btn btn-success btn-sm">Download</a>
                                                    </div>
                                                @else
                                                    <p class="text-danger font-weight-bold mb-0"><i class="fas fa-exclamation-triangle"></i> File not found</p>
                                                @endif
                                            @else
                                                <p class="text-muted mb-0">Document not uploaded</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Business Documents Card -->
                                <div class="col-md-6 mb-4">
                                    <div class="card h-100 border shadow-sm">
                                        <div class="card-header bg-light">
                                            <h6 class="card-title mb-0">Business Documents</h6>
                                        </div>
                                        <div class="card-body text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 200px;">
                                            @if($user?->profile?->file)
                                                @php
                                                    $file_path = public_path($user->profile->file);
                                                    $file_exists = file_exists($file_path);
                                                @endphp
                                                @if($file_exists)
                                                    @php
                                                        $ext = strtolower(pathinfo($user->profile->file, PATHINFO_EXTENSION));
                                                    @endphp
                                                    
                                                    <div class="mb-3">
                                                        @if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                                            <img src="{{ route('admin.pending-agent-requests.document.view', ['id' => $user->id, 'type' => 'business_document']) }}" class="img-thumbnail" style="max-height: 120px; object-fit: contain;">
                                                        @elseif($ext === 'pdf')
                                                            <i class="fas fa-file-pdf text-danger" style="font-size: 4rem;"></i>
                                                        @elseif(in_array($ext, ['doc', 'docx']))
                                                            <i class="fas fa-file-word text-primary" style="font-size: 4rem;"></i>
                                                        @else
                                                            <i class="fas fa-file text-secondary" style="font-size: 4rem;"></i>
                                                        @endif
                                                    </div>
                                                    <div class="text-muted small mb-3">File: {{ basename($user->profile->file) }}</div>
                                                    <div class="btn-group">
                                                        <a href="{{ route('admin.pending-agent-requests.document.view', ['id' => $user->id, 'type' => 'business_document']) }}" target="_blank" class="btn btn-primary btn-sm">View</a>
                                                        <a href="{{ route('admin.pending-agent-requests.document.download', ['id' => $user->id, 'type' => 'business_document']) }}" class="btn btn-success btn-sm">Download</a>
                                                    </div>
                                                @else
                                                    <p class="text-danger font-weight-bold mb-0"><i class="fas fa-exclamation-triangle"></i> File not found</p>
                                                @endif
                                            @else
                                                <p class="text-muted mb-0">Document not uploaded</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </section>
      </div>

<script>
    function approveRequest(id){
        Swal.fire({
            title: "Are you sure you want to approve this agent request?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, Approve It",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#approve-form-"+id).submit();
            }
        })
    }

    function rejectRequest(id){
        Swal.fire({
            title: "Are you sure you want to reject this agent request?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#3085d6',
            confirmButtonText: "Yes, Reject It",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#reject-form-"+id).submit();
            }
        })
    }
</script>
@endsection
