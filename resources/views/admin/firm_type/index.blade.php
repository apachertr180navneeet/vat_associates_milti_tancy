@extends('admin.layouts.app')
@section('title', 'Super Admin Firm Type')
@section('style')

@endsection  
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Firm Type</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route("admin.firm.type.create") }}" class="btn btn-primary">
                Add Firm Type
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="firmTypeTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    const baseUrl = "{{ route('admin.firm.type.edit', ['id' => ':id']) }}";

    $('#firmTypeTable').DataTable({
        processing: true,
        serverSide: true, // Added for better server-side processing
        ajax: {
            url: "{{ route('admin.firm.type.all') }}",
            type: "GET",
        },
        columns: [
            {
                data: "name",
            },
            {
                data: "status",
                render: (data, type, row) => {
                    return row.status === 'active'
                        ? '<span class="badge bg-label-success me-1">Active</span>'
                        : '<span class="badge bg-label-danger me-1">Inactive</span>';
                }
            },
            {
                data: "id", // Corrected to use `id` for action links
                render: (id, type, row) => {
                    let buttons = '';
                    
                    // Status toggle buttons
                    if (row.status === 'inactive') {
                        buttons += `<button type="button" class="btn btn-sm btn-success me-1" onclick="status(${id}, 'active')">Activate</button>`;
                    } else if (row.status === 'active') {
                        buttons += `<button type="button" class="btn btn-sm btn-danger me-1" onclick="status(${id}, 'inactive')">Deactivate</button>`;
                    }

                    // Delete button
                    buttons += `<button type="button" class="btn btn-sm btn-danger me-1" onclick="deleteData(${id})">Delete</button>`;

                    // Edit button
                    buttons += `<a href="${baseUrl.replace(':id', id)}" class="btn btn-sm btn-warning">Edit</a>`;

                    return buttons;
                }
            }
        ]
    });




    function status(firmtypeid,status){
        var message = '';
        if(status == 'active'){
            message = 'Firm Type able to login after active!';
        }else{
            message = 'Firm Type cannot login after Inactive!';
        }

        
        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Okey'
        }).then((result) => {
            if(result.isConfirmed == true) {
                $.ajax({
                    type: "POST",
                    url: "{{route('admin.firm.type.status')}}",
                    data: {'firmtypeid':firmtypeid,'status':status,'_token': "{{ csrf_token() }}"},
                    success: function(response) {
                        if(response.success){
                            if(status == 1){
                                setFlesh('success','Firm Type Activate Successfully');
                            }else{
                                setFlesh('success','Firm Type Inactivate Successfully');
                            }
                            $('#firmTypeTable').DataTable().ajax.reload();
                        }else{
                            setFlesh('error','There is some problem to change status!Please contact to your server adminstrator');
                        }
                    }
                });
            }else{
                $('#firmTypeTable').DataTable().ajax.reload();
            }
        })
    }


    function deleteData(firmtypeid){
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this Firm Type!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if(result.isConfirmed == true) {
                var url = '{{ route("admin.firm.type.destroy", ":firmtypeid") }}';
                url = url.replace(':firmtypeid', firmtypeid);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {'_token': "{{ csrf_token() }}"},
                    success: function(response) {
                        if(response.success){
                            setFlesh('success','Firm Type Deleted Successfully');
                            $('#firmTypeTable').DataTable().ajax.reload();
                        }else{
                            setFlesh('error','There is some problem to delete Firm Type!Please contact to your server adminstrator');
                        }
                    }
                });
            }
        })
    }
</script>
@endsection
