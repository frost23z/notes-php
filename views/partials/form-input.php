<?php
/**
 * Reusable input field component
 *
 * Required variables:
 * @var string $name - Input name attribute
 * @var string $label - Label text
 *
 * Optional variables:
 * @var string $type - Input type (default: 'text')
 * @var string $value - Input value
 * @var string $placeholder - Placeholder text
 * @var string $autocomplete - Autocomplete attribute
 * @var bool $required - Whether field is required (default: false)
 */

use Core\Session;

$type = $type ?? 'text';
$value = $value ?? '';
$placeholder = $placeholder ?? '';
$autocomplete = $autocomplete ?? '';
$required = $required ?? false;
$error = Session::get('errors')[$name] ?? false;
?>

<div>
    <label for="<?= $name ?>" class="block text-sm/6 font-medium text-gray-100"><?= $label ?></label>
    <div class="mt-2">
        <input
                id="<?= $name ?>"
                type="<?= $type ?>"
                name="<?= $name ?>"
                value="<?= htmlspecialchars($value) ?>"
                <?= $placeholder ? 'placeholder="' . htmlspecialchars($placeholder) . '"' : '' ?>
                <?= $autocomplete ? 'autocomplete="' . $autocomplete . '"' : '' ?>
                <?= $required ? 'required' : '' ?>
                class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"
        />
    </div>
    <?php if ($error): ?>
        <p class="mt-2 text-sm text-red-500"><?= $error ?></p>
    <?php endif; ?>
</div>
