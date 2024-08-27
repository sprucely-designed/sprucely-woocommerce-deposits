<?php
/**
 * Plugin Name: Sprucely WooCommerce Deposits Customizations
 * Plugin URI:  https://github.com/sprucely/sprucely-woocommerce-deposits-customizations
 * Description: Customizations for WooCommerce Deposits to prevent automatic emails, modify future payments text, make pending deposit orders editable, and modify the line items of balance payments.
 * Version:     1.0.0
 * Author:      Isaac Russell @ Sprucely Designed, LLC
 * Author URI:  https://www.sprucely.net
 * License:     GPL-2.0+
 *
 * Requires Plugins: woocommerce-sequential-order-numbers/woocommerce-sequential-order-numbers.php, woocommerce-deposits/woocommerce-deposits.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add custom order item name for scheduled orders.
add_action( 'woocommerce_deposits_create_order', 'custom_update_deposit_order_item_name', 10, 1 );

/**
 * Update order item name for deposit orders.
 *
 * @param int $new_order_id The new order ID.
 */
function custom_update_deposit_order_item_name( $new_order_id ) {
	$new_order = wc_get_order( $new_order_id );

	if ( 'wc_deposits' === $new_order->get_created_via() ) {
		// Get the parent order ID.
		$original_order_id = $new_order->get_parent_id();
		if ( ! empty( $original_order_id ) ) {
			// Get the original order.
			$original_order = wc_get_order( $original_order_id );

			// Get the sequential order number.
			$sequential_order_number = $original_order->get_meta( '_order_number' );

			// Loop through each item in the new order.
			foreach ( $new_order->get_items() as $item_id => $item ) {
				// Update the item name.
				$new_item_name = sprintf(
					'Balance for Order #%1$s - %2$s',
					$sequential_order_number,
					$item->get_name()
				);

				// Set the new item name.
				wc_update_order_item( $item_id, array( 'order_item_name' => $new_item_name ) );
			}
		}
	}
}

add_filter( 'woocommerce_deposits_should_send_invoice_remaining_balance_email', 'sprucely_disable_invoice_remaining_balance_email', 10, 2 );
/**
 * Disable the invoice remaining balance email for balance payment orders.
 *
 * @param bool $send_email Whether to send the email.
 * @param int  $new_order_id The new order ID.
 *
 * @return bool $send_email Whether to send the email.
 */
function sprucely_disable_invoice_remaining_balance_email( $send_email, $new_order_id ) {
	return false; // Prevent the email from being sent
}

add_filter( 'gettext', 'sprucely_modify_future_payments_tax_text_translatable', 10, 3 );
/**
 * Modify the translatable text for future payments tax message.
 *
 * @param string $translated_text Translated text.
 * @param string $text Text to translate.
 * @param string $domain Text domain.
 *
 * @return string $translated_text Translated text to be included in the plugin.
 */
function sprucely_modify_future_payments_tax_text_translatable( $translated_text, $text, $domain ) {
	// Check if the text matches the one you want to change
	if ( $domain === 'woocommerce-deposits' && $text === '(excludes tax)' ) {
		// Replace the text
		$translated_text = '(excludes tax and any custom add-ons or adjustments)';
	}

	return $translated_text;
}

add_filter( 'wc_order_is_editable', 'sprucely_make_pending_deposit_editable', 10, 2 );
/**
 * Make pending deposit orders editable.
 *
 * @param bool $is_editable Whether the order is editable.
 * @param WC_Order $order The order object.
 *
 * @return bool $is_editable Whether the order is editable.
 */
function sprucely_make_pending_deposit_editable( $is_editable, $order ) {
	if ( $order->has_status( 'pending-deposit' ) ) {
		$is_editable = true;
	}
	return $is_editable;
}