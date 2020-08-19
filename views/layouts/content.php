<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;

?>
<style type="text/css">
    /*Baru tambah untuk loading screen by Gibran */
    .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 120px;
      height: 120px;
      -webkit-animation: spin 2s linear infinite; /* Safari */
      animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    .main_container{width: 100%;}
    .toggle{position: relative;z-index: 9999;}
    .navbar-right{position: relative;z-index: 9999}
</style>
<div class="content-wrapper">
    <style>     
        .loader {      
             border: 16px solid #f3f3f3;       
             border-radius: 50%;      
             border-top: 16px solid #3c8dbc;       
             width: 120px;      
             height: 120px;       
            -webkit-animation: spin 2s linear infinite; /* Safari */       
            animation: spin 2s linear infinite;     
    }      
    /* Safari */     
    @-webkit-keyframes spin {       
    0% { -webkit-transform: rotate(0deg); }       
    100% { -webkit-transform: rotate(360deg); }     }      
    @keyframes spin {       0% { transform: rotate(0deg); }       
    100% { transform: rotate(360deg); }     }     
    </style>     
    <div class="loading col-md-12 col-xs-12" id="loading" style="    height: 100%;display:none;z-index:1000;position: absolute;background-color: rgba(255, 255, 255, 0.68);">     
        <div class="loader" style="margin: 100px 300px;margin-left: 500px;;">
            
        </div>     
        <h2 style=" margin: -80px 310px;margin-left: 470px; width: 100%;color: #555555">Loading Data...</h2>     
    </div>  
    <section class="content-header">
        <!-- <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?> -->

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>
    <?php
        if ($_GET['r']=='site/index') {
            echo '<section id="master-content" class="content" style="    margin-top: -70px;">';
        }else{
            echo '<section id="master-content" class="content" style="    margin-top: 20px;">';
        }
    ?>
    
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>
<?php
if (!Yii::$app->user->isGuest) {
    ?>
    <script>
        // navigator.serviceWorker.register('sw.js');
        function notification(title, url) {
            var notification = new Notification(title, {body: 'Click Me'});
            notification.onclick = function (event) {
                event.preventDefault();
                // window.open("http://stackoverflow.com/");
                console.log(url)
                window.open(url);
            };
            notification.onclose = function (event) {
                console.log('event close')
            }
            notification.onshow = function (event) {
                console.log('event show notification')
            }
        }
        let socket = new WebSocket('<?=Yii::$app->params['socket']?>');
        connectToServer();
        const syncMessage = (socket,message) => {
            socket.send(JSON.stringify(message));
        }
        function connectToServer() {
            console.log('connectToServer')
            socket.onopen = function (e) {
                let id = 324412;
                let usermode = "agent";
                let information = {};
                information.id = '<?=Yii::$app->user->id?>';
                information.command = "inisiate";
                syncMessage(socket,information);
                setInterval(function () {
                    syncMessage(socket,information);
                },3000);
            };

            socket.onmessage = function (event) {
                console.log('[message] Data received from server: event')
                console.log(event);
                data = JSON.parse(event.data);
                title = data.tn_title;
                body = data.tn_message;
                url = data.tn_url;
                link = url;
                message = "<li class='new_notif'><a href='"+link+"'><h4>"+title+"<small><i class='fa fa-clock-o'></i> 5 mins</small>" +
                "</h4><p>"+body+"</p></a></li>";
                newMessage = $(".total-message").text();
                jumlahPesan = parseInt(newMessage)+1;
                $(".total-message, .t-message").text(jumlahPesan);
                $("#messages li").first().before(message);

                if (!("Notification" in window)) {
                    alert("This browser does not support desktop notification");
                } else if (Notification.permission === "granted") {
                    notification(title, url);
                } else if (Notification.permission !== "denied") {
                    Notification.requestPermission().then(function (permission) {
                        if (permission === "granted") {
                            notification(title, url);
                        }
                    });
                }
            };

            socket.onclose = function (event) {
                if (event.wasClean) {
                    connectToServer()
                    console.log(`[close] Connection closed cleanly, code=${event.code} reason=${event.reason}`);
                } else {
                    // e.g. server process killed or network down
                    // event.code is usually 1006 in this case
                    console.log('[close] Connection died');
                    connectToServer()
                }
            };

            socket.onerror = function (error) {
                console.log(error)
                connectToServer()
                // alert(`[error] ${error.message}`);
            };
        }
    </script>
    <?php
}
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 2.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y') ?> <a href="#"></a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
        <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                            <p>Will be 23 on April 24th</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-user bg-yellow"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                            <p>New phone +1(800)555-1234</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                            <p>nora@example.com</p>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <i class="menu-icon fa fa-file-code-o bg-green"></i>

                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                            <p>Execution time 5 seconds</p>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class='control-sidebar-menu'>
                <li>
                    <a href='javascript::;'>
                        <h4 class="control-sidebar-subheading">
                            Custom Template Design
                            <span class="label label-danger pull-right">70%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <h4 class="control-sidebar-subheading">
                            Update Resume
                            <span class="label label-success pull-right">95%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <h4 class="control-sidebar-subheading">
                            Laravel Integration
                            <span class="label label-waring pull-right">50%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href='javascript::;'>
                        <h4 class="control-sidebar-subheading">
                            Back End Framework
                            <span class="label label-primary pull-right">68%</span>
                        </h4>

                        <div class="progress progress-xxs">
                            <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                        </div>
                    </a>
                </li>
            </ul>
            <!-- /.control-sidebar-menu -->

        </div>
        <!-- /.tab-pane -->

        <!-- Settings tab content -->
        <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
                <h3 class="control-sidebar-heading">General Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Report panel usage
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        Some information about this general settings option
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Allow mail redirect
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        Other sets of options are available
                    </p>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Expose author name in posts
                        <input type="checkbox" class="pull-right" checked/>
                    </label>

                    <p>
                        Allow the user to show his name in blog posts
                    </p>
                </div>
                <!-- /.form-group -->

                <h3 class="control-sidebar-heading">Chat Settings</h3>

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Show me as online
                        <input type="checkbox" class="pull-right" checked/>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Turn off notifications
                        <input type="checkbox" class="pull-right"/>
                    </label>
                </div>
                <!-- /.form-group -->

                <div class="form-group">
                    <label class="control-sidebar-subheading">
                        Delete chat history
                        <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                    </label>
                </div>
                <!-- /.form-group -->
            </form>
        </div>
        <!-- /.tab-pane -->
    </div>
</aside><!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class='control-sidebar-bg'></div>
<?php
$rolesnya = Yii::$app->user->identity->roless;
$js = <<<JS
        $( document ).ready(function() {
            $(document).ajaxStart(function() {
                $('.loading').show();
            }).ajaxStop(function() {
                $('.loading').hide();
                if('$rolesnya'=='View only'){
                    $( ".btn" ).each(function( index ) {
                      a = $( this ).text();
                      if (a.indexOf("Create") !== -1) {
                            $( this ).remove();
                      }
                      if (a.indexOf("Remove") !== -1) {
                            $( this ).remove();
                      }
                    });
                }
            });
        })

JS;
$this->registerJs($js);
?>