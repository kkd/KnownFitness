<?=$this->draw('entity/edit/header');?>

<form action="<?=$vars['object']->getURL()?>" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-8 col-md-offset-2 edit-pane">
            <h4>
                <?php
                    if (empty($vars['object']->_id)) {
                        echo 'New Fitness Activity';
                    } else {
                        echo 'Edit Fitness Activity';
                    }
                ?>
            </h4>
            <p>
            <?php
                if (empty($vars['object']->_id)) {
                ?>
                    <label>
                        <span class="btn btn-primary btn-file">
                            <i class="fa fa-upload"></i>
                            <span id="track-filename">Upload GPX or TCX Track</span>
                            <input type="file" name="track" id="track" class="span9" 
                                onchange="$('#track-filename').html($(this).val())"
                            />
                        </span>
                    </label>
                <?php
                }
                ?>
            </p>

            <div class="content-form">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Give it a title" value="<?=htmlspecialchars($vars['object']->title)?>" class="form-control col-md-8" />
            </div>

            <div class="content-form">
                <label for="type">Activity</label>
                <select name="type">
                    <option value="Uncategorized">Uncategorized</option>
                    <option value="Running">Running</option>
                    <option value="Cycling">Cycling</option>
                    <option value="Fitness Equipment">Fitness Equipment</option>
                    <option value="Hiking">Hiking</option>
                    <option value="Swimming">Swimming</option>
                    <option value="Walking">Walking</option>
                    <option value="Transition">Transition</option>
                    <option value="Motorcycling">Motorcycling</option>
                    <option value="Diving">Diving</option>
                    <option value="Yoga">Yoga</option>
                </select>
            </div>

            <div class="content-form">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" placeholder="Add notes" class="form-control col-md-8 bodyInput"><?=htmlspecialchars($vars['object']->notes)?></textarea>
            </div>

            <?php
            if (empty($vars['object']->_id)) {
                ?>
                <button type="button" class="btn btn-inverse advanced">Advanced</button>
                <?php
            }
            ?>

            <?=$this->draw('entity/tags/input');?>

            <?php echo $this->drawSyndication('fitness', $vars['object']->getPosseLinks()); ?>
            <?php if (empty($vars['object']->_id)) { ?><input type="hidden" name="forward-to" value="<?= \Idno\Core\Idno::site()->config()->getDisplayURL() . 'content/all/'; ?>" /><?php } ?>

            <p class="button-bar">
                <?= \Idno\Core\Idno::site()->actions()->signForm('/fitness/edit') ?>
                <input type="button" class="btn btn-cancel" value="Cancel" onclick="hideContentCreateForm();" />
                <input type="submit" class="btn btn-primary" value="Publish" />

                <?= $this->draw('content/access'); ?>
            </p>
        </div>
    </div>
</form>
