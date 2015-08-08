    <?php

    use Phinx\Migration\AbstractMigration;

    class StripeMigration extends AbstractMigration
    {
        /**
            * Change Method.
            *
            * Write your reversible migrations using this method.
            *
            * More information on writing migrations is available here:
            * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
        */
        public function change()
        {
            //
            // Plans
            //
            $table = $this->table('plans');
            $table
            ->addColumn('stripe_plan_id', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('name', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('amount', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('currency', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('interval', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('interval_count', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('trial_period_days', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();
            
            //
            // Customers
            //
            $table = $this->table('customers');
            $table
            ->addColumn('stripe_customer_id', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('user_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('currency', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('deliquent', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();
            
            //
            // Subscriptions
            //
            $table = $this->table('subscriptions');
            $table
            ->addColumn('stripe_subscription_id', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('plan_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('customer_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('status', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('cancel_at_period_end', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('application_fee_percent', 'decimal', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('start', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('current_period_start', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('current_period_end', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('tax_percent', 'decimal', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('ended_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('canceled_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('trial_start', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('trial_end', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();
            
            //
            // Charges
            //
            $table = $this->table('charges');
            $table
            ->addColumn('stripe_charge_id', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('customer_id', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('amount', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('currency', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('status', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('paid', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('receipt_email', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('receipt_number', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
             ->addColumn('refunded', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('failure_message', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();

            
            //
            // Events
            //
            $table = $this->table('events');
            $table
            ->addColumn('stripe_event_id', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('data', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('pending_webhooks', 'integer', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('type', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('api_version', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
             ->addColumn('request', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->create();
            
            //
            // Account
            //
            $table = $this->table('account');
            $table
            ->addColumn('stripe_account_id', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('display_name', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('business_name', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('business_url', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('email', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('support_email', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('statement_descriptor', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('timezone', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('charges_enabled', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('country', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('currencies_supported', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('default_currency', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('details_submitted', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
             ->addColumn('transfers_enabled', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('managed', 'boolean', [
                'default' => false,
                'limit' => null,
                'null' => false,
            ])
            ->create();
        }
    }
