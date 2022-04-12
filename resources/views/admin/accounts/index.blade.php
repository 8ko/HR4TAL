@extends('layouts.main')
@section('content')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Accounts</h3>
  @include('layouts.flash-messages')
  <div class="card shadow">
    <div class="card-header py-3">
      <p class="text-primary m-0 fw-bold">Manage Accounts</p>
    </div>
    <div class="card-body">
      <table id="user-table" class="table table-hover table-responsive">
        <thead>
          <tr>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#user-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: "{{ route('admin.accounts.list') }}",
        "order": [
            [0, "desc"]
        ],
        columns: [
            { data: 'employee_id', name: 'employee_id'},
            { data: 'first_name', name: 'first_name'},
            { data: 'last_name', name: 'last_name'},
            { data: 'email', name: 'email'},
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
  });
</script>
@endsection