<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ route('dashboard-student') }}" class="relative">
            <input type="text" name="search" placeholder="Search by Name or Grade..."
                class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                value="{{ request('search') }}">
        </form>

        <button id="addStudentBtn" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
            Add +
        </button>
    </div>


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

            </tbody>
        </table>
    </div>


    <div id="addStudentModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Add New Student</h2>
            <form id="addStudentForm" action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="Nama" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="Nama" name="Nama"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label for="grade_id" class="block text-sm font-medium text-gray-700">Grade</label>
                    <select id="grade_id" name="grade_id"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="" disabled selected>Select Grade</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="Email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="Email" name="Email"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>
                <div class="mb-4">
                    <label for="Alamat" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea id="Alamat" name="Alamat"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModalBtn"
                        class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md hover:bg-gray-300 mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addStudentBtn = document.getElementById('addStudentBtn');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const addStudentModal = document.getElementById('addStudentModal');

        addStudentBtn.addEventListener('click', () => {
            addStudentModal.classList.remove('hidden');
        });

        closeModalBtn.addEventListener('click', () => {
            addStudentModal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === addStudentModal) {
                addStudentModal.classList.add('hidden');
            }
        });
    </script>

</x-dashboard-layout>
