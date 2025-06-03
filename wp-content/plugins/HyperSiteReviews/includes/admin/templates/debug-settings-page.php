<div class="wrap">
    <h1>HyperSite Reviews Debug Settings</h1>
    <form method="post">
        <?php wp_nonce_field('hsrev_debug_setting_set'); ?>
        <p>Handle any settings for debug purposes here.</p>
        <label>Setup Complete? : </label>
        <input type="checkbox" name="is-setup" <?php checked(get_option('hsrev_setup_complete'), true); ?>>
        <label>Bypass Setup? : </label>
        <input type="checkbox" name="bypass-setup-page">
        <input type="submit" value="Complete Setup" class="button button-primary">
    </form>
</div>