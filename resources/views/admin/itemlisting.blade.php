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
                    <table id="itemTable" class="stripe hover w-full text-sm text-left">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Name</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#itemTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/admin/item-data',
                    error: function (xhr, error, thrown) {
                        console.log("AJAX Error: ", xhr.responseText);
                        alert("Failed to load user data. Check console for details.");
                    }
                },
                columns: [
                    { data: 'name', name: 'name' },
                ],
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    paginate: {
                        next: "Next",
                        previous: "Previous"
                    }
                },
                pageLength: 10,
            });
        });
    </script>
</x-app-layout>
