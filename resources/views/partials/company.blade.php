<div class="row" style="float:right;margin-right:10px;margin-bottom:25px;">
    <a role="button" href="{{ url('/add-company') }}" class="btn btn-primary" >+ Add Company</a>
</div>
<table class="table table-bordered" id="company_datatable">
    <thead>
        <tr>
            <td>S.No</td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Website</td>
            <td>Total Employee</td>
            <td>Logo</td>
            <td>Created At</td>
            <td>Action</td>
        </tr>
    </thead>
</table>

<script>
    
   $(document).ready( function () {
    $('#company_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ url('companylist') }}",
           columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'website', name: 'website' },
                    { data: 'company_employee_count', name: 'company_employee_count' },
                    { data: 'logo_url', name: 'logo_url' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                 ]
        });
        $('#company_datatable').DataTable().on('click', '.edit-company[data-value]', function (e) { 
            var id = $(this).data("value");
            window.location.href = '{{ url("/") }}'+"/edit-company/"+id;
        });
        $('#company_datatable').DataTable().on('click', '.delete-company[data-value]', function (e) {
            if(confirm("Aru Sure you want to delete this company")){
                var id = $(this).data("value");
                window.location.href = '{{ url("/") }}'+"/delete-company/"+id;
            }
        }) 
     });
     
  </script>