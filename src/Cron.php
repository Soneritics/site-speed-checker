<?php
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

chdir(__DIR__);
require_once('../vendor/autoload.php');
new Framework\Bootstrap;

$sites = \Application::getConfig()->get('Sites');

echo "Script running\n";
if (!empty($sites)) {
    $model = new \Models\Measurement;
    foreach ($sites as $site) {
        $startTime = microtime_float();
        file_get_contents($site);
        $endTime = microtime_float();
        $time = round($endTime - $startTime, 4);
        $model->insert()->values(['site' => $site, 'seconds' => $time])->execute();

        echo "Site '{$site}' took {$time} seconds\n";
    }
}
echo "Done.\n\n";
