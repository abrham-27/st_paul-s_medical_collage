<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — SPHMMC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 flex items-center justify-center p-4">

    {{-- Background pattern --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-700/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl"></div>
    </div>

    <div class="relative w-full max-w-md" x-data="{ showPassword: false }">

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-900 to-blue-700 px-8 py-8 text-center">
                {{-- Logo --}}
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl shadow-lg mb-4">
                    <span class="text-blue-900 font-black text-xl tracking-tight">SP</span>
                </div>
                <h1 class="text-white font-bold text-xl leading-tight">St. Paul's Hospital</h1>
                <p class="text-blue-200 text-sm mt-1">Millennium Medical College</p>
                <div class="mt-3 inline-flex items-center gap-1.5 bg-blue-800/50 text-blue-200 text-xs px-3 py-1 rounded-full">
                    <i class="fa-solid fa-shield-halved text-blue-300"></i>
                    Admin Portal
                </div>
            </div>

            {{-- Form --}}
            <div class="px-8 py-8">
                <h2 class="text-gray-900 font-semibold text-lg mb-1">Welcome back</h2>
                <p class="text-gray-500 text-sm mb-6">Sign in to access the admin dashboard</p>

                {{-- Error from session (e.g. non-admin tried to access) --}}
                @if(session('error'))
                    <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-lg mb-5">
                        <i class="fa-solid fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Email Address
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-gray-400 text-sm"></i>
                            </div>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="admin@sphmmc.edu.et"
                                class="w-full pl-10 pr-4 py-3 text-sm border rounded-lg outline-none transition
                                       {{ $errors->has('email') ? 'border-red-400 bg-red-50 focus:ring-2 focus:ring-red-300' : 'border-gray-300 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200' }}">
                        </div>
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input
                                id="password"
                                :type="showPassword ? 'text' : 'password'"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full pl-10 pr-12 py-3 text-sm border rounded-lg outline-none transition
                                       {{ $errors->has('password') ? 'border-red-400 bg-red-50 focus:ring-2 focus:ring-red-300' : 'border-gray-300 bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-200' }}">
                            <button type="button"
                                    @click="showPassword = !showPassword"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition">
                                <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'" class="text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1.5 text-xs text-red-600 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Remember me --}}
                    <div class="flex items-center">
                        <input id="remember" type="checkbox" name="remember"
                               class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                        <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer select-none">
                            Keep me signed in
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-blue-700 hover:bg-blue-800 active:bg-blue-900 text-white text-sm font-semibold rounded-lg transition duration-150 shadow-sm">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Sign In to Admin Panel
                    </button>
                </form>
            </div>

            {{-- Footer --}}
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center">
                <p class="text-xs text-gray-400">
                    <i class="fa-solid fa-shield-halved mr-1"></i>
                    Secure admin access only. Unauthorized access is prohibited.
                </p>
            </div>
        </div>

        {{-- Back to website --}}
        <div class="text-center mt-5">
            <a href="{{ url('/') }}"
               class="inline-flex items-center gap-1.5 text-blue-200 hover:text-white text-sm transition">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Back to main website
            </a>
        </div>

    </div>

</body>
</html>
