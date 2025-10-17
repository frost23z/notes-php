<?php view("partials/header.php") ?>
<?php view("partials/nav.php") ?>
    <main class="grid min-h-full place-items-center bg-gray-900 px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">
            <p class="text-base font-semibold text-indigo-400">403</p>
            <h1 class="mt-4 text-5xl font-semibold tracking-tight text-balance text-white sm:text-7xl">Forbidden</h1>
            <p class="mt-6 text-lg font-medium text-pretty text-gray-400 sm:text-xl/8">Sorry, you don't have permission
                to
                access this page.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
                <a href="/"
                   class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Go
                    back home</a>
            </div>
        </div>
    </main>
<?php view("partials/footer.php") ?>