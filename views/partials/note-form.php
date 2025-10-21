<?php
/**
 * Note form partial (reusable for create and edit)
 *
 * Required variables:
 * @var string $action - Form action URL
 * @var string $method - HTTP method (POST for create, PATCH for update)
 *
 * Optional variables:
 * @var array $note - Note data for edit form
 * @var string $submitText - Submit button text (default: 'Save')
 * @var string $cancelUrl - Cancel button URL (default: '/notes')
 */

use Core\Session;

$method = $method ?? 'POST';
$submitText = $submitText ?? 'Save';
$cancelUrl = $cancelUrl ?? '/notes';
$content = old('content', $note['content'] ?? '');
$contentError = Session::get('errors')['content'] ?? false;
?>

<form method="POST" action="<?= $action ?>" class="h-full flex flex-col">
    <?php if ($method !== 'POST'): ?>
        <input type="hidden" name="_method" value="<?= $method ?>">
    <?php endif; ?>

    <?php if (isset($note['id'])): ?>
        <input type="hidden" name="id" value="<?= $note['id'] ?>">
    <?php endif; ?>

    <!-- Content Textarea (full height, auto-focuses on content) -->
    <div class="flex-1 relative">
        <textarea
                name="content"
                id="content"
                placeholder="Start writing your note... (title will be auto-generated from your first words)"
                required
                autofocus
                class="block w-full h-full bg-transparent border-0 px-0 py-0 text-base text-gray-100 placeholder:text-gray-600 focus:ring-0 resize-none leading-relaxed focus:outline-none"
        ><?= htmlspecialchars($content) ?></textarea>
        <?php if ($contentError): ?>
            <p class="absolute bottom-2 left-0 text-sm text-red-400 bg-red-900/20 px-3 py-1 rounded"><?= $contentError ?></p>
        <?php endif; ?>
    </div>

    <!-- Action Buttons (Fixed at bottom) -->
    <div class="flex felex-end items-center justify-end gap-x-4 pt-4 pb-2 border-t border-gray-800/50  sticky bottom-0">
        <div class="flex items-center gap-x-3">
            <a href="<?= $cancelUrl ?>"
               class="rounded-md px-4 py-2 text-sm font-medium text-gray-400 hover:text-white hover:bg-gray-800 transition-colors duration-150">
                Cancel
            </a>
            <button type="submit"
                    class="rounded-md bg-indigo-600 px-6 py-2 text-sm font-semibold text-white hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition-colors duration-150 shadow-lg shadow-indigo-500/20">
                <?= $submitText ?>
            </button>
        </div>
    </div>
</form>
