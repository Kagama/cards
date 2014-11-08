<?php
//use backend\assets\AppAsset;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;



/**
 * @var \yii\web\View $this
 * @var string $content
 */
//echo $this->getAssetManager();
//AppAsset::register($this);

// jquery and friends
//$this->registerJsFile('');
//$this->registerJsFile('/cp/lib/lightblue/jquery-pjax/jquery.pjax.js');


// jquery plugins
//$this->registerJsFile('/cp/lib/lightblue/icheck.js/jquery.icheck.js');
//$this->registerJsFile('/cp/lib/lightblue/sparkline/jquery.sparkline.js');
//$this->registerJsFile('/cp/lib/lightblue/jquery-ui-1.10.3.custom.js');
//$this->registerJsFile('/cp/lib/lightblue/jquery.slimscroll.js');

// d3, nvd3
//$this->registerJsFile('/cp/lib/lightblue/nvd3/lib/d3.v2.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/nv.d3.custom.js');

// nvd3 models
//$this->registerJsFile('/cp/lib/lightblue/nvd3/src/models/scatter.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/src/models/axis.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/src/models/legend.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/src/models/multiBar.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/src/models/multiBarChart.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/src/models/line.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/src/models/lineChart.js');
//$this->registerJsFile('/cp/lib/lightblue/nvd3/stream_layers.js');

// backbone and friends
//$this->registerJsFile('/cp/lib/lightblue/backbone/underscore-min.js');
//$this->registerJsFile('/cp/lib/lightblue/backbone/backbone-min.js');
//$this->registerJsFile('/cp/lib/lightblue/backbone/backbone.localStorage-min.js');

// bootstrap default plugins
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/transition.js');
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/collapse.js');
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/alert.js');
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/tooltip.js');
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/popover.js');
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/button.js');
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/tab.js');
//$this->registerJsFile('/cp/lib/lightblue/bootstrap/dropdown.js');

// basic application js
//$this->registerJsFile('/cp/js/lightblue/app.js');
//$this->registerJsFile('/cp/js/lightblue/settings.js');


//$this->registerCssFile("themes/lightblue/css/site.css");
?>
<?php $this->beginPage() ?>
<!DOCTYPE HTML>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<?php $this->beginBody() ?>
<body class="background-dark">
<div class="logo widget" style=" margin: 0 0 10px 0; padding: 0 0 0 0; float: left; left: 0; top: -10px;">
    <h4 style="position: relative; left: 40px;"><a href="index.html">Kagama <strong>&nbsp;&nbsp;CMS</strong></a></h4>
</div>
<?= $this->render('@app/themes/lightblue/partial/menu', []); ?>
<div class="wrap">
    <header class="page-header">
<!--        <div class="navbar">-->
<!--            <ul class="nav navbar-nav navbar-right pull-right">-->
<!--                <li class="visible-phone-landscape">-->
<!--                    <a href="index.html#" id="search-toggle">-->
<!--                        <i class="fa fa-search"></i>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="dropdown">-->
<!--                    <a href="index.html#" title="Messages" id="messages"-->
<!--                       class="dropdown-toggle"-->
<!--                       data-toggle="dropdown">-->
<!--                        <i class="fa fa-comments"></i>-->
<!--                    </a>-->
<!--                    <ul id="messages-menu" class="dropdown-menu messages" role="menu">-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="dropdown">-->
<!--                    <a href="index.html#" title="8 support tickets"-->
<!--                       class="dropdown-toggle"-->
<!--                       data-toggle="dropdown">-->
<!--                        <i class="fa fa-group"></i>-->
<!--                        <span class="count">8</span>-->
<!--                    </a>-->
<!--                    <ul id="support-menu" class="dropdown-menu support" role="menu">-->
<!--                        <li role="presentation">-->
<!--                            <a href="index.html#" class="support-ticket">-->
<!--                                <div class="picture">-->
<!--                                    <span class="label label-important"><i class="fa fa-bell-o"></i></span>-->
<!--                                </div>-->
<!--                                <div class="details">-->
<!--                                    Check out this awesome ticket-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="index.html#" class="support-ticket">-->
<!--                                <div class="picture">-->
<!--                                    <span class="label label-warning"><i class="fa fa-question-circle"></i></span>-->
<!--                                </div>-->
<!--                                <div class="details">-->
<!--                                    "What is the best way to get ...-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="index.html#" class="support-ticket">-->
<!--                                <div class="picture">-->
<!--                                    <span class="label label-success"><i class="fa fa-tag"></i></span>-->
<!--                                </div>-->
<!--                                <div class="details">-->
<!--                                    This is just a simple notification-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="index.html#" class="support-ticket">-->
<!--                                <div class="picture">-->
<!--                                    <span class="label label-info"><i class="fa fa-info-circle"></i></span>-->
<!--                                </div>-->
<!--                                <div class="details">-->
<!--                                    12 new orders has arrived today-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="index.html#" class="support-ticket">-->
<!--                                <div class="picture">-->
<!--                                    <span class="label label-important"><i class="fa fa-plus"></i></span>-->
<!--                                </div>-->
<!--                                <div class="details">-->
<!--                                    One more thing that just happened-->
<!--                                </div>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="index.html#" class="text-align-center see-all">-->
<!--                                See all tickets <i class="fa fa-arrow-right"></i>-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="divider"></li>-->
<!--                <li class="hidden-xs">-->
<!--                    <a href="index.html#" id="settings"-->
<!--                       title="Settings"-->
<!--                       data-toggle="popover"-->
<!--                       data-placement="bottom">-->
<!--                        <i class="fa fa-cog"></i>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="hidden-xs dropdown">-->
<!--                    <a href="index.html#" title="Account" id="account"-->
<!--                       class="dropdown-toggle"-->
<!--                       data-toggle="dropdown">-->
<!--                        <i class="fa fa-user"></i>-->
<!--                    </a>-->
<!--                    <ul id="account-menu" class="dropdown-menu account" role="menu">-->
<!--                        <li role="presentation" class="account-picture">-->
<!--                            <img src="/cp/img/lightblue/2.jpg" alt="">-->
<!--                            Philip Daineka-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="form_account.html" class="link">-->
<!--                                <i class="fa fa-user"></i>-->
<!--                                Profile-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="component_calendar.html" class="link">-->
<!--                                <i class="fa fa-calendar"></i>-->
<!--                                Calendar-->
<!--                            </a>-->
<!--                        </li>-->
<!--                        <li role="presentation">-->
<!--                            <a href="index.html#" class="link">-->
<!--                                <i class="fa fa-inbox"></i>-->
<!--                                Inbox-->
<!--                            </a>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="visible-xs">-->
<!--                    <a href="index.html#"-->
<!--                       class="btn-navbar"-->
<!--                       data-toggle="collapse"-->
<!--                       data-target=".sidebar"-->
<!--                       title="">-->
<!--                        <i class="fa fa-bars"></i>-->
<!--                    </a>-->
<!--                </li>-->
<!--                <li class="hidden-xs"><a href="--><?//= Url::toRoute('/admin/default/logout') ?><!--"><i class="fa fa-sign-out"></i></a>-->
<!--                </li>-->
<!--            </ul>-->
<!--            <form id="search-form" class="navbar-form pull-right" role="search">-->
<!--                <input type="search" class="search-query" placeholder="Search...">-->
<!--            </form>-->
<!--            <div class="notifications pull-right">-->
<!--                <div class="alert pull-right">-->
<!--                    <a href="index.html#" class="close" data-dismiss="alert">&times;</a>-->
<!--                    <i class="fa fa-info-circle"></i> Check out Light Blue <a id="notification-link" href="index.html#">settings</a>-->
<!--                    on the right!-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
    </header>
    <?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= $content ?>
    <div class="loader-wrap hiding hide">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
    <div class="loader-wrap hiding hide">
        <i class="fa fa-spinner fa-spin"></i>
    </div>
</div>

<script type="text/template" id="message-template">
    <div class="sender pull-left">
        <div class="icon">
            <img src="/cp/img/lightblue/lightblue/2.jpg" class="img-circle" alt="">
        </div>
        <div class="time">
            just now
        </div>
    </div>
    <div class="chat-message-body">
        <span class="arrow"></span>
        <div class="sender">Tikhon Laninga</div>
        <div class="text">
            <%- text %>
        </div>
    </div>
</script>

<script type="text/template" id="settings-template">
    <div class="setting clearfix">
        <div>Background</div>
        <div id="background-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% dark = background == 'dark'; light = background == 'light';%>
            <button type="button" data-value="dark" class="btn btn-sm btn-transparent <%= dark? 'active' : '' %>">Dark</button>
            <button type="button" data-value="light" class="btn btn-sm btn-transparent <%= light? 'active' : '' %>">Light</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar on the</div>
        <div id="sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% onRight = sidebar == 'right'%>
            <button type="button" data-value="left" class="btn btn-sm btn-transparent <%= onRight? '' : 'active' %>">Left</button>
            <button type="button" data-value="right" class="btn btn-sm btn-transparent <%= onRight? 'active' : '' %>">Right</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>Sidebar</div>
        <div id="display-sidebar-toggle" class="pull-left btn-group" data-toggle="buttons-radio">
            <% display = displaySidebar%>
            <button type="button" data-value="true" class="btn btn-sm btn-transparent <%= display? 'active' : '' %>">Show</button>
            <button type="button" data-value="false" class="btn btn-sm btn-transparent <%= display? '' : 'active' %>">Hide</button>
        </div>
    </div>
    <div class="setting clearfix">
        <div>White Version</div>
        <div>
            <a href="white/" class="btn btn-sm btn-transparent">&nbsp; Switch &nbsp;   <i class="fa fa-angle-right"></i></a>
        </div>
    </div>
</script>

<script type="text/template" id="sidebar-settings-template">
    <% auto = sidebarState == 'auto'%>
    <% if (auto) {%>
        <button type="button"
                data-value="icons"
                class="btn-icons btn btn-transparent btn-sm">Icons</button>
        <button type="button"
                data-value="auto"
                class="btn-auto btn btn-transparent btn-sm">Auto</button>
    <%} else {%>
        <button type="button"
                data-value="auto"
                class="btn btn-transparent btn-sm">Auto</button>
    <% } %>
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

