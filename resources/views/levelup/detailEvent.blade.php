@extends('layout.layout')

@section('content')
<div class="mx-20 my-8">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="#"
                    class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    Event
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <a href="#"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Webinar</a>
                </div>
            </li>
        </ol>
    </nav>
    <div class="grid grid-cols-2 gap-8 mt-5 justify-between">
        <div class="">
            <h2 class="text-3xl font-bold lg:mb-4">{{ $event->nama }}</h2>
            <div class="pt-3">
                <kbd
                    class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-full dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Career</kbd>
                <kbd
                    class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-full dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">Technology</kbd>
            </div>
            <p class="py-5">{{ $event->deskripsi }}</p>
            <div class="flex">
                <p class="mr-4"><i data-feather="user" class="inline mr-3"></i>Work For Life</p>
                <p><i data-feather="calendar" class="inline mr-3"></i>{{ date('d/m/Y', strtotime($event->created_at)) }}
                </p>
                <i data-feather="heart" class="ml-3"></i>
                <i data-feather="share-2" class="ml-3"></i>
            </div>
        </div>
        <div class="">
            <div
                class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg" src="{{ asset('img/webinar.jpg') }}" alt="">
                </a>
                <div class="px-8 py-5">
                    <a href="#">
                        <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $event->nama }}</h5>
                    </a>
                    <ul class="mb-6 text-base">
                        <li class="mb-2">
                            <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            {{ date('Y-m-d', strtotime($event->tanggal_event)) }}
                        </li>
                        <li class="mb-2">
                            <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ date('H:i', strtotime($event->tanggal_event)) }}
                        </li>
                        <li class="mb-2">
                            <svg class="w-6 h-6 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                            Rp {{ $event->harga }}
                        </li>
                    </ul>
                    <a href="/levelup/event/{{ $event->id }}/daftar"
                        class="mx-16 block text-md items-center py-2 font-medium text-center text-white bg-[#E84A5F] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection