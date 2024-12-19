@extends('admin.layouts.app')
@section('title', 'Super Admin Firm Type')
@section('style')

@endsection
@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-6">
            <h5 class="py-2 mb-2">
                <span class="text-primary fw-light">Firm</span>
            </h5>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route("admin.firm.create") }}" class="btn btn-primary">
                Add Firm
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-bordered" id="firmTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Location</th>
                                    <th>Firm Type</th>
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
    const editBaseUrl = "{{ route('admin.firm.edit', ['id' => ':id']) }}";

    $('#firmTable').DataTable({
        processing: true,
        ordering: false,
        ajax: {
            url: "{{ route('admin.firm.all') }}",
            type: "GET",
        },
        columns: [
            {
                data: "firm_name",
            },
            {
                data: "phone",
            },
            {
                data: "location",
            },
            {
                data: "firm_type.name",
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
                    buttons += `<a href="${editBaseUrl.replace(':id', id)}" class="btn btn-sm btn-warning me-1">Edit</a>`;
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
                    url: "{{route('admin.firm.status')}}",
                    data: {'firmtypeid':firmtypeid,'status':status,'_token': "{{ csrf_token() }}"},
                    success: function(response) {
                        if(response.success){
                            if(status == 'active'){
                                setFlesh('success','Firm Type Activated Successfully');
                            }else{
                                setFlesh('success','Firm Type Deactivated Successfully');
                            }
                            $('#firmTable').DataTable().ajax.reload();
                        }else{
                            setFlesh('error','There is some problem to change status! Please contact your server administrator');
                        }
                    }
                });
            }else{
                $('#firmTable').DataTable().ajax.reload();
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
                var url = '{{ route("admin.firm.destroy", ":firmtypeid") }}';
                url = url.replace(':firmtypeid', firmtypeid);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: {'_token': "{{ csrf_token() }}"},
                    success: function(response) {
                        if(response.success){
                            setFlesh('success','Firm Type Deleted Successfully');
                            $('#firmTable').DataTable().ajax.reload();
                        }else{
                            setFlesh('error','There is some problem to delete Firm Type! Please contact your server administrator');
                        }
                    }
                });
            }
        })
    }
</script>
@endsection
