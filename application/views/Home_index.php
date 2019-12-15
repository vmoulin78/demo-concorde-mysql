<?php
defined('APP_ENTRY_PASS') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Demo Concorde</title>
    </head>
    <body>
        <div>
            <h1>Demo Concorde</h1>

            <div>
                <h2>Blog</h2>
                <p><button type="button" onclick="window.location='<?php echo site_url('Blog/test'); ?>'">Test</button></p>
<?php
for ($i = 1; $i <= 40; $i++) {
    echo '<p><button type="button" onclick="window.location=\'' . site_url('Blog/example_' . $i) . '\'">Example ' . $i . '</button></p>';
}
?>
            </div>
        </div>
    </body>
</html>