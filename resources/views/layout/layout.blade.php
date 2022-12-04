<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkForLife</title>
    <link rel="icon" href="{{ asset('img/logo1.png') }}">
    <link href="{{ asset('css/testimonial.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="p-4 bg-coolGray-100 text-coolGray-800">
	<div class="container flex justify-between h-16 mx-auto">
		<div class="flex">
			<a rel="noopener noreferrer" href="{{ url('/') }}" aria-label="Back to homepage" class="flex items-center pb-32 pt-2 px-5 w-48 h-48 ">
				<img src="{{ asset('img/logo.png') }}" alt="">
			</a>
			<ul class="items-stretch hidden space-x-3 lg:flex">
				<li class="flex">
					<a rel="noopener noreferrer" href="{{ url('/') }}" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Beranda</a>
				</li>
				<li class="flex">
					<a rel="noopener noreferrer" href="/loker" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Cari Loker</a>
				</li>
				<li class="flex">
					<a rel="noopener noreferrer" href="/posts" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Sharing</a>
				</li>
        <li class="flex">
					<a rel="noopener noreferrer" href="/levelup" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">LevelUp</a>
				</li>
        @if (!(session()->has('token')))
        @else
        @if(session()->get('role')== 2)
        <li class="flex">
					<a rel="noopener noreferrer" href="/admin" class="flex items-center px-4 -mb-1 border-b-2 border-transparent">Admin</a>
				</li>
        @endif
        @endif
			</ul>
		</div>

		@if (!(session()->has('token')))
		<div class="pt-2 items-center flex-shrink-0 hidden lg:flex">
			@if (!(session()->has('token')))
      <form action="/company">
			  <button class="mx-8 px-8 py-2 font-semibold rounded-lg bg-white border-2 border-gray-500 text-dongker hover:bg-white/30 hover:border-gray-500/30">Rekrut Sekarang</button>
      </form>
      
      <form action="/login">
        @csrf
			  <button class="px-8 py-2 font-semibold rounded-lg bg-dongker border-2 border-[#123C69] text-white hover:bg-dongker/40 hover:border-[#123C69]/40">Masuk</button>
      </form>
      @endif	
		</div>

		@else
		<div class="pt-2 items-center flex-shrink-0 hidden lg:flex">
      <form action="/logout" method="POST">
        @csrf
        <button class="px-8 py-2 font-semibold rounded-lg bg-dongker border-2 border-[#123C69] text-white hover:bg-dongker/40 hover:border-[#123C69]/40">Keluar</button>
      </form>
      
      <button type="button" class="flex items-center focus:outline-none" aria-label="toggle profile dropdown">
                <div class="w-10 h-10 mx-10 overflow-hidden border-2 border-gray-400 rounded-full">
                    <a href="/profile">
                      @if(session()->get('foto_profil') != NULL)
                        <img src="{{ asset('storage/' . session()->get('foto_profil')) }}" class="object-cover w-full h-full" alt="avatar">
                      @else
                        <img src="{{ asset('img/avatar.png') }}" class="object-cover w-full h-full" alt="avatar">
                      @endif
                    </a>
                </div>
            </button>
		</div>
		@endif

    <!--Mobile Menu-->
    <div class="md:hidden flex items-center">
    @if (!(session()->has('token')))
		<div class="pt-2 items-center flex-shrink-0 flex">
			@if (!(session()->has('token')))
      <form action="/company">
			  <button class="mx-4 px-3 py-1 font-semibold rounded-lg bg-white border-2 border-gray-500 text-dongker hover:bg-white/30 hover:border-gray-500/30">Rekrut Sekarang</button>
      </form>
      
      <form action="/login">
        @csrf
			  <button class="px-3 py-1 font-semibold rounded-lg bg-dongker border-2 border-[#123C69] text-white hover:bg-dongker/40 hover:border-[#123C69]/40">Masuk</button>
      </form>
      @endif	
		</div>

		@else
		<div class="pt-2 items-center flex-shrink-0 flex">
      <form action="/logout" method="POST">
        @csrf
        <button class="px-4 py-1 font-semibold rounded-lg bg-dongker border-2 border-[#123C69] text-white hover:bg-dongker/40 hover:border-[#123C69]/40">Keluar</button>
      </form>
      
      <button type="button" class="flex items-center focus:outline-none" aria-label="toggle profile dropdown">
                <div class="w-9 h-9 mx-9 overflow-hidden border-2 border-gray-400 rounded-full">
                    <a href="/profile">
                      @if(session()->get('foto_profil') != NULL)
                        <img src="{{ asset('storage/' . session()->get('foto_profil')) }}" class="object-cover w-full h-full" alt="avatar">
                      @else
                        <img src="{{ asset('img/avatar.png') }}" class="object-cover w-full h-full" alt="avatar">
                      @endif
                    </a>
                </div>
            </button>
		</div>
		@endif
						<button class="outline-none mobile-menu-button">
						<svg class=" w-6 h-6 text-gray-500 hover:text-dongker "
							x-show="!showMenu"
							fill="none"
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							viewBox="0 0 24 24"
							stroke="currentColor"
						>
							<path d="M4 6h16M4 12h16M4 18h16"></path>
						</svg>
					</button>
					</div>
				</div>
			</div>
			<!-- mobile menu -->
			<div class="hidden mobile-menu mx-10">
				<ul class="">
					<li><a href="/" class="block text-sm px-2 py-4 bg-white hover:bg-dongker hover:text-white transition duration-300">Beranda</a></li>
					<li><a href="/loker" class="block text-sm px-2 py-4 bg-white hover:bg-dongker hover:text-white transition duration-300">Cari Loker</a></li>
					<li><a href="/posts" class="block text-sm px-2 py-4 bg-white hover:bg-dongker hover:text-white transition duration-300">Sharing</a></li>
          @if(!(session()->has('token')))
          @else
          @if(session()->get('role') == 2)
					<li><a href="/admin" class="block text-sm px-2 py-4 bg-white hover:bg-dongker hover:text-white transition duration-300">Admin</a></li>
          @elseif(session()->get('role') == 1)
          <li><a href="/loker/all" class="block text-sm px-2 py-4 bg-white hover:bg-dongker hover:text-white transition duration-300">Rekap Lowongan Kerja</a></li>
          @endif
          @endif
				</ul>
			</div>
	</div>

      <script>
				const btn = document.querySelector("button.mobile-menu-button");
				const menu = document.querySelector(".mobile-menu");

				btn.addEventListener("click", () => {
					menu.classList.toggle("hidden");
				});
			</script>
</nav>


	<!-- START MAIN -->
  <div class="py-4">
    @yield('content')
  </div>
  <!-- END MAIN -->

	<!-- Footer -->
	<footer class="bg-dongker">
  	<div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8 font-montserrat">
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
      <div>
        <img class="w-72" src="{{ asset('img/logo-dark.png') }}" alt="logo dark">

        <p class="max-w-md mt-4 text-md text-white">
		Job portal terpercaya di Indonesia yang menyediakan beragam informasi lowongan kerja dengan bidang dan lokasi yang bervariasi. WorkForLife juga menyediakanmu forum untuk berbagi pengalaman bekerja di suatu posisi. Mulai karirmu sekarang!
        </p>

        <div class="flex mt-8 space-x-6 text-white">
          <a class="hover:opacity-75" href="" target="_blank" rel="noreferrer">
            <span class="sr-only"> Facebook </span>

            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
            </svg>
          </a>

          <a class="hover:opacity-75" href="" target="_blank" rel="noreferrer">
            <span class="sr-only"> Instagram </span>

            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
            </svg>
          </a>

          <a class="hover:opacity-75" href="" target="_blank" rel="noreferrer">
            <span class="sr-only"> Twitter </span>

            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
            </svg>
          </a>

          <a class="hover:opacity-75" href="" target="_blank" rel="noreferrer">
            <span class="sr-only"> GitHub </span>

            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
              <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clip-rule="evenodd" />
            </svg>
          </a>

          <a class="hover:opacity-75" href="" target="_blank" rel="noreferrer">
            <span class="sr-only"> Youtube </span>

            <svg class="w-9 h-9" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
  				<path fill-rule="evenodd" d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" clip-rule="evenodd" />
			</svg>
          </a>
        </div>
      </div>

      <div class="pl-40 pt-9 grid grid-cols-1 gap-[300px] lg:col-span-2 sm:grid-cols-2 lg:grid-cols-4">

        <div class="w-40">
          <p class="font-bold text-lg text-white">
            Telusuri
          </p>

          <nav class="flex flex-col mt-4 space-y-4 text-sm text-white">
            <a class="hover:opacity-75" href=""> Home </a>
            <a class="hover:opacity-75" href=""> Lowongan Kerja </a>
            <a class="hover:opacity-75" href=""> Berbagi Pengalaman </a>
            <a class="hover:opacity-75" href=""> Rekrut Sekarang </a>
          </nav>
        </div>

        <div class="w-32">
          <p class="font-bold text-lg text-white">
            Informasi
          </p>

          <nav class="flex flex-col mt-4 space-y-4 text-sm text-white">
            <a class="hover:opacity-75" href=""> Tentang Kami </a>
            <a class="hover:opacity-75" href=""> Kontak </a>
          </nav>
        </div>

      </div>
    </div>

    <p class="mt-8 text-xs text-white">
      &copy; 2022 WorkForLife	
    </p>
  	</div>
	</footer>
  <script>feather.replace()</script>
</body>
</html>