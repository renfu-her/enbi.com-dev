<?php 
/**
 * 這是訊息資料類別庫，用途是作為所有alert的訊息產生之用。
 * 我們可以藉用添加msgLib方法的case內容來不應用不同的回報訊息。
 * message library
 */

class MsgProcess {
	
	public $msg;
	public $type;
	
	function __construct($msg , $type = 'alert') {
		$this->msgLib($msg);
		
		if(empty($msg))		//若無傳入任何訊息則無作至何回應。
			return true;
			
		switch($type) {
			case 'alert':
				$this->alert();
				break;
			default:
				$this->alert();
				break;			
		}
	}
	
	function alert() {
		echo<<<DOC
		
	<script type="text/javascript">
	$(function() {
		$('#dialog').dialog({
			resizable: false,
			show: 'blind',
			modal: true,
			hide: 'explode',
			buttons: {
				關閉: function() {
					$(this).dialog('close');
				}
			}
		});
	});
		
	</script>
<div id="dialog" title="系統訊息">
<table align="center">
<tr>
<td>
	<p>{$this->msg}</p>
</td>
</tr>
</table>
</div>

DOC;
	}


	 // 訊息方法回報庫
	 // @param $shortMsg
	 // @return unknown_type

	function msgLib($shortMsg) {
		switch($shortMsg) {
            
				
				
            case 'succ_edit':
                $this->msg = '修改成功';
                break;
            case 'fail_edit':
                $this->msg = '修改失敗';
                break;
				
            case 'succ_add':
                $this->msg = '新增成功';
                break;
            case 'fail_add':
                $this->msg = '新增失敗';
                break;
				
            case 'succ_del':
                $this->msg = '刪除成功';
                break;
				
				
			default:
			$this->msg = $shortMsg;
			break;
		}
	}
}

?>