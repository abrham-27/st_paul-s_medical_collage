<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ResearchProject;
use App\Models\ResearchProjectTeamMember;
use App\Models\ResearchProjectFAQ;
use App\Models\ResearchProjectResource;
use App\Models\ResearchProjectStatistic;
use App\Models\ResearchProjectWorkflowStep;
use App\Models\ResearchProjectFunction;

class ResearchProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update IRB project
        $irb = ResearchProject::updateOrCreate(
            ['project_type' => 'irb'],
            [
                'title' => 'Institutional Review Board',
                'subtitle' => 'Ensuring Research Integrity & Participant Protection',
                'content' => '<p>The Institutional Review Board (IRB) serves as the guardian of ethical standards in research, ensuring all studies protect human subjects while advancing scientific knowledge. Our IRB operates under the highest ethical standards, following national and international guidelines.</p>',
                'hero_description' => 'The IRB plays a supervisory role to all human subject studies conducted at SPHMMC, ensuring ethical compliance and participant safety in all research activities.',
                'image' => 'research-projects/irb-main.jpg',
                'hero_image' => 'research-projects/irb-hero.jpg',
                'status' => 'active',
                'office_address' => 'SPHMMC Research Building, 3rd Floor, Room 301',
                'office_phone' => '+251-11-276-2345',
                'office_email' => 'irb@sphmmc.edu.et',
                'office_hours' => 'Monday - Friday: 8:00 AM - 5:00 PM',
                'legal_framework' => json_encode([
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
                ]),
                'irb_structure' => json_encode([
                    'intro_text' => 'As per national guideline, SPHMMC IRB has <strong>15 members</strong> from a multidisciplinary panel:',
                    'members' => [
                        ['icon' => '👨‍⚕️', 'title' => 'Medical & Healthcare Professionals', 'desc' => 'Clinical experts with extensive experience in medical research and patient care'],
                        ['icon' => '⚖️', 'title' => 'Legal Experts', 'desc' => 'Lawyers specializing in healthcare law and research ethics'],
                        ['icon' => '👥', 'title' => 'Social Scientists', 'desc' => 'Experts in social sciences, ethics, and community impact assessment'],
                        ['icon' => '🌍', 'title' => 'Community Representatives', 'desc' => 'Patient advocates and community stakeholders representing public interests'],
                        ['icon' => '🤝', 'title' => 'Ethicists', 'desc' => 'Specialists in bioethics and research methodology'],
                        ['icon' => '👤', 'title' => 'Laypersons', 'desc' => 'Community members providing non-technical perspective on research ethics']
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
                            'items' => ['Ethical principles and guidelines', 'Research methodology and design', 'Risk assessment and participant protection']
                        ]
                    ]
                ])
            ]
        );

        // IRB Team Members
        $irbTeamMembers = [
            ['name' => 'Dr. Alemayehu Bekele', 'role' => 'IRB Chairperson', 'bio' => 'Professor of Internal Medicine with 20+ years experience in clinical research ethics', 'email' => 'alemayehu.bekele@sphmmc.edu.et', 'order_index' => 1],
            ['name' => 'Dr. Hiwot Tadesse', 'role' => 'Vice Chairperson', 'bio' => 'Associate Professor of Public Health, specialist in community-based research ethics', 'email' => 'hiwot.tadesse@sphmmc.edu.et', 'order_index' => 2],
            ['name' => 'Ato Girma Wolde', 'role' => 'Legal Advisor', 'bio' => 'Senior legal counsel specializing in healthcare law and research regulations', 'email' => 'girma.wolde@sphmmc.edu.et', 'order_index' => 3],
            ['name' => 'Dr. Meron Getnet', 'role' => 'Ethics Specialist', 'bio' => 'PhD in Bioethics, expert in research methodology and ethical review processes', 'email' => 'meron.getnet@sphmmc.edu.et', 'order_index' => 4],
            ['name' => 'W/ro Almaz Tefera', 'role' => 'Community Representative', 'bio' => 'Patient advocate and community leader representing public interests in research', 'email' => 'almaz.tefera@sphmmc.edu.et', 'order_index' => 5]
        ];

        foreach ($irbTeamMembers as $member) {
            ResearchProjectTeamMember::updateOrCreate(
                ['research_project_id' => $irb->id, 'email' => $member['email']],
                $member
            );
        }

        // IRB FAQs
        $irbFAQs = [
            ['question' => 'How long does the IRB review process take?', 'answer' => 'The initial review typically takes 2-4 weeks for expedited reviews and 4-6 weeks for full board reviews, depending on the complexity of the study and completeness of the submission.', 'order_index' => 1],
            ['question' => 'What documents are required for IRB submission?', 'answer' => 'Required documents include: research protocol, informed consent forms, investigator qualifications (CV), data collection instruments, and any recruitment materials.', 'order_index' => 2],
            ['question' => 'Can I start my research before IRB approval?', 'answer' => 'No. Research involving human subjects cannot begin until you receive written IRB approval. Starting research before approval is a serious violation of ethical guidelines.', 'order_index' => 3],
            ['question' => 'How often do I need to submit progress reports?', 'answer' => 'Continuing review reports are required annually for ongoing studies, or more frequently if specified by the IRB based on the risk level of your research.', 'order_index' => 4],
            ['question' => 'What happens if I need to modify my approved study?', 'answer' => 'Any changes to your approved research must be submitted as an amendment and approved by the IRB before implementation, except in cases of immediate safety concerns.', 'order_index' => 5]
        ];

        foreach ($irbFAQs as $faq) {
            ResearchProjectFAQ::updateOrCreate(
                ['research_project_id' => $irb->id, 'question' => $faq['question']],
                $faq
            );
        }

        // IRB Resources
        $irbResources = [
            ['title' => 'IRB Application Form', 'description' => 'Complete application form for new research protocol submission', 'file_path' => 'documents/irb-application-form.pdf', 'file_type' => 'pdf', 'file_size' => '245KB', 'order_index' => 1],
            ['title' => 'Informed Consent Template', 'description' => 'Standard template for informed consent forms', 'file_path' => 'documents/informed-consent-template.docx', 'file_type' => 'docx', 'file_size' => '156KB', 'order_index' => 2],
            ['title' => 'Research Ethics Guidelines', 'description' => 'Comprehensive guidelines for ethical research conduct', 'file_path' => 'documents/research-ethics-guidelines.pdf', 'file_type' => 'pdf', 'file_size' => '1.2MB', 'order_index' => 3],
            ['title' => 'Amendment Request Form', 'description' => 'Form for requesting modifications to approved studies', 'file_path' => 'documents/amendment-request-form.pdf', 'file_type' => 'pdf', 'file_size' => '189KB', 'order_index' => 4]
        ];

        foreach ($irbResources as $resource) {
            ResearchProjectResource::updateOrCreate(
                ['research_project_id' => $irb->id, 'title' => $resource['title']],
                $resource
            );
        }

        // IRB Statistics
        $irbStatistics = [
            ['label' => 'Protocols Reviewed', 'value' => '150+', 'description' => 'Research protocols reviewed this year', 'icon' => '📋', 'order_index' => 1],
            ['label' => 'Active Studies', 'value' => '85', 'description' => 'Currently active research studies', 'icon' => '🔬', 'order_index' => 2],
            ['label' => 'Committee Members', 'value' => '15', 'description' => 'Multidisciplinary IRB committee members', 'icon' => '👥', 'order_index' => 3],
            ['label' => 'Average Review Time', 'value' => '3 weeks', 'description' => 'Average time for protocol review', 'icon' => '⏱️', 'order_index' => 4]
        ];

        foreach ($irbStatistics as $statistic) {
            ResearchProjectStatistic::updateOrCreate(
                ['research_project_id' => $irb->id, 'label' => $statistic['label']],
                $statistic
            );
        }

        // IRB Workflow Steps
        $irbWorkflowSteps = [
            ['title' => 'Submit Application', 'description' => 'Complete and submit IRB application form with all required documents', 'step_number' => 1, 'icon' => '📝', 'estimated_time' => '1-2 days'],
            ['title' => 'Initial Review', 'description' => 'IRB staff conducts initial review for completeness and assigns review type', 'step_number' => 2, 'icon' => '🔍', 'estimated_time' => '3-5 days'],
            ['title' => 'Committee Review', 'description' => 'IRB committee members review protocol for ethical compliance', 'step_number' => 3, 'icon' => '👥', 'estimated_time' => '2-3 weeks'],
            ['title' => 'Decision & Notification', 'description' => 'IRB decision communicated to investigator with any required modifications', 'step_number' => 4, 'icon' => '✅', 'estimated_time' => '1-2 days'],
            ['title' => 'Final Approval', 'description' => 'Final approval letter issued after all requirements are met', 'step_number' => 5, 'icon' => '📄', 'estimated_time' => '1 day']
        ];

        foreach ($irbWorkflowSteps as $step) {
            ResearchProjectWorkflowStep::updateOrCreate(
                ['research_project_id' => $irb->id, 'step_number' => $step['step_number']],
                $step
            );
        }

        // IRB Functions
        $irbFunctions = [
            ['title' => 'Protocol Review', 'description' => 'Comprehensive review of research protocols for ethical compliance', 'icon' => '🔍', 'features' => ['Ethical assessment', 'Risk evaluation', 'Compliance check'], 'order_index' => 1],
            ['title' => 'Informed Consent Review', 'description' => 'Review and approval of informed consent documents', 'icon' => '📋', 'features' => ['Language clarity', 'Comprehensiveness', 'Legal compliance'], 'order_index' => 2],
            ['title' => 'Continuing Review', 'description' => 'Ongoing monitoring of approved research studies', 'icon' => '🔄', 'features' => ['Progress monitoring', 'Safety assessment', 'Compliance verification'], 'order_index' => 3],
            ['title' => 'Training & Education', 'description' => 'Research ethics training for investigators and staff', 'icon' => '🎓', 'features' => ['Ethics workshops', 'Online training', 'Certification programs'], 'order_index' => 4]
        ];

        foreach ($irbFunctions as $function) {
            ResearchProjectFunction::updateOrCreate(
                ['research_project_id' => $irb->id, 'title' => $function['title']],
                $function
            );
        }

        // Create iDream Lab project
        $idream = ResearchProject::updateOrCreate(
            ['project_type' => 'idream'],
            [
                'title' => 'iDream Laboratory',
                'subtitle' => 'Innovation Hub for Medical Research',
                'content' => '<p>The iDream Laboratory serves as an innovation hub for cutting-edge research and development in medical sciences, fostering collaboration between researchers, students, and industry partners to advance healthcare solutions.</p>',
                'hero_description' => 'Pioneering medical innovation through collaborative research, advanced technology, and interdisciplinary partnerships.',
                'image' => 'research-projects/idream-main.jpg',
                'hero_image' => 'research-projects/idream-hero.jpg',
                'status' => 'active',
                'office_address' => 'SPHMMC Innovation Center, 2nd Floor, Lab Complex',
                'office_phone' => '+251-11-276-3456',
                'office_email' => 'idream@sphmmc.edu.et',
                'office_hours' => 'Monday - Friday: 7:00 AM - 6:00 PM, Saturday: 8:00 AM - 2:00 PM'
            ]
        );

        // iDream Team Members
        $idreamTeamMembers = [
            ['name' => 'Dr. Tadesse Alemu', 'role' => 'Laboratory Director', 'bio' => 'PhD in Biomedical Engineering, expert in medical device innovation', 'email' => 'tadesse.alemu@sphmmc.edu.et', 'order_index' => 1],
            ['name' => 'Dr. Selamawit Girma', 'role' => 'Research Coordinator', 'bio' => 'MD/PhD, specialist in translational medicine and clinical research', 'email' => 'selamawit.girma@sphmmc.edu.et', 'order_index' => 2],
            ['name' => 'Eng. Dawit Haile', 'role' => 'Technology Lead', 'bio' => 'MSc in Biomedical Engineering, expert in medical technology development', 'email' => 'dawit.haile@sphmmc.edu.et', 'order_index' => 3]
        ];

        foreach ($idreamTeamMembers as $member) {
            ResearchProjectTeamMember::updateOrCreate(
                ['research_project_id' => $idream->id, 'email' => $member['email']],
                $member
            );
        }

        // iDream Functions
        $idreamFunctions = [
            ['title' => 'Drug Discovery', 'description' => 'Advanced research in pharmaceutical development and drug discovery processes', 'icon' => '💊', 'features' => ['Medicinal chemistry', 'Preclinical testing', 'Clinical trials support'], 'order_index' => 1],
            ['title' => 'Genomics Research', 'description' => 'Exploring genetic factors in disease and personalized medicine approaches', 'icon' => '🧬', 'features' => ['Genetic sequencing', 'Biomarker discovery', 'Precision medicine'], 'order_index' => 2],
            ['title' => 'Medical Technology', 'description' => 'Developing innovative medical devices and healthcare technologies', 'icon' => '🤖', 'features' => ['Medical device innovation', 'Healthcare AI applications', 'Telemedicine solutions'], 'order_index' => 3]
        ];

        foreach ($idreamFunctions as $function) {
            ResearchProjectFunction::updateOrCreate(
                ['research_project_id' => $idream->id, 'title' => $function['title']],
                $function
            );
        }

        // Create HDSS project
        $hdss = ResearchProject::updateOrCreate(
            ['project_type' => 'hdss'],
            [
                'title' => 'Health and Demographic Surveillance System',
                'subtitle' => 'Comprehensive Health Data Collection & Analysis',
                'content' => '<p>The HDSS provides comprehensive health and demographic data collection and analysis to support public health research, policy development, and evidence-based decision making for improved community health outcomes.</p>',
                'hero_description' => 'Systematic collection and analysis of health and demographic data to inform public health policy and research.',
                'image' => 'research-projects/hdss-main.jpg',
                'hero_image' => 'research-projects/hdss-hero.jpg',
                'status' => 'active',
                'office_address' => 'SPHMMC Public Health Building, 1st Floor, Data Center',
                'office_phone' => '+251-11-276-4567',
                'office_email' => 'hdss@sphmmc.edu.et',
                'office_hours' => 'Monday - Friday: 8:00 AM - 5:00 PM'
            ]
        );

        // HDSS Team Members
        $hdssTeamMembers = [
            ['name' => 'Dr. Mulugeta Tamire', 'role' => 'HDSS Director', 'bio' => 'DrPH in Epidemiology, expert in population health surveillance', 'email' => 'mulugeta.tamire@sphmmc.edu.et', 'order_index' => 1],
            ['name' => 'Dr. Rahel Netsanet', 'role' => 'Data Manager', 'bio' => 'PhD in Biostatistics, specialist in health data analysis', 'email' => 'rahel.netsanet@sphmmc.edu.et', 'order_index' => 2],
            ['name' => 'Ato Bekele Worku', 'role' => 'Field Coordinator', 'bio' => 'MPH, experienced in community health data collection', 'email' => 'bekele.worku@sphmmc.edu.et', 'order_index' => 3]
        ];

        foreach ($hdssTeamMembers as $member) {
            ResearchProjectTeamMember::updateOrCreate(
                ['research_project_id' => $hdss->id, 'email' => $member['email']],
                $member
            );
        }

        // HDSS Functions
        $hdssFunctions = [
            ['title' => 'Population Monitoring', 'description' => 'Continuous monitoring of demographic changes and population dynamics', 'icon' => '👥', 'features' => ['Birth and death registration', 'Migration tracking', 'Household surveys'], 'order_index' => 1],
            ['title' => 'Health Data Collection', 'description' => 'Comprehensive health data collection from various sources', 'icon' => '🏥', 'features' => ['Disease surveillance', 'Health service utilization', 'Risk factor monitoring'], 'order_index' => 2],
            ['title' => 'Data Analysis', 'description' => 'Advanced statistical analysis and reporting of health trends', 'icon' => '📈', 'features' => ['Trend analysis', 'Risk assessment', 'Policy recommendations'], 'order_index' => 3]
        ];

        foreach ($hdssFunctions as $function) {
            ResearchProjectFunction::updateOrCreate(
                ['research_project_id' => $hdss->id, 'title' => $function['title']],
                $function
            );
        }

        // HDSS Statistics
        $hdssStatistics = [
            ['label' => 'Population Coverage', 'value' => '50K+', 'description' => 'Individuals under surveillance', 'icon' => '👥', 'order_index' => 1],
            ['label' => 'Data Collection Sites', 'value' => '25', 'description' => 'Active data collection sites', 'icon' => '📍', 'order_index' => 2],
            ['label' => 'Annual Surveys', 'value' => '12', 'description' => 'Comprehensive surveys conducted yearly', 'icon' => '📊', 'order_index' => 3],
            ['label' => 'Years of Operation', 'value' => '8+', 'description' => 'Years of continuous surveillance', 'icon' => '📅', 'order_index' => 4]
        ];

        foreach ($hdssStatistics as $statistic) {
            ResearchProjectStatistic::updateOrCreate(
                ['research_project_id' => $hdss->id, 'label' => $statistic['label']],
                $statistic
            );
        }

        $this->command->info('Research Projects seeder completed successfully!');
        $this->command->info('Created/Updated:');
        $this->command->info('- 3 Research Projects (IRB, iDream, HDSS)');
        $this->command->info('- ' . ResearchProjectTeamMember::count() . ' Team Members');
        $this->command->info('- ' . ResearchProjectFAQ::count() . ' FAQs');
        $this->command->info('- ' . ResearchProjectResource::count() . ' Resources');
        $this->command->info('- ' . ResearchProjectStatistic::count() . ' Statistics');
        $this->command->info('- ' . ResearchProjectWorkflowStep::count() . ' Workflow Steps');
        $this->command->info('- ' . ResearchProjectFunction::count() . ' Functions');
    }
}