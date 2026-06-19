<?php

use CodeIgniter\Pager\PagerRenderer;

/**
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mb-0 gap-2">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link rounded-circle border-0 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>">
                    <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link rounded-circle border-0 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" href="<?= $pager->getPrevious() ?>" aria-label="<?= lang('Pager.previous') ?>">
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link rounded-circle border-0 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; <?= $link['active'] ? 'background-color: #0d6efd; color: white;' : '' ?>" href="<?= $link['uri'] ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link rounded-circle border-0 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link rounded-circle border-0 shadow-sm d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>
