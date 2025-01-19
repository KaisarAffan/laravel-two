<x-dashboard-layout>

    <x-slot:title>{{ $title }}</x-slot:title>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end items-center mb-4">

        <a id="addGradeBtn" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
            Add +
        </a>
    </div>

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
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $Grade)
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
                        <td class="px-6 py-4  flex space-x-2">
                            <button onclick="showDetailModal({{ $Grade->id }})"
                                class="text-white bg-blue-500 px-6 py-3 text-lg rounded-lg hover:bg-blue-600" title="View Details">
                                <h1>View detail</h1>
                            </button>
                            <button
                                onclick="showEditModal({{ $Grade->id }},'{{$Grade->Name}}','{{$Grade->department_id}}')"
                                class="text-white bg-green-500 px-6 py-3 text-lg rounded-lg hover:bg-green-700" title="Edit">
                                <h1>Edit</h1>
                            </button>
                            <button onclick="showDeleteModal({{ $Grade->id }})"
                                class="text-white bg-red-500 px-6 py-3 text-lg rounded-lg hover:bg-red-700" title="Delete">
                                <h1>Delete</h1>
                            </button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    {{-- addmodal --}}
    <div id="addGradeModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Add New Grade</h2>
            <form id="addGradeForm" action="{{ route('admin.grades.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="Nama" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="Name" name="Name"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @if ($errors->has('Name'))
                        <p class="text-sm text-red-600 mt-2">{{ $errors->first('Nama') }}</p>
                    @endif
                </div>
                <div class="mb-4">
                    <label for="department_id" class="block text-sm font-medium text-gray-700">Department</label>
                    <select id="department_id" name="department_id"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="" disabled selected>Select Grade</option>
                        @foreach ($department as $departments)
                            <option value="{{ $departments->id }}">{{ $departments->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeAddModalBtn"
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

    {{-- detail modal --}}
    <div id="detailGradeModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Grade Details</h2>
            <dl>
                <div class="mb-2">
                    <dt class="text-sm font-medium text-gray-700">ID</dt>
                    <dd id="detailId" class="text-gray-900"></dd>
                </div>
                <div class="mb-2">
                    <dt class="text-sm font-medium text-gray-700">Name</dt>
                    <dd id="detailName" class="text-gray-900"></dd>
                </div>
                <div class="mb-2">
                    <dt class="text-sm font-medium text-gray-700">Department</dt>
                    <dd id="detailDepartment" class="text-gray-900"></dd>
                </div>
                <div class="mb-2">
                    <dt class="text-sm font-medium text-gray-700">Students</dt>
                    <dd class="text-gray-900">
                        <ul id="studentsList" class="list-disc pl-5"></ul>
                    </dd>
                </div>
            </dl>
            <div class="flex justify-between">
                <button onclick="showEditModal({{ $Grade->id }}, '{{ $Grade->Name }}', '{{ $Grade->department_id }}')"
                    class="text-white bg-green-500 px-6 py-3 text-lg rounded-lg hover:bg-green-700" title="Edit" id="editDetile">
                    <h1>Edit</h1>
                </button>
                <button type="button" id="closeDetailModalBtn"
                    class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md">
                    Close
                </button>
            </div>
        </div>
    </div>

    {{-- edit modal --}}
    <div id="editGradeModal"
    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-medium text-gray-800">Edit Student</h2>
        <form id="editGradeForm" action="{{route('admin.grades.update',$Grade->id )}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="editNama" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="editName" name="Name"
                    class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                    required>
                @if ($errors->has('Name'))
                    <p class="text-sm text-red-600 mt-2">{{ $errors->first('Name') }}</p>
                @endif
            </div>
            <div class="mb-4">
                <label for="editDepartmentId" class="block text-sm font-medium text-gray-700">Department</label>
                <select id="editDepartmentId" name="department_id"
                    class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="" disabled selected>Select Grade</option>
                    @foreach ($department as $departments)
                        <option value="{{ $departments->id }}">{{ $departments->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeEditModalBtn"
                    class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md mr-2">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 text-white bg-blue-500 rounded-md">
                    Save
                </button>
            </div>
        </form>
        </div>
    </div>

    {{-- delete modal --}}
    <div id="deleteGradeModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Delete Confirmation</h2>
            <p>Are you sure you want to delete this Grade?</p>
            <form id="deleteGradeForm" action="{{route('admin.grades.delete',$Grade->id )}}"method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end mt-4">
                    <button type="button" id="closeDeleteModalBtn" class="px-4 py-2 text-gray-600 bg-gray-200 rounded-md mr-2">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 text-white bg-red-500 rounded-md">
                        Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const addGradeBtn = document.getElementById('addGradeBtn');

        const editGradeModal = document.getElementById('editGradeModal');
        const addGradeModal = document.getElementById('addGradeModal');
        const deleteGradeModal = document.getElementById('deleteGradeModal');
        const detailGradeModal = document.getElementById('detailGradeModal');

        const closeEditModalBtn = document.getElementById('closeEditModalBtn');
        const closeAddModalBtn = document.getElementById('closeAddModalBtn');
        const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
        const closeDetailModalBtn = document.getElementById('closeDetailModalBtn');
        const editDetile = document.getElementById('editDetile');

        function showEditModal(id, name, departmentId) {
            document.getElementById('editName').value = name;
            document.getElementById('editDepartmentId').value = departmentId;
            document.getElementById('editGradeForm').action = `grades/update/${id}`;
            editGradeModal.classList.remove('hidden');
        }

        function showDeleteModal(id) {
            document.getElementById('deleteGradeForm').action = `grades/delete/${id}`;
            deleteGradeModal.classList.remove('hidden');
        }

        function showDetailModal(id) {
            fetch(`grades/show/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detailId').textContent = data.id;
                    document.getElementById('detailName').textContent = data.Name;
                    document.getElementById('detailDepartment').textContent = data.department.Name;

                    const studentsList = document.getElementById('studentsList');
                    studentsList.innerHTML = '';
                    data.students.forEach(student => {
                        const li = document.createElement('li');
                        li.textContent = student.Nama;
                        studentsList.appendChild(li);
                    });
                    detailGradeModal.classList.remove('hidden');

                });
        }

        addGradeBtn.addEventListener('click', () => {
            addGradeModal.classList.remove('hidden');
        });

        [closeEditModalBtn, closeAddModalBtn, closeDeleteModalBtn, closeDetailModalBtn,editDetile].forEach(btn => {
            btn.addEventListener('click', () => {
                btn.closest('.z-50').classList.add('hidden');
            });
        });

        window.addEventListener('click', (e) => {
            if (e.target === addGradeModal) {
                addGradeModal.classList.add('hidden');
            }
            if (e.target === editGradeModal) {
                editGradeModal.classList.add('hidden');
            }
            if (e.target === deleteGradeModal) {
                deleteGradeModal.classList.add('hidden');
            }
            if (e.target === detailGradeModal) {
                detailGradeModal.classList.add('hidden');}
        });

    </script>
</x-dashboard-layout>
