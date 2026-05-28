@extends('admin.layouts.app')

@section('title', 'Research Projects V2')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Research Projects Management</h3>
        </div>
        <div class="p-6">
            <p class="text-gray-600 dark:text-gray-400 mb-6">Manage content for all research project sections: IRB, iDream Lab, and HDSS.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- IRB Project -->
                <div class="bg-white dark:bg-gray-800 border-2 border-blue-200 rounded-lg">
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <span class="text-5xl">⚖️</span>
                        </div>
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Function of IRB</h5>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Institutional Review Board - Ethical oversight and research integrity</p>
                        <div class="space-y-2">
                            <a href="{{ route('admin.research.projects-v2.show', 'irb') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-edit mr-2"></i> Manage IRB
                            </a>
                        </div>
                        <small class="text-gray-500 text-xs mt-2 block">
                            Last updated: {{ $irb->updated_at ? $irb->updated_at->format('M d, Y') : 'Never' }}
                        </small>
                    </div>
                </div>

                <!-- iDream Lab Project -->
                <div class="bg-white dark:bg-gray-800 border-2 border-green-200 rounded-lg">
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <span class="text-5xl">🔬</span>
                        </div>
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">iDream Lab</h5>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Innovation laboratory for research and development</p>
                        <div class="space-y-2">
                            <a href="{{ route('admin.research.projects-v2.show', 'idream') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-edit mr-2"></i> Manage iDream
                            </a>
                        </div>
                        <small class="text-gray-500 text-xs mt-2 block">
                            Last updated: {{ $idream->updated_at ? $idream->updated_at->format('M d, Y') : 'Never' }}
                        </small>
                    </div>
                </div>

                <!-- HDSS Project -->
                <div class="bg-white dark:bg-gray-800 border-2 border-cyan-200 rounded-lg">
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <span class="text-5xl">📊</span>
                        </div>
                        <h5 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">HDSS</h5>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Health and Demographic Surveillance System</p>
                        <div class="space-y-2">
                            <a href="{{ route('admin.research.projects-v2.show', 'hdss') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="fas fa-edit mr-2"></i> Manage HDSS
                            </a>
                        </div>
                        <small class="text-gray-500 text-xs mt-2 block">
                            Last updated: {{ $hdss->updated_at ? $hdss->updated_at->format('M d, Y') : 'Never' }}
                        </small>
                    </div>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <h6 class="flex items-center text-blue-800 dark:text-blue-200 font-medium mb-2">
                    <i class="fas fa-info-circle mr-2"></i> Quick Guide
                </h6>
                <ul class="text-blue-700 dark:text-blue-300 text-sm space-y-1 mb-0">
                    <li>• Click on any project card above to manage its content</li>
                    <li>• Each project has sections: Basic Info, Functions, Workflow, Resources, Statistics, Team, FAQ, and Contact</li>
                    <li>• All changes are immediately reflected on the public website</li>
                    <li>• Use rich text editor for detailed descriptions and content</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection