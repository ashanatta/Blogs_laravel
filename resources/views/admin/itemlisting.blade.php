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

                    {{-- 1) DataTable Markup --}}
                    <table id="itemTable" class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">#</th>
                                <th class="px-4 py-2 text-left font-medium text-gray-700">Name</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            {{-- DataTables will inject rows here --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

        <style>
       
        div.dataTables_length select {
            
            background-image: none; 
        }
        
        </style>

        <script>
        $(document).ready(function () {
            $('#itemTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route("admin.items.data") }}',
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'px-4 py-2' 
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true,
                        className: 'px-4 py-2'
                    },
                    
                ],
                order: [[1, 'asc']],     // sort by column “Name” initially
                pageLength: 10,          // show 10 rows per page by default
                lengthMenu: [10, 25, 50, 100], 
                dom: 'lfrtip',           // length | filter | table | info | pagination
                language: {
                    lengthMenu: 'Show _MENU_ entries',
                    search: 'Search:',
                    processing: 'Loading…'
                }
            });
        });
        </script>
</x-app-layout>
