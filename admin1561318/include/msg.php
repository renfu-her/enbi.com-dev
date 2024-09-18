<?php
    if($ary_get['msg'] == 'succ_edit'){
        echo '<h4 class="alert_success">成功更新</h4>';
    }else if($ary_get['msg'] == 'succ_add'){
        echo '<h4 class="alert_success">成功新增</h4>';
    }else if($ary_get['msg'] == 'succ_del'){
        echo '<h4 class="alert_success">成功刪除</h4>';
    }

/*
    <h4 class="alert_info">Welcome to the free MediaLoot admin panel template, this could be an informative message.</h4>
    <h4 class="alert_warning">A Warning Alert</h4>
    <h4 class="alert_error">An Error Message</h4>
*/

?>

