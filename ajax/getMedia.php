<?php
require_once "../classes/db.class.php";

$limit = intval($_POST['show']) ?? 5;
if (isset($_POST['show']) && $_POST['show'] == 0)
    $data = db::FetchData('media');
else
    $data = db::FetchWithLimit('media', 0, $limit);
?>
<div class="row">
    <?php if (!empty($data)) {
        foreach ($data as $row) { ?>
            <div class="col-sm-4">
                <div style="display: block; position: relative; cursor: pointer; height: 166px;margin-bottom: 10px">
                    <span class="fa fa-check fa-fw icon md-check up_img hidden"></span>
                    <img class="img-thumbnail" style="width: 100%;object-fit: cover;height:100%" width="100%"
                         height="100%"
                         data-id="<?= $row["id"] ?>"
                         src="files/media/<?= $row["image"] ?>"
                         data-media="<?= $row["image"] ?>">
                </div>
            </div>
        <?php }
    } ?>
</div>
