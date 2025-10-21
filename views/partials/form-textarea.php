<?php
/**
 * Reusable textarea component
 *
 * Required variables:
 * @var string $name - Textarea name attribute
 * @var string $label - Label text
 *
 * Optional variables:
 * @var string $value - Textarea value
 * @var int $rows - Number of rows (default: 3)
 * @var string $placeholder - Placeholder text
 * @var bool $required - Whether field is required (default: false)
 */

use Core\Session;

$value = $value ?? '';
$rows = $rows ?? 3;
$placeholder = $placeholder ?? '';
$required = $required ?? false;
$error = Session::get('errors')[$name] ?? false;
?>

<div>
    <label for="<?= $name ?>" class="block text-sm/6 font-medium text-white"><?= $label ?></label>
    <div class="mt-2">
        <textarea
                id="<?= $name ?>"
                name="<?= $name ?>"
                rows="<?= $rows ?>"
            <?= $placeholder ? 'placeholder="' . htmlspecialchars($placeholder) . '"' : '' ?>
                <?= $required ? 'required' : '' ?>
            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
        ><?= htmlspecialchars($value) ?></textarea>
    </div>
    <?php if ($error): ?>
        <p class="mt-2 text-sm text-red-500"><?= $error ?></p>
    <?php endif; ?>
</div>
