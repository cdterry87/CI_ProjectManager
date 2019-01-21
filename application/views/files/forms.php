<h2 class="title is-4">Forms</h2>
<?php
    if (empty($forms)) {
        echo "<p>No forms found.</p>";
    } else {
?>
<table class="table is-striped is-narrow is-hoverable is-fullwidth datatable">
    <thead>
        <tr>
            <th>Title</th> 
            <th>Description</th> 
            <th>File</th> 
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
            foreach ($forms as $row) {
        ?>
        <tr>
            <td width="20%"><?php echo anchor('public/files/forms/'.$row['file_id']."/".$row['file_name'], '<i class="fas fa-download"></i> ' . $this->format->shorten($row['file_title'], 25), 'target="_blank"'); ?></td>
            <td><?php echo $this->format->shorten($row['file_description']); ?></td>
            <td width="20%"><?php echo $this->format->shorten($row['file_name'], 8); ?> (<?php echo $row['file_size']; ?>KB)</td>
            <td width="10%"><?php echo anchor('files/delete_form/'.$row['file_id'], '<i class="fas fa-trash"></i>', 'class="has-text-danger"'); ?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<?php
    }
?>

