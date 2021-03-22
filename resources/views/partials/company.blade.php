<div class="row">
    <a role="button" href="#" class="btn btn-primary pull-right">+ Add Company</a>
</div>
<table class="table table-bordered" id="company_datatable">
    <thead>
        <tr>
            <td>S.No</td>
            <td>Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Website</td>
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
                    { data: 'logo', name: 'logo' },
                    { data: 'created_at', name: 'created_at' },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                 ]
        });
     });
  </script>