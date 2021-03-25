<div class="row" style="float:right;margin-right:10px;margin-bottom:25px;">
    <a role="button" href="{{ url('/add-employee') }}" class="btn btn-primary" >+ Add Employee</a>
</div>
<table class="table table-bordered" id="employee_datatable" width="100%">
    <thead>
        <tr>
            <td>S.No</td>
            <td>Fullname</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Profile Picture</td>
            <td>Dob</td>
            <td>Designation</td>
            <td>Created At</td>
            <td>Action</td>
        </tr>
    </thead>
</table>

<script>
   $(document).ready( function () {
    $('#employee_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url('employeelist') }}",
           columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'fullname', name: 'fullname' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'profile_photo', name: 'profile_photo' },
                    { data: 'dob', name: 'dob' },
                    { data: 'designation', name: 'designation' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                 ]
        });

        $('#employee_datatable').DataTable().on('click', '.edit-employee[data-value]', function (e) {
            var id = $(this).data("value");
            window.location.href = '{{ url("/") }}'+"/edit-employee/"+id;
        });
        $('#employee_datatable').DataTable().on('click', '.delete-employee[data-value]', function (e) {
            if(confirm("Are you Sure you want to delete this employee")){
                var id = $(this).data("value");
                window.location.href = '{{ url("/") }}'+"/delete-employee/"+id;
            }
        });
     });
    
  </script>