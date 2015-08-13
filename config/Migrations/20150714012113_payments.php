    <?php

    use Phinx\Migration\AbstractMigration;

    class Payments extends AbstractMigration
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
            ->addColumn('interval_time', 'text', [
                'default' => null,
                'limit' => null,
                'null' => false,
            ])
            ->addColumn('interval_count', 'integer', [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
            
            //
            // Customers
            //
            $table = $this->table('customers');
            $table
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
                'null' => true,
            ])
            ->create();
            
            //
            // Subscriptions
            //
            $table = $this->table('subscriptions');
            $table
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
            ->addColumn('start', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('current_period_start', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('current_period_end', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('ended_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->addColumn('canceled_at', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();
            
            //
            // Charges
            //
            $table = $this->table('charges');
            $table
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
            ->addColumn('created', 'datetime', [
                'default' => null,
                'limit' => null,
                'null' => true,
            ])
            ->create();

            //
            // Account
            //
            $table = $this->table('account');
            $table
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
            ->addColumn('statement_descriptor', 'text', [
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
            ->create();
        }
    }
