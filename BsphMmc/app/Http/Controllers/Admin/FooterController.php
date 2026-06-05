<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Get default footer sections array.
     */
    private function getDefaultSections()
    {
        return [
            'about' => [
                'title' => 'About SPHMMC',
                'links' => [
                    ['label' => 'About Us', 'href' => '/about'],
                    ['label' => 'Leaders', 'href' => '/leaders'],
                    ['label' => 'Gallery', 'href' => '/gallery']
                ]
            ],
            'quickLinks' => [
                'title' => 'Quick Links',
                'links' => [
                    ['label' => 'Academic Calendar', 'href' => '#'],
                    ['label' => 'Admission Portal', 'href' => '#'],
                    ['label' => 'Online Journal', 'href' => '#'],
                    ['label' => 'Careers', 'href' => '#'],
                    ['label' => 'Health Tips', 'href' => '/health-tips'],
                    ['label' => 'Specialised Center', 'href' => '/specialized-centers'],
                    ['label' => 'Alumni', 'href' => '/alumni']
                ]
            ],
            'contact' => [
                'title' => 'Contact Us',
                'address' => 'Gulele Sub-City, Addis Ababa, Ethiopia',
                'po_box' => 'PO Box 1271',
                'short_code' => '976',
                'email' => 'info@sphmmc.edu.et',
                'socials' => [
                    ['platform' => 'LinkedIn', 'url' => 'https://www.linkedin.com', 'icon' => 'fa-brands fa-linkedin'],
                    ['platform' => 'Facebook', 'url' => 'https://www.facebook.com', 'icon' => 'fa-brands fa-facebook'],
                    ['platform' => 'YouTube', 'url' => 'https://www.youtube.com', 'icon' => 'fa-brands fa-youtube'],
                    ['platform' => 'Telegram', 'url' => 'https://t.me/', 'icon' => 'fa-brands fa-telegram'],
                    ['platform' => 'TikTok', 'url' => 'https://www.tiktok.com', 'icon' => 'fa-brands fa-tiktok'],
                    ['platform' => 'Instagram', 'url' => 'https://www.instagram.com', 'icon' => 'fa-brands fa-instagram']
                ]
            ],
            'legal' => [
                'title' => 'Legal Info',
                'links' => [
                    ['label' => 'Privacy Policy', 'href' => '/privacy'],
                    ['label' => 'Terms of Service', 'href' => '/terms'],
                    ['label' => 'Contact', 'href' => '/contact']
                ]
            ]
        ];
    }

    public function edit()
    {
        $footer = Footer::first();
        if (!$footer) {
            $footer = Footer::create([
                'sections' => $this->getDefaultSections()
            ]);
        }
        return view('admin.footer.edit', compact('footer'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'sections' => 'required|array'
        ]);

        $footer = Footer::first();
        if (!$footer) {
            $footer = new Footer();
        }

        $footer->sections = $request->input('sections');
        $footer->save();

        return redirect()->route('admin.footer.edit')
            ->with('success', 'Footer sections updated successfully.');
    }
}
