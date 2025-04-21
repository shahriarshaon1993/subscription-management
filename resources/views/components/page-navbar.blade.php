<nav class="border-gray-200 bg-gray-900 relative z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-white">
                Subscription
            </span>
        </a>

        <div class="w-full md:w-auto" id="navbar-default">
            <ul class="font-medium flex p-4 md:p-0 border border-gray-100 rounded-lg space-x-8 rtl:space-x-reverse mt-0 md:border-0 bg-gray-900">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 px-3 bg-blue-700 rounded-sm bg-transparent md:p-0 {{request()->routeIs('home') ? 'text-blue-500': 'text-white'}}" aria-current="page">
                        Home
                    </a>
                </li>

                @auth
                    <li class="nav-item btn-item">
                        <form action="/logout" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="block py-2 px-3 text-white hover:text-blue-500 cursor-pointer rounded-sm bg-transparent md:p-0">Log Out</button>
                        </form>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}" class="block py-2 px-3 bg-blue-700 rounded-sm bg-transparent md:p-0 {{request()->routeIs('login') ? 'text-blue-500': 'text-white'}}" aria-current="page">
                            Login
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('register') }}" class="block py-2 px-3 bg-blue-700 rounded-sm bg-transparent md:p-0 {{request()->routeIs('register') ? 'text-blue-500': 'text-white'}}" aria-current="page">
                            Register
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>



{{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark">--}}
{{--    <div class="container-fluid">--}}
{{--        <a class="navbar-brand" href="{{route('home')}}">Ticketing System</a>--}}
{{--        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
{{--            <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('home') ? 'active': ''}}" aria-current="page" href="{{route('home')}}">--}}
{{--                        Home--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--                @role('admin')--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link {{request()->routeIs('admin.tickets.index') ? 'active': ''}}" href="{{route('admin.tickets.index')}}">--}}
{{--                        All Tickets--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                @endrole--}}
{{--            </ul>--}}
{{--            <div class="d-flex">--}}
{{--                <ul class="navbar-nav me-auto mb-2 mb-lg-0">--}}
{{--                    @auth--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{request()->routeIs('tickets.create') ? 'active': ''}}" href="{{route('tickets.create')}}">Open a Ticket</a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item btn-item">--}}
{{--                            <form action="/logout" method="POST">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="btn-blank">Log Out</button>--}}
{{--                            </form>--}}
{{--                        </li>--}}
{{--                    @endauth--}}

{{--                    @guest--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{request()->routeIs('login') ? 'active': ''}}" href="{{route('login')}}">--}}
{{--                                Login--}}
{{--                            </a>--}}
{{--                        </li>--}}

{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link {{request()->routeIs('register') ? 'active': ''}}" href="{{route('register')}}">--}}
{{--                                Sign Up--}}
{{--                            </a>--}}
{{--                        </li>--}}
{{--                    @endguest--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}
