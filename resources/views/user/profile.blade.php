<!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('https://workforlife.herokuapp.com/css/app.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <title>Profile</title>
</head>
<body>
-->
@extends('layout.layout')

@section('content')
<section class="flex item-center justify-center my-20 mx-10">

    <div class="flex-shrink-0 w-44 mb-6 h-44 sm:mb-0">
        @if($profilUser->foto_profil == NULL)
        <img src="{{ asset('img/avatar.png') }}" alt=""
            class="object-cover object-center w-full h-full rounded-full bg-white">
        @else
        <img src="{{ asset('storage/' . $profilUser->foto_profil) }}" alt=""
            class="object-cover object-center w-full h-full rounded-full bg-white">
        @endif
    </div>
    <div class="flex flex-col space-y-4 pl-5 mt-3">
        <div>
            <h4 class="text-lg mb-1">HALO,</h4>
            <h2 class="text-4xl font-medium mb-1">{{ $profilUser->nama }}</h2>
            <span class="text-md text">{{ $profilUser->posisi }} in {{ $profilUser->perusahaan }}</span>
        </div>
        <div>
            <button
                class="px-3 py-1 rounded-full bg-[#E84A5F] text-white font-bold border-[#E84A5F] hover:bg-[#E84A5F]/75 border-[#E84A5F]/75">
                <a href="/profile/{{ session()->get('username') }}/edit">EDIT PROFIL</a>
            </button>
        </div>

</section>

<div class="flex flex-wrap font-montserrat" id="tabs-id">
    <div class="w-full">
        <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                <a class="text-sm font-bold px-5 py-3 border-b-4 border-[#123C69] block-1 leading-normal text-dongker bg-white"
                    onclick="changeAtiveTab(event,'tab-profile')">
                    Informasi Diri
                </a>
            </li>
            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                <a class="text-sm font-bold px-5 py-3 border-b-4 leading-normal text-dongker bg-white"
                    onclick="changeAtiveTab(event,'tab-settings')">
                    Postingan Saya
                </a>
            </li>
            <li class="-mb-px mr-2 last:mr-0 flex-auto text-center">
                <a class="text-sm font-bold px-5 py-3 border-b-4 leading-normal text-dongker bg-white"
                    onclick="changeAtiveTab(event,'tab-events')">
                    Event Saya
                </a>
            </li>
        </ul>
        <div class="relative flex flex-col min-w-0 break-words bg-[#F6F6F6] mb-6 mx-32 shadow-lg rounded">
            <div class="px-4 py-5 flex-auto">
                <div class="tab-content tab-space">
                    <div class="block" id="tab-profile">
                        <div class="mx-auto">
                            <form>
                                <div class="flex flex-wrap">
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block text-blueGray-600 text-sm font-bold mb-2"
                                                htmlfor="grid-password">
                                                Nama
                                            </label>
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ $profilUser->nama }}" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block text-blueGray-600 text-sm font-bold mb-2"
                                                htmlfor="grid-password">
                                                Nomor Telepon
                                            </label>
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ $profilUser->no_telp }}" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block text-blueGray-600 text-sm font-bold mb-2"
                                                htmlfor="grid-password">
                                                Jenis Kelamin
                                            </label>
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ $profilUser->jk }}" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block text-blueGray-600 text-sm font-bold mb-2"
                                                htmlfor="grid-password">
                                                Email
                                            </label>
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ $profilUser->email }}" disabled readonly>
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block text-blueGray-600 text-sm font-bold mb-2"
                                                htmlfor="grid-password">
                                                Posisi
                                            </label>
                                            @if($profilUser->posisi == NULL)
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="-" disabled readonly>
                                            @else
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ $profilUser->posisi }}" disabled readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="w-full lg:w-6/12 px-4">
                                        <div class="relative w-full mb-3">
                                            <label class="block text-blueGray-600 text-sm font-bold mb-2"
                                                htmlfor="grid-password">
                                                Perusahaan
                                            </label>
                                            @if($profilUser->perusahaan == NULL)
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="-" disabled readonly>
                                            @else
                                            <input type="text" id="disabled-input-2"
                                                class="bg-white border border-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                                value="{{ $profilUser->perusahaan }}" disabled readonly>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="hidden" id="tab-settings">
                        <!-- component -->
                        @foreach ($my_posts as $post)
                        <div class="flex bg-white shadow-lg rounded-xl mx-4 md:mx-auto max-w-md md:max-w-2xl mb-5">
                            <!--horizantil margin is just for display-->
                            <div class="flex items-start px-4 py-6">
                                <img class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                                    src="{{ asset('img/avatar.png') }}" alt="avatar">
                                <div class="">
                                    <div class="flex items-center justify-between">
                                        <h2 class="text-lg font-semibold text-gray-900 -mt-1">{{ $profilUser->nama }}
                                        </h2>
                                    </div>
                                    <p class="text-gray-700">{{ $post->created_at }}</p>
                                    <h6 class="mt-3 font-extrabold block n-2 line-clamp-2">{{ $post->judul }}</h6>
                                    <p class="mt-1 text-gray-700 text-sm block n-2 line-clamp-2">
                                        {{ $post->deskripsi  }}
                                    </p>
                                    <form action="/posts/{{ $post->id }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="font-medium text-dongker"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?')">Hapus</button>
                                    </form>
                                    <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary tombol2">Edit</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="hidden" id="tab-events">
                        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                    <tr class="bg-[#F4F7FC]" style="background-color: #F4F7FC">
                                        <th scope="col" class="py-3 px-6">
                                            Nama Event
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Deskripsi
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Tanggal Event
                                        </th>
                                        <th scope="col" class="py-3 px-6">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($my_events as $event)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $event->nama }}
                                        </th>
                                        <td class="py-4 px-6">
                                        {{ $event->deskripsi }}
                                        </td>
                                        <td class="py-4 px-6">
                                        {{ $event->tanggal_event }}
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($event->status_bayar == "Berhasil")
                                            <p class="p-2 rounded-md text-white text-xs uppercase"
                                                style="background-color: #2F9960">{{ $event->status_bayar }}</p>
                                                <button
                                                    class="p-2 rounded-md text-white font-bold mt-2" style="background-color: #6D6D6D;">
                                                    <a href= "{{$event->link_conference}}">
                                                        <svg width="15" height="16" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_579_6871)"><path d="M6.25 8.62498C6.51841 8.98381 6.86085 9.28072 7.25409 9.49557C7.64734 9.71041 8.08219 9.83818 8.52916 9.87019C8.97612 9.9022 9.42474 9.83771 9.84459 9.68109C10.2644 9.52448 10.6457 9.2794 10.9625 8.96248L12.8375 7.08748C13.4067 6.4981 13.7217 5.70871 13.7146 4.88935C13.7075 4.06998 13.3788 3.2862 12.7994 2.7068C12.22 2.1274 11.4362 1.79874 10.6169 1.79162C9.79751 1.7845 9.00813 2.09948 8.41875 2.66873L7.34375 3.73748" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.74988 7.37502C8.48147 7.01619 8.13903 6.71928 7.74579 6.50443C7.35254 6.28958 6.91769 6.16182 6.47072 6.12981C6.02376 6.0978 5.57514 6.16229 5.15529 6.31891C4.73544 6.47552 4.35418 6.7206 4.03738 7.03752L2.16238 8.91252C1.59314 9.5019 1.27815 10.2913 1.28527 11.1106C1.29239 11.93 1.62105 12.7138 2.20045 13.2932C2.77985 13.8726 3.56364 14.2013 4.383 14.2084C5.20237 14.2155 5.99175 13.9005 6.58113 13.3313L7.64988 12.2625" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0_579_6871"><rect width="15" height="15" fill="white" transform="translate(0 0.5)"/></clipPath></defs></svg>
                                                    </a>
                                                </button>
                                            @elseif($event->status_bayar == "Menunggu Pembayaran")
                                            <p class="p-2 rounded-md text-white text-xs uppercase" style="background-color: #D6AD2B">{{ $event->status_bayar }}
                                                <button
                                                    class="p-2 rounded-md text-black font-bold mt-2" style="background-color: #FFFFFF;">
                                                    <a href= "{{ route('formPayment', ['id' => $event->id]) }}">
                                                        Bayar Sekarang
                                                    </a>
                                                </button>
                                            </p>
                                            @elseif($event->status_bayar == "Menunggu Konfirmasi")
                                            <p class="p-2 rounded-md text-white text-xs uppercase"
                                                style="background-color: #6680C2">{{ $event->status_bayar }}</p>
                                            @else($event->status_bayar == "Gagal")
                                            <p class="p-2 rounded-md text-white text-xs uppercase"
                                                style="background-color: #6D6D6D">{{ $event->status_bayar }}</p>
                                            @endif
                                        </td>
                                    </tr>
                                 @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script type="text/javascript">
function changeAtiveTab(event, tabID) {
    let element = event.target;
    while (element.nodeName !== "A") {
        element = element.parentNode;
    }
    ulElement = element.parentNode.parentNode;
    aElements = ulElement.querySelectorAll("li > a");
    tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
    for (let i = 0; i < aElements.length; i++) {
        aElements[i].classList.remove("border-[#123C69]");
        aElements[i].classList.add("text-dongker");
        tabContents[i].classList.add("hidden");
        tabContents[i].classList.remove("block");
    }
    element.classList.add("text-dongker");
    element.classList.add("border-[#123C69]");
    document.getElementById(tabID).classList.remove("hidden");
    document.getElementById(tabID).classList.add("block");
}
</script>

@endsection
<!--
</body>
</html>
-->