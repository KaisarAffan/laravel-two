<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end items-center mb-4">

        <a id="addBtn" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
            Add +
        </a>
    </div>

    <div class="relative overflow-x-auto bg-white shadow-md rounded-lg mt-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                    <th scope="col" class="px-8 py-4 rounded-e-lg">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $Department)
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

                    <td class="px-6 py-4  flex space-x-2">
                        <button onclick="showDetailModal({{ $Department->id }})"
                            class="text-white bg-blue-500 px-12 py-1 text-lg rounded-lg hover:bg-blue-600" title="View Details">
                            <h4>View detail</h4>
                        </button>
                        <button
                            onclick="showEditModal({{ $Department->id }},'{{$Department->Name}}','{{$Department->Description}}')"
                            class="text-white bg-green-500 px-6 py-1  text-lg rounded-lg hover:bg-green-700" title="Edit">
                            <h1>Edit</h1>
                        </button>
                        <button onclick="showDeleteModal({{ $Department->id }})"
                            class="text-white bg-red-500 px-6 py-1 text-lg rounded-lg hover:bg-red-700" title="Delete">
                            <h1>Delete</h1>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- add modal --}}
    <div id="addModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Add New Grade</h2>
            <form id="addForm" action="{{ route('admin.departments.store') }}" method="POST">
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
                    <label for="Description" class="block text-sm font-medium text-gray-700">Department</label>
                    <input type="text" id="Description" name="Description"
                        class="mt-1 block w-full px-4 py-2 border rounded-md focus:ring-blue-500 focus:border-blue-500"
                        required>
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

    {{-- edit modal --}}
    <div id="editModal"
    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-medium text-gray-800">Edit Student</h2>
        <form id="editForm" action="{{route('admin.departments.update',$Department->id )}}" method="POST">
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
                <div class="mb-4">
                    <label for="editDescription" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea id="editDescription" name="Description" class="mt-1 block w-full px-4 py-2 border rounded-md"></textarea>
                </div>
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
    <div id="deleteModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Delete Confirmation</h2>
            <p>Are you sure you want to delete this Grade?</p>
            <form id="deleteForm" action="{{route('admin.departments.delete',$Department->id )}}"method="POST">
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

    {{-- detail modal --}}
    <div id="detailModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Department Details</h2>
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
                    <dd id="detailDescription" class="text-gray-900"></dd>
                </div>
                <div class="mb-2">
                    <dt class="text-sm font-medium text-gray-700">Students</dt>
                    <dd class="text-gray-900">
                        <ul id="gradeList" class="list-disc pl-5"></ul>
                    </dd>
                </div>
            </dl>
            <div class="flex justify-between">
                <button onclick="showEditModal({{ $Department->id }}, '{{ $Department->Name }}', '{{ $Department->Description }}')"
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

    <script>
        const addBtn = document.getElementById('addBtn');

        const editModal = document.getElementById('editModal');
        const addModal = document.getElementById('addModal');
        const deleteModal = document.getElementById('deleteModal');
        const detailModal = document.getElementById('detailModal');

        const closeEditModalBtn = document.getElementById('closeEditModalBtn');
        const closeAddModalBtn = document.getElementById('closeAddModalBtn');
        const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
        const closeDetailModalBtn = document.getElementById('closeDetailModalBtn');
        const editDetile = document.getElementById('editDetile');

        function showEditModal(id, name, Description) {
            document.getElementById('editName').value = name;
            document.getElementById('editDescription').value = Description;
            document.getElementById('editForm').action = `departments/update/${id}`;
            editModal.classList.remove('hidden');
        }

        function showDeleteModal(id) {
            document.getElementById('deleteForm').action = `departments/delete/${id}`;
            deleteModal.classList.remove('hidden');
        }

        function showDetailModal(id) {
            fetch(`departments/show/${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('detailId').textContent = data.id;
                    document.getElementById('detailName').textContent = data.Name;
                    document.getElementById('detailDescription').textContent = data.Description;

                    const gradeList = document.getElementById('gradeList');
                    gradeList.innerHTML = '';
                    data.grades.forEach(grades => {
                        const li = document.createElement('li');
                        li.textContent = grades.Name;
                        gradeList.appendChild(li);
                    });
                    detailModal.classList.remove('hidden');

                });
        }

        addBtn.addEventListener('click', () => {
            addModal.classList.remove('hidden');
        });

        [closeAddModalBtn, closeEditModalBtn, closeDeleteModalBtn, closeDetailModalBtn,editDetile].forEach(btn => {
            btn.addEventListener('click', () => {
                btn.closest('.z-50').classList.add('hidden');
            });
        });

        window.addEventListener('click', (e) => {
            if (e.target === addModal) {
                addModal.classList.add('hidden');
            }
            if (e.target === editModal) {
                editModal.classList.add('hidden');
            }
            if (e.target === deleteModal) {
                deleteModal.classList.add('hidden');
            }
            if (e.target === detailModal) {
                detailModal.classList.add('hidden');}
        });

    </script>
</x-dashboard-layout>
