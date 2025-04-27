@extends('layouts.main')

@section('body')
    <div class="max-w-screen-xl mx-auto p-4">
        <form method="POST" action="{{ route('aggregate') }}">
            @csrf
            <h1 class="text-3xl font-semibold">Ataskaitos</h1>
            <div class="mt-4">
                <label for="private" class="block text-white text-xl text-gray-700">Matomumas</label>
                <select name="private" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="-1" selected>Visi</option>
                    <option value="0">Viesa</option>
                    <option value="1">Privati</option>
                </select>
            </div>
            <div class="mt-4">
                <label class="block text-white text-xl text-gray-700">Bibliotekos sukurimo data</label>

                <label for="createdFrom" class="block text-white font-medium text-gray-700">Nuo:</label>
                <input type="date" name="createdFrom" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                <label for="createdTo" class="block text-white font-medium text-gray-700">Iki:</label>
                <input type="date" name="createdTo" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>

            <div class="mt-4">
                <label class="block text-white text-xl text-gray-700">Kalba</label>
                <input name="language" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"/>

            </div>

            <div class="mt-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Sudaryti ataskaita</button>
            </div>
        </form>
    </div>
@endsection
