<?php if (!defined('ABSPATH')) exit; ?>

<div class="wrap">
    <h1>Google OAuth Callback</h1>

    <?php if (!empty($message)) : ?>
        <div class="notice <?php echo $error ? 'notice-error' : 'notice-success'; ?> is-dismissible">
            <p><?php echo esc_html($message); ?></p>
        </div>
    <?php endif; ?>
</div>
