<?php

namespace App\Http\Controllers;

use App\Models\ResearchProjectV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResearchProjectsController extends Controller
{
    /**
     * Get project by type
     */
    public function getProject($type)
    {
        $project = ResearchProjectV2::getByType($type);
        
        if ($project) {
            $project->loadCompleteData();
        }
        
        return response()->json([
            'success' => true,
            'data' => $project
        ]);
    }

    /**
     * Get all projects
     */
    public function getAllProjects()
    {
        $irb = ResearchProjectV2::getByType('irb');
        $idream = ResearchProjectV2::getByType('idream');
        $hdss = ResearchProjectV2::getByType('hdss');
        
        if ($irb) $irb->loadCompleteData();
        if ($idream) $idream->loadCompleteData();
        if ($hdss) $hdss->loadCompleteData();
        
        return response()->json([
            'success' => true,
            'data' => [
                'irb' => $irb,
                'idream' => $idream,
                'hdss' => $hdss
            ]
        ]);
    }

    // Legacy methods for backward compatibility
    public function irb() { return $this->getProject('irb'); }
    public function idream() { return $this->getProject('idream'); }
    public function hdss() { return $this->getProject('hdss'); }
    public function all() { return $this->getAllProjects(); }
}