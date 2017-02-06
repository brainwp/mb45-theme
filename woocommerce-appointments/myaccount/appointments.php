<?php
/**
 * My Appointments
 *
 * Shows appointments on the account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/appointments.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @version     1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div class="appointment-class">
<?php if ( ! empty( $tables ) ) : ?>

	<?php foreach ( $tables as $table ) : ?>

		<h2><?php echo esc_html( $table['header'] ) ?></h2>

		<table class="shop_table my_account_appointments">
			<thead>
				<tr>
					<th scope="col" class="appointment-id"><?php _e( 'ID', 'woocommerce-appointments' ); ?></th>
					<th scope="col" class="order-number"><?php _e( 'Order', 'woocommerce-appointments' ); ?></th>
					<th scope="col" class="appointment-date"><?php _e( 'Date', 'woocommerce-appointments' ); ?></th>
					<th scope="col" class="appointment-time"><?php _e( 'Time', 'woocommerce-appointments' ); ?></th>
					<th scope="col" class="appointment-status"><?php _e( 'Status', 'woocommerce-appointments' ); ?></th>
					<th scope="col" class="appointment-cancel"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $table['appointments'] as $appointment ) : ?>
					<tr>
						<td class="appointment-id"><?php echo $appointment->get_id(); ?></td>
						<td class="order-number">
							<?php if ( $appointment->get_order() ) : ?>
							<a href="<?php echo $appointment->get_order()->get_view_order_url(); ?>">
								<?php echo $appointment->get_order()->get_order_number(); ?>
							</a>
							<?php endif; ?>
						</td>
						<td class="appointment-date"><?php echo $appointment->get_start_date( wc_date_format(), '' ); ?></td>
						<td class="appointment-time"><?php echo $appointment->get_start_date( '', wc_time_format() ) . ' &mdash; ' . $appointment->get_end_date( '', wc_time_format() ); ?></td>
						<td class="appointment-status"><?php echo $appointment->get_status( false ); ?></td>
						<td class="appointment-cancel">
							<?php if ( $appointment->get_status() != 'cancelled' && $appointment->get_status() != 'completed' && ! $appointment->passed_cancel_day() ) : ?>
							<a href="<?php echo $appointment->get_cancel_url(); ?>" class="button cancel"><?php _e( 'Cancel', 'woocommerce-appointments' ); ?></a>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

	<?php endforeach; ?>

<?php else : ?>
	<div class="woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
			<?php _e( 'Go Book', 'woocommerce-appointments' ) ?>
		</a>
		<?php _e( 'No appointments scheduled yet.', 'woocommerce-appointments' ); ?>
	</div>
<?php endif; ?>
</div>
