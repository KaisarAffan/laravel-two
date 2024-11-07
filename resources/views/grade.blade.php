<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="max-w-fit mx-auto bg-white p-6 rounded-lg shadow">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-3 text-left text-sm font-semibold text-gray-900">No</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-900">Grade Name</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-900">Department Name</th>
                        <th class="py-2 px-4 text-left text-sm font-semibold text-gray-900">Student List</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($grade as $user)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ $user->id }}</td>
                            <td class="py-2 px-4">{{ $user->Name }}</td>

                            <td class="py-2 px-4">{{ $user->Department->Name }}</td>
                            <td class="py-2 px-4">
                                @foreach ($user->students as $student)
                                    <li>{{ $student->Nama }}</li>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-layout>
