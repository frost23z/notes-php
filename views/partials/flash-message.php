<?php
/**
 * Flash message display component (Toast-style notifications)
 *
 * Displays flash messages from session as fixed position toasts
 * Supports: success, error, warning, info
 * Features: Auto-dismiss, close button, smooth animations
 */

use Core\Session;

$success = Session::get('success');
$error = Session::get('error');
$warning = Session::get('warning');
$info = Session::get('info');

$messages = [];
if ($success) $messages[] = ['type' => 'success', 'message' => $success];
if ($error) $messages[] = ['type' => 'error', 'message' => $error];
if ($warning) $messages[] = ['type' => 'warning', 'message' => $warning];
if ($info) $messages[] = ['type' => 'info', 'message' => $info];
?>

<?php if (!empty($messages)): ?>
    <!-- Toast Container (Fixed Position) -->
    <div id="toast-container" class="fixed top-4 right-4 z-[9999] space-y-3 pointer-events-none">
        <?php foreach ($messages as $index => $flash): ?>
            <?php
            $colors = [
                    'success' => [
                            'bg' => 'bg-green-500/95',
                            'border' => 'border-green-500',
                            'text' => 'text-white',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                    ],
                    'error' => [
                            'bg' => 'bg-red-500/95',
                            'border' => 'border-red-500',
                            'text' => 'text-white',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                    ],
                    'warning' => [
                            'bg' => 'bg-yellow-500/95',
                            'border' => 'border-yellow-500',
                            'text' => 'text-gray-900',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>'
                    ],
                    'info' => [
                            'bg' => 'bg-blue-500/95',
                            'border' => 'border-blue-500',
                            'text' => 'text-white',
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
                    ]
            ];
            $style = $colors[$flash['type']];
            ?>
            <div class="toast-message pointer-events-auto w-96 max-w-full <?= $style['bg'] ?> <?= $style['text'] ?> rounded-lg shadow-2xl border-l-4 <?= $style['border'] ?> backdrop-blur-sm"
                 data-index="<?= $index ?>"
                 style="animation: slideIn 0.3s ease-out forwards; animation-delay: <?= $index * 0.1 ?>s;">
                <div class="flex items-start gap-3 p-4">
                    <!-- Icon -->
                    <svg class="w-6 h-6 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <?= $style['icon'] ?>
                    </svg>

                    <!-- Message -->
                    <div class="flex-1 pt-0.5">
                        <p class="text-sm font-medium leading-relaxed">
                            <?= htmlspecialchars($flash['message']) ?>
                        </p>
                    </div>

                    <!-- Close Button -->
                    <button onclick="dismissToast(this)"
                            class="flex-shrink-0 p-1 hover:bg-white/20 rounded transition-colors duration-150"
                            aria-label="Close">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Auto-dismiss progress bar -->
                <div class="h-1 bg-white/30 overflow-hidden">
                    <div class="h-full bg-white/50 toast-progress"
                         style="animation: shrink 5s linear forwards; animation-delay: <?= $index * 0.1 ?>s;"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOut {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        @keyframes shrink {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }

        /* Ensure toasts are visible and properly sized */
        .toast-message {
            min-width: 320px;
        }

        /* Mobile responsive */
        @media (max-width: 640px) {
            #toast-container {
                left: 1rem;
                right: 1rem;
                width: auto;
            }

            .toast-message {
                width: 100%;
                min-width: auto;
            }
        }
    </style>

    <script>
        // Auto-dismiss toasts after 5 seconds
        document.addEventListener('DOMContentLoaded', function () {
            const toasts = document.querySelectorAll('.toast-message');

            toasts.forEach((toast, index) => {
                setTimeout(() => {
                    dismissToast(toast);
                }, 5000 + (index * 100)); // Stagger dismissal slightly
            });
        });

        // Dismiss toast with animation
        function dismissToast(element) {
            const toast = element.closest ? element.closest('.toast-message') : element;

            toast.style.animation = 'slideOut 0.3s ease-out forwards';

            setTimeout(() => {
                toast.remove();

                // Remove container if no toasts left
                const container = document.getElementById('toast-container');
                if (container && container.querySelectorAll('.toast-message').length === 0) {
                    container.remove();
                }
            }, 300);
        }

        // Keyboard accessibility - ESC to dismiss all
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                const toasts = document.querySelectorAll('.toast-message');
                toasts.forEach(toast => dismissToast(toast));
            }
        });
    </script>
<?php endif; ?>
