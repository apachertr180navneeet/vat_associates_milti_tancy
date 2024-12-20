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

    const table = $('#firmTypeTable').DataTable({
        processing: true,
        ordering: false,
        ajax: {
            url: "{{ route('admin.firm.type.all') }}",
            type: "GET",
            dataSrc: function (json) {
                console.log(json);
                return json.data;
            }
        },
        columns: [
            {
                data: "name",
            },
            {
                data: "status",
                render: (data, type, row) => {
                    if (row.status === undefined) {
                        console.error('Status is undefined for row:', row);
                        return '<span class="badge bg-label-danger me-1">Unknown</span>';
                    }
                    return row.status === 'active'
                        ? '<span class="badge bg-label-success me-1">Active</span>'
                        : '<span class="badge bg-label-danger me-1">Inactive</span>';
                }
            },
            {
                data: "id",
                render: (id, type, row) => {
                    let buttons = '';
                    if (row.status === 'inactive') {
                        buttons += `<button type="button" class="btn btn-sm btn-success me-1" onclick="status(${id}, 'active')">Activate</button>`;
                    } else if (row.status === 'active') {
                        buttons += `<button type="button" class="btn btn-sm btn-danger me-1" onclick="status(${id}, 'inactive')">Deactivate</button>`;
                    }
                    buttons += `<button type="button" class="btn btn-sm btn-danger me-1" onclick="deleteData(${id})">Delete</button>`;
                    buttons += `<a href="${baseUrl.replace(':id', id)}" class="btn btn-sm btn-warning">Edit</a>`;
                    return buttons;
                }
            }
        ]
    });

    function status(firmtypeid, status) {
        var message = status === 'active'
            ? 'Firm Type able to login after active!'
            : 'Firm Type cannot login after Inactive!';

        Swal.fire({
            title: 'Are you sure?',
            text: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Okay'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.firm.type.status') }}",
                    data: { 'firmtypeid': firmtypeid, 'status': status, '_token': "{{ csrf_token() }}" },
                    success: function(response) {
                        if (response.success) {
                            setFlesh('success', status === 'active' ? 'Firm Type Activated Successfully' : 'Firm Type Deactivated Successfully');
                            table.ajax.reload(null, false); // Reload the DataTable without resetting the paging
                        } else {
                            setFlesh('error', 'There is some problem to change status! Please contact your server administrator');
                        }
                    }
                });
            } else {
                table.ajax.reload(null, false); // Reload the DataTable without resetting the paging
            }
        });
    }

    function deleteData(firmtypeid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this Firm Type!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                var url = '{{ route("admin.firm.type.destroy", ":firmtypeid") }}';
                url = url.replace(':firmtypeid', firmtypeid);
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: { '_token': "{{ csrf_token() }}" },
                    success: function(response) {
                        if (response.success) {
                            setFlesh('success', 'Firm Type Deleted Successfully');
                            table.ajax.reload(null, false); // Reload the DataTable without resetting the paging
                        } else {
                            setFlesh('error', 'There is some problem to delete Firm Type! Please contact your server administrator');
                        }
                    }
                });
            }
        });
    }
</script>
@endsection
