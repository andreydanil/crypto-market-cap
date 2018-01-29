<?php
/**
 * utils.php
 *
 * @author     Dr. Max Ehsan <contact@kaijuscripts.com>
 * @copyright  2017 Dr. Max Ehsan
 */

defined('INSTALLER_NAME') or die('Unauthorized access');

function form_input($field, $title, $help = null, $type = 'text', $value = null, $options = [], $checked = false)
{
    if ($type == null)
        $type = 'text';

    $value = !empty($_POST[$field]) ? $_POST[$field] : $value ?? '';
    ?>
    <div class="form-group">
        <?php if ($type == 'checkbox'): ?>
            <div class="col-lg-offset-4 col-lg-6 checkbox">
                <label class="control-label" for="<?= $field ?>">
                    <input type="checkbox" id="<?= $field ?>" name="<?= $field ?>" value="1"
                        <?php if ($checked) echo 'checked="checked"'; ?>
                    >
                    <?= $title ?>
                </label>
                <?php if (isset($help)): ?>
                    <br/><span class="small-text"><?= $help ?></span>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <label class="col-lg-4 control-label" for="<?= $field ?>"><?= $title ?></label>
            <div class="col-lg-6">
                <?php if ($type == 'select'): ?>
                    <select class="form-control" name="<?= $field ?>" id="<?= $field ?>">
                        <?php foreach ($options as $key => $val): ?>
                            <option value="<?= $key ?><?php if ($value === $val) echo ' selected="selected"'; ?>">
                                <?= $val ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <input type="<?= $type ?>" class="form-control" name="<?= $field ?>" id="<?= $field ?>"
                           value="<?= $value ?>">
                <?php endif; ?>
                <?php if (isset($help)): ?>
                    <span class="small-text"><?= $help ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

function form_render(array $form)
{
    foreach ($form as $section => $fields) {
        echo "<h3>$section</h3>\n";
        foreach ($fields as $field) {
            form_input($field['id'], $field['title'], $field['help'], $field['type'], $field['value'], $field['options'], $field['checked']);
        }
        echo '<hr />';
    }
}

function table_row($enabled, $col1, $col2, $success = 'Installed', $fail = 'Not installed')
{
    ?>
    <tr>
        <td><?= $col1 ?></td>
        <td><?= $col2 ?></td>
        <td><?php echo ($enabled == true) ? '<font color="green"><i class="fa fa-check fa-fw fa-check-circle-o"></i> ' . $success . '</font>' : '<font color="red"><i class="fa fa-times fa-fw fa-exclamation-circle"></i> ' . $fail . '</font>' ?></td>
    </tr>
    <?php
}

function str_contains($haystack, $needles)
{
    foreach ((array)$needles as $needle) {
        if ($needle !== '' && mb_strpos($haystack, $needle) !== false) {
            return true;
        }
    }

    return false;
}

function quote_string($s)
{
    return str_contains($s, [' ', "\t"]) ? sprintf('"%s"', $s) : $s;
}

function getPermission($path)
{
    $path = ROOT_DIR . DIRECTORY_SEPARATOR . $path;
    clearstatcache(null, $path);
    return substr(sprintf('%o', fileperms($path)), -4);
}

/*
function checkPerms($path, $mask = 0775)
{
    $path = ROOT_DIR . DIRECTORY_SEPARATOR . $path;
    clearstatcache(null, $path);
    return decoct(fileperms($path) & $mask);
}
*/

function check_permissions(array $folders)
{
    $results = ['errors' => false];

    foreach ($folders as $folder => $permission) {
        $actual = getPermission($folder);
        if ($actual >= $permission) {
            $results['permissions'][] = [
                'folder' => $folder,
                'permission' => $permission,
                'permission_found' => $actual,
                'valid' => true
            ];
        } else {
            $results['permissions'][] = [
                'folder' => $folder,
                'permission' => $permission,
                'permission_found' => $actual,
                'valid' => false
            ];
            $results['errors'] = true;
        }
    }

    return $results;
}

function check_extensions(array $requirements)
{
    $results = ['errors' => false];
    foreach ($requirements as $requirement => $label) {
        $results['labels'][$requirement] = $label;
        if (!extension_loaded($requirement)) {
            $results['labels'][$requirement] = $label;
            $results['requirements'][$requirement] = false;
            $results['errors'] = true;
        } else {
            $results['requirements'][$requirement] = true;
        }
    }
    return $results;
}

function is_blank_str($value)
{
    if (null === $value) {
        return true;
    }

    if (is_string($value)) {
        return trim($value) === '';
    }

    if (is_numeric($value) || is_bool($value)) {
        return false;
    }

    return empty($value);
}


function generate_key()
{
    return 'base64:' . base64_encode(random_bytes(32));
}

function get_theme_color($value = null)
{
    if ($value != null) {
        $value = strtolower(trim($value));
        if (in_array($value, ['blue', 'green', 'red', 'purple', 'cyan']))
            return $value;
    }
    return 'blue';
}

function web_path()
{
    $uri_path = strstr($_SERVER['REQUEST_URI'], '?', true);
    $uri_path = ltrim($uri_path, '/');
    $uri_path = '/' . strstr($uri_path, 'install/', true);
    return $uri_path;
}

function url_origin($s, $use_forwarded_host = false)
{
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . ($ssl ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = $host ?? $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}

function guess_app_url()
{
    return url_origin($_SERVER) . web_path();
}

function write_env_file(array $data, $filename)
{
    $key = generate_key();
    $mail_driver = is_blank_str($data['mail_host']) ? 'sendmail' : 'smtp';
    $theme = get_theme_color($data['theme']);
    $admin_email = strtolower($data['admin_email']);
    $disqus = is_blank_str($data['disqus_id']) ? 'false' : 'true';
    $page_speed = $data['page_speed'] == '1' ? 'true' : 'false';

    $content = <<<EOT
APP_NAME={$data['app_name']}
APP_URL={$data['app_url']}
APP_ENV=production
APP_KEY=$key
APP_DEBUG=false
APP_LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST={$data['sql_host']}
DB_PORT={$data['sql_port']}
DB_DATABASE={$data['sql_name']}
DB_USERNAME={$data['sql_user']}
DB_PASSWORD={$data['sql_pass']}

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=$mail_driver
MAIL_HOST={$data['mail_host']}
MAIL_PORT={$data['mail_port']}
MAIL_USERNAME={$data['mail_user']}
MAIL_PASSWORD={$data['mail_pass']}
MAIL_ENCRYPTION={$data['mail_encr']}
MAIL_FROM_NAME={$data['app_name']}
MAIL_FROM_ADDRESS=$admin_email

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=

ADMIN_EMAIL=$admin_email
THEME_COLOR=$theme

GOOGLE_ANALYTICS_ID={$data['ga_id']}
ADSENSE_PUB_ID={$data['adsense_pub']}
ADSENSE_SLOT1_ID={$data['adsense_slot1']}
ADSENSE_SLOT2_ID={$data['adsense_slot2']}

CHANGELLY_AFF_ID={$data['changelly_id']}
DONATE_BTC={$data['donate_btc']}
DONATE_ETH={$data['donate_eth']}
DONATE_LTC={$data['donate_ltc']}

DISQUS_ENABLED=$disqus
DISQUS_USERNAME={$data['disqus_id']}

LARAVEL_PAGE_SPEED_ENABLE=$page_speed
EOT;
    return file_put_contents($filename, $content);
}