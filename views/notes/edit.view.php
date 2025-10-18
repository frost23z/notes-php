<?php view("partials/header.php") ?>
<?php view("partials/nav.php") ?>
<?php view("partials/banner.php", ['heading' => $heading]) ?>
    <main>

        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <form method="POST" action="/notes/update">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="id" value="<?= $note['id'] ?>">
                <div class="space-y-12">
                    <div class="border-b border-white/10 pb-12">


                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="col-span-full">
                                <label for="title" class="block text-sm/6 font-medium text-white">Title</label>
                                <div class="mt-2">
                                    <div class="flex items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                                        <input id="title" type="text" name="title" placeholder="Enter note title"
                                               value="<?= htmlspecialchars($note['title']) ?>"
                                               class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6"/>

                                    </div>
                                    <?php if (isset($errors['title'])): ?>
                                        <p class="text-sm/6 text-red-500"><?= $errors['title'] ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="content" class="block text-sm/6 font-medium text-white">Content</label>
                                <div class="mt-2">
                                    <textarea id="content" name="content" rows="3"
                                              class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6"><?= htmlspecialchars($note['content']) ?></textarea>
                                </div>
                                <?php if (isset($errors['content'])): ?>
                                    <p class="text-sm/6 text-red-500"><?= $errors['content'] ?></p>
                                <?php endif; ?>
                            </div>


                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="button" class="text-sm/6 font-semibold text-white">Cancel</button>
                    <button type="submit"
                            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </main>
<?php view("partials/footer.php") ?>