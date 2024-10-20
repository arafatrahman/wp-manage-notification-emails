<?php
/**
 * Settings view for WP Manage Notification E-mails
 */

$options = get_option('wp_mne_settings', []);
?>

<div class="wrap">
    <h2><?php esc_html_e('Manage Notification Emails', 'wp_manage_notification_emails'); ?></h2>
    <form action="options.php" method="post">
        <?php
        settings_fields('wpManageNotificationEmails');
        do_settings_sections('wpManageNotificationEmails');
        ?>

        <h3><?php esc_html_e('Notification Settings', 'wp_manage_notification_emails'); ?></h3>
        <?php
        $notification_settings = [
            'new_user_notification_admin' => __('New user notification to admin', 'wp_manage_notification_emails'),
            'new_user_notification_user' => __('New user notification to user', 'wp_manage_notification_emails'),
            'notify_post_author' => __('Notify post author', 'wp_manage_notification_emails'),
            'notify_moderator' => __('Notify moderator', 'wp_manage_notification_emails'),
            'password_change_notification_admin' => __('Password change notification to admin', 'wp_manage_notification_emails'),
            'password_change_notification_user' => __('Password change notification to user', 'wp_manage_notification_emails'),
            'email_change_notification_user' => __('E-mail address change notification to user', 'wp_manage_notification_emails'),
            'forgotten_password_email_user' => __('Forgotten password e-mail to user', 'wp_manage_notification_emails'),
            'forgotten_password_email_admin' => __('Forgotten password e-mail to administrator', 'wp_manage_notification_emails'),
            'automatic_core_update_email' => __('Automatic WordPress core update e-mail', 'wp_manage_notification_emails'),
            'automatic_plugin_update_email' => __('Automatic WordPress plugin update e-mail', 'wp_manage_notification_emails'),
            'automatic_theme_update_email' => __('Automatic WordPress theme update e-mail', 'wp_manage_notification_emails'),
            'extra_admin_emails' => __('Send admin notifications to extra admin e-mail addresses', 'wp_manage_notification_emails'),
            'email_address_update_request' => __('Send an e-mail to administrators after a user requested to update their e-mail address', 'wp_manage_notification_emails'),
            'email_address_update_success' => __('Send an e-mail to administrators after a user successfully updated their e-mail address', 'wp_manage_notification_emails'),
            'multi_site_support' => __('Multi-site support', 'wp_manage_notification_emails'),
            'export_import_settings' => __('Export and import settings', 'wp_manage_notification_emails'),
        ];

        foreach ($notification_settings as $key => $label) {
            ?>
            <p>
                <input type="checkbox" id="<?php echo esc_attr($key); ?>" name="wp_mne_settings[<?php echo esc_attr($key); ?>]" value="1" <?php checked(isset($options[$key]) ? $options[$key] : 0, 1); ?>>
                <label for="<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label>
            </p>
            <?php
        }
        ?>

        <h3><?php esc_html_e('Export/Import Settings', 'wp_manage_notification_emails'); ?></h3>
        <p>
            <strong><?php esc_html_e('Export Settings:', 'wp_manage_notification_emails'); ?></strong><br>
            <textarea readonly style="width:100%; height:100px;"><?php echo esc_textarea(serialize($options)); ?></textarea>
        </p>
        <p>
            <strong><?php esc_html_e('Import Settings:', 'wp_manage_notification_emails'); ?></strong><br>
            <textarea id="import_settings" name="import_settings" style="width:100%; height:100px;"></textarea>
            <button type="button" class="button" id="import_settings_button"><?php esc_html_e('Import Settings', 'wp_manage_notification_emails'); ?></button>
        </p>

        <?php submit_button(); ?>
    </form>
</div>

<script>
    document.getElementById('import_settings_button').onclick = function () {
        var settings = document.getElementById('import_settings').value;
        if (settings) {
            var data = {
                action: 'wp_mne_import_settings',
                settings: settings
            };
            jQuery.post(ajaxurl, data, function (response) {
                location.reload();
            });
        }
    };
</script>
?>
