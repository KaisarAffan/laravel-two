<x-dashboard-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <div class="relative overflow-x-auto bg-white shadow-md rounded-lg mt-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Department
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Students
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grade as $Grade)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $Grade->id }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $Grade->Name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $Grade->Department->Name }}
                        </td>
                        <td class="px-6 py-4">
                            <ul>
                                @foreach ($Grade->students as $student)
                                    <li>{{ $student->Nama }}</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-dashboard-layout>
