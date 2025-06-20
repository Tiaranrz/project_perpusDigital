<?php if ($pager->hasPrevious() || $pager->hasNext() || count($pager->links()) > 1): ?>
<nav class="flex items-center gap-2" aria-label="Pagination">
  <?php if ($pager->hasPrevious()) : ?>
    <a href="<?= $pager->getPreviousPage() ?>" class="px-3 py-2 rounded bg-fuchsia-50 text-fuchsia-700 font-semibold hover:bg-fuchsia-200 transition">
      &laquo;
    </a>
  <?php endif ?>
  <?php foreach ($pager->links() as $link) : ?>
    <a href="<?= $link['uri'] ?>"
       class="px-3 py-2 rounded <?= $link['active'] ? 'bg-fuchsia-600 text-white shadow' : 'bg-fuchsia-50 text-fuchsia-700 hover:bg-fuchsia-200' ?> font-semibold transition">
      <?= $link['title'] ?>
    </a>
  <?php endforeach ?>
  <?php if ($pager->hasNext()) : ?>
    <a href="<?= $pager->getNextPage() ?>" class="px-3 py-2 rounded bg-fuchsia-50 text-fuchsia-700 font-semibold hover:bg-fuchsia-200 transition">
      &raquo;
    </a>
  <?php endif ?>
</nav>
<?php endif ?>
