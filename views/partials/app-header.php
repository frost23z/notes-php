<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-950">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Notes App</title>
    <style>
        /* Custom styles for better polish */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgb(17, 24, 39);
        }

        ::-webkit-scrollbar-thumb {
            background: rgb(55, 65, 81);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgb(75, 85, 99);
        }

        /* Smooth transitions for note items */
        .note-item {
            transition: all 0.15s ease-in-out;
        }

        .note-item.active {
            background: rgba(55, 65, 81, 0.3);
        }

        /* Focus styles */
        textarea:focus, input:focus {
            outline: none;
        }

        /* Ensure toast container is always visible */
        #toast-container {
            position: fixed !important;
            z-index: 9999 !important;
        }
    </style>
</head>
<body class="h-full overflow-hidden">
