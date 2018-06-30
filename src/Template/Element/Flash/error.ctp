<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="success_msg alert text-center" style = "background-color: red; top: 100px">

   <?php echo $message; ?>
</div>
