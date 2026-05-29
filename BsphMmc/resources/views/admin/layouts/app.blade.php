<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false, darkMode: false }" :class="{ dark: darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - SPHMMC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>[x-cloak]{display:none!important}</style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

<div x-show="sidebarOpen" x-cloak @click="sidebarOpen=false"
     class="fixed inset-0 z-20 bg-black/50 lg:hidden"></div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-900 text-white flex flex-col transition-transform duration-300 lg:translate-x-0">

    <div class="flex items-center gap-3 px-6 py-5 border-b border-blue-800 flex-shrink-0">
        <div class="w-9 h-9 bg-white rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="text-blue-900 font-black text-sm">SP</span>
        </div>
        <div>
            <p class="font-bold text-sm leading-tight">SPHMMC</p>
            <p class="text-blue-300 text-xs">Admin Panel</p>
        </div>
    </div>

    <nav class="flex-1 px-3 py-4 overflow-y-auto">
        <div class="space-y-1">

            <a href="{{ route('admin.dashboard') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-gauge-high text-base w-5 text-center flex-shrink-0"></i>
                <span>Dashboard</span>
            </a>

            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-blue-400 uppercase tracking-wider">About Section</p>

            <a href="{{ route('admin.about.edit') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.about.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-circle-info text-base w-5 text-center flex-shrink-0"></i>
                <span>About Us</span>
            </a>

            <a href="{{ route('admin.leaders.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.leaders.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-users text-base w-5 text-center flex-shrink-0"></i>
                <span>Leaders</span>
            </a>

            <a href="{{ route('admin.mission-vision.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.mission-vision.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-bullseye text-base w-5 text-center flex-shrink-0"></i>
                <span>Mission / Vision</span>
            </a>

            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-blue-400 uppercase tracking-wider">Health & Services</p>

            <a href="{{ route('admin.health-tips.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.health-tips.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-heart-pulse text-base w-5 text-center flex-shrink-0"></i>
                <span>Health Tips</span>
            </a>

            <a href="{{ route('admin.specialized-centers.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.specialized-centers.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-hospital text-base w-5 text-center flex-shrink-0"></i>
                <span>Specialized Centers</span>
            </a>

            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-blue-400 uppercase tracking-wider">Content</p>

            <a href="{{ route('admin.posts.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.posts.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-newspaper text-base w-5 text-center flex-shrink-0"></i>
                <span>Posts</span>
            </a>

            <a href="{{ route('admin.gallery.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.gallery.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-images text-base w-5 text-center flex-shrink-0"></i>
                <span>Gallery</span>
            </a>

            {{-- Home Content --}}
            <div x-data="{ homeContentOpen: {{ request()->is('admin/content/home-content*') ? 'true' : 'false' }} }">
                <button @click="homeContentOpen=!homeContentOpen"
                        class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->is('admin/content/home-content*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                    <i class="fa-solid fa-home text-base w-5 text-center flex-shrink-0"></i>
                    <span class="flex-1 text-left">Home Content</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="homeContentOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="homeContentOpen" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ route('admin.home-content.hero.index') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.home-content.hero.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-image w-4 text-center"></i> Hero Section
                    </a>
                    <a href="{{ route('admin.home-content.featured.index') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.home-content.featured.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-sliders w-4 text-center"></i> Featured Section
                    </a>
                </div>
            </div>

            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-blue-400 uppercase tracking-wider">Academics</p>

            {{-- School of Medicine --}}
            <div x-data="{ medOpen: {{ request()->is('admin/academics/medicine*') ? 'true' : 'false' }} }">
                <button @click="medOpen=!medOpen"
                        class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->is('admin/academics/medicine*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                    <i class="fa-solid fa-stethoscope text-base w-5 text-center flex-shrink-0"></i>
                    <span class="flex-1 text-left">School of Medicine</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="medOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="medOpen" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ route('admin.academics.school', 'medicine') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.academics.school') && request()->route('school') === 'medicine' ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-eye w-4 text-center"></i> Overview
                    </a>
                    <div x-data="{ deptOpen: {{ request()->is('admin/academics/medicine/departments*') || request()->is('admin/academics/medicine/sub-departments*') || request()->is('admin/academics/medicine/academic-units*') ? 'true' : 'false' }} }">
                        <button @click="deptOpen=!deptOpen"
                                class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->is('admin/academics/medicine/*departments*') || request()->is('admin/academics/medicine/academic-units*') ? 'bg-blue-800/50 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                            <i class="fa-solid fa-sitemap w-4 text-center"></i> 
                            <span class="flex-1 text-left">Departments</span>
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="deptOpen ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="deptOpen" x-cloak class="pl-4 mt-1 space-y-1">
                            <a href="{{ route('admin.medicine.departments.index') }}"
                               class="flex items-center gap-2 px-4 py-1.5 rounded-lg text-[11px] font-medium transition-all w-full {{ request()->routeIs('admin.medicine.departments.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                                <i class="fa-solid fa-layer-group w-3 text-center"></i> Main Departments
                            </a>
                            <a href="{{ route('admin.medicine.sub-departments.index') }}"
                               class="flex items-center gap-2 px-4 py-1.5 rounded-lg text-[11px] font-medium transition-all w-full {{ request()->routeIs('admin.medicine.sub-departments.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                                <i class="fa-solid fa-indent w-3 text-center"></i> Sub Departments
                            </a>
                            <a href="{{ route('admin.medicine.academic-units.index') }}"
                               class="flex items-center gap-2 px-4 py-1.5 rounded-lg text-[11px] font-medium transition-all w-full {{ request()->routeIs('admin.medicine.academic-units.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                                <i class="fa-solid fa-graduation-cap w-3 text-center"></i> Academic Units
                            </a>
                        </div>
                    </div>
                    <a href="{{ route('admin.academic-staffs.index') }}?school=medicine"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.academic-staffs.*') && request('school') === 'medicine' ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-user-doctor w-4 text-center"></i> Staff
                    </a>
                    <a href="{{ route('admin.academics.research-publications.index', 'medicine') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->is('admin/academics/medicine/research-publications*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-book-open w-4 text-center"></i> Research Publications
                    </a>
                </div>
            </div>

            {{-- School of Nursing --}}
            <div x-data="{ nursingOpen: {{ request()->is('admin/academics/nursing*') ? 'true' : 'false' }} }">
                <button @click="nursingOpen=!nursingOpen"
                        class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->is('admin/academics/nursing*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                    <i class="fa-solid fa-heart-pulse text-base w-5 text-center flex-shrink-0"></i>
                    <span class="flex-1 text-left">School of Nursing</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="nursingOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="nursingOpen" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ route('admin.academics.school', 'nursing') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.academics.school') && request()->route('school') === 'nursing' ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-eye w-4 text-center"></i> Overview
                    </a>
                    <a href="{{ route('admin.nursing.partnerships.index') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.nursing.partnerships.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-handshake w-4 text-center"></i> Partnerships
                    </a>
                    <a href="{{ route('admin.academic-staffs.index') }}?school=nursing"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.academic-staffs.*') && request('school') === 'nursing' ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-user-nurse w-4 text-center"></i> Staff
                    </a>
                    <a href="{{ route('admin.academics.research-publications.index', 'nursing') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->is('admin/academics/nursing/research-publications*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-book-open w-4 text-center"></i> Research Publications
                    </a>
                </div>
            </div>

            {{-- School of Public Health --}}
            <div x-data="{ sphOpen: {{ request()->is('admin/academics/public*') ? 'true' : 'false' }} }">
                <button @click="sphOpen=!sphOpen"
                        class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->is('admin/academics/public*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                    <i class="fa-solid fa-earth-africa text-base w-5 text-center flex-shrink-0"></i>
                    <span class="flex-1 text-left">School of Public Health</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="sphOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="sphOpen" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ route('admin.academics.school', 'public_health') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.academics.school') && request()->route('school') === 'public_health' ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-eye w-4 text-center"></i> Overview
                    </a>
                    <a href="{{ route('admin.public-health.partnerships.index') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.public-health.partnerships.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-handshake w-4 text-center"></i> Partnerships
                    </a>
                    <a href="{{ route('admin.public-health.departments.index') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.public-health.departments.*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-sitemap w-4 text-center"></i> Departments
                    </a>
                    <a href="{{ route('admin.academic-staffs.index') }}?school=public_health"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.academic-staffs.*') && request('school') === 'public_health' ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-user w-4 text-center"></i> Staff
                    </a>
                    <a href="{{ route('admin.academics.research-publications.index', 'public_health') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->is('admin/academics/public_health/research-publications*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-book-open w-4 text-center"></i> Research Publications
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.academic-staffs.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.academic-staffs.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-chalkboard-user text-base w-5 text-center flex-shrink-0"></i>
                <span>Academic Staffs</span>
            </a>

            <a href="{{ route('admin.academic-projects.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.academic-projects.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-flask text-base w-5 text-center flex-shrink-0"></i>
                <span>Academic Projects</span>
            </a>

            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-blue-400 uppercase tracking-wider">Offices</p>

            <div x-data="{ ictOpen: {{ request()->routeIs('admin.offices.ict.*') ? 'true' : 'false' }} }">
                <button @click="ictOpen=!ictOpen"
                        class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full text-blue-200 hover:bg-blue-700 hover:text-white">
                    <i class="fa-solid fa-computer text-base w-5 text-center flex-shrink-0"></i>
                    <span class="flex-1 text-left">ICT Office</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="ictOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="ictOpen" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ route('admin.offices.ict.about') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.ict.about') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-circle-info w-4 text-center"></i> About ICT
                    </a>
                    <a href="{{ route('admin.offices.ict.gallery') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.ict.gallery') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-images w-4 text-center"></i> Gallery
                    </a>
                    <a href="{{ route('admin.offices.ict.services') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.ict.services') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-gears w-4 text-center"></i> Services
                    </a>
                    <a href="{{ route('admin.offices.ict.projects') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.ict.projects*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-diagram-project w-4 text-center"></i> Projects
                    </a>
                    <a href="{{ route('admin.offices.ict.contact') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.ict.contact') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-address-card w-4 text-center"></i> Contact Info
                    </a>
                </div>
            </div>

            <!-- Registrar Office -->
            <div x-data="{ registrarOpen: {{ request()->routeIs('admin.offices.registrar.*') ? 'true' : 'false' }} }">
                <button @click="registrarOpen=!registrarOpen"
                        class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full text-blue-200 hover:bg-blue-700 hover:text-white">
                    <i class="fa-solid fa-file-contract text-base w-5 text-center flex-shrink-0"></i>
                    <span class="flex-1 text-left">Registrar Office</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="registrarOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="registrarOpen" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ route('admin.offices.registrar.about') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.registrar.about') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-circle-info w-4 text-center"></i> About Registrar
                    </a>
                    <a href="{{ route('admin.offices.registrar.services') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.registrar.services') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-gears w-4 text-center"></i> Services
                    </a>
                    <a href="{{ route('admin.offices.registrar.process') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.registrar.process*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-list-check w-4 text-center"></i> Registration Process
                    </a>
                    <a href="{{ route('admin.offices.registrar.contact') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.offices.registrar.contact') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-address-card w-4 text-center"></i> Contact Info
                    </a>
                </div>
            </div>

            <!-- All Offices Management -->
            <div x-data="{ allOfficesOpen: {{ request()->routeIs('admin.all-offices.*') ? 'true' : 'false' }} }">
                <button @click="allOfficesOpen=!allOfficesOpen"
                        class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.all-offices.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                    <i class="fa-solid fa-building text-base w-5 text-center flex-shrink-0"></i>
                    <span class="flex-1 text-left">All Offices</span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="allOfficesOpen ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="allOfficesOpen" x-cloak class="pl-4 mt-0.5 space-y-0.5">
                    <a href="{{ route('admin.all-offices.about') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.all-offices.about') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-circle-info w-4 text-center"></i> About
                    </a>
                    <a href="{{ route('admin.all-offices.services') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.all-offices.services') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-gears w-4 text-center"></i> Our Services
                    </a>
                    <a href="{{ route('admin.all-offices.projects') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.all-offices.projects*') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-diagram-project w-4 text-center"></i> Projects
                    </a>
                    <a href="{{ route('admin.all-offices.contact') }}"
                       class="flex items-center gap-2 px-4 py-2 rounded-lg text-xs font-medium transition-all w-full {{ request()->routeIs('admin.all-offices.contact') ? 'bg-blue-700 text-white' : 'text-blue-300 hover:bg-blue-700 hover:text-white' }}">
                        <i class="fa-solid fa-address-card w-4 text-center"></i> Contact
                    </a>
                </div>
            </div>

            <a href="{{ route('admin.statistics.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.statistics.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-chart-bar text-base w-5 text-center flex-shrink-0"></i>
                <span>Statistics</span>
            </a>

            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-blue-400 uppercase tracking-wider">Research</p>

            <a href="{{ route('admin.research.overview') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.research.overview') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-microscope text-base w-5 text-center flex-shrink-0"></i>
                <span>Research Overview</span>
            </a>

            <a href="{{ route('admin.research.projects.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.research.projects.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-flask text-base w-5 text-center flex-shrink-0"></i>
                <span>Research Projects</span>
            </a>

            <a href="{{ route('admin.research.roles-responsibility.index') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.research.roles-responsibility.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-book text-base w-5 text-center flex-shrink-0"></i>
                <span>Roles & Responsibility</span>
            </a>

            <p class="px-4 pt-4 pb-1 text-xs font-semibold text-blue-400 uppercase tracking-wider">Account</p>

            <a href="{{ route('admin.profile.edit') }}"
               class="flex flex-row items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-all w-full {{ request()->routeIs('admin.profile.*') ? 'bg-blue-700 text-white' : 'text-blue-200 hover:bg-blue-700 hover:text-white' }}">
                <i class="fa-solid fa-user-gear text-base w-5 text-center flex-shrink-0"></i>
                <span>Profile</span>
            </a>

        </div>
    </nav>

    <div class="px-4 py-4 border-t border-blue-800 flex-shrink-0">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-sm font-bold flex-shrink-0">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-blue-300 capitalize">{{ auth()->user()->role }}</p>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                    class="w-full flex flex-row items-center gap-2 px-3 py-2 text-sm text-blue-200 hover:text-white hover:bg-blue-700 rounded-lg transition">
                <i class="fa-solid fa-right-from-bracket flex-shrink-0"></i>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</aside>

<div class="lg:pl-64 flex flex-col min-h-screen">

    <header class="sticky top-0 z-10 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 shadow-sm">
        <div class="flex items-center justify-between px-4 sm:px-6 h-16">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen=!sidebarOpen" class="lg:hidden text-gray-500 hover:text-gray-700 p-1">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h1 class="text-base font-semibold text-gray-800 dark:text-white">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>
            <div class="flex items-center gap-3">
                <button @click="darkMode=!darkMode"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <i x-show="!darkMode" class="fa-solid fa-moon"></i>
                    <i x-show="darkMode" x-cloak class="fa-solid fa-sun text-yellow-400"></i>
                </button>
                <a href="{{ route('admin.profile.edit') }}"
                   class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold hover:bg-blue-700 transition">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </a>
            </div>
        </div>
    </header>

    <div class="px-4 sm:px-6 pt-4">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 class="flex items-center gap-3 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
                <i class="fa-solid fa-circle-check text-green-500 flex-shrink-0"></i>
                <span class="text-sm">{{ session('success') }}</span>
                <button @click="show=false" class="ml-auto text-green-500 hover:text-green-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                 class="flex items-center gap-3 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4">
                <i class="fa-solid fa-circle-exclamation text-red-500 flex-shrink-0"></i>
                <span class="text-sm">{{ session('error') }}</span>
                <button @click="show=false" class="ml-auto text-red-500 hover:text-red-700">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif
    </div>

    <main class="flex-1 px-4 sm:px-6 pb-8">
        @yield('content')
    </main>
</div>

@stack('scripts')

</body>
</html>
