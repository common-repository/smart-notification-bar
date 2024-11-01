<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( "add_action" ) ) {
	echo "Hi there!  I'm just a plugin, not much I can do when called directly.";
	exit;
}
?>

<div class="ep-plugin-page-actions ep-plugin-page-actions--header edit-post-header" id="smart-notification-bar__editor-header">
	<div class="actions">
		<h1>
			<?php
			if ( $smart_notification_bar->id ) {
				?>
				Editing: <?php echo esc_html( $smart_notification_bar->name ); ?>
				<?php
			} else {
				?>
				Create New Notification Bar
				<?php
			}
			?>
		</h1>

		<?php
		if ( $smart_notification_bar->id ) {
			?>
			<a href="<?php echo get_site_url() . "?smbarprvw=" . $smart_notification_bar->id; ?>" target="_blank" class="button" id="smart-notification-bar-preview-button">Preview Notification Bar</a>
			<?php
		}
		?>

		<button type="submit" class="ep-plugin-button button button-primary ep-plugin-save-smart-notification-bar">
			Save notification bar
			<i class="hidden">
				<svg class="ep-plugin-spin" width="25" height="15" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M33 20.5C33 22.9723 32.2669 25.389 30.8934 27.4446C29.5199 29.5002 27.5676 31.1024 25.2835 32.0485C22.9995 32.9946 20.4861 33.2421 18.0614 32.7598C15.6366 32.2775 13.4093 31.087 11.6612 29.3388C9.91301 27.5907 8.7225 25.3634 8.24018 22.9386C7.75787 20.5139 8.00541 18.0005 8.95151 15.7165C9.8976 13.4324 11.4998 11.4801 13.5554 10.1066C15.611 8.73311 18.0277 8 20.5 8L20.5 13C19.0166 13 17.5666 13.4399 16.3332 14.264C15.0999 15.0881 14.1386 16.2594 13.5709 17.6299C13.0032 19.0003 12.8547 20.5083 13.1441 21.9632C13.4335 23.418 14.1478 24.7544 15.1967 25.8033C16.2456 26.8522 17.582 27.5665 19.0368 27.8559C20.4917 28.1453 21.9997 27.9968 23.3701 27.4291C24.7406 26.8614 25.9119 25.9001 26.736 24.6668C27.5601 23.4334 28 21.9834 28 20.5H33Z" fill="white">
					</path>
				</svg>
			</i>
		</button>
	</div>

	<?php include __DIR__ . "/form-components/preview.php" ?>

</div>


<form action="" method="post" id="smart-nofitication-bar-form" class="ep-plugin-form">
	<div class="ep-plugin-form__form">

		<?php
		include __DIR__ . "/form-components/get-started.php";
		include __DIR__ . "/form-components/basic-settings.php";
		include __DIR__ . "/form-components/notification-bar-content.php";
		include __DIR__ . "/form-components/call-to-action-settings.php";
		include __DIR__ . "/form-components/close-button-settings.php";
		include __DIR__ . "/form-components/display-rules.php";
		?>

	</div><!-- end .ep-plugin-form__form -->

	<div class="ep-plugin-form__sidebar">
		<?php
		include __DIR__ . "/form-components/visibility.php";
		?>

		<?php
		if ( $smart_notification_bar->id ) {
			?>
			<div class="ep-plugin-card">
				<div class="ep-plugin-card__section ep-plugin-card__section--secondary">
					<h3 class="ep-plugin-card__title">Danger zone</h3>
					<p>If you'd like to delete this Notification Bar, click the button below.<br /></p>
				</div>

				<div class="ep-plugin-card__section ep-plugin-card__section--secondary">
					<div class="ep-plugin-form-group">
						<button type="button" class="button button-link-delete" id="button--notification-bar-delete">
							Delete Notificaiton Bar
						</button>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div><!-- end .ep-plugin-form__sidebar -->
</form>

<div class="ep-plugin-page-actions">
	<a href="admin.php?page=smart-notification-bars-list" class="ep-plugin-button--link">Back to Notification Bars list</a>

	<button type="submit" class="ep-plugin-button button button-primary button-hero ep-plugin-save-smart-notification-bar">
		Save Notification Bar
		<i class="hidden">
			<svg class="ep-plugin-spin" width="25" height="15" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M33 20.5C33 22.9723 32.2669 25.389 30.8934 27.4446C29.5199 29.5002 27.5676 31.1024 25.2835 32.0485C22.9995 32.9946 20.4861 33.2421 18.0614 32.7598C15.6366 32.2775 13.4093 31.087 11.6612 29.3388C9.91301 27.5907 8.7225 25.3634 8.24018 22.9386C7.75787 20.5139 8.00541 18.0005 8.95151 15.7165C9.8976 13.4324 11.4998 11.4801 13.5554 10.1066C15.611 8.73311 18.0277 8 20.5 8L20.5 13C19.0166 13 17.5666 13.4399 16.3332 14.264C15.0999 15.0881 14.1386 16.2594 13.5709 17.6299C13.0032 19.0003 12.8547 20.5083 13.1441 21.9632C13.4335 23.418 14.1478 24.7544 15.1967 25.8033C16.2456 26.8522 17.582 27.5665 19.0368 27.8559C20.4917 28.1453 21.9997 27.9968 23.3701 27.4291C24.7406 26.8614 25.9119 25.9001 26.736 24.6668C27.5601 23.4334 28 21.9834 28 20.5H33Z" fill="white">
				</path>
			</svg>
		</i>
	</button>
</div>


<div class="ep-plugin-form-result__modal <?php
	if ( ! isset( $_GET["msg"] ) ) {
		echo "hidden";
	}
	?>">
	<div class="ep-plugin-form-result__modal-content">
		<div class="ep-plugin-form-result ep-plugin-form-result--error hidden">
			<div class="ep-plugin-form-result__content">
				Error
			</div>
			<button type="button" class="ep-plugin-form-result__close-button">
				<strong>
					&times;
				</strong>
			</button>
		</div>

		<div class="ep-plugin-form-result ep-plugin-form-result--success <?php
			if ( ! isset( $_GET["msg"] ) || $_GET["msg"] != "created" ) {
				echo "hidden";
			}
			?>">
			<div class="ep-plugin-form-result__content">
				<?php
				if ( isset( $_GET["msg"] ) ) {
					$currentMsg = sanitize_title( $_GET["msg"] );

					switch( $currentMsg ) {
						case "created":
							echo "Notification bar created successfully";
							break;
						
						default:
							echo "Success";
							break;
					}
				} else {
					echo "Success";
				}
				?>
			</div>
			<button type="button" class="ep-plugin-form-result__close-button">
				<strong>
					&times;
				</strong>
			</button>
		</div>
	</div>
</div>

<div class="ep-plugin-form__delete-confirm-modal hidden">
	<div class="ep-plugin-form__delete-confirm-modal-content">
		<h3>Are you sure?</h3>
		<p>The notification bar will be removed completely.</p>
		<div class="ep-plugin-form__delete-confirm-actions">
			<button type="button" class="button" id="button--cancel-delete">Cancel</button>
			<button type="button" class="button ep-plugin-button--danger" id="button--confirm-delete">
				Delete notification bar
				<i class="hidden">
					<svg class="ep-plugin-spin" width="25" height="15" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M33 20.5C33 22.9723 32.2669 25.389 30.8934 27.4446C29.5199 29.5002 27.5676 31.1024 25.2835 32.0485C22.9995 32.9946 20.4861 33.2421 18.0614 32.7598C15.6366 32.2775 13.4093 31.087 11.6612 29.3388C9.91301 27.5907 8.7225 25.3634 8.24018 22.9386C7.75787 20.5139 8.00541 18.0005 8.95151 15.7165C9.8976 13.4324 11.4998 11.4801 13.5554 10.1066C15.611 8.73311 18.0277 8 20.5 8L20.5 13C19.0166 13 17.5666 13.4399 16.3332 14.264C15.0999 15.0881 14.1386 16.2594 13.5709 17.6299C13.0032 19.0003 12.8547 20.5083 13.1441 21.9632C13.4335 23.418 14.1478 24.7544 15.1967 25.8033C16.2456 26.8522 17.582 27.5665 19.0368 27.8559C20.4917 28.1453 21.9997 27.9968 23.3701 27.4291C24.7406 26.8614 25.9119 25.9001 26.736 24.6668C27.5601 23.4334 28 21.9834 28 20.5H33Z" fill="white">
						</path>
					</svg>
				</i>
			</button>
		</div>

		<button type="button" class="ep-plugin-form__delete-confirm-modal__close-button">
			<strong>
				&times;
			</strong>
		</button>
	</div>
</div>

<div class="ep-plugin-form__template-preview-modal hidden">
	<div class="ep-plugin-form__template-preview-modal-content">
		<h3>Template: <span id="template-preview-name"></span></h3>

		<div class="ep-plugin-form__template-preview-modal-body">
		</div>

		<div class="ep-plugin-form__template-preview-actions">
			<button type="button" class="button" id="button--cancel-template-preview">Cancel</button>
			<button type="button" class="button button-primary" id="button--confirm-template-preview">Use this template</button>
		</div>

		<button type="button" class="ep-plugin-form__template-preview-modal__close-button">
			<strong>
				&times;
			</strong>
		</button>
	</div>
</div>

<script>
var notificationBarId = <?php echo intval( $smart_notification_bar->id ); ?>;
var notificationBarNonce = '<?php echo wp_create_nonce( "notification-bar-nonce-string" ); ?>';
var notificationBarPublicFolder = '<?php echo plugin_dir_url( realpath( dirname( __FILE__ ) . "../" ) ); ?>smart-notification-bar/public/';
</script>