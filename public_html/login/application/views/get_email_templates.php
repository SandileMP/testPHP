<div class="panel-body no-padding table-responsive">
    <form action="<?= $action ?>" method="post" id="template-list-form">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th><?= $entry_template_name ?></th>
                    <th><?= $entry_subject ?></th>
                    <th><?= $entry_interview_status ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if($templates) { ?>
                <?php foreach ($templates as $template) { ?>
                <tr>
                    <td>
                        <label class="fancy-checkbox">
                            <input type="radio" class="tempCheck" name="emailTemplate"  value="<?= $template['template_id'] ?>" />
                            <span></span>
                        </label>
                    </td>
                    <td><?= $template['template_name'] ?></td>
                    <td class="text-capitalize"><?= $template['subject'] ?></td>
                    <td class="text-capitalize"><?= $template['interview_status'] ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                    <td colspan="11" class="text-center"><?= $text_empty ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>
