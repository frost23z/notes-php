<?php
/**
 * Sidebar for notes app
 * Shows user info and list of notes
 *
 * Required variables (passed via compact() from parent view):
 * @var array $notes - Array of all user's notes
 * @var int|null $currentNoteId - ID of currently displayed note
 */

use Core\Session;

?>

<!-- Mobile Sidebar Toggle Checkbox (hidden) -->
<input type="checkbox" id="sidebar-toggle" class="peer sr-only">

<!-- Mobile Overlay -->
<label for="sidebar-toggle"
       class="peer-checked:block hidden fixed inset-0 bg-black/50 z-40 lg:hidden cursor-pointer"></label>

<!-- Sidebar -->
<div class="peer-checked:translate-x-0 fixed lg:static inset-y-0 left-0 z-50 flex h-full w-80 flex-col bg-gray-900 border-r border-gray-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Header -->
    <div class="flex h-16 items-center justify-between px-6 border-b border-gray-800">
        <div class="flex items-center gap-2">
            <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h1 class="text-lg font-semibold text-white">Notes</h1>
        </div>
        <a href="/notes/create"
           class="rounded-md bg-indigo-500 p-1.5 text-white hover:bg-indigo-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </a>
    </div>

    <!-- Notes List -->
    <div class="flex-1 overflow-y-auto">
        <?php if (empty($notes)): ?>
            <div class="flex flex-col items-center justify-center h-full px-6 text-center">
                <svg class="w-16 h-16 text-gray-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-400 text-sm mb-4">No notes yet</p>
                <a href="/notes/create"
                   class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">
                    Create your first note
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($notes as $note): ?>
                <?php $isActive = $currentNoteId == $note['id']; ?>
                <div class="group relative note-item <?= $isActive ? 'active' : '' ?>"
                     data-note-id="<?= $note['id'] ?>">
                    <a href="/notes/show?id=<?= $note['id'] ?>"
                       class="block px-4 py-3 hover:bg-gray-800/50 transition-colors duration-150 <?= $isActive ? 'bg-gray-800/70 border-l-4 border-indigo-500' : 'border-l-4 border-transparent' ?>">
                        <!-- Title Display/Edit -->
                        <div class="flex items-center gap-2 mb-1.5">
                            <h3 class="note-title-display flex-1 text-white font-medium text-sm leading-snug truncate">
                                <?= htmlspecialchars($note['title']) ?>
                            </h3>
                            <input type="text"
                                   class="note-title-input hidden flex-1 bg-gray-700 text-white text-sm px-2 py-1 rounded border border-gray-600 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"
                                   value="<?= htmlspecialchars($note['title']) ?>"
                                   data-original-title="<?= htmlspecialchars($note['title']) ?>">
                        </div>
                        <p class="text-gray-400 text-xs leading-relaxed line-clamp-2">
                            <?= htmlspecialchars(substr($note['content'], 0, 80)) ?><?= strlen($note['content']) > 80 ? '...' : '' ?>
                        </p>
                        <!-- Timestamp -->
                        <?php if (isset($note['updated_at'])): ?>
                            <p class="text-gray-600 text-xs mt-1.5">
                                <?= date('M j, g:i A', strtotime($note['updated_at'])) ?>
                            </p>
                        <?php endif; ?>
                    </a>

                    <!-- Edit/Delete Buttons (shown only when note is active) -->
                    <?php if ($isActive): ?>
                        <div class="absolute right-2 top-2.5 flex gap-1 z-10">
                            <button onclick="editTitle(event, <?= $note['id'] ?>)"
                                    class="note-edit-btn p-1.5 bg-gray-700/90 hover:bg-gray-600 text-gray-300 hover:text-white rounded transition-colors duration-150 shadow-sm"
                                    title="Edit title">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </button>
                            <button onclick="saveTitle(event, <?= $note['id'] ?>)"
                                    class="note-save-btn hidden p-1.5 bg-green-600 hover:bg-green-700 text-white rounded transition-colors duration-150 shadow-sm"
                                    title="Save title">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5 13l4 4L19 7"/>
                                </svg>
                            </button>
                            <button onclick="cancelEdit(event, <?= $note['id'] ?>)"
                                    class="note-cancel-btn hidden p-1.5 bg-gray-700/90 hover:bg-gray-600 text-gray-300 hover:text-white rounded transition-colors duration-150 shadow-sm"
                                    title="Cancel">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            <button onclick="deleteNote(event, <?= $note['id'] ?>)"
                                    class="note-delete-btn p-1.5 bg-red-600/90 hover:bg-red-700 text-white rounded transition-colors duration-150 shadow-sm"
                                    title="Delete note">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <!-- User Info Footer -->
    <div class="flex h-16 items-center justify-between px-4 border-t border-gray-800">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white text-sm font-medium">
                <?= strtoupper(substr(Session::user()['email'], 0, 1)) ?>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm text-white truncate">
                    <?= htmlspecialchars(Session::user()['email']) ?>
                </p>
            </div>
        </div>
        <form method="POST" action="/logout" class="inline">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit"
                    class="text-gray-400 hover:text-white p-1 rounded transition"
                    title="Log out">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    // Edit title functionality
    function editTitle(event, noteId) {
        event.preventDefault();
        event.stopPropagation();

        const noteItem = document.querySelector(`.note-item[data-note-id="${noteId}"]`);
        const titleDisplay = noteItem.querySelector('.note-title-display');
        const titleInput = noteItem.querySelector('.note-title-input');
        const editBtn = noteItem.querySelector('.note-edit-btn');
        const saveBtn = noteItem.querySelector('.note-save-btn');
        const cancelBtn = noteItem.querySelector('.note-cancel-btn');
        const deleteBtn = noteItem.querySelector('.note-delete-btn');

        // Toggle visibility
        titleDisplay.classList.add('hidden');
        titleInput.classList.remove('hidden');
        editBtn.classList.add('hidden');
        saveBtn.classList.remove('hidden');
        cancelBtn.classList.remove('hidden');
        deleteBtn.classList.add('hidden');

        // Focus input and select text
        titleInput.focus();
        titleInput.select();
    }

    // Save title
    async function saveTitle(event, noteId) {
        event.preventDefault();
        event.stopPropagation();

        const noteItem = document.querySelector(`.note-item[data-note-id="${noteId}"]`);
        const titleInput = noteItem.querySelector('.note-title-input');
        const newTitle = titleInput.value.trim();

        if (!newTitle) {
            alert('Title cannot be empty');
            return;
        }

        try {
            const response = await fetch(`/notes/${noteId}/title`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({title: newTitle})
            });

            const data = await response.json();

            if (response.ok) {
                // Update display
                const titleDisplay = noteItem.querySelector('.note-title-display');
                titleDisplay.textContent = newTitle;
                titleInput.setAttribute('data-original-title', newTitle);

                // Exit edit mode
                exitEditMode(noteItem);
            } else {
                alert(data.message || 'Failed to update title');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to update title');
        }
    }

    // Cancel edit
    function cancelEdit(event, noteId) {
        event.preventDefault();
        event.stopPropagation();

        const noteItem = document.querySelector(`.note-item[data-note-id="${noteId}"]`);
        const titleInput = noteItem.querySelector('.note-title-input');

        // Restore original title
        titleInput.value = titleInput.getAttribute('data-original-title');

        // Exit edit mode
        exitEditMode(noteItem);
    }

    // Exit edit mode helper
    function exitEditMode(noteItem) {
        const titleDisplay = noteItem.querySelector('.note-title-display');
        const titleInput = noteItem.querySelector('.note-title-input');
        const editBtn = noteItem.querySelector('.note-edit-btn');
        const saveBtn = noteItem.querySelector('.note-save-btn');
        const cancelBtn = noteItem.querySelector('.note-cancel-btn');
        const deleteBtn = noteItem.querySelector('.note-delete-btn');

        titleDisplay.classList.remove('hidden');
        titleInput.classList.add('hidden');
        editBtn.classList.remove('hidden');
        saveBtn.classList.add('hidden');
        cancelBtn.classList.add('hidden');
        deleteBtn.classList.remove('hidden');
    }

    // Delete note
    async function deleteNote(event, noteId) {
        event.preventDefault();
        event.stopPropagation();

        if (!confirm('Are you sure you want to delete this note?')) {
            return;
        }

        try {
            const response = await fetch(`/notes/${noteId}`, {
                method: 'DELETE',
            });

            const data = await response.json();

            if (response.ok) {
                // Redirect to notes index
                window.location.href = '/notes';
            } else {
                alert(data.message || 'Failed to delete note');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Failed to delete note');
        }
    }

    // Allow Enter to save, Escape to cancel
    document.addEventListener('keydown', function (event) {
        const activeInput = document.querySelector('.note-title-input:not(.hidden)');
        if (!activeInput) return;

        const noteId = activeInput.closest('.note-item').getAttribute('data-note-id');

        if (event.key === 'Enter') {
            event.preventDefault();
            saveTitle(event, noteId);
        } else if (event.key === 'Escape') {
            event.preventDefault();
            cancelEdit(event, noteId);
        }
    });
</script>
