<div class="wrap">
    <h1>HyperSite Reviews Debug Settings</h1>
    <form method="post">
        <?php wp_nonce_field('hsrev_setup'); ?>
        <p>Handle any settings for debug purposes here.</p>
        <input type="checkbox" name="is-setup" <?php echo get_option('hsrev_setup_complete') ? 'checked' : ''; ?>>
        <input type="checkbox" name="bypass-setup-page">
        <input type="submit" value="Complete Setup" class="button button-primary">
    </form>
</div>