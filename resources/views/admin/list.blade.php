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
    { data: 'name', name: 'name' },
    { data: 'email', name: 'email' }
]});
});
</script>


</x-app-layout>
