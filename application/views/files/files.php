<div class="columns is-multiline">
    <div class="column is-full">
        <?php echo form_open_multipart('files/action', 'id="files-form"'); ?>
        <h3 class="title is-4">Upload Files</h3>
        <div class="field">
            <div class="control">
                <?php echo form_input('file_title', '', 'class="input is-small" maxlength="100" placeholder="Enter title" data-required'); ?>
            </div>
        </div>
        <div class="field">
            <div class="control is-expanded">
                <?php echo form_textarea('file_description', '', 'class="textarea is-small" placeholder="Enter description here" data-required rows="3"'); ?>
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control is-expanded">
                <div class="file has-name is-fullwidth">
                    <label class="file-label">
                        <input class="file-input" type="file" name="userfile" id="file-attachment">
                        <span class="file-cta">
                            <span class="file-icon"><i class="fas fa-upload"></i></span>
                            <span class="file-label">Choose a file…</span>
                        </span>
                        <span id="file-name" class="file-name"></span>
                    </label>
                </div>
            </div>
            <div class="control">
                <?php echo form_submit('action', 'Add File', 'class="button is-info is-fullwidth"'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
        <hr>
    </div>
    <div class="column is-half">
        <div class="panel">
            <div class="panel-heading has-background-info has-text-white">
                <h2><i class="fas fa-file-invoice"></i> Forms</h2>
            </div>
            <div class="panel-block">
                <?php $this->load->view('files/forms'); ?>
            </div>
        </div>
    </div>
    <div class="column is-half">
        <div class="panel">
            <div class="panel-heading has-background-danger has-text-white">
                <h2><i class="fas fa-book"></i> Documentation</h2>
            </div>
            <div class="panel-block">
                <?php $this->load->view('files/documentation'); ?>
            </div>
        </div>
    </div>
</div>