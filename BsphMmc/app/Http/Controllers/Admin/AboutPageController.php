<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function edit()
    {
        $about = AboutPage::instance();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'page_title'        => 'required|string|max:255',
            'subtitle'          => 'nullable|string|max:255',
            'main_description'  => 'nullable|string',
            'history_text'      => 'nullable|string',
            'featured_image'    => 'nullable|image|max:3072',
            'additional_content'=> 'nullable|string',
            'seo_title'         => 'nullable|string|max:255',
            'seo_description'   => 'nullable|string|max:500',
        ]);

        $about = AboutPage::instance();
        $data  = $request->except('featured_image');

        if ($request->hasFile('featured_image')) {
            if ($about->featured_image) {
                Storage::disk('public')->delete($about->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')
                ->store('about', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.about.edit')
            ->with('success', 'About Us page updated successfully.');
    }
}
