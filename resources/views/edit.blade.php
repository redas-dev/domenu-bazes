@extends('layouts/main')

@section('body')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-screen-xl mx-auto p-4">
        <h1 class="text-3xl font-semibold">{{$library->Pavadinimas}}</h1>
        <form action="/libraries/{{$library->id}}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="Nr" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nr</label>
                <input type="text" id="Nr" name="Nr" disabled value="{{$library->id}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <!-- Pavadinimas Field -->
            <div class="mb-4">
                <label for="Pavadinimas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pavadinimas</label>
                <input type="text" id="Pavadinimas" name="Pavadinimas" value="{{$library->Pavadinimas}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="Savininkas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Savininkas</label>
                <select id="Savininkas" name="Savininkas" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($maintainers as $maintainer)
                        <option value="{{$maintainer->id}}" {{$maintainer->Role === 'Savininkas' ? 'selected' : ''}}>{{$maintainer->Slapyvardis}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="Aprasymas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aprasymas</label>
                <textarea id="Aprasymas" name="Aprasymas" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">{{$library->Aprasymas}}</textarea>
            </div>

            <div class="mb-4">
                <label for="Licenzija" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Licenzija</label>
                <input type="text" id="Licenzija" name="Licenzija" value="{{$library->Licenzija}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="Privati" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Privati</label>
                <select id="Privati" name="Privati" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1" {{$library->Privati ? 'selected' : ''}}>Taip</option>
                    <option value="0" {{!$library->Privati ? 'selected' : ''}}>Ne</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="Repozitorija" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repozitorija</label>
                <input type="text" id="Repozitorija" name="Repozitorija" value="{{$library->Repozitorija}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="Raktazodziai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Raktazodziai</label>
                <input type="text" id="Raktazodziai" name="Raktazodziai" value="{{$library->Raktazodziai}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="Kalba" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalba</label>
                <input type="text" id="Kalba" name="Kalba" value="{{$library->Kalba}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label for="Palaikymo_busena" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Palaikymo busena</label>
                <select id="Palaikymo_busena" name="Palaikymo_busena" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="Palaikoma" {{$library->Palaikymo_busena === 'Palaikoma' ? 'selected' : ''}}>Palaikoma</option>
                    <option value="Nepalaikoma" {{$library->Palaikymo_busena === 'Nepalaikoma' ? 'selected' : ''}}>Nepalaikoma</option>
                    <option value="Apleista" {{$library->Palaikymo_busena === 'Apleista' ? 'selected' : ''}}>Apleista</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="Sukurimo_data" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sukurimo data</label>
                <input type="date" id="Sukurimo_data" disabled name="Sukurimo_data" value="{{ \Carbon\Carbon::parse($library->Sukurimo_data)->toDateString() }}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="my-6">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Atnaujinti
                </button>
            </div>

            <h1 class="text-3xl font-semibold">Versijos</h1>
            <table id="versionTable" class="w-full mt-4">
                <thead>
                <tr>
                    <th class="text-left">Versija</th>
                    <th class="text-left">Pakeitimu aprasas</th>
                    <th class="text-left">Ar pasenusi (deprecated)</th>
                    <th class="text-left">Atsisiuntimu skaicius</th>
                    <th class="text-left">Zyme</th>
                    <th class="text-left">Ar eksperimentine</th>
                    <th class="text-left">Stabilumo lygis</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                @foreach($versions as $index => $version)
                    <tr>
                        <input type="hidden" name="versions[{{$index}}][Veiksmas]" value="update" />
                        <td class="py-2">
                            <input type="text" name="versions[{{$index}}][Versija]" value="{{$version->Versija}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <input type="hidden" name="versions[{{$index}}][id]" value="{{$version->id}}">
                        </td>
                        <td class="py-2">
                            <input name="versions[{{$index}}][Pakeitimu_aprasas]" value="{{$version->Pakeitimu_aprasas}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
                        </td>
                        <td class="py-2">
                            <select name="versions[{{$index}}][Pasenusi]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1" {{$version->Deprecated ? 'selected' : ''}}>Taip</option>
                                <option value="0" {{!$version->Deprecated ? 'selected' : ''}}>Ne</option>
                            </select>
                        </td>
                        <td class="py-2">
                            <input name="versions[{{$index}}][Atsisiuntimu_skaicius]" value="{{$version->Atsisiuntimu_skaicius}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </td>
                        <td class="py-2">
                            <input name="versions[{{$index}}][Zyme]" value="{{$version->Zyme}}" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </td>
                        <td class="py-2">
                            <select name="versions[{{$index}}][Eksperimentine]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1" {{$version->Eksperimentine ? 'selected' : ''}}>Taip</option>
                                <option value="0" {{!$version->Eksperimentine ? 'selected' : ''}}>Ne</option>
                            </select>
                        </td>
                        <td class="py-2">
                            <select name="versions[{{$index}}][Stabilumo_lygis]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="alfa" {{$version->Stabilumo_lygis === 'alfa' ? 'selected' : ''}}>Alfa</option>
                                <option value="beta" {{$version->Stabilumo_lygis === 'beta' ? 'selected' : ''}}>Beta</option>
                                <option value="stabili" {{$version->Stabilumo_lygis === 'stabili' ? 'selected' : ''}}>Stabili</option>
                            </select>
                        </td>
                        <td class="py-2">
                            <button type="button" class="delete-version-row px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                Ištrinti
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="my-6">
                <button id="newVersion" type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Nauja Versija
                </button>
                <button id="saveVersions" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Issaugoti
                </button>
            </div>
        </form>
        <script>
            let versionRowCount = {{ count($versions) }};

            document.getElementById('newVersion').addEventListener('click', function() {
                const table = document.getElementById('versionTable').getElementsByTagName('tbody')[0];
                const row = document.createElement('tr');
                row.innerHTML = `
            <input type="hidden" name="versions[${versionRowCount}][Veiksmas]" value="new" />
            <td class="py-2">
                <input type="text" name="versions[${versionRowCount}][Versija]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <input type="hidden" name="versions[${versionRowCount}][id]" value="new">
            </td>
            <td class="py-2">
                <input name="versions[${versionRowCount}][Pakeitimu_aprasas]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>
            </td>
            <td class="py-2">
                <select name="versions[${versionRowCount}][Pasenusi]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">Taip</option>
                    <option value="0" selected>Ne</option>
                </select>
            </td>
            <td class="py-2">
                <input name="versions[${versionRowCount}][Atsisiuntimu_skaicius]" value="0" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </td>
            <td class="py-2">
                <input name="versions[${versionRowCount}][Zyme]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </td>
            <td class="py-2">
                <select name="versions[${versionRowCount}][Eksperimentine]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">Taip</option>
                    <option value="0" selected>Ne</option>
                </select>
            </td>
            <td class="py-2">
                <select name="versions[${versionRowCount}][Stabilumo_lygis]" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="alfa">Alfa</option>
                    <option value="beta" selected>Beta</option>
                    <option value="stabili">Stabili</option>
                </select>
            </td>
            <td class="py-2">
                <button type="button" class="delete-version-row px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Ištrinti
                </button>
            </td>
        `;
                table.appendChild(row);
                versionRowCount++;

                attachDeleteHandlers();
            });

            function attachDeleteHandlers() {
                document.querySelectorAll('.delete-version-row').forEach(button => {
                    button.addEventListener('click', function() {
                        this.closest('tr').hidden = true;
                        this.closest('tr').querySelector('input[name$="[Veiksmas]"]').value = 'delete';
                    });
                });
            }

            // Initial attachment of delete handlers
            attachDeleteHandlers();
        </script>
    </div>
@endsection
