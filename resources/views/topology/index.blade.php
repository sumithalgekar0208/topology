<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Topology') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="mynetwork" style="height:800px; border: 2px solid #3141D8;"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var container = document.getElementById("mynetwork");
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            response = JSON.parse(this.responseText);
            var data = {
                nodes: response.nodes,
                edges: response.edges
            };
            var options = {};
            var network = new vis.Network(container, data, options);

        }
        xhttp.open('GET', "{{ route('topology.data') }}")
        xhttp.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
        xhttp.send();

    </script>
</x-app-layout>
