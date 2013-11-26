<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Administrator
 * Date: 11/25/13
 * Time: 12:50 PM
 * To change this template use File | Settings | File Templates.
 */

class SwitchDiv
{
	public static function BindOnChange($controlID,$data)
	{
		$html='';
		foreach($data as $div)
		{
			$html.="<div style='display:none' id='".$controlID."_ish_".$div[0]."' class='".$controlID."_ish'>".$div[1]."</div>\r\n";
		}

		$html.="<script type='text/javascript'>\r\n";
		$html.="$('#".$controlID."').change(function(){\r\n";
		$html.="$('.".$controlID."_ish').hide();\r\n";
		$html.="$('#".$controlID."_ish_'+ this.value).show();\r\n";
		$html.="});\r\n";
		$html.="$('#".$controlID."').change();\r\n";
		$html.="</script>\r\n";



		return $html;
	}
}
