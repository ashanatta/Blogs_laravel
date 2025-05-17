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
                    <table id="itemTable" class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

   
<script>
$('#itemTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{{ route("admin.items.data") }}',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'name', name: 'name', orderable: true, }
    ],
    dom: 'lfrtip',
    language: {
        lengthMenu: 'Show _MENU_ entries',
        search: 'Search:',
    },
    classes: {
        sLength: 'form-select block w-full mt-1', // for dropdown
    }
});

</script>

</x-app-layout>
