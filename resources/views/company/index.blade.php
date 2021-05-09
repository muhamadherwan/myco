@extends('layouts.main')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>Company</h4>
                </div>
                <div class="col-md-12 text-right mb-5">
                    <a class="btn btn-success" href="javascript:void(0)" id="addNewCompany"> Add New Company</a>
                </div>
                <div class="col-md-12">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th width="280px">Action</th>
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

<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="companyForm" name="companyForm" class="form-horizontal">
                    <input type="hidden" name="company_id" id="company_id">
                    
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="website" class="col-sm-2 control-label">Website</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="website" name="website" placeholder="Enter Website" value="" maxlength="50" required="">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create-company">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>    
    
    <script type="text/javascript">
    $(function () {
     
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        // Read
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('company.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'website', name: 'website'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
        // Create
        $('#addNewCompany').click(function () {
            $('#saveBtn').val("create-company");
            $('#company_id').val('');
            $('#companyForm').trigger("reset");
            $('#modelHeading').html("Add New Company");
            $('#ajaxModel').modal('show');
        });
        
        // Update
        $('body').on('click', '.editCompany', function () {
            var company_id = $(this).data('id');
            $.get("{{ route('company.index') }}" +'/' + company_id +'/edit', function (data) {
                $('#modelHeading').html("Edit Company");
                $('#saveBtn').val("edit-company");
                $('#ajaxModel').modal('show');
                $('#company_id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#website').val(data.website);
            })
            
        });

        // Save
        $('#saveBtn').click(function (e) {
            e.preventDefault();
             $(this).html('Sending..');
                
             $.ajax({
                data: $('#companyForm').serialize(),
                url: "{{ route('company.store') }}",
                type: "POST",
                dataType: 'json',  
                success: function (data) {
                    $('#companyForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },

                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            
            }); 
        });

        // Delete
        $('body').on('click', '.deleteCompany', function (){
        var product_id = $(this).data("id");
        var result = confirm("Are You sure want to delete?");
        if(result){
            $.ajax({
                type: "DELETE",
                url: "{{ route('company.store') }}"+'/'+product_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }else{
            return false;
        }

    });




    });
</script>
@endsection