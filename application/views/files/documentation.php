<?php
    if (empty($documentation)) {
        echo "<p>No documentation found.</p>";
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
            foreach ($documentation as $row) {
        ?>
        <tr>
            <td width="20%"><?php echo anchor('public/files/documentation/'.$row['file_id']."/".$row['file_name'], '<i class="fas fa-download"></i> ' . $this->format->shorten($row['file_title'], 25), 'target="_blank"'); ?></td>
            <td><?php echo $this->format->shorten($row['file_description']); ?></td>
            <td width="20%"><?php echo $this->format->shorten($row['file_name'], 8); ?> (<?php echo $row['file_size']; ?>KB)</td>
            <td width="10%"><?php echo anchor('files/delete_documentation/'.$row['file_id'], '<i class="fas fa-trash"></i>', 'class="has-text-danger"'); ?></td>
        </tr>
        <?php
            }
        ?>
    </tbody>
</table>
<?php
    }
?>

