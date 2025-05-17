<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-6 text-gray-900">
                        <table id="userTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
  
<script>
$(document).ready(function() {
var table = $('#userTable').DataTable({
    processing: true,
    serverSide: false,
    ajax: {
        url: '/admin/users-data',
        error: function(xhr, error, thrown) {
            console.log("AJAX Error: ", xhr.responseText);
            alert("Failed to load user data. Check console for details.");
        }
    },
    columns: [
        { data: 'name', name: 'name', render: function(data, type, row) {
            return `<input type="text" class="editable" data-id="${row.id}" data-column="name" value="${data}" />`;
        }},
        { data: 'email', name: 'email', render: function(data, type, row) {
            return `<input type="text" class="editable" data-id="${row.id}" data-column="email" value="${data}" />`;
        }},
        { data: null, orderable: false, render: function (data, type, row) {
            return `<button class="saveBtn" data-id="${row.id}">Save</button>`;
        }}
    ]
});


    // Handle save button
    $('#userTable').on('click', '.saveBtn', function () {
        var id = $(this).data('id');
        var row = $(this).closest('tr');
        var updatedData = {
            name: row.find('input[data-column="name"]').val(),
            email: row.find('input[data-column="email"]').val(),
        };

        $.ajax({
            url: `/admin/update-user/${id}`,
            method: 'POST',
            data: {
                ...updatedData,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert('Updated successfully!');
                table.ajax.reload();
            }
        });
    });
});
</script>


</x-app-layout>
