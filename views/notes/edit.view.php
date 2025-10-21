<?php view("partials/app-header.php") ?>

    <div class="flex h-full">
        <?php view("partials/sidebar.php", compact('notes', 'currentNoteId')) ?>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Toolbar (h-16 to match sidebar header/footer) -->
            <div class="flex h-16 items-center justify-between px-6 lg:px-8 border-b border-gray-800/80 bg-gray-900/50 backdrop-blur-sm">
                <!-- Mobile Menu Button -->
                <label for="sidebar-toggle"
                       class="lg:hidden text-gray-400 hover:text-white p-2 rounded-lg transition-colors duration-150 mr-2 cursor-pointer">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </label>

                <h1 class="text-xl lg:text-2xl font-semibold text-white">Edit Note</h1>
            </div>

            <!-- Form Content -->
            <div class="flex-1 overflow-y-auto px-6 lg:px-8 py-6">
                <div class="max-w-5xl mx-auto h-full">
                    <?php view("partials/note-form.php", [
                            'action' => '/notes',
                            'method' => 'PATCH',
                            'note' => $note,
                            'submitText' => 'Update Note',
                            'cancelUrl' => "/notes/show?id={$note['id']}"
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

<?php view("partials/app-footer.php") ?>