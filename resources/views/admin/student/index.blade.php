<x-dashboard-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ route('admin.students.index') }}" class="relative">
            <input type="text" name="search" placeholder="Search by Name or Grade..."
                class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                value="{{ request('search') }}">
        </form>

        <a id="addStudentBtn" class="px-4 py-2 text-white bg-blue-500 rounded-md hover:fibg-blue-600">
            Add +
        </a>
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
                    <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">Actions</th>
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
                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                            <button onclick="showDetailModal({{ $Student->id }},'{{ $Student->Nama }}', '{{ $Student->Grade->Name }}', '{{ $Student->Grade->Department->Name }}', '{{ $Student->Email }}', '{{$Student->Phone}}','{{ $Student->Alamat }}')"
                                class="text-white bg-blue-500 px-6 py-3 text-lg rounded-lg hover:bg-blue-600" title="View Details">
                                <h1>View Details</h1>
                            </button>
                            <button
                                onclick="showEditModal({{ $Student->id }}, '{{ $Student->Nama }}', {{ $Student->grade_id }}, '{{ $Student->Email }}','{{ $Student->Phone }}', '{{ $Student->Alamat }}')"
                                class="text-white bg-green-500 px-6 py-3 text-lg rounded-lg hover:bg-green-700" title="Edit">
                                <h1>Edit</h1>
                            </button>
                            <!-- Delete Button -->
                            <button onclick="showDeleteModal({{ $Student->id }})"
                                class="text-white bg-red-500 px-6 py-3 text-lg rounded-lg hover:bg-red-700" title="Delete">
                                <h3>Delete</h3>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                Showing
                <span class="font-semibold text-gray-900 dark:text-white">{{ $students->firstItem() }}-{{ $students->lastItem() }}</span>
                of
                <span class="font-semibold text-gray-900 dark:text-white">{{ $students->total() }}</span>
            </span>
            <ul class="inline-flex items-stretch -space-x-px">
                @if ($students->onFirstPage())
                    <li>
                        <span class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300">1</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $students->url(1) }}" class="flex items-center justify-center h-full py-1.5 px-3 ml-0 text-gray-500 bg-white rounded-l-lg border border-gray-300 hover:bg-gray-100">1</a>
                    </li>
                @endif

                @foreach ($students->getUrlRange(2, $students->lastPage() - 1) as $page => $url)
                    <li>
                        <a href="{{ $url }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 {{ $page == $students->currentPage() ? 'bg-blue-500 text-black' : '' }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach

                @if ($students->hasMorePages())
                    <li>
                        <a href="{{ $students->url($students->lastPage()) }}" class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300 hover:bg-gray-100">{{ $students->lastPage() }}</a>
                    </li>
                @else
                    <li>
                        <span class="flex items-center justify-center h-full py-1.5 px-3 leading-tight text-gray-500 bg-white rounded-r-lg border border-gray-300">{{ $students->lastPage() }}</span>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    {{-- Add Modal --}}

    <div id="addStudentModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Add New Student</h2>
            <form id="addStudentForm" action="{{ route('admin.students.store') }}" method="POST">
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
                            <option value="{{ $grade->id }}">{{ $grade->Name }} -- {{ $grade->Department->Name }}</option>
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
                    <label for="Phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" id="Phone" name="Phone"
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

    <div id="detailStudentModal"
    class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-medium text-gray-800">Student Details</h2>
        <dl>
            <div class="mb-2">
                <dt class="text-sm font-medium text-gray-700">id</dt>
                <dd id="detailId" class="text-gray-900"></dd>
            </div>
            <div class="mb-2">
                <dt class="text-sm font-medium text-gray-700">Name</dt>
                <dd id="detailName" class="text-gray-900"></dd>
            </div>
            <div class="mb-2">
                <dt class="text-sm font-medium text-gray-700">Grade</dt>
                <dd id="detailGrade" class="text-gray-900"></dd>
            </div>
            <div class="mb-2">
                <dt class="text-sm font-medium text-gray-700">Department</dt>
                <dd id="detailDepartment" class="text-gray-900"></dd>
            </div>
            <div class="mb-2">
                <dt class="text-sm font-medium text-gray-700">Email</dt>
                <dd id="detailEmail" class="text-gray-900"></dd>
            </div>
            <div class="mb-2">
                <dt class="text-sm font-medium text-gray-700">Phone</dt>
                <dd id="detailPhone" class="text-gray-900"></dd>
            </div>
            <div class="mb-2">
                <dt class="text-sm font-medium text-gray-700">Address</dt>
                <dd id="detailAddress" class="text-gray-900"></dd>
            </div>
        </dl>
            <div class="flex justify-between">
            <button onclick="showEditModal({{ $Student->id }}, '{{ $Student->Nama }}', {{ $Student->grade_id }}, '{{ $Student->Email }}','{{ $Student->Phone }}', '{{ $Student->Alamat }}')"
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
    </div>

    <div id="editStudentModal"
        class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Edit Student</h2>
            <form id="editStudentForm" action="{{route('admin.students.update',$Student->id )}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="editNama" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="editNama" name="Nama"
                        class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="editGradeId" class="block text-sm font-medium text-gray-700">Grade</label>
                    <select id="editGradeId" name="grade_id" class="mt-1 block w-full px-4 py-2 border rounded-md"
                        required>
                        <option value="" disabled selected>Select Grade</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->Name }} -- {{ $grade->Department->Name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="editEmail" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="editEmail" name="Email"
                        class="mt-1 block w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="editPhone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <textarea id="editPhone" name="Phone" class="mt-1 block w-full px-4 py-2 border rounded-md"></textarea>
                </div>
                <div class="mb-4">
                    <label for="editAlamat" class="block text-sm font-medium text-gray-700">Address</label>
                    <textarea id="editAlamat" name="Alamat" class="mt-1 block w-full px-4 py-2 border rounded-md"></textarea>
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

    <div id="deleteStudentModal" class="fixed inset-0 z-50 hidden bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
            <h2 class="text-lg font-medium text-gray-800">Delete Confirmation</h2>
            <p>Are you sure you want to delete this student?</p>
            <form id="deleteStudentForm" action="{{route('admin.students.delete',$Student->id )}}"method="POST">
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
        const addStudentModal = document.getElementById('addStudentModal');
        const editStudentModal = document.getElementById('editStudentModal');
        const deleteStudentModal = document.getElementById('deleteStudentModal');
        const detailStudentModal = document.getElementById('detailStudentModal');

        const closeAddModalBtn=document.getElementById('closeModalBtn');
        const closeEditModalBtn = document.getElementById('closeEditModalBtn');
        const closeDeleteModalBtn = document.getElementById('closeDeleteModalBtn');
        const closeDetailModalBtn = document.getElementById('closeDetailModalBtn');
        const editDetile = document.getElementById('editDetile');

        const editStudentForm = document.getElementById('editStudentForm');
        const deleteStudentForm = document.getElementById('deleteStudentForm');

        function showDetailModal(id,name, grade, department, email, phone, address) {
            detailStudentModal.classList.remove('hidden');
            document.getElementById('detailId').textContent = id;
            document.getElementById('detailName').textContent = name;
            document.getElementById('detailGrade').textContent = grade;
            document.getElementById('detailDepartment').textContent = department;
            document.getElementById('detailEmail').textContent = email;
            document.getElementById('detailPhone').textContent = phone;
            document.getElementById('detailAddress').textContent = address;
        }

        function showEditModal(id, name, gradeId, email,phone , address) {
            document.getElementById('editNama').value = name;
            document.getElementById('editGradeId').value = gradeId;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editAlamat').value = address;
            editStudentForm.action = `update/${id}`;
            editStudentModal.classList.remove('hidden');
        }



        function showDeleteModal(id) {
            deleteStudentForm.action = `students/delete/${id}`;
            deleteStudentModal.classList.remove('hidden');
        }

        [closeEditModalBtn, closeAddModalBtn, closeDeleteModalBtn, closeDetailModalBtn,editDetile].forEach(btn => {
            btn.addEventListener('click', () => {
                btn.closest('.z-50').classList.add('hidden');
            });
        });

        addStudentBtn.addEventListener('click', () => {
            addStudentModal.classList.remove('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === addStudentModal) {
                addStudentModal.classList.add('hidden');
            }
            if (e.target === editStudentModal) {
                editStudentModal.classList.add('hidden');
            }
            if (e.target === deleteStudentModal) {
                deleteStudentModal.classList.add('hidden');
            }
            if (e.target === detailStudentModal) {
                detailStudentModal.classList.add('hidden');}
        });

    </script>
</x-dashboard-layout>
