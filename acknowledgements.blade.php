@extends('complaint.app')
@section('page_title','Acknowledged List Of Complaints')

@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 col-8 align-self-center">
                    <h3 class="text-themecolor">LOGIN</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <div class="col-md-7 col-4 align-self-center">
                    <a href="https://wrappixel.com/templates/materialpro/" class="btn waves-effect waves-light btn-danger pull-right hidden-sm-down"> Upgrade to Pro</a>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12 col-md-7">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title">The list of acknowledged complaints</h4>

                            @if (Session::has('flash_message_success'))
                                <p><span class="alert alert-success" style="text-align: center;font-size: 13px;">{{ Session::get('flash_message_success') }}</span></p>
                            @endif

                            @if(Session::has('flash_message_failure'))
                                <p><span class="alert alert-danger" style="text-align: center;font-size: 13px;">{{ Session::get('flash_message_failure') }}</span></p>
                            @endif
                            {{--<h6 class="card-subtitle">Add class <code></code></h6>--}}
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Acknowledgement </th>
                                        <th>Approved By User</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $count = 0; @endphp
                                    @foreach($acknowledgements as $acknowledgement)
                                        @php $count++; @endphp
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td>{{ $acknowledgement->acknowledgement }}</td>
                                            <td>
                                                @if($acknowledgement->approved_by_user == 0)
                                                    {{ "Pending" }}
                                                @elseif($acknowledgement->approved_by_user == 1)
                                                    {{ "Accepted" }}
                                                @elseif($acknowledgement->approved_by_user == 2)
                                                    {{ "Rejected" }}
                                                @endif
                                            </td>
                                            {{--<td>{{ $acknowledgement->when_created }}</td>--}}
                                            <td>
                                                @if($acknowledgement->approved_by_user == 0)
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#complaint_modal{{ $count }}">
                                                        View
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="complaint_modal{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title" id="exampleModalLabel">Complaint Details</h3>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5><strong>Complaint Made</strong></h5>
                                                                    {{ $acknowledgement->complaint }}
                                                                    <hr>
                                                                    <h5><strong>Email Address</strong></h5>
                                                                    {{ $acknowledgement->email_address }}
                                                                    <hr>
                                                                    <h5><strong>Phone Number</strong></h5>
                                                                    {{ $acknowledgement->phone_number }}
                                                                    <hr>
                                                                    <h5><strong>Complaint Type</strong></h5>
                                                                    {{ $acknowledgement->type_of_complaint }}
                                                                    <hr>
                                                                    <h5><strong>Date Submitted</strong></h5>
                                                                    {{ $acknowledgement->when_sent }}
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($acknowledgement->approved_by_user == 1)
                                                    <button type="button" class="btn-success btn" data-toggle="modal" data-target="#send_to_qa{{ $count }}">
                                                        Send To QA
                                                    </button>
                                                        <!-- Modal -->
                                                    <div class="modal fade" id="send_to_qa{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Send Complaint To QA</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ url('complaint/send_to_qa/'.$acknowledgement->complaint_id) }}" id="qa_form{{ $count }}" method="post" class="form-horizontal qa_form form-material">
                                                                        {{ csrf_field() }}
                                                                        <label for="" class="form_submit_error"></label>
                                                                        <div class="form-group">
                                                                            <label for="example-email" class="col-md-12">QA Specialist</label>
                                                                            <div class="col-md-12">
                                                                                <select class="form-control qa_form_select form-control-line" name="speciality" id="example-email">
                                                                                    <option value="">Select QA Specialist</option>
                                                                                    @foreach($specialities as $speciality)
                                                                                        {!! "<option value='".$speciality->specialist_id."'>".$speciality->speciality."</option>" !!}
                                                                                    @endforeach
                                                                                </select>
                                                                                @if ($errors->has('speciality'))
                                                                                    <span class="text-danger">{{ $errors->first('speciality') }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>

                                                                        <button type="submit" class="btn btn-secondary">Assign</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close Modal</button>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif($acknowledgement->approved_by_user == 2)
                                                        <button type="button" class="btn-success btn" data-toggle="modal" data-target="#resolve_complaint{{ $count }}">
                                                            Resend Acknowledgment
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="resolve_complaint{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Read Complaint</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ url('complaint/resend_acknowledgment/'.$acknowledgement->acknowledgement_id) }}" id="resolve_form{{ $count }}" method="post" class="form-horizontal acknowledgement_form form-material">
                                                                            {{ csrf_field() }}
                                                                            <label for="" class="form_submit_error"></label>
                                                                            <div class="form-group">
                                                                                <label for="example-email" class="col-md-12">Acknowledgment letter</label>
                                                                                <div class="col-md-12">
                                                                                    <textarea placeholder="Type Acknowledgment Letter here..." class="form-control acknowledgement form-control-line" name="acknowledgement" id="example-email">{{ old('resolution_letter') }}</textarea>
                                                                                    @if ($errors->has('acknowledgement'))
                                                                                        <span class="text-danger">{{ $errors->first('acknowledgement') }}</span>
                                                                                    @endif
                                                                                </div>
                                                                            </div>

                                                                            <button type="submit" class="btn btn-secondary">Submit Acknowledgement Letter</button>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close Modal</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                @endif
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
        </div>
        <!-- Row -->
        <!-- Row -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer"> © Admin login page </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
@stop