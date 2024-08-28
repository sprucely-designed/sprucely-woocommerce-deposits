# Sprucely WooCommerce Deposits Customizations

**Contributors:** [Isaac Russell @ Sprucely Designed, LLC](https://www.sprucely.net)  
**Plugin URI:** [Sprucely WooCommerce Deposits Customizations](https://github.com/sprucely/sprucely-woocommerce-deposits-customizations)  
**Tags:** WooCommerce, Deposits, Customizations, Plugin  
**Requires at least:** 5.0  
**Tested up to:** 6.3  
**Stable tag:** 1.0.0  
**License:** GPL-2.0+  
**License URI:** https://www.gnu.org/licenses/gpl-2.0.html  

## Description

Sprucely WooCommerce Deposits Customizations is a plugin that extends the functionality of the WooCommerce Deposits plugin. It provides several customizations to enhance the management of deposit orders:

- **Disable Automatic Emails for Balance Payments:** Prevent automatic emails from being sent when a balance payment order is created.
- **Customize Future Payments Text:** Modify the default "(excludes tax)" text in order emails to include additional information about custom add-ons or adjustments.
- **Make Pending Deposit Orders Editable:** Allow orders with the `pending-deposit` status to be editable without needing to change the order status.
- **Update Order Item Names for Balance Payments:** Automatically updates the item names in balance payment orders to include the original order number for easier tracking.

## Installation

1. Download the plugin from [GitHub](https://github.com/sprucely/sprucely-woocommerce-deposits-customizations).
2. Upload the plugin files to the `/wp-content/plugins/sprucely-woocommerce-deposits-customizations` directory.
3. Activate the plugin through the 'Plugins' screen in WordPress.

## Requirements

- WooCommerce
- WooCommerce Sequential Order Numbers
- WooCommerce Deposits

## Usage

Once installed and activated, the plugin will automatically apply the following customizations:

- **Prevent Automatic Emails:** The plugin will stop WooCommerce from sending an email when a balance payment order is created. This gives you the flexibility to review and send the email manually.
  
- **Modify Future Payments Text:** The plugin will replace the "(excludes tax)" text in the future payments row of order emails with "(excludes tax and any custom add-ons or adjustments)."
  
- **Make Orders Editable:** Orders with the `pending-deposit` status will become editable, allowing you to modify order items without changing the status.
  
- **Custom Order Item Names:** The plugin will update order item names in balance payment orders to include the original order number, making it easier to track payments.

## Frequently Asked Questions

**Q: Does this plugin require any other plugins to work?**  
A: Yes, this plugin requires WooCommerce, WooCommerce Sequential Order Numbers, and WooCommerce Deposits.

**Q: Can I customize the text further?**  
A: Yes, you can modify the `sprucely_modify_future_payments_tax_text_translatable` function to change the text to whatever you need.

**Q: Will this plugin work with my current theme?**  
A: This plugin should work with any theme that is compatible with WooCommerce. If you encounter any issues, feel free to open an issue on the GitHub repository.

## Contributing

Contributions are welcome! Please visit the [GitHub repository](https://github.com/sprucely/sprucely-woocommerce-deposits-customizations) to submit issues or pull requests.

## Changelog

### 1.0.0
* Initial release.

## License

This plugin is licensed under the GPL-2.0+ License. See the [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html) file for more information.
