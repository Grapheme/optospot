<footer>
    <div class="container_12 footer-container">
<?php foreach ($menu as $menu_item): ?>
    <?php if (count($menu_item['pages']) || count($menu_item['sub_pages'])): ?>
        <div class="footer-block">
            <h4><?= $menu_item['title']; ?></h4>
            <nav>
                <ul>
                <?php foreach ($menu_item['pages'] as $page): ?>
                    <li><?= anchor($page['url'], $page['link'], 'class="footer-link"'); ?></li>
                <?php endforeach; ?>
                <?php foreach ($menu_item['sub_pages'] as $page): ?>
                    <li class="second"><?= anchor($page['url'], $page['link'], 'class="footer-link"'); ?></li>
                <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
        <div class="clear"></div>
        <div class="footer-end">
            <?= $this->localization->getLocalButton('copyright', 'annotation'); ?>
            <br>
            <p class="footer-end-left">&copy; <?= $this->localization->getLocalButton('copyright', 'copy'); ?></p>
        </div>
    </div>
</footer>