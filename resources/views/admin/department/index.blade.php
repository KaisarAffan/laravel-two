<x-dashboard-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="relative overflow-x-auto mt-8 max-w-6xl mx-auto">
        <table class="w-full text-base text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-lg text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-8 py-4 rounded-s-lg">
                        No
                    </th>
                    <th scope="col" class="px-8 py-4">
                        Nama
                    </th>
                    <th scope="col" class="px-8 py-4 rounded-e-lg">
                        Description
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($department as $Department)
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row"
                            class="px-8 py-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $Department->id }}
                        </th>
                        <td class="px-8 py-6">
                            {{ $Department->Name }}
                        </td>
                        <td class="px-8 py-6">
                            {{ $Department->Description }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard-layout>
