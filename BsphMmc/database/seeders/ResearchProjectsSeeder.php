<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResearchProject;

class ResearchProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create IRB project with structured content
        ResearchProject::updateOrCreate(
            ['project_type' => 'irb'],
            [
                'project_type' => 'irb',
                'title' => 'Ensuring Research Integrity & Participant Protection',
                'content' => 'The Institutional Review Board serves as the guardian of ethical standards in research, ensuring all studies protect human subjects while advancing scientific knowledge.',
                'status' => 'active',
                'legal_framework' => json_encode([
                    'cards' => [
                        [
                            'icon' => '🏛️',
                            'title' => 'Regulatory Authorities',
                            'content' => 'Obtained from <strong>National Health Research Ethics Review Committee (NHRERC)</strong>, the IRB plays a supervisory role to all human subject studies conducted at SPHMMC.',
                            'items' => [
                                'Direct supervision by national ethics committee',
                                'Regular review and audit of research protocols'
                            ]
                        ],
                        [
                            'icon' => '📜',
                            'title' => 'National Guidelines',
                            'content' => 'SPHMMC has adopted <strong>National Health Research Ethics Guidelines</strong>, aligned with international standards:',
                            'items' => [
                                'Declaration of Helsinki — international ethical principles',
                                'Belmont Report — ethical principles for human subject protection'
                            ]
                        ],
                        [
                            'icon' => '🏢',
                            'title' => 'Institutional Mandate',
                            'content' => 'SPHMMC IRB operates under institutional oversight but is <strong>independent in its aspect</strong>, compliant with national guidelines.',
                            'items' => [
                                'Autonomous decision-making authority',
                                'Adherence to national and international standards',
                                'Comprehensive review of all research activities'
                            ]
                        ]
                    ]
                ]),
                'irb_structure' => json_encode([
                    'intro_text' => 'As per national guideline, SPHMMC IRB has <strong>15 members</strong> from a multidisciplinary panel:',
                    'members' => [
                        [
                            'icon' => '👨‍⚕️',
                            'title' => 'Medical & Healthcare Professionals',
                            'desc' => 'Clinical experts with extensive experience in medical research and patient care'
                        ],
                        [
                            'icon' => '⚖️',
                            'title' => 'Legal Experts',
                            'desc' => 'Lawyers specializing in healthcare law and research ethics'
                        ],
                        [
                            'icon' => '👥',
                            'title' => 'Social Scientists',
                            'desc' => 'Experts in social sciences, ethics, and community impact assessment'
                        ],
                        [
                            'icon' => '🌍',
                            'title' => 'Community Representatives',
                            'desc' => 'Patient advocates and community stakeholders representing public interests'
                        ],
                        [
                            'icon' => '🤝',
                            'title' => 'Ethicists',
                            'desc' => 'Specialists in bioethics and research methodology'
                        ],
                        [
                            'icon' => '👤',
                            'title' => 'Laypersons',
                            'desc' => 'Community members providing non-technical perspective on research ethics'
                        ]
                    ]
                ]),
                'appointment_training' => json_encode([
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
                            'items' => [
                                'Ethical principles and guidelines',
                                'Research methodology and design',
                                'Risk assessment and participant protection'
                            ]
                        ]
                    ]
                ])
            ]
        );

        // Create iDream Lab project
        ResearchProject::updateOrCreate(
            ['project_type' => 'idream'],
            [
                'project_type' => 'idream',
                'title' => 'iDream Laboratory',
                'content' => 'The iDream Laboratory serves as an innovation hub for cutting-edge research and development in medical sciences, fostering collaboration between researchers and industry partners.',
                'status' => 'active'
            ]
        );

        // Create HDSS project
        ResearchProject::updateOrCreate(
            ['project_type' => 'hdss'],
            [
                'project_type' => 'hdss',
                'title' => 'Health and Demographic Surveillance System',
                'content' => 'The HDSS provides comprehensive health and demographic data collection and analysis to support public health research and policy development.',
                'status' => 'active'
            ]
        );
    }
}
