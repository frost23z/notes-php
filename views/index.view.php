<?php view("partials/auth-header.php", ['title' => 'Notes - Capture Your Thoughts']) ?>

    <div class="bg-gray-950 min-h-full flex flex-col">
        <!-- Hero Section -->
        <div class="relative isolate overflow-hidden flex-1 flex flex-col">
            <!-- Background gradient -->
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-indigo-600 to-purple-600 opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
            </div>

            <!-- Navbar -->
            <nav class="flex items-center justify-between p-6 lg:px-8">
                <div class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span class="text-xl font-bold text-white">Notes</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="/login" class="text-sm font-semibold text-white hover:text-gray-300 transition">
                        Log in
                    </a>
                    <a href="/register"
                       class="rounded-md bg-indigo-500 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-600 transition">
                        Get started
                    </a>
                </div>
            </nav>

            <!-- Hero Content -->
            <div class="mx-auto max-w-3xl px-6 py-32 sm:py-40 lg:px-8 flex-1 flex items-center justify-center">
                <div class="text-center">
                    <h1 class="text-5xl font-bold tracking-tight text-white sm:text-7xl">
                        Capture your <span class="text-indigo-400">thoughts</span>
                    </h1>
                    <p class="mt-8 text-lg leading-8 text-gray-300">
                        A simple, elegant way to organize your ideas, notes, and daily thoughts.
                        Start writing in seconds.
                    </p>
                    <div class="mt-10 flex items-center justify-center gap-4">
                        <a href="/register"
                           class="rounded-md bg-indigo-500 px-6 py-3 text-base font-semibold text-white hover:bg-indigo-600 transition shadow-lg hover:shadow-xl">
                            Start writing for free
                        </a>
                        <a href="/login"
                           class="rounded-md bg-gray-800 px-6 py-3 text-base font-semibold text-white hover:bg-gray-700 transition">
                            Sign in
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Simple Footer -->
        <div class="mx-auto mt-auto max-w-7xl px-6 lg:px-8 py-8 text-center">
            <p class="text-sm text-gray-500">
                Simple. Secure. Fast. Start taking notes today.
            </p>
        </div>
    </div>
<?php view("partials/auth-footer.php") ?>