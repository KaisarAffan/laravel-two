<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-nav-link href="/dashboard" :active="request()->is('home')">Home</x-nav-link>

</x-layout>
