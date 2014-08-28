<?php
foreach ($results as $result) {
    unset($result['Treasure']['id']);
}
echo json_encode(compact('results', 'results2'));

?>