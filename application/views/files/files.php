<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="files-upload"><a><i class="fas fa-upload"></i> Upload</a></li>
        <li class="tab" data-target="files-forms"><a><i class="fas fa-file-invoice"></i> Forms</a></li>
        <li class="tab" data-target="files-documentation"><a><i class="fas fa-book"></i> Documentation</a></li>
    </ul>
</div>

<div id="files-upload" class="tab-panel tab-panel-init">
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
</div>

<div id="files-forms" class="tab-panel">
    <?php $this->load->view('files/forms'); ?>
</div>

<div id="files-documentation" class="tab-panel">
    <?php $this->load->view('files/documentation'); ?>
</div>
