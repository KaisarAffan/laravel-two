<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Name</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Class</th>
                    <th scope="col" class="px-6 py-3">Department</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Email</th>
                    <th scope="col" class="px-6 py-3">Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $Student)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                            {{ $Student->id }}
                        </td>
                        <td class="px-6 py-4">{{ $Student->Nama }}</td>
                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{ $Student->Grade->Name }}</td>
                        <td class="px-6 py-4">{{ $Student->Grade->Department->Name }}</td>
                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{ $Student->Email }}</td>
                        <td class="px-6 py-4">{{ $Student->Alamat }}</td>
                    </tr>
                @endforeach
                @foreach ($students as $user)
                    <tr class="border-t">
                        <td class="py-2">{{ $user->id }}</td>
                        <td class="py-2">{{ $user->Nama }}</td>
                        <td class="py-2">{{ $user->Grade->Department->Name }}</td>
                        <td class="py-2">{{ $user->Grade->Name }}</td>
                        <td class="py-2">{{ $user->Email }}</td>
                        <td class="py-2">{{ $user->Alamat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-dashboard-layout>
