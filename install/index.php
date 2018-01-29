<?php
/**
 * index.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

define('INSTALL_DIR', __DIR__);
define('ROOT_DIR', dirname(__DIR__));
define('INSTALLER_NAME', 'CoinIndex');

require_once(INSTALL_DIR . DIRECTORY_SEPARATOR . 'utils.php');
require_once(INSTALL_DIR . DIRECTORY_SEPARATOR . 'conf.php');

@ini_set('memory_limit', '-1');
@set_time_limit(0);
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
//error_reporting(0);

$install_errors = [];
$_ENV_PATH = ROOT_DIR . DIRECTORY_SEPARATOR . '.env';
$_SQL_PATH = __DIR__ . DIRECTORY_SEPARATOR . 'install.sql';

// sanitize POST variables
$_POST = array_map('trim', $_POST);

if (!empty($_POST['install'])) {
    if (is_blank_str($_POST['sql_host']) ||
        is_blank_str($_POST['sql_name']) ||
        is_blank_str($_POST['sql_user']) ||
        is_blank_str($_POST['sql_pass'])) {
        $install_errors[] = 'Please provide valid MySQL database connection details.';
    }

    $parts = ['dbname=' . $_POST['sql_name'], 'charset=UTF8'];

    $is_socket = false;
    if ($_POST['sql_host'][0] === '/') {
        $parts[] = 'unix_socket=' . $_POST['sql_host'];
        $is_socket = true;
    } else {
        $parts[] = 'host=' . $_POST['sql_host'];
    }

    if ($_POST['sql_port'] != null && !$is_socket && is_numeric($_POST['sql_port'])) {
        $parts[] = 'port=' . $_POST['sql_port'];
    }

    $dsn = 'mysql:' . implode(';', $parts);

    if (is_blank_str($install_errors)) {
        try {
            $db_conn = new PDO($dsn, $_POST['sql_user'], $_POST['sql_pass']);
        } catch (PDOException $e) {
            $install_errors[] = 'MySQL Connection failed: ' . $e->getMessage();
        }
    }

    if (is_blank_str($_POST['app_name'])) {
        $install_errors[] = 'Invalid website name.';
    }

    if (!filter_var($_POST['app_url'], FILTER_VALIDATE_URL)) {
        $install_errors[] = 'Invalid website url.';
    }

    if (!filter_var($_POST['admin_email'], FILTER_VALIDATE_EMAIL)) {
        $install_errors[] = 'Please provide a valid email address for administrator.';
    }

    if (empty($install_errors)) {
        $success = '';
        $_sanitized = [];
        foreach ($_POST as $k => $v) {
            $_sanitized[$k] = quote_string($v);
        }

        $config_file = write_env_file($_sanitized, $_ENV_PATH);

        if ($config_file) {
            // Temporary variable, used to store current query
            $buffer = '';
            // Read in entire file
            $lines = file($_SQL_PATH);
            // Loop through each line
            foreach ($lines as $line) {
                $line = trim($line);

                // Skip it if it's a comment or blank line
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                // Add this line to the current segment
                $buffer .= $line . PHP_EOL;
                $query = false;

                // If it has a semicolon at the end, it's the end of the query
                if ($line[strlen($line) - 1] === ';') {
                    // Perform the query
                    $query = $db_conn->exec($buffer);
                    // Reset temp variable to empty
                    $buffer = '';
                }
            }

            if ($query === false) {
                $install_errors[] = 'Error found while populating database, please contact us.';
            } else {
                /*
                $query_one .= $db_conn->exec("INSERT INTO `users` (
            `username`,`password`, `email`, `admin`, `active`, `verified`, `registered`, `start_up`, `start_up_info`, `startup_follow`, `startup_image`)
            VALUES ('" . mysqli_real_escape_string($db_conn, $_POST['admin_username']) . "', '" . mysqli_real_escape_string($db_conn, sha1($_POST['admin_password'])) . "','" . mysqli_real_escape_string($db_conn, $_POST['siteEmail']) . "'
                ,'1', '1', '1', '00/0000', '1', '1', '1', '1')");
                */
                $success = INSTALLER_NAME . ' successfully installed, please wait ..';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= INSTALLER_NAME ?> | Installation</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        button:disabled {
            color: #fff !important;
        }

        html {
            position: relative;
            min-height: 100%;
        }

        body {
            background: #fcfcfc;
            font-family: 'Open Sans', sans-serif;
            margin-bottom: 60px;
        }

        form {
            margin-bottom: 0;
        }

        .btn-main {
            color: #ffffff;
            background-color: #5c58aa;
            border-color: #5c58aa;
        }

        .btn-main:disabled {
            color: #333;
            border: none;
        }

        .btn-main:hover {
            color: #ffffff;
            background-color: #7d96c4;
            border-color: #4230c4;
        }

        .small-text {
            font-weight: 300;
            font-size: 12px;
            color: #636c72;
        }

        .admin-panel .col-md-9 .list-group-item:first-child,
        .setting-panel .col-md-8 .list-group-item:first-child,
        .profile-lists .list-group-item:first-child,
        .col-md-8 .list-group-item:first-child,
        .col-sm-4 .list-group-item:first-child,
        .red-list .list-group-item:first-child {
            color: #ffffff;
            background-color: #5c58aa;
        }

        .admin-panel .col-md-9 .list-group-item:first-child a,
        .setting-panel .col-md-8 .list-group-item:first-child a,
        .profile-lists .list-group-item:first-child a,
        .col-md-8 .list-group-item:first-child a {
            color: #ffffff !important;
        }

        .list-group-item.black-list.active-list {
            color: #ffffff;
            background-color: #5c58aa;
        }

        .list-group-item.black-list {
            background: #ffffff;
        }

        .list-group-item.black-list a {
            color: #444444;
        }

        .list-group-item.black-list.active-list a {
            color: #ffffff;
        }

        .small-text a {
            color: #777777 !important;
        }

        .search-advanced-container a:hover {
            text-decoration: none;
            color: #ffffff;
            background-color: #5c58aa;
        }

        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:focus,
        .nav-tabs > li.active > a:hover {
            cursor: default;
            color: #5c58aa;
            border-bottom: 1px solid #5c58aa;
            background-color: transparent
        }

        .btn-active {
            color: #ffffff;
            background: #5c58aa;
            outline: none;
            border: 1px solid #4647a8
        }

        .btn-active:hover,
        .btn-active:focus {
            border: 1px solid #7363c4;
            color: #ffffff;
            background: #4f6ec4;
        }

        .btn-active-color:hover {
            background: #7e71c4;
        }

        small {
            color: #555 !important;
        }

        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 60px;
            background-color: #f5f5f5;
        }

        .footer .container {
            width: auto;
            max-width: 380px;
            padding: 0 15px;
        }

        .footer .container .text-muted {
            margin: 20px 0;
            font-size: 0.95em;
            font-weight: 300;
        }
    </style>
</head>
<body>
<script>
    function submitButton() {
        $('button').attr('disabled', true);
        $('button').text('Please wait..');
        $('form').submit();
    }

    $(function () {
        $('#agree').change(function () {
            if ($(this).is(":checked")) {
                $('#next-terms').attr('disabled', false);
            } else {
                $('#next-terms').attr('disabled', true);
            }
        });
    });
</script>

<?php
$page = 'terms';
$all_pages = ['requirements', 'terms', 'installation', 'finish'];
if (!empty($_GET['page']) && in_array($_GET['page'], $all_pages, true)) {
    $page = $_GET['page'];
}

$page_icon = '';
$page_name = '';
$progress = 0;
if ($page === 'terms') {
    $page_name = 'Terms of use';
    $page_icon = 'newspaper-o';
} else if ($page === 'requirements') {
    $page_name = 'Requirements';
    $page_icon = 'cogs';
    $progress = 25;
} else if ($page === 'installation') {
    $page_name = 'Installation';
    $page_icon = 'download';
    $progress = 50;
} else if ($page === 'finish') {
    $page_name = 'Finish';
    $page_icon = 'fa-flag-checkered';
    $progress = 100;
}

$php_valid = version_compare(PHP_VERSION, '7.0.0', '>=');
$is_writable = is_writable($_ENV_PATH);
$is_sql = file_exists($_SQL_PATH);
$disabled = !($php_valid && $is_writable && $is_sql);

$extensions = check_extensions($_EXTENSIONS);
if ($extensions['errors']) $disabled = true;

$permissions = check_permissions($_PERMISSIONS);
if ($permissions['errors']) $disabled = true;
?>


<div class="container">
    <div>
        <h2><?= INSTALLER_NAME ?> Installation</h2>
        <p>Welcome to <?= INSTALLER_NAME ?> installer! Installation process is very easy and it only takes 60
            seconds!</p>
        <div class="progress">
            <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar"
                 aria-valuenow="<?= $progress ?>"
                 aria-valuemin="0"
                 aria-valuemax="100" style="width: <?= $progress ?>%"><span class="sr-only"><?= $progress ?>
                    % Complete</span></div>
        </div>
    </div>

    <div class="row admin-panel">

        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item black-list <?php echo ($page == 'terms') ? 'active-list' : ''; ?>"><i
                            class="fa fa-fw fa-newspaper-o"></i> Terms of use
                </li>
                <li class="list-group-item black-list <?php echo ($page == 'requirements') ? 'active-list' : ''; ?>"><i
                            class="fa fa-fw fa-cogs"></i> Requirements
                </li>
                <li class="list-group-item black-list <?php echo ($page == 'installation') ? 'active-list' : ''; ?>"><i
                            class="fa fa-fw fa-download"></i> Installation
                </li>
                <li class="list-group-item black-list <?php echo ($page == 'finish') ? 'active-list' : ''; ?>"><i
                            class="fa fa-fw fa-flag-checkered"></i> Finish
                </li>
            </ul>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-fw fa-<?php echo $page_icon ?>"></i> <?php echo $page_name ?>
                </div>
                <div class="panel-body">
                    <?php if ($page == 'terms') { ?>

                        <p><strong>License to be used on one (1) domain only!</strong></p>

                        <p>The Regular license entitles you to use the product on one website / domain only. If you want
                            to use it on multiple websites / domains you have to purchase several Regular licenses (1
                            website = 1 license).</p>

                        <p>If you charge website users to have access to the product or its components you need to
                            purchase the Extended license.</p>

                        <p><b>You CAN:</b></p>
                        <ul>
                            <li>Use on one (1) domain only, additional license purchase required for each
                                additional domain.
                            </li>
                            <li>Modify or edit as you see fit.</li>
                            <li>Delete sections as you see fit.</li>
                            <li>Translate to your choice of language.</li>
                        </ul>

                        <p><b>You CANNOT:</b></p>
                        <ul>
                            <li>Resell, distribute, give away or trade by any means to any third party or
                                individual without permission.
                            </li>
                            <li>Include this product into other products sold on Envato market and its affiliate
                                websites.
                            </li>
                            <li>Use on more than one (1) domain.</li>
                        </ul>

                        <p>Please adhere to these rules. Read <a href="https://codecanyon.net/licenses/faq"
                                                                 target="_blank">License FAQ</a> for more information.
                        </p>

                        <hr>
                        <form action="?page=requirements" method="post">
                            <div class="form-group">
                                <input type="checkbox" id="agree" name="agree"> I agree to the terms of use and
                                privacy policy
                            </div>
                            <div class="row">
                                <div class="col-sm-2 pull-left last-btn">
                                    <button type="submit" class="btn btn-main" id="next-terms" disabled>
                                        <i class="fa fa-arrow-right progress-icon" data-icon="paper-plane-o"></i>
                                        Next
                                    </button>
                                </div>
                                <div class="setting-saved-update-alert milinglist"></div>
                            </div>
                        </form>

                    <?php } else if ($page == 'requirements') { ?>

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?= table_row($php_valid, 'PHP 7.0+', 'Required PHP version 7.0 or higher') ?>

                            <?php
                            foreach ($extensions['requirements'] as $ext => $enabled) {
                                $label = $extensions['labels'][$ext];
                                echo table_row($enabled, $ext, "Required $label PHP extension");
                            }

                            foreach ($permissions['permissions'] as $item) {
                                $perm = 'Required permission: <strong>' . $item['permission'] . '</strong> Found: <strong>' . $item['permission_found'] . '</strong>';
                                echo table_row($item['valid'], $item['folder'], $perm, 'Writable', 'Not Writable');
                            }
                            ?>
                            <?= table_row($is_writable, '.env', 'Required <em>.env</em> to be writable for the installation', 'Writable', 'Not Writable') ?>
                            <?= table_row($is_sql, 'install.sql', 'Required <em>install.sql</em> for the installation', 'Readable', 'Not Readable') ?>
                            </tbody>
                        </table>

                        <br>
                        <form action="?page=installation" method="post">
                            <div class="row">
                                <div class="col-sm-2 pull-left last-btn">
                                    <button type="submit" class="btn btn-main"
                                            id="next-terms" <?php echo ($disabled == true) ? 'disabled' : ''; ?>>
                                        <i class="fa fa-arrow-right progress-icon" data-icon="paper-plane-o"></i>
                                        Next
                                    </button>
                                </div>
                                <div class="setting-saved-update-alert milinglist"></div>
                            </div>
                        </form>

                    <?php } else if ($page == 'finish') { ?>
                        <h5>Congratulations! <?= INSTALLER_NAME ?> had been installed successfully!</h5>
                        <div class="alert alert-warning" role="alert">
                            <i class="fa fa-warning" aria-hidden="true"></i> <strong>URGENT!</strong> Please delete your
                            installation folder and its contents!
                        </div>
                        <p>The reason for this is mainly due to security - if someone can access your installation
                            folder they could potentially overwrite your website by running the installer again.</p>
                        <p>To delete your installation folder manually, use an FTP client and right click on the folder
                            named <strong>"install"</strong> and press Delete. </p>
                        <br><a href="../">
                            <button class="btn btn-main">
                                Let's Start!
                            </button>
                        </a>
                    <?php } else if ($page == 'installation') { ?>
                        <?php
                        if (!empty($install_errors)) {
                            ?>
                            <div class="alert alert-danger">
                                <?php
                                foreach ($install_errors as $value) {
                                    echo '- ' . $value . "<br>";
                                }
                                ?>
                            </div>
                        <?php } else if (!empty($success)) { ?>
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i> <?php echo $success; ?>
                                <script type="text/javascript">
                                    var URL = '?page=finish';
                                    var delay = 1000; //Your delay in milliseconds
                                    setTimeout(function () {
                                        window.location = URL;
                                    }, delay);
                                </script>
                            </div>
                        <?php } ?>

                        <form action="?page=installation" method="post"
                              class="form-horizontal">
                            <p class="pull-right small-text"> View <a href="http://docs.kaijuscripts.com/coinindex/"
                                                                      target="_blank">Online Documentation</a></p>
                            <?php form_render($FORM_DEFINITION); ?>

                            <div class="form-group">
                                <div class="col-md-6">
                                    Note: Installation process may take few minutes.
                                </div>
                            </div>

                            <input type="hidden" name="install" value="install">
                            <div class="form-group last-btn">
                                <div class="col-md-6">
                                    <button type="submit" onclick="submitButton();"
                                            class="btn btn-main btn-lg btn-block" <?php echo ($disabled == true) ? 'disabled' : ''; ?>>
                                        <i class="fa fa-download progress-icon" data-icon="download"></i> Install
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-muted">Copyright &copy; <?= date('Y') . ' ' . INSTALLER_NAME ?>. Powered by <a
                    href="http://kaijuscripts.com/" target="_blank">KaijuScripts</a></p>
    </div>
</footer>
</body>
</html>