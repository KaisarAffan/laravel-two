<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 text-left text-sm font-semibold text-gray-900">No</th>
                        <th class="py-2 text-left text-sm font-semibold text-gray-900">Nama</th>
                        <th class="py-2 text-left text-sm font-semibold text-gray-900">Department</th>
                        <th class="py-2 text-left text-sm font-semibold text-gray-900">Grade</th>
                        <th class="py-2 text-left text-sm font-semibold text-gray-900">Email</th>
                        <th class="py-2 text-left text-sm font-semibold text-gray-900">Alamat</th>
                        <th class="py-2 text-left text-sm font-semibold text-gray-900"></th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
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
    </div>

</x-layout>
