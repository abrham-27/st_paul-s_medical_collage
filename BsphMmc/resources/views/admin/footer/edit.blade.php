@extends('admin.layouts.app')

@section('title', 'Footer Settings')
@section('page-title', 'Footer Settings')

@section('content')
<div class="py-6 max-w-4xl" x-data="{ 
    aboutLinks: {{ json_encode($footer->sections['about']['links'] ?? []) }},
    quickLinks: {{ json_encode($footer->sections['quickLinks']['links'] ?? []) }},
    legalLinks: {{ json_encode($footer->sections['legal']['links'] ?? []) }},
    addAboutLink() {
        this.aboutLinks.push({ label: '', href: '' });
    },
    removeAboutLink(index) {
        this.aboutLinks.splice(index, 1);
    },
    addQuickLink() {
        this.quickLinks.push({ label: '', href: '' });
    },
    removeQuickLink(index) {
        this.quickLinks.splice(index, 1);
    },
    addLegalLink() {
        this.legalLinks.push({ label: '', href: '' });
    },
    removeLegalLink(index) {
        this.legalLinks.splice(index, 1);
    }
}">
    <form method="POST" action="{{ route('admin.footer.update') }}" class="space-y-6">
        @csrf @method('PUT')

        {{-- About Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">
                <i class="fa-solid fa-circle-info text-blue-600 mr-2"></i> About SPHMMC Section
            </h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Section Title</label>
                <input type="text" name="sections[about][title]" value="{{ old('sections.about.title', $footer->sections['about']['title'] ?? 'About SPHMMC') }}" required
                       class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">About Links</label>
                <template x-for="(link, index) in aboutLinks" :key="index">
                    <div class="flex items-center gap-2">
                        <input type="text" :name="'sections[about][links]['+index+'][label]'" x-model="link.label" placeholder="Link Label (e.g. About Us)" required
                               class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <input type="text" :name="'sections[about][links]['+index+'][href]'" x-model="link.href" placeholder="Link Href (e.g. /about)" required
                               class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <button type="button" @click="removeAboutLink(index)" class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </template>
                <button type="button" @click="addAboutLink()" class="mt-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                    <i class="fa-solid fa-plus mr-1"></i> Add Link
                </button>
            </div>
        </div>

        {{-- Quick Links Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">
                <i class="fa-solid fa-link text-blue-600 mr-2"></i> Quick Links Section
            </h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Section Title</label>
                <input type="text" name="sections[quickLinks][title]" value="{{ old('sections.quickLinks.title', $footer->sections['quickLinks']['title'] ?? 'Quick Links') }}" required
                       class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Quick Links</label>
                <template x-for="(link, index) in quickLinks" :key="index">
                    <div class="flex items-center gap-2">
                        <input type="text" :name="'sections[quickLinks][links]['+index+'][label]'" x-model="link.label" placeholder="Link Label (e.g. Health Tips)" required
                               class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <input type="text" :name="'sections[quickLinks][links]['+index+'][href]'" x-model="link.href" placeholder="Link Href (e.g. /health-tips)" required
                               class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <button type="button" @click="removeQuickLink(index)" class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </template>
                <button type="button" @click="addQuickLink()" class="mt-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                    <i class="fa-solid fa-plus mr-1"></i> Add Link
                </button>
            </div>
        </div>

        {{-- Contact Us & Socials Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">
                <i class="fa-solid fa-address-book text-blue-600 mr-2"></i> Contact Us & Social Media
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Section Title</label>
                    <input type="text" name="sections[contact][title]" value="{{ old('sections.contact.title', $footer->sections['contact']['title'] ?? 'Contact Us') }}" required
                           class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email Address</label>
                    <input type="email" name="sections[contact][email]" value="{{ old('sections.contact.email', $footer->sections['contact']['email'] ?? 'info@sphmmc.edu.et') }}" required
                           class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address / City</label>
                    <input type="text" name="sections[contact][address]" value="{{ old('sections.contact.address', $footer->sections['contact']['address'] ?? 'Gulele Sub-City, Addis Ababa, Ethiopia') }}" required
                           class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">P.O. Box</label>
                    <input type="text" name="sections[contact][po_box]" value="{{ old('sections.contact.po_box', $footer->sections['contact']['po_box'] ?? 'PO Box 1271') }}" required
                           class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Short Code / Phone</label>
                    <input type="text" name="sections[contact][short_code]" value="{{ old('sections.contact.short_code', $footer->sections['contact']['short_code'] ?? '976') }}" required
                           class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                </div>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Social Media URLs</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @php
                        $socials = $footer->sections['contact']['socials'] ?? [];
                        $socialMap = [];
                        foreach($socials as $s) {
                            $socialMap[$s['platform']] = $s['url'];
                        }
                    @endphp
                    @foreach(['LinkedIn', 'Facebook', 'YouTube', 'Telegram', 'TikTok', 'Instagram'] as $platform)
                        @php
                            $iconMap = [
                                'LinkedIn' => 'fa-brands fa-linkedin',
                                'Facebook' => 'fa-brands fa-facebook',
                                'YouTube' => 'fa-brands fa-youtube',
                                'Telegram' => 'fa-brands fa-telegram',
                                'TikTok' => 'fa-brands fa-tiktok',
                                'Instagram' => 'fa-brands fa-instagram'
                            ];
                        @endphp
                        <div>
                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">
                                <i class="{{ $iconMap[$platform] }} mr-1 text-blue-600 dark:text-blue-400 text-sm"></i> {{ $platform }} URL
                            </label>
                            <input type="hidden" name="sections[contact][socials][{{ $loop->index }}][platform]" value="{{ $platform }}">
                            <input type="hidden" name="sections[contact][socials][{{ $loop->index }}][icon]" value="{{ $iconMap[$platform] }}">
                            <input type="url" name="sections[contact][socials][{{ $loop->index }}][url]" value="{{ old('sections.contact.socials.'.$loop->index.'.url', $socialMap[$platform] ?? '') }}" placeholder="https://..."
                                   class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Legal Info Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-6 space-y-4">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-3">
                <i class="fa-solid fa-scale-balanced text-blue-600 mr-2"></i> Legal & Footer Bottom Section
            </h2>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Section Title</label>
                <input type="text" name="sections[legal][title]" value="{{ old('sections.legal.title', $footer->sections['legal']['title'] ?? 'Legal Info') }}" required
                       class="w-full px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
            </div>

            <div class="space-y-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Legal Policy Links</label>
                <template x-for="(link, index) in legalLinks" :key="index">
                    <div class="flex items-center gap-2">
                        <input type="text" :name="'sections[legal][links]['+index+'][label]'" x-model="link.label" placeholder="Link Label (e.g. Privacy Policy)" required
                               class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <input type="text" :name="'sections[legal][links]['+index+'][href]'" x-model="link.href" placeholder="Link Href (e.g. /privacy)" required
                               class="flex-1 px-3 py-1.5 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none">
                        <button type="button" @click="removeLegalLink(index)" class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </template>
                <button type="button" @click="addLegalLink()" class="mt-2 text-sm text-blue-600 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                    <i class="fa-solid fa-plus mr-1"></i> Add Link
                </button>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Footer Settings
            </button>
        </div>
    </form>
</div>
@endsection
