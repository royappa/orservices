@extends('layouts.app')
@section('title')
Trackings
@stop<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    tr.modified {
        background-color: red !important;
    }

    tr.modified>td {
        background-color: red !important;
        color: white;
    }
    .all_form_field .input-daterange input.form-control {width:auto !important;}
    .input-daterange .input-group-addon{
        line-height: 52px;
        vertical-align: middle;
        background-color: #eee;
        border: 1px solid #a4a8b8;
        border-width: 1px 0;
        padding: 0px 15px;
    }
    .input-daterange input:first-child{border-radius: 12px 0 0 12px;}
    .input-daterange input:last-child{border-radius: 0px 12px 12px 0px;}
    .datepicker td, .datepicker th{font-size: 11px;}

</style>
@section('content')
<div class="top_header_blank"></div>
<div class="inner_services">
    <div id="locations-content" class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="card-title title_edit mb-30">
                    Tracking
                </h4>
                <div class="card all_form_field">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Organization Tags</label>
                                    <div>
                                        {!! Form::select('organization_tag', $organization_tags, null, ['class' => 'form-control selectpicker', 'id' => 'organization_tag', 'multiple' => true, 'data-live-search' => 'true', 'data-size' => 5]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Service Tags</label>
                                    <div>
                                        {!! Form::select('service_tag', $service_tags, null, ['class' => 'form-control selectpicker', 'id' => 'service_tag', 'multiple' => true, 'data-live-search' => 'true', 'data-size' => 5]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Status</label>
                                    <div>
                                        {!! Form::select('status', $organizationStatus, null, ['class' => 'form-control selectpicker', 'id' => 'status', 'multiple' => true, 'data-live-search' => 'true', 'data-size' => 5]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Last Updated By</label>
                                    <div>
                                        <select name="last_updated_by" id="last_updated_by" class="form-control selectpicker"  data-live-search='true' data-size='5'>
                                            <option value="">Select</option>
                                            @foreach ($users as $value)
                                            <option value="{{ $value->id }}">{{ $value->first_name .' '. $value->last_name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-md-12 control-label">Last Verified By</label>
                                    <div>
                                        <select name="last_verified_by" id="last_verified_by" class="form-control selectpicker" data-live-search='true' data-size='5'>
                                            <option value="">Select</option>
                                            @foreach ($users as $value)
                                            <option value="{{ $value->id }}">{{ $value->first_name .' '. $value->last_name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Saved Filter</label>
                                    <div>
                                        <select name="saved_filter" id="saved_filters" class="form-control selectpicker">
                                            <option value="">Select</option>
                                            @foreach ($saved_filters as $value )
                                            <option value="{{ $value }}">{{ $value->filter_name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- {!! Form::select('status', $saved_filters, null, ['class' => 'form-control selectpicker', 'id' => 'status', 'multiple' => true, 'data-live-search' => 'true', 'data-size' => 5]) !!} --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-4 control-label">Last Updated Date</label>
                                    {{-- <div> --}}
                                        {{-- <input type="date" name="start_date" id="start_date" class="form-control"> --}}
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-sm form-control" name="start_updated" id="start_updated" />
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-sm form-control" name="end_updated" id="end_updated" />
                                        </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">Last Verified Date</label>
                                    {{-- <div>
                                        <input type="date" name="end_date" id="end_date" class="form-control">
                                    </div> --}}
                                    <div class="input-daterange input-group" id="datepicker1">
                                        <input type="text" class="input-sm form-control" name="start_verified" id="start_verified" />
                                        <span class="input-group-addon">to</span>
                                        <input type="text" class="input-sm form-control" name="end_verified" id="end_verified" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-md-12 control-label d-flex">Bookmarks Only
                                    <input type="checkbox" name="organization_bookmark_only" id="organization_bookmark_only" value="1" class="d-inline-block ml-2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{-- <label for="inputPassword3" class="col-sm-3 control-label"></label> --}}
                                    <div class="col-sm-12 text-right">
                                        <button type="button" class="btn btn-success" id="saveFilterButton">Save New Filter</button>
                                        <a href="javascript:void(0)" id="export_csv" class="btn btn-info">Download CSV</a>
                                        {{-- <a href="/manage_filters" class="btn btn-info">Manage Filters</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <table class="table table-striped jambo_table bulk_action table-responsive"> -->
                        <table id="tb_organizations_table" class="display dataTable table-striped jambo_table table-bordered table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" >Bookmark</th>
                                    <th class="text-center" >Name</th>
                                    {{-- <th class="text-center">Url</th> --}}
                                    <th class="text-center">Organization Tags</th>
                                    <th class="text-center">Organization Status</th>
                                    <th class="text-center">Service Tags</th>
                                    <th class="text-center" data-type='date'>Date Last Verified</th>
                                    <th class="text-center">Last Verified By</th>
                                    <th class="text-center" data-type='date'>Last Note Date</th>
                                    <th class="text-center" data-type='date'>Last Updated Date</th>
                                    <th class="text-center">Last Updated By</th>
                                    {{-- <th class="text-center">Description</th> --}}
                                    {{-- <th class="text-center">Legal status</th> --}}
                                    {{-- <th class="text-center">Tax status</th> --}}
                                    {{-- <th class="text-center">Tax id</th> --}}
                                    {{-- <th class="text-center">Year incorporated</th> --}}
                                    {{-- <th class="text-center">Services</th> --}}
                                    {{-- <th class="text-center">Phones</th> --}}
                                    {{-- <th class="text-center">Location</th> --}}
                                    {{-- <th class="text-center">Contact</th> --}}
                                    {{-- <th class="text-center">Details</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Passing BASE URL to AJAX -->
    <input id="url" type="hidden" value="{{ \Request::url() }}">

    <!-- Modal -->
    <div class="modal fade" id="editStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Oraganization Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/saveOrganizationStatus" method="post">
                    @csrf
                    <div class="modal-body all_form_field">
                        <input type="hidden" name="organization_recordid" id="organization_recordid_status">
                        <div class="form-group">
                            <label class="p-0">Status</label>
                            <div>
                                {!! Form::select('organisation_status', $organizationStatus, null, ['class' => 'form-control selectpicker', 'id' => 'organisation_status_pop_up','data-live-search' => 'true', 'data-size' => 5]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-primary" data-target="#create_new_organization_tag" data-toggle="modal">Create New Tag</button> --}}
                        <button type="button" class="btn btn-danger btn-lg btn_delete red_btn " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btn_padding green_btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- save filter Modal -->
    <div class="modal fade " id="saveFilterModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Save Filter Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/saveOrganizationFilter" method="post">
                    @csrf
                    <div class="modal-body all_form_field">
                        <input type="hidden" name="organization_recordid" id="organization_recordid_status">
                        <input type="hidden" name="extraData" id="extra_data_filter_pop_up">
                        <div class="form-group">
                            <label class="p-0">Filter Name</label>
                            <div>
                                <input type="text" name="filter_name" id="filter_name_pop_up" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-primary" data-target="#create_new_organization_tag" data-toggle="modal">Create New Tag</button> --}}
                        <button type="button" class="btn btn-danger btn-lg btn_delete red_btn " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btn_padding green_btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editTagModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Oraganization Tags</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/saveOrganizationTags" method="post">
                    @csrf
                    <div class="modal-body all_form_field">
                        <input type="hidden" name="organization_recordid" id="organization_recordid">
                        <div class="form-group">
                            <label class="p-0">Tag</label>
                            <div>
                                {!! Form::select('organization_tag[]', $organization_tags, null, ['class' => 'form-control selectpicker', 'id' => 'organization_tag_pop_up', 'multiple' => true, 'data-live-search' => 'true', 'data-size' => 5]) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn_darkblack yellow_btn " data-target="#create_new_organization_tag" data-toggle="modal">Create New Tag</button>
                        <button type="button" class="btn btn-danger btn-lg btn_delete red_btn " data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btn_padding green_btn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- organization tag modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="create_new_organization_tag">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/createNewOrganizationTag" method="post">
                    @csrf
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Create New Organization Tag</h4>
                    </div>
                    <input type="hidden" name="organization_recordid" id="organization_recordid_create">
                    <div class="modal-body all_form_field">
                        <div class="form-group">
                            <label style="margin-bottom:5px;font-weight:600;color: #000;letter-spacing: 0.5px;">Tag</label>
                            <input type="text" class="form-control" name="tag" placeholder="tag" id="tag">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-lg btn_delete red_btn organizationTagCloseButton"  data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-lg btn_padding green_btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End here --}}
@endsection

@section('customScript')
<script src="{{ URL::asset('/backend/vendors/sumoselect/jquery.sumoselect.js') }}"></script>
<link href="{{ URL::asset('/backend/vendors/sumoselect/sumoselect.css') }}" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    // $('#organization_tag').SumoSelect({ placeholder: 'Nothing selected' });
    $('.input-daterange').datepicker({ format: 'yyyy-mm-dd' }).val();
    $("#organization_tag").selectpicker();
    $("#service_tag").selectpicker();
    let tb_organizations_table;
    let extraData = {};
    let ajaxUrl = "{{ route('tracking.index') }}";
    $(document).ready(function() {
        tb_organizations_table = $('#tb_organizations_table').DataTable({
            processing: true,
            serverSide: true,
            order: [[ 8, "desc" ]],
            ajax: {
                url: ajaxUrl,
                method: "get",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                data: function(d) {
                    if (typeof extraData !== 'undefined') {
                        // $('#loading').show();
                        d.extraData = extraData;
                    }
                },
            },
            columns: [
                {
                    data: 'bookmark',
                    name: 'bookmark'
                },
                {
                    data: 'organization_name',
                    name: 'organization_name'
                },
                // {
                //     data: 'organization_url',
                //     name: 'organization_url'
                // },
                {
                    data: 'organization_tag',
                    name: 'organization_tag'
                },
                {
                    data: 'organization_status_x',
                    name: 'organization_status_x'
                },
                {
                    data: 'service_tag',
                    name: 'service_tag'
                },
                {
                    data: 'last_verified_at',
                    name: 'last_verified_at'
                },
                {
                    data: 'last_verified_by',
                    name: 'last_verified_by'
                },
                {
                    data: 'last_note_date',
                    name: 'last_note_date'
                },
                {
                    data: 'latest_updated_date',
                    name: 'latest_updated_date'
                },
                {
                    data: 'updated_by',
                    name: 'updated_by'
                },
                // {
                //     data: 'organization_description',
                //     name: 'organization_description'
                // },
                // {
                //     data: 'organization_legal_status',
                //     name: 'organization_legal_status'
                // },
                // {
                //     data: 'organization_tax_status',
                //     name: 'organization_tax_status'
                // },
                // {
                //     data: 'organization_tax_id',
                //     name: 'organization_tax_id'
                // },
                // {
                //     data: 'organization_year_incorporated',
                //     name: 'organization_year_incorporated'
                // },
                // {
                //     data: 'services',
                //     name: 'services'
                // },
                // {
                //     data: 'phones',
                //     name: 'phones'
                // },
                // {
                //     data: 'location',
                //     name: 'location'
                // },
                // {
                //     data: 'contact_name',
                //     name: 'contact_name'
                // },
                // {
                //     data: 'organization_details',
                //     name: 'organization_details'
                // },
            ],
            columnDefs: [{
                    "targets": 0,
                    "orderable": true,
                    "class": "text-center",
                },
                {
                    "targets": 1,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 2,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 3,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 4,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 5,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 6,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 7,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 8,
                    "orderable": true,
                    "class": "text-left"
                },
                {
                    "targets": 9,
                    "orderable": true,
                    "class": "text-left"
                },
                // {
                //     "targets": 10,
                //     "orderable": true,
                //     "class": "text-left"
                // },
                // {
                //     "targets": 11,
                //     "orderable": true,
                //     "class": "text-left"
                // },
                // {
                //     "targets": 12,
                //     "orderable": true,
                //     "class": "text-left"
                // },
                // {
                //     "targets": 13,
                //     "orderable": true,
                //     "class": "text-left"
                // },
                // {
                //     "targets": 14,
                //     "orderable": true,
                //     "class": "text-left"
                // },
            ],
        });
        $('#organization_tag').change(function() {
            let val = $(this).val()
            extraData.organization_tag = val
            tb_organizations_table.ajax.reload()
        })
        $('#service_tag').change(function() {
            let val = $(this).val()
            extraData.service_tag = val
            tb_organizations_table.ajax.reload()
        })
        $('#status').change(function() {
            let val = $(this).val()
            extraData.status = val
            tb_organizations_table.ajax.reload()
        })
        $('#organization_bookmark_only').change(function(){
            let val = $(this).is(':checked')
            extraData.organization_bookmark_only = val
            tb_organizations_table.ajax.reload()
        })
        // $('#start_date').change(function() {
        //     let val = $(this).val()
        //     extraData.start_date = val
        //     tb_organizations_table.ajax.reload()
        // })
        $('#start_verified').change(function() {
            let val = $(this).val()
            extraData.start_verified = val
            tb_organizations_table.ajax.reload()
        })
        $('#last_updated_by').change(function() {
            let val = $(this).val()
            extraData.last_updated_by = val
            tb_organizations_table.ajax.reload()
        })
        $('#last_verified_by').change(function() {
            let val = $(this).val()
            extraData.last_verified_by = val
            tb_organizations_table.ajax.reload()
        })
        $('#end_verified').change(function() {
            let val = $(this).val()
            extraData.end_verified = val
            tb_organizations_table.ajax.reload()
        })
        $('#start_updated').change(function() {
            let val = $(this).val()
            extraData.start_updated = val
            tb_organizations_table.ajax.reload()
        })
        $('#end_updated').change(function() {
            let val = $(this).val()
            extraData.end_updated = val
            tb_organizations_table.ajax.reload()
        })
        $('#saved_filters').change(function() {
            extraData = {}
            if($(this).val()){
                let val = JSON.parse($(this).val())

                if(val.organization_tags){
                    extraData.organization_tag = val.organization_tags.split(',')
                }
                if(val.service_tags){
                    extraData.service_tag = val.service_tags.split(',')
                }
                if(val.status){
                    extraData.status = val.status.split(',')
                }
                if(val.bookmark_only){
                    extraData.organization_bookmark_only = val.bookmark_only
                }
                if(val.start_date){
                    extraData.start_date = val.start_date
                }
                if(val.end_date){
                    extraData.end_date = val.end_date
                }
                if(val.start_verified){
                    extraData.start_verified = val.start_verified
                }
                if(val.end_verified){
                    extraData.end_verified = val.end_verified
                }
                if(val.start_updated){
                    extraData.start_updated = val.start_updated
                }
                if(val.end_updated){
                    extraData.end_updated = val.end_updated
                }
                if(val.last_verified_by){
                    extraData.last_verified_by = val.last_verified_by
                }
                if(val.last_updated_by){
                    extraData.last_updated_by = val.last_updated_by
                }
                // extraData.end_date = val
            }
            tb_organizations_table.ajax.reload()
        })
        $(document).on('click','.organizationTags',function(){
            let id = $(this).data('id');
            let tags = $(this).data('tags');

            if(tags.toString().indexOf(',') !== -1){
                tags = tags.split(',')
            }
            if(id){
                $('#organization_tag_pop_up').val(tags)
                $('#organization_recordid').val(id)
                $('#organization_recordid_create').val(id)
                $('#organization_tag_pop_up').selectpicker()
                $('#organization_tag_pop_up').selectpicker('refresh')
                $('#editTagModal').modal('show')
            }
        })
        $(document).on('click','.organizationStatuses',function(){
            let id = $(this).data('id');
            let status = $(this).data('status');

            if(status.toString().indexOf(',') !== -1){
                status = status.split(',')
            }
            if(id){
                $('#organisation_status_pop_up').val(status)
                $('#organization_recordid_status').val(id)
                // $('#organization_recordid_create').val(id)
                $('#organisation_status_pop_up').selectpicker()
                $('#organisation_status_pop_up').selectpicker('refresh')
                $('#editStatusModal').modal('show')
            }
        })
        $('#saveFilterButton').click(function(){
            $('#extra_data_filter_pop_up').val(JSON.stringify(extraData));
            $('#saveFilterModal').modal('show');
        })
        $(document).on('click','.clickBookmark',function(){
            let id = $(this).data('id');
            let value = $(this).data('value');
            if(value == 0){
                value = 1
            }else{
                value = 0
            }
            let self = $(this)
            $.ajax({
                url : '{{ route("tables.saveOrganizationBookmark") }}',
                method : 'post',
                data : {value,id},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                success: function (response) {
                    // location.reload()
                    tb_organizations_table.ajax.reload()
                    // if(value == 0){
                    //     self.find('img').attr('src','/images/bookmark.svg')
                    // }else{
                    //     self.find('img').attr('src','/images/unbookmark.svg')
                    // }
                    alert(response.message)
                },
                error : function (error) {
                    console.log(error)
                }
            })
        })
        $('#export_csv').click(function () {
            _token = '{{ csrf_token() }}'
            $.ajax({
                url:"{{ route('tracking.export') }}",
                method : 'POST',
                data:{extraData,_token},
                success:function(response){
                    // const url = window.URL.createObjectURL(new Blob([response]));
                    const a = document.createElement('a');
                            a.href = response.path;
                            a.download = 'organizations.csv';
                            document.body.appendChild(a);
                            a.click();
                },
                error : function(error){
                    console.log(error)
                }
            })
        })
    });
</script>
{{-- <script src="{{ asset('js/organization_ajaxscript.js') }}"></script> --}}
@endsection
