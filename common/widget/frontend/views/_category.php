<div class="category-block">
    <div class="title">
        <img src="/img/flag-icon.png" alt="flag"/> <span><?=$title?></span>
    </div>
    <ul>
        <?php
        foreach ($categoryArr as $cat) {
            ?>
            <li <?= ($selected == $cat->id ? "class='selected'" : "") ?>><a
                    href="<?= \yii\helpers\Url::toRoute('/' . $module_name . '/section/' . $cat->alt_name); ?>"><?= $cat->name; ?></a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>
