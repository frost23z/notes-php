<?php view("partials/app-header.php") ?>

    <div class="flex h-full">
        <?php view("partials/sidebar.php", compact('notes', 'currentNoteId')) ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Mobile Header with Menu Button (h-16 to match sidebar) -->
            <div class="lg:hidden flex h-16 items-center justify-between px-4 border-b border-gray-800/80 bg-gray-900/50 backdrop-blur-sm">
                <label for="sidebar-toggle"
                       class="text-gray-400 hover:text-white p-2 rounded-lg transition-colors duration-150 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </label>
                <h1 class="text-lg font-semibold text-white">Notes</h1>
                <a href="/notes/create"
                   class="rounded-lg bg-indigo-600 p-2 text-white hover:bg-indigo-500 transition-colors duration-150 shadow-lg shadow-indigo-500/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto flex items-center justify-center p-8">
                <div class="max-w-4xl mx-auto">
                    <div class="text-center py-16">
                        <svg class="mx-auto h-24 w-24 text-gray-700 mb-6" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <h2 class="text-2xl font-semibold text-white mb-2">Welcome to Notes</h2>
                        <p class="text-gray-400 mb-6">Select a note from the sidebar to view it,<br>or create a new one
                            to get started.</p>
                        <a href="/notes/create"
                           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-6 py-3 text-sm font-semibold text-white hover:bg-indigo-500 transition-colors duration-150 shadow-lg shadow-indigo-500/20">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 4v16m8-8H4"/>
                            </svg>
                            Create New Note
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php view("partials/app-footer.php") ?>