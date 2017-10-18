<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<script>showFlashMsg('<?= h($message) ?>')</script>
