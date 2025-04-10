@extends('layouts/main')

@section('body')
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-screen-xl mx-auto p-4">
        <h1 class="text-3xl font-semibold">Pridėti naują biblioteką</h1>
        <form action="/libraries" method="POST" class="mt-4">
            @csrf

            <div class="mb-4">
                <label for="Pavadinimas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pavadinimas <span class="text-danger">*</span></label>
                <input required type="text" id="Pavadinimas" name="Pavadinimas" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="Aprasymas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aprasymas <span class="text-danger">*</span></label>
                <textarea id="Aprasymas" name="Aprasymas" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
            </div>
            <div class="mb-4">
                <label for="Licenzija" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Licenzija <span class="text-danger">*</span></label>
                <input type="text" id="Licenzija" name="Licenzija" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="Privati" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Privati <span class="text-danger">*</span></label>
                <select id="Privati" name="Privati" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="1">Taip</option>
                    <option value="0">Ne</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="Repozitorija" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Repozitorija <span class="text-danger">*</span></label>
                <input type="text" id="Repozitorija" name="Repozitorija" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="Raktazodziai" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Raktazodziai <span class="text-danger">*</span></label>
                <input type="text" id="Raktazodziai" name="Raktazodziai" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="Kalba" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kalba <span class="text-danger">*</span></label>
                <input type="text" id="Kalba" name="Kalba" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-4">
                <label for="Palaikymo_busena" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Palaikymo busena <span class="text-danger">*</span></label>
                <select id="Palaikymo_busena" name="Palaikymo_busena" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="Palaikoma">Palaikoma</option>
                    <option value="Nepalaikoma">Nepalaikoma</option>
                    <option value="Apleista">Apleista</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="Savininkas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Savininkas <span class="text-danger">*</span></label>
                <select id="Savininkas" name="Savininkas" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{$user->Slapyvardis}}</option>
                    @endforeach
                </select>
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
                </tbody>
            </table>
            <div class="flex flex-col items-start w-fit gap-4 mt-4">
                <button id="newVersion" type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Nauja Versija
                </button>

                <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg">Kurti</button>
            </div>
        </form>
        <p
            class="text-sm text-gray-500 mt-4">* - privaloma</p>

        <script>
            let versionRowCount = 0;

            document.getElementById('newVersion').addEventListener('click', function() {
                const table = document.getElementById('versionTable').getElementsByTagName('tbody')[0];
                const row = document.createElement('tr');
                row.innerHTML = `
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
                        this.closest('tr').remove();
                    });
                });
            }

            // Initial attachment of delete handlers
            attachDeleteHandlers();
        </script>
    </div>
@endsection
