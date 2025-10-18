<?php
$activeNav = 'aria-current="page" class="rounded-md bg-gray-950/50 px-3 py-2 text-sm font-medium text-white"';
$defaultNav = 'class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white"';
$navStyle = function ($route) use ($activeNav, $defaultNav) {
    return urlIs($route) ? $activeNav : $defaultNav;
};
?>

<nav class="bg-gray-800/50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center">
                <div class="shrink-0">
                    <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                         alt="Your Company" class="size-8"/>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-950/50 text-white", Default: "text-gray-300 hover:bg-white/5 hover:text-white" -->
                        <a href="/" <?= $navStyle("/") ?>>Home</a>
                        <a href="/notes" <?= $navStyle("/notes") ?>>Notes</a>
                        <a href="/notes/create" <?= $navStyle("/notes/create") ?>>Create</a>
                        <a href="/about" <?= $navStyle("/about") ?>>About</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6 space-x-4">
                    <?php if (isGuest()): ?>
                        <a href="/register" <?= $navStyle("/register") ?>>Register</a>
                        <a href="/login" <?= $navStyle("/login") ?>>Log In</a>
                    <?php else: ?>
                        <span class="text-sm text-gray-300">
                            <?= htmlspecialchars(currentUser()['email']) ?>
                        </span>
                        <form method="POST" action="/logout">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit"
                                    class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-white/5 hover:text-white">
                                Log Out
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</nav>