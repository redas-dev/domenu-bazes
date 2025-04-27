@extends('layouts.main')
@section('body')
    <div class="max-w-screen-xl mx-auto p-4">
        <h1 class="text-3xl font-semibold">Ataskaitos</h1>
        @if($aggregatedData->isNotEmpty())
            @foreach($aggregatedData as $user => $libraries)
                @if($user !== "")
                    <table class="w-full mt-4 table-fixed">
                        <h2 class="text-2xl font-semibold mt-4">{{$user}}</h2>
                        <thead>
                            <tr>
                                <th class="text-left w-1/5 py-2">Pavadinimas</th>
                                <th class="text-left w-1/5 py-2">Privati</th>
                                <th class="text-left w-1/5 py-2">Vidutinis failo dydis</th>
                                <th class="text-left w-1/5 py-2">Didziausias parsisiusto failo dydis</th>
                                <th class="text-left w-1/5 py-2">Bendra failu suma</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($libraries as $library => $libraryData)
                                @if($library !== "")
                                    <tr>
                                        <td class="py-2">{{$libraryData[0]->LibraryName}}</td>
                                        <td class="py-2">{{$libraryData[0]->Privati ? "Taip" : "Ne"}}</td>
                                        <td class="py-2">{{$libraryData[0]->AverageFileSize}}</td>
                                        <td class="py-2">{{$libraryData[0]->MaxSingleFileDownloads}}</td>
                                        <td class="py-2">{{$libraryData[0]->TotalFileSize}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2"></td>
                                <td class="py-2 text-xl font-bold">Bendra failu suma:</td>
                                <td class="py-2">{{$aggregatedData[$user][""][0]->TotalFileSize}}</td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            @endforeach
            <table class="w-full mt-4 table-fixed">
                <h2 class="text-2xl font-semibold mt-4">Bendras</h2>

                <thead>
                    <tr>
                        <th class="text-left w-1/5 py-2"></th>
                        <th class="text-left w-1/5 py-2"></th>
                        <th class="text-left w-1/5 py-2"></th>
                        <th class="text-left w-1/5 py-2"></th>
                        <th class="text-left w-1/5 py-2"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2"></td>
                        <td class="py-2 text-2xl font-bold">Galutine suma:</td>
                        <td class="py-2">{{$aggregatedData[""][""][array_key_last($aggregatedData[""][""]->toArray())]->TotalFileSize}}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>
                Nera duomenu.
            </p>
        @endif
    </div>
@endsection
