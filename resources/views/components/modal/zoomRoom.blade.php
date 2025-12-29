<div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title"><?php echo $sessionName; ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                  <?php $isHasTopic = isset($topic)?>
                    @if ($isHasTopic)
                        <strong>Topic:</strong>&nbsp;<?php echo $topic; ?><br />
                    @endif
                    <strong>Meeting ID:</strong>&nbsp;<?php echo $meetingId; ?><br />
                    <strong>Password:</strong>&nbsp;<?php echo $meetingPassword; ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-warning"
                    onclick="openZoomLink('<?php echo $zoomLink; ?>')">เข้าร่วมห้องประชุมนี้</button>
            </div>
        </div>
    </div>
</div>
