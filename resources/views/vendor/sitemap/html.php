<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $channel['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= asset('asset/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h3><a href="<?= $channel['link'] ?>"><?= $channel['title'] ?></a></h3>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Page</th>
                    <th>Last Updated</th>
                </tr>
                <?php foreach ($items as $item) : ?>
                    <tr>
                        <td>
                            <a href="<?= $item['loc'] ?>"><?= (empty($item['title'])) ? $item['loc'] : $item['title'] ?></a>
                        </td>
                        <td>
                            <small><?= date('Y-m-d\TH:i:sP', strtotime($item['lastmod'])) ?></small>
                        </td>
                    </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
</body>
</html>