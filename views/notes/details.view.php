<?php require "views/partials/header.php" ?>
<?php require "views/partials/nav.php" ?>
<?php require "views/partials/banner.php" ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h2 class="mb-2 text-xl font-semibold text-white"><?= htmlspecialchars($note['title']) ?></h2>

            <p class="mt-4 text-white"><?= htmlspecialchars($note['content']) ?></p>
        </div>
    </main>
<?php require "views/partials/footer.php" ?>