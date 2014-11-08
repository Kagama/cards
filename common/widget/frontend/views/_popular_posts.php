<div class="popular-posts">
    <div class="title">
        <img src="/img/flag-icon.png" alt="flag"/> <span>Популярные</span>
    </div>
    <ul>
        <?php
        foreach ($models as $model) {

            ?>
            <li><a
                    href="<?= \yii\helpers\Url::toRoute('/' . $module_name . '/'.$model->id."_".$model->alt_title); ?>"><?= $model->title; ?></a>
                <div class="views-comments">
                    <span class="glyphicon glyphicon-comment"></span> <?php echo $model->getCommentCount() ?> &nbsp;
                    <span class="glyphicon glyphicon-eye-open"></span> <?=$model->views_count ?>
                </div>
            </li>
        <?php
        }
        ?>
    </ul>
</div>
