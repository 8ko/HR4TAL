@extends('layouts.main')
@section('content')
<div class="container-fluid" style="height: 500px;">
    <div class="d-sm-flex justify-content-between align-items-center mb-4"></div>
    <div class="row">        

        <div class="col-md-6 col-xl-3 mb-3" data-bss-hover-animate="pulse">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-s mb-0"><span class="dotw"></span></div>
                            <span class="clock text-dark fw-bold h1 mb-0"></span><br>
                            <span class="date text-uppercase text-dark fw-bold h5"></span>
                        </div>
                        <div class="col-auto"><i class="fas fa-clock fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-3" data-bss-hover-animate="pulse">
            <div class="card shadow border-start-primary py-2">
                <a style="text-decoration:none; color: inherit;" href="{{url(Auth::user()->employee_id)}}"><div class="card-body">
                    <div class="d-flex flex-row no-gutters">
                        <img class="rounded-circle mx-2 my-1" src="{{ Auth::user()->avatar() }}" width="90" height="90" />
                        <div>
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span> {{ Auth::user()->roles->first()->display_name }} </span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>{{ Auth::user()->first_name }} </span></div>
                                <span><small><i class="fas fa-map-marker-alt"></i> {{ Auth::user()->school }} </small></span><br>
                                <span><small><i class="fas fa-award"></i> {{ Auth::user()->course }}</small></span>
                        </div>
                    </div>
                </div></a>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-3" data-bss-hover-animate="pulse">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Department Name</span></div>
                            <div class="text-dark fw-bold h6 mb-3"><span>{{ Auth::user()->department ? $departments[Auth::user()->department] : '' }}</span></div>
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Workgroup</span></div>
                            <div class="text-dark fw-bold h6 mb-0"><span> Human Resources</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-code-branch fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

    
    <!-- <div class="col-md-6 col-xl-3 mb-4" data-bss-hover-animate="pulse">
        <div class="card shadow border-start-success py-2">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col me-2">
                        <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Department Function</span></div>
                        <div class="text-dark fw-bold h5 mb-0">
                            <div class="accordion" role="tablist" id="accordion-1">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="false" aria-controls="accordion-1 .item-1">Web Development</button></h2>
                                    <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#accordion-1">
                                        <div class="accordion-body">
                                            <p class="mb-0"></p>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Meeting</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">Dissemination of Topic</p>
                                                </div>
                                            </div><i class="la la-chevron-circle-down d-xl-flex justify-content-xl-center" style="text-align: center;"></i>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Presentation</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">For Initial Draft/Revision</p>
                                                </div>
                                            </div><i class="la la-refresh d-xl-flex justify-content-xl-center" style="text-align: center;"></i>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">Required a revision for the task.</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">require to present again</p>
                                                </div>
                                            </div><i class="la la-chevron-circle-down d-xl-flex justify-content-xl-center" style="text-align: center;"></i>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="mb-0">For final review</h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text">If that task got satisfactory rating, it is marked as completed</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">Graphic Design</button></h2>
                                    <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-1">
                                        <div class="accordion-body">
                                            <p class="mb-0">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">Content Writing</button></h2>
                                    <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
                                        <div class="accordion-body">
                                            <p class="mb-0">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                        </div>
                                    </div>
                                </div>
                            </div><span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

        <div class="col-md-6 col-xl-3 mb-4" data-bss-hover-animate="pulse">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Feedback</span></div>
                            <small class="datenum fw-bold"></small> | <small>{{ Auth::user()->comment}} </small><br>
                            <small class="datenum fw-bold"></small> | <small>{{ Auth::user()->comment}} </small><br>
                            <small class="datenum fw-bold"></small> | <small>{{ Auth::user()->comment}} </small>
                        </div>
                        <div class="col-auto"><i class="fas fa-comment fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-s mb-1"><span>Time in / Time out</span></div>
                            <a role="button" style="margin-right:5px;" data-bss-hover-animate="pulse" class="btn btn-icon-split border-primary rounded-1 {{ $timeout ? 'disabled' : '' }}"
                                @if (!$timeout)
                                    href="{{route('hr.timein')}}"
                                @endif
                            >
                            <span class="text-primary icon"><i class="far fa-clock"></i></span>
                            <span class="text-primary text">Clock in</span></a>
                            
                            <a role="button" data-bss-hover-animate="pulse" class="btn btn-icon-split border-primary rounded-1 {{ $timeout && !$isTimedOut ? '' : 'disabled' }}"
                                @if ($timeout && !$isTimedOut)
                                    href="{{route('hr.timeout')}}"
                                @endif
                            >
                            <span class="text-primary icon"><i class="fas fa-clock"></i></span>
                            <span class="text-primary text">Clock out</span></a>
                        </div>
                        <div class="col-auto"><i class="fas fa-user-clock fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4" data-bss-hover-animate="pulse">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Department Name</span></div>
                            <div class="text-dark fw-bold h5 mb-0"><span>{{ Auth::user()->department ? $departments[Auth::user()->department] : '' }}</span></div>
                        </div>
                        <div class="col-auto"><i class="fas fa-code-branch fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3 mb-4">
            <div class="card shadow border-start-primary py-2">
                <div class="card-body">
                    <div class="row align-items-center no-gutters">
                        <div class="col me-2">
                            <div class="text-uppercase text-primary fw-bold text-s mb-1"><span>Time in / Time out</span></div>
                            <a style="margin-right:5px;" class="btn btn-primary {{ $timeout ? 'disabled' : '' }}"
                    @if (!$timeout)
                        href="{{route('hr.timein')}}"
                    @endif
                    ><i class="far fa-clock"></i> &nbsp;Clock in</a>
                    <a class="btn btn-primary {{ $timeout && !$isTimedOut ? '' : 'disabled' }}"
                    @if ($timeout && !$isTimedOut)
                        href="{{route('hr.timeout')}}"
                    @endif
                    ><i class="fas fa-clock"></i> &nbsp;Clock Out</a>
                        </div>
                        <div class="col-auto"><i class="fas fa-user-clock fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>
    jQuery(function($) {
        setInterval(function() {
            var date = new Date(),
                time = date.toLocaleTimeString();
            $(".clock").html(time);
            $(".date").html( moment().format('MMM D, YYYY') );
            $(".dotw").html( moment().format('dddd') );
            $(".datenum").html( moment().format('MM/DD/YY') );
            

    // var today = moment().format('D MMM, YYYY');
        }, 1000);
    
    });
</script>
@endsection
