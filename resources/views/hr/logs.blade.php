@extends('layouts.main')
@section('content')
<div class="container-fluid">
  <h3 class="text-dark mb-4">Team</h3>
  <div class="card shadow">
    <div class="card-header py-3">
      <p class="text-primary m-0 fw-bold">Employee Info</p>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 text-nowrap">
          <div
            id="dataTable_length"
            class="dataTables_length"
            aria-controls="dataTable">
            <label class="form-label"
              >Show <select class="d-inline-block form-select form-select-sm">
                <option value="20" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select></label>
          </div>
        </div>
        <div class="col-md-6">
          <div id="dataTable_filter" class="text-md-end dataTables_filter">
            <label class="form-label">
              <input
                class="form-control form-control-sm"
                type="search"
                aria-controls="dataTable"
                placeholder="Search"/></label>
          </div>
        </div>
      </div>
      <div
        id="dataTable"
        class="table-responsive table mt-2"
        role="grid"
        aria-describedby="dataTable_info"
      >
        <table id="dataTable" class="table my-0 table-hover">
          <thead>
            <tr>
              <th>Employee ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Department</th>
              <th>Time In</th>
              <th>Time Out</th>
              <th>Type</th>
              <th>Hours Rendered</th>
            </tr>
          </thead>
          <tbody>


            @foreach ($logs as $log)
              <tr onclick="window.location='{{ $log->employee_id }}';">
              <td class="col-md-1">{{ $log->employee_id }}</td>
              <td class="col-md-1">{{ $log->first_name }}</td>
              <td class="col-md-1">{{ $log->last_name }}</td>
              <td class="col-md-1">{{ $log->name }}</td>
              <td class="col-md-1">{{ $log->time_in }}</td>
              <td class="col-md-1">{{ $log->time_out }}</td>
              <td class="col-md-1">{{ $log->log_type }}</td>
              <td class="col-md-1"> {{ $log->rendered }}/{{ $log->quota_hours }}</td> <!-- equation / quota_hours-->
              </tr>
            @endforeach            
            
          </tbody>
          <tfoot>
            <tr>
              <td><strong>Employee ID</strong></td>
              <td><strong>First Name</strong></td>
              <td><strong>Last Name</strong></td>
              <td><strong>Department</strong></td>
              <td><strong>Time In</strong></td>
              <td><strong>Time Out</strong></td>
              <td><strong>Type</strong></td>
              <td><strong>Hours Rendered</strong></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="row">
        <div class="col-md-6 align-self-center">
          <p
            id="dataTable_info"
            class="dataTables_info"
            role="status"
            aria-live="polite"
          >
            Showing 1 to 10 of 27
          </p>
        </div>
        <div class="col-md-6">
          <nav
            class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers"
          >
            <ul class="pagination">
              <li class="page-item disabled">
                <a class="page-link" href="#" aria-label="Previous"
                  ><span aria-hidden="true">«</span></a
                >
              </li>
              <li class="page-item active">
                <a class="page-link" href="#">1</a>
              </li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next"
                  ><span aria-hidden="true">»</span></a
                >
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
@endsection