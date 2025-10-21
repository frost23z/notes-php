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

                <h1 class="text-xl lg:text-2xl font-semibold text-white truncate flex-1 mr-4">
                    <?= htmlspecialchars($note['title']) ?>
                </h1>
                <div class="flex items-center gap-2">
                    <a href="/notes/edit?id=<?= $note['id'] ?>"
                       class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-500 transition-colors duration-150 shadow-lg shadow-indigo-500/20">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span class="hidden sm:inline">Edit</span>
                    </a>
                    <form method="POST" action="/notes?id=<?= $note['id'] ?>" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this note? This action cannot be undone.');">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg bg-red-600/90 px-4 py-2 text-sm font-medium text-white hover:bg-red-600 transition-colors duration-150 shadow-lg shadow-red-500/20">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            <span class="hidden sm:inline">Delete</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Note Content (consistent padding with edit/create) -->
            <div class="flex-1 overflow-y-auto px-6 lg:px-8 py-6">
                <div class="max-w-5xl mx-auto">
                    <!-- Metadata -->
                    <?php if (isset($note['updated_at'])): ?>
                        <div class="flex items-center gap-2 text-sm text-gray-500 mb-6 pb-4 border-b border-gray-800/50">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Last updated <?= date('F j, Y \a\t g:i A', strtotime($note['updated_at'])) ?></span>
                        </div>
                    <?php endif; ?>

                    <!-- Content -->
                    <div class="prose prose-invert prose-lg max-w-none">
                        <p class="text-gray-200 text-base lg:text-lg">
                            <?= htmlspecialchars($note['content']) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php view("partials/app-footer.php") ?>