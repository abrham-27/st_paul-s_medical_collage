<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_type',
        'title',
        'content',
        'image',
        'status',
        'legal_framework',
        'irb_structure',
        'appointment_training',
        'additional_sections',
    ];

    /**
     * Scope to get only active projects
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get project by type
     */
    public function scopeByType($query, $type)
    {
        return $query->where('project_type', $type);
    }

    /**
     * Get IRB project
     */
    public static function getIrb()
    {
        return static::active()->byType('irb')->first();
    }

    /**
     * Get iDream project
     */
    public static function getIdream()
    {
        return static::active()->byType('idream')->first();
    }

    /**
     * Get HDSS project
     */
    public static function getHdss()
    {
        return static::active()->byType('hdss')->first();
    }

    /**
     * Get or create project by type
     */
    public static function getOrCreateByType($type)
    {
        $project = static::active()->byType($type)->first();
        
        if (!$project) {
            $project = new static([
                'project_type' => $type,
                'title' => '',
                'content' => '',
                'image' => null,
                'status' => 'active',
                'legal_framework' => null,
                'irb_structure' => null,
                'appointment_training' => null,
                'additional_sections' => null,
            ]);
        }
        
        return $project;
    }

    /**
     * Get structured legal framework content
     */
    public function getLegalFrameworkContent()
    {
        if ($this->legal_framework) {
            return json_decode($this->legal_framework, true);
        }
        
        // Default content for IRB
        if ($this->project_type === 'irb') {
            return [
                'cards' => [
                    [
                        'icon' => '🏛️',
                        'title' => 'Regulatory Authorities',
                        'content' => 'Obtained from <strong>National Health Research Ethics Review Committee (NHRERC)</strong>, the IRB plays a supervisory role to all human subject studies conducted at SPHMMC.',
                        'items' => ['Direct supervision by national ethics committee', 'Regular review and audit of research protocols']
                    ],
                    [
                        'icon' => '📜',
                        'title' => 'National Guidelines',
                        'content' => 'SPHMMC has adopted <strong>National Health Research Ethics Guidelines</strong>, aligned with international standards:',
                        'items' => ['Declaration of Helsinki — international ethical principles', 'Belmont Report — ethical principles for human subject protection']
                    ],
                    [
                        'icon' => '🏢',
                        'title' => 'Institutional Mandate',
                        'content' => 'SPHMMC IRB operates under institutional oversight but is <strong>independent in its aspect</strong>, compliant with national guidelines.',
                        'items' => ['Autonomous decision-making authority', 'Adherence to national and international standards', 'Comprehensive review of all research activities']
                    ]
                ]
            ];
        }
        
        return null;
    }

    /**
     * Get structured IRB structure content
     */
    public function getIrbStructureContent()
    {
        if ($this->irb_structure) {
            return json_decode($this->irb_structure, true);
        }
        
        // Default content for IRB
        if ($this->project_type === 'irb') {
            return [
                'intro_text' => 'As per national guideline, SPHMMC IRB has <strong>15 members</strong> from a multidisciplinary panel:',
                'members' => [
                    ['icon' => '👨‍⚕️', 'title' => 'Medical & Healthcare Professionals', 'desc' => 'Clinical experts with extensive experience in medical research and patient care'],
                    ['icon' => '⚖️', 'title' => 'Legal Experts', 'desc' => 'Lawyers specializing in healthcare law and research ethics'],
                    ['icon' => '👥', 'title' => 'Social Scientists', 'desc' => 'Experts in social sciences, ethics, and community impact assessment'],
                    ['icon' => '🌍', 'title' => 'Community Representatives', 'desc' => 'Patient advocates and community stakeholders representing public interests'],
                    ['icon' => '🤝', 'title' => 'Ethicists', 'desc' => 'Specialists in bioethics and research methodology'],
                    ['icon' => '👤', 'title' => 'Laypersons', 'desc' => 'Community members providing non-technical perspective on research ethics']
                ]
            ];
        }
        
        return null;
    }

    /**
     * Get structured appointment and training content
     */
    public function getAppointmentTrainingContent()
    {
        if ($this->appointment_training) {
            return json_decode($this->appointment_training, true);
        }
        
        // Default content for IRB
        if ($this->project_type === 'irb') {
            return [
                'cards' => [
                    [
                        'icon' => '📋',
                        'title' => 'Appointment Process',
                        'content' => 'Members appointed by <strong>Academic and Vice Provost</strong> and undergo regular ethics and scientific integrity training.',
                        'steps' => [
                            ['num' => '1', 'text' => 'Nomination by department heads'],
                            ['num' => '2', 'text' => 'Review by Academic Council'],
                            ['num' => '3', 'text' => 'Final appointment by Vice Provost']
                        ]
                    ],
                    [
                        'icon' => '🎓',
                        'title' => 'Training Requirements',
                        'content' => 'All IRB members complete comprehensive training programs:',
                        'items' => ['Ethical principles and guidelines', 'Research methodology and design', 'Risk assessment and participant protection']
                    ]
                ]
            ];
        }
        
        return null;
    }
}
