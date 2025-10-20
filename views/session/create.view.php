<?php view("partials/auth-header.php", ['title' => 'Log In - Notes']) ?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 bg-gray-950">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <!-- Logo/Icon -->
        <div class="flex justify-center">
            <div class="flex items-center gap-2">
                <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span class="text-2xl font-bold text-white">Notes</span>
            </div>
        </div>
        <h2 class="mt-8 text-center text-3xl font-bold tracking-tight text-white">Welcome back</h2>
        <p class="mt-2 text-center text-sm text-gray-400">
            Sign in to your account to continue
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-gray-900 px-8 py-10 shadow-xl ring-1 ring-gray-800 sm:rounded-lg">
            <?php view("partials/flash-message.php") ?>

            <form action="/login" method="POST" class="space-y-6">
                <?php view("partials/form-input.php", [
                        'name' => 'email',
                        'label' => 'Email address',
                        'type' => 'email',
                        'value' => old('email'),
                        'autocomplete' => 'email',
                        'required' => true,
                        'placeholder' => 'you@example.com'
                ]) ?>

                <?php view("partials/form-input.php", [
                        'name' => 'password',
                        'label' => 'Password',
                        'type' => 'password',
                        'autocomplete' => 'current-password',
                        'required' => true,
                        'placeholder' => '••••••••'
                ]) ?>

                <div>
                    <button type="submit"
                            class="flex w-full justify-center rounded-md bg-indigo-500 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-800"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="bg-gray-900 px-2 text-gray-400">New to Notes?</span>
                    </div>
                </div>

                <div class="mt-6">
                    <a href="/register"
                       class="flex w-full justify-center rounded-md bg-gray-800 px-4 py-2.5 text-sm font-semibold text-white hover:bg-gray-700 transition">
                        Create an account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php view("partials/auth-footer.php") ?>
