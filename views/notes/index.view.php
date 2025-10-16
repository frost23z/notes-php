<?php require "views/partials/header.php" ?>
<?php require "views/partials/nav.php" ?>
<?php require "views/partials/banner.php" ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <?php foreach ($notes as $note): ?>
                <div class="mb-4 rounded-lg bg-gray-800 p-4">
                    <a href="/details?id=<?= htmlspecialchars($note['id']) ?>">
                        <h2 class="mb-2 text-xl font-semibold text-white"><?= htmlspecialchars($note['title']) ?></h2>
                    </a>

                </div>
            <?php endforeach; ?>
        </div>
    </main>
<?php require "views/partials/footer.php" ?>