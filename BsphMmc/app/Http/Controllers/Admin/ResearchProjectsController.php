<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResearchProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResearchProjectsController extends Controller
{
    /**
     * Research Projects overview page
     */
    public function index()
    {
        $irb = ResearchProject::getOrCreateByType('irb');
        $idream = ResearchProject::getOrCreateByType('idream');
        $hdss = ResearchProject::getOrCreateByType('hdss');
        
        return view('admin.research.projects.index', compact('irb', 'idream', 'hdss'));
    }

    /**
     * Update IRB project
     */
    public function updateIrb(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'project_type' => 'irb',
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'active',
        ];

        // Handle structured content
        if ($request->has('legal_framework')) {
            $legalFramework = [];
            for ($i = 0; $i < 3; $i++) {
                if ($request->input("legal_framework_{$i}_title")) {
                    $itemsString = $request->input("legal_framework_{$i}_items", '');
                    $itemsArray = $itemsString ? array_filter(array_map('trim', explode("\n", $itemsString))) : [];
                    
                    $legalFramework[] = [
                        'icon' => $request->input("legal_framework_{$i}_icon", '🏛️'),
                        'title' => $request->input("legal_framework_{$i}_title"),
                        'content' => $request->input("legal_framework_{$i}_content"),
                        'items' => $itemsArray
                    ];
                }
            }
            $data['legal_framework'] = json_encode(['cards' => $legalFramework]);
        }

        if ($request->has('irb_structure')) {
            $irbStructure = [
                'intro_text' => $request->input('irb_intro_text', 'As per national guideline, SPHMMC IRB has <strong>15 members</strong> from a multidisciplinary panel:'),
                'members' => []
            ];
            
            for ($i = 0; $i < 6; $i++) {
                if ($request->input("irb_member_{$i}_title")) {
                    $irbStructure['members'][] = [
                        'icon' => $request->input("irb_member_{$i}_icon", '👤'),
                        'title' => $request->input("irb_member_{$i}_title"),
                        'desc' => $request->input("irb_member_{$i}_desc")
                    ];
                }
            }
            $data['irb_structure'] = json_encode($irbStructure);
        }

        if ($request->has('appointment_training')) {
            $appointmentTraining = ['cards' => []];
            
            for ($i = 0; $i < 2; $i++) {
                if ($request->input("appointment_{$i}_title")) {
                    $card = [
                        'icon' => $request->input("appointment_{$i}_icon", '📋'),
                        'title' => $request->input("appointment_{$i}_title"),
                        'content' => $request->input("appointment_{$i}_content")
                    ];
                    
                    // Handle steps
                    if ($request->has("appointment_{$i}_steps")) {
                        $card['steps'] = [];
                        for ($j = 0; $j < 3; $j++) {
                            if ($request->input("appointment_{$i}_step_{$j}_text")) {
                                $card['steps'][] = [
                                    'num' => ($j + 1) . '',
                                    'text' => $request->input("appointment_{$i}_step_{$j}_text")
                                ];
                            }
                        }
                    }
                    
                    // Handle items
                    if ($request->has("appointment_{$i}_items")) {
                        $itemsString = $request->input("appointment_{$i}_items", '');
                        $card['items'] = $itemsString ? array_filter(array_map('trim', explode("\n", $itemsString))) : [];
                    }
                    
                    $appointmentTraining['cards'][] = $card;
                }
            }
            $data['appointment_training'] = json_encode($appointmentTraining);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research-projects', 'public');
        }

        ResearchProject::updateOrCreate(
            ['project_type' => 'irb'],
            $data
        );

        return redirect()->route('admin.research.projects.index')
            ->with('success', 'IRB project updated successfully!');
    }

    /**
     * Update iDream project
     */
    public function updateIdream(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'project_type' => 'idream',
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'active',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research-projects', 'public');
        }

        ResearchProject::updateOrCreate(
            ['project_type' => 'idream'],
            $data
        );

        return redirect()->route('admin.research.projects.index')
            ->with('success', 'iDream Lab project updated successfully!');
    }

    /**
     * Update HDSS project
     */
    public function updateHdss(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'project_type' => 'hdss',
            'title' => $request->title,
            'content' => $request->content,
            'status' => 'active',
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('research-projects', 'public');
        }

        ResearchProject::updateOrCreate(
            ['project_type' => 'hdss'],
            $data
        );

        return redirect()->route('admin.research.projects.index')
            ->with('success', 'HDSS project updated successfully!');
    }
}
