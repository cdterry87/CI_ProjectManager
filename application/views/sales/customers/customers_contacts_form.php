<?php echo form_open('sales/customers/action', 'id="contacts-form"'); ?>
<?php echo form_hidden('customer_id', $customer['customer_id']); ?>
<?php echo form_hidden('customer_contact_id', ''); ?>
<div class="modal-background" data-modal="contact-form" ></div>
<div class="modal-card">
    <div class="modal-card-head">
        <h2 class="title is-4">Contact Information</h2>
    </div>
    <div class="modal-card-body">
        <div class="ajax-messages"></div>
        <div class="content">
            <div class="field">
                <?php echo form_label('Contact Name:', 'contact_name', 'class="label"'); ?>
                <div class="control">
                    <?php echo form_input('contact_name', '', 'class="input is-small" maxlength="100" data-required'); ?>
                </div>
            </div>

            <div class="columns">
                <div class="column is-half">
                    <div class="field">
                        <?php echo form_label('Contact Title:', 'contact_title', 'class="label"'); ?>
                        <div class="control">
                            <?php echo form_input('contact_title', '', 'class="input is-small" maxlength="100" data-required'); ?>
                        </div>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="field">
                        <?php echo form_label('Contact Email:', 'contact_email', 'class="label"'); ?>
                        <div class="control">
                            <?php echo form_input('contact_email', '', 'class="input is-small" maxlength="250" data-required'); ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo form_label('Phone #1:', 'contact_phone_1', 'class="label"'); ?>
            <div class="field is-grouped">
                <div class="select is-small control">
                    <select name="contact_phone_type" id="contact_phone_type">
                        <option value="">Phone type</option>
                        <option value="Cell">Cell</option>
                        <option value="Home">Home</option>
                        <option value="Work">Work</option>
                    </select>    
                </div>
                <div class="control"><?php echo form_input('contact_phone_1', '', 'class="input is-small" maxlength="3" size="3" data-numeric data-autotab'); ?></div>
                <div class="control"><?php echo form_input('contact_phone_2', '', 'class="input is-small" maxlength="3" size="3" data-numeric data-autotab'); ?></div>
                <div class="control"><?php echo form_input('contact_phone_3', '', 'class="input is-small" maxlength="4" size="4" data-numeric'); ?></div>
            </div>

            <?php echo form_label('Phone #2:', 'contact_phone2_1', 'class="label"'); ?>
            <div class="field is-grouped">
                <div class="select is-small control">
                    <select name="contact_phone_alt_type" id="contact_phone_alt_type">
                        <option value="">Phone type</option>
                        <option value="Cell">Cell</option>
                        <option value="Home">Home</option>
                        <option value="Work">Work</option>
                    </select>    
                </div>
                <div class="control"><?php echo form_input('contact_phone_alt_1', '', 'class="input is-small" maxlength="3" size="3" data-numeric data-autotab'); ?></div>
                <div class="control"><?php echo form_input('contact_phone_alt_2', '', 'class="input is-small" maxlength="3" size="3" data-numeric data-autotab'); ?></div>
                <div class="control"><?php echo form_input('contact_phone_alt_3', '', 'class="input is-small" maxlength="4" size="4" data-numeric'); ?></div>
            </div>
        </div>
    </div>
    <div class="modal-card-foot">
        <button type="submit" value='save contact' class="button is-info ajax-btn">Save Contact</button>
    </div>
</div>
<?php echo form_close(); ?>
