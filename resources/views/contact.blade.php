<x-layout><x-slot:title>Contact</x-slot>
    <div class="main">
        <ul>
            <li>nama : {{ $name }}</li>
            <li>kelas : {{ $class }}</li>
            <li>linkedin : <a href={{ $linkedin }} title="Go to Linkedin">Kaisar Affan</a></li>
            <li>salahsatu repository: <a href={{ $porto }} title="Go to repo">Slice grab ui
                </a></li>
        </ul>
    </div>
</x-layout>
