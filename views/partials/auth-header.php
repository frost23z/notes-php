<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title><?= $title ?? 'Notes App' ?></title>
    <style>
        /* Ensure toast container is always visible */
        #toast-container {
            position: fixed !important;
            z-index: 9999 !important;
        }
    </style>
</head>
<body class="h-full">
