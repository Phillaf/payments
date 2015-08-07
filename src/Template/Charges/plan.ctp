<?='<script type="text/javascript" src="https://js.stripe.com/v2/"></script>';?>
<?='<script type="text/javascript">Stripe.setPublishableKey("' . "pk_test_20f8DMWAvMzNbryrjQlWp7GE" . '");</script>';?>


<?= $this->Form->create($charge, ['id' => 'payment-form'])?> 
    <legend><?= __('Buy This Thing') ?></legend>
    <?php // Show PHP errors, if they exist:
    if (isset($errors) && !empty($errors) && is_array($errors)) {
        echo '<div class="alert alert-error"><h4>Error!</h4>The following error(s) occurred:<ul>';
        foreach ($errors as $e) {
            echo "<li>$e</li>";
        }
        echo '</ul></div>';
    }?>

    <div id="payment-errors"></div>
    <span class="help-block">
        <?= __('You can pay using: Mastercard, Visa, American Express, JCB, Discover, and Diners Club.')?>
    </span>

    <?php
        echo $this->Form->input('card-number', ['type' => 'text', 'label' => 'Card Number', 'value' => '4242424242424242']);
        echo $this->Form->input('expiry-month', ['type' => 'text', 'label' => 'Expiration Month', 'value' => '12']);
        echo $this->Form->input('expiry-year', ['type' => 'text', 'label' => 'Expiration Year', 'value' => '18']);
        echo $this->Form->input('card-cvc', ['type' => 'text', 'label' => 'CVC', 'value' => '123' ]);
    ?>  
    <?= $this->Form->button(__('Submit'), ['id' => 'submitBtn']) ?>
<?= $this->Form->end() ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="/gintonic_c_m_s/js/charge.js"></script>