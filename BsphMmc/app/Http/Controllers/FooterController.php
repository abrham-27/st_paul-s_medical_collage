<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Return footer sections as JSON.
     */
    public function index()
    {
        $footer = Footer::first();
        if (!$footer) {
            // Provide default configuration to public API
            $defaultSections = [
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
            return response()->json(['sections' => $defaultSections], 200);
        }
        return response()->json(['sections' => $footer->sections], 200);
    }
}
