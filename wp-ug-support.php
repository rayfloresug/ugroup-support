<?php

/*
* Plugin Name: UGroup - WordPress Support
* Description: Simple plugin for client support with dashboard widget when face any wordpress issue they will contact to the developer without going anywhere.
* Version: 1.0.0
* Author: rayfloresug
* Author URI: https://u.group
* License:  GPLv3
* License URI: http://www.gnu.org/licenses/gpl-3.0.html
* Requires PHP: 5.6
* Text Domain:  wp-ug-support
* NOTE:
* 1.
* 2.
*/

// include only file
if (!defined('ABSPATH')) {
	die('Do not open this file directly.');
}


class WP_UG_SUPPORT
{
	static function wp_ug_support_implement()
	{
		function wp_admin_menu()
		{
			add_menu_page(
				__('Wordpress Support', 'wp-support'),
				'WP Support',
				'manage_options',
				'wp_ug_support_page.php',
				'wp_ug_support_setting_page',
				'dashicons-admin-generic',
				1
			);
		}
		add_action('admin_menu', 'wp_admin_menu');

		// Link to settings page from plugins screen
		add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'add_action_links');
		function add_action_links($links)
		{
			$mylinks = array(
				'<a href="' . admin_url('admin.php?page=wp_ug_support_page.php') . '">Settings</a>',
			);
			return array_merge($links, $mylinks);
		}

		// add settng on admin tool bar
		add_action('admin_bar_menu', 'add_link_to_admin_bar', 999);

		function add_link_to_admin_bar($admin_bar)
		{
			$args = array(
				'id'     => 'wp-support',
				'title'  => 'WP Support',
				'href'   => esc_url(admin_url('admin.php?page=wp-ug-support.php')),
				'meta'   => false
			);
			$admin_bar->add_node($args);
		}
		// add widget on dashboard
		add_action('wp_dashboard_setup', 'wp_ug_support_dashboard_widgets');
		function wp_ug_support_dashboard_widgets()
		{
			add_meta_box('wp_ug_support', 'U.Group WordPress Support', 'wp_ug_support_dashboard_box', 'dashboard', 'side', 'high');
		}
		function wp_ug_support_dashboard_box()
		{
			$widget = '<div class="support_dashboard" style="padding: 20px 0px;">';
			$widget .= '<p style="text-align: center; margin: 0px"><svg id="Layer_1" height="50" viewBox="0 0 512 512" width="50" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1"><path d="m489.76 435.49-269.35-269.35a109.681 109.681 0 0 0 -134.61-149.49l44.46 44.46-11.48 57.25-59.17 10.46-42.89-43.18h-.01a109.676 109.676 0 0 0 149.43 134.77l269.36 269.35a38.371 38.371 0 1 0 54.26-54.27z" fill="#b0b5ca"/><path d="m494.08 36.72-33.07 56.55-29.13 10.34-113.41 113.41-1.78 1.78-23.49-23.49 1.78-1.78 113.41-113.41 10.34-29.13 56.55-33.07z" fill="#e5e5e5"/><path d="m270.506 191.261h40.348v60.118h-40.348z" fill="#a0eaea" transform="matrix(.707 -.707 .707 .707 -71.359 270.364)"/><path d="m226.22 232.37-60.82 33.28-135.5 135.5a40.879 40.879 0 0 0 0 57.82l23.13 23.13a40.879 40.879 0 0 0 57.82 0l135.5-135.5 33.28-60.82z" fill="#fb6771"/><path d="m63.11 211.16a109.581 109.581 0 0 1 -28.058-107.06l-18.332-18.46h-.01a109.745 109.745 0 0 0 54.646 132.954c-2.838-2.321-5.598-4.786-8.246-7.434z" fill="#ccd3df"/><path d="m49.9 471.97a40.879 40.879 0 0 1 0-57.82l135.5-135.5 56.3-30.8-15.48-15.48-60.82 33.28-135.5 135.5a40.879 40.879 0 0 0 0 57.82l23.13 23.13a40.679 40.679 0 0 0 17.3 10.3z" fill="#db525f"/><path d="m93.725 450.112a6 6 0 0 1 -4.242-10.242l95.859-95.859a6 6 0 0 1 8.485 8.486l-95.859 95.858a5.982 5.982 0 0 1 -4.243 1.757z" fill="#bf4153"/><path d="m67.887 424.274a6 6 0 0 1 -4.242-10.242l95.855-95.859a6 6 0 0 1 8.485 8.486l-95.855 95.858a5.982 5.982 0 0 1 -4.243 1.757z" fill="#bf4153"/><g fill="#6d7486"><path d="m427.115 432.942a5.982 5.982 0 0 1 -4.243-1.757l-131.757-131.757a6 6 0 0 1 8.485-8.486l131.757 131.758a6 6 0 0 1 -4.242 10.242z"/><path d="m217.23 223.058a5.981 5.981 0 0 1 -4.243-1.758l-16.54-16.54a6 6 0 1 1 8.486-8.485l16.539 16.54a6 6 0 0 1 -4.242 10.243z"/><path d="m197.317 139.678c-.155 0-.311-.006-.469-.018a6 6 0 0 1 -5.52-6.444 80.849 80.849 0 0 0 -3.84-31.621 6 6 0 1 1 11.393-3.769 92.849 92.849 0 0 1 4.412 36.314 6 6 0 0 1 -5.976 5.538z"/><path d="m183.691 85.917a5.993 5.993 0 0 1 -5.039-2.736 80.821 80.821 0 0 0 -4.943-6.809 6 6 0 1 1 9.33-7.547 92.728 92.728 0 0 1 5.68 7.826 6 6 0 0 1 -5.028 9.266z"/></g><path d="m305.78 264.95-58.73-58.73a16.61 16.61 0 0 0 -23.49 23.49l58.73 58.73a16.61 16.61 0 0 0 23.49-23.49z" fill="#e75163"/></svg></p>';
			$widget .= '<h2 style="text-align: center; font-weight: 500;">Need WordPress Help?</h2>';
			$widget .= '<p style="text-align: center;"><a href="'. esc_url(admin_url("admin.php?page=wp_ug_support_page.php")).'" class="button button-primary">Submit Ticket</a></p>';
			$widget .= '</div>';
			echo $widget;
		}

		function wp_ug_support_setting_page()
		{
			//function to generate response
			if (isset($_POST['subbmit_btn'])) {
				//user posted variables
				$name = $_POST['message_name'];
				$email = get_option('admin_email');
				$subject = $_POST['message_subject'];
				$body = $_POST['message_text'];
				$message = '<html><body>';
				$message .= '<h1>Need Technical Support</h1>';
				$message .= '<table rules="all" style="border: 1px solid #b7afaf; width: 50%; " cellpadding="10">';
				$message .= "<tr style='background: #eee;'><td><strong>Name</strong> </td><td>" . $_POST['message_name'] . "</td></tr>";
				$message .= "<tr><td><strong>Subject</strong> </td><td>" . $_POST['message_subject'] . "</td></tr>";
				$message .= "<tr><td><strong>Phone</strong> </td><td>" . $_POST['message_phone'] . "</td></tr>";
				$message .= "<tr><td><strong>Message</strong> </td><td>" . $_POST['message_text'] . "</td></tr>";
				$message .= "</table>";
				$message .= "</body></html>";

				//mail variables
//				$to = get_option('admin_email');
				$to = 'ray.flores@u.group';
				$subject = "Need Help at ".get_bloginfo('name');
				$headers = array('From: '. $email , 'Content-Type: text/html; charset=UTF-8');
				$sent = wp_mail($to, $subject, $message, $headers);
				if ($sent) {
					echo '<div class="updated notice">
                            <p>Thanks! Your message has been sent. We\'ll contact you soon</p>
                        </div>';
				} else {
					echo '<div class="error notice">
                            <p>Message was not sent. Try Again.</p>
                        </div>';
				}
			}

			?>
			<div class="wrap">
				<h1 class="wp-heading-inline">WordPress Support</h1>
				<div id="respond">
					<form action="admin.php?page=wp_ug_support_page.php" method="post">
						<table class="form-table" role="presentation">
							<tbody>
							<tr>
								<th scope="row"><label for="message_name">Name<span class="description">(required)</span></label></th>
								<td><input class="regular-text" type="text" name="message_name" required></td>
							</tr>
							<tr>
								<th scope="row"><label for="message_subject">Subject<span class="description">(required)</span></label></th>
								<td><input class="regular-text" type="text" name="message_subject" required></td>
							</tr>
							<tr>
								<th scope="row"><label for="message_phone">Phone<span class="description">(required)</span></label></th>
								<td><input class="regular-text" type="text" name="message_phone" required></td>
							</tr>
							<tr>
								<th scope="row"><label for="message_text">Message<span class="description">(required)</span></label></th>
								<td><textarea rows="5" cols="50" name="message_text" required></textarea>
									<p class="description" id="support-description">Describe your problem</p>
								</td>
							</tr>
							</tbody>
						</table>
						<p class="submit">
							<input type="submit" name="subbmit_btn" id="submit" class="button button-primary">
						</p>
					</form>
				</div>
			</div>
		<?php }
	}
}


WP_UG_SUPPORT::wp_ug_support_implement();