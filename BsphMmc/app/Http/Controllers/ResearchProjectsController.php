<?php

namespace App\Http\Controllers;

use App\Models\ResearchProject;
use Illuminate\Http\Request;

class ResearchProjectsController extends Controller
{
    /**
     * Get IRB project data
     */
    public function irb()
    {
        $irb = ResearchProject::getIrb();
        
        if ($irb) {
            $irb->legal_framework_content = $irb->getLegalFrameworkContent();
            $irb->irb_structure_content = $irb->getIrbStructureContent();
            $irb->appointment_training_content = $irb->getAppointmentTrainingContent();
        }
        
        return response()->json([
            'success' => true,
            'data' => $irb
        ]);
    }

    /**
     * Get iDream project data
     */
    public function idream()
    {
        $idream = ResearchProject::getIdream();
        
        return response()->json([
            'success' => true,
            'data' => $idream
        ]);
    }

    /**
     * Get HDSS project data
     */
    public function hdss()
    {
        $hdss = ResearchProject::getHdss();
        
        return response()->json([
            'success' => true,
            'data' => $hdss
        ]);
    }

    /**
     * Get all research projects data
     */
    public function all()
    {
        $irb = ResearchProject::getIrb();
        $idream = ResearchProject::getIdream();
        $hdss = ResearchProject::getHdss();
        
        return response()->json([
            'success' => true,
            'data' => [
                'irb' => $irb,
                'idream' => $idream,
                'hdss' => $hdss
            ]
        ]);
    }
}
