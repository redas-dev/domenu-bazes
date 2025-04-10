@extends('layouts/main')

@section('body')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="max-w-screen-xl mx-auto p-4">
        <h1 class="text-3xl font-semibold">Bibliotekos</h1>
        <table class="w-full mt-4">
            <thead>
                <tr>
                    <th class="text-left">Nr.</th>
                    <th class="text-left">Pavadinimas</th>
                    <th class="text-left">Kalba</th>
                    <th class="text-left">Savininkas</th>
                    <th class="text-left">Sukurimo data</th>
                    <th class="text-left">Veiksmai</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($libraries as $library)
                    <tr>
                        <td class="py-2">{{$library->id}}</td>
                        <td class="py-2">{{$library->Pavadinimas}}</td>
                        <td class="py-2">{{$library->Kalba}}</td>
                        <td class="py-2">{{$library->Slapyvardis}}</td>
                        <td class="py-2">{{new \Carbon\Carbon($library->Sukurimo_data)->toDateString()}}</td>
                        <td class="py-2">
                            <div>
                                <a href="/libraries/{{$library->id}}" class="text-blue-500">Peržiūrėti</a>
                                <button id="delete" data-id={{$library->id}} class="text-red-500">Ištrinti</button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            <a href="/create" class="text-blue-500">Pridėti naują biblioteką</a>
        </div>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.querySelectorAll('#delete').forEach(item => {
            item.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                swal({
                    title: "Ar tikrai norite ištrinti šią biblioteką?",
                    text: "Po ištrynimo, šios bibliotekos duomenys bus negrįžtamai ištrinti iš duomenų bazės!",
                    icon: "warning",
                    buttons: {
                        cancel: "Atšaukti",
                        confirm: "Ištrinti"
                    },
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        fetch(`/libraries/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        })
                        .then(() => {
                            window.location.reload();
                        });
                    }
                });
            });
        });
    </script>

@endsection
