<?php view("partials/header.php") ?>
<?php view("partials/nav.php") ?>
<?php view("partials/banner.php", ['heading' => $heading]) ?>
    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h2 class="mb-2 text-xl font-semibold text-white"><?= htmlspecialchars($note['title']) ?></h2>

            <p class="mt-4 text-white"><?= htmlspecialchars($note['content']) ?></p>

            <form method="POST" action="/notes/destroy?id=<?= $note['id'] ?>" class="mt-6">
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit"
                        class="rounded-md bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                    Delete Note
                </button>
            </form>
        </div>
    </main>
<?php view("partials/footer.php") ?>