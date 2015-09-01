<?php
function html_string($pre){
	$r = '';
	$s = explode('-',$pre);
	if(!empty($s)){
		foreach($s as $t){
			if(!empty($t)){
				$r.= '[\''.$t.'\']';
			}
		}
	}
	if(!empty($r)){
		$r = '$raw'.$r;
	}
	return $r;
}
function html_listing($str,$pre){
	$r = $s = array();
	$s = html_element($str,'tmp');
	$r['html'] = '\'.html_'.md5($pre).'($raw,\''.$pre.'\')'.'.\'';
	$r['func'] = 'function html_'.md5($pre).'($raw,$pre){
	$r = \'\';
	if(!empty($pre)){
		foreach('.html_string($pre).' as $tmp){
			$r.= \''.str_replace('$raw[\'tmp\']','$tmp',$s['html']).'\';
		}
	}
	return $r;
}'.PHP_EOL;
	return $r;
}
function html_element($str,$pre){
	$r = array();
	$r['html'] = $str;
	$r['func'] = '';
	if(preg_match('/'.preg_quote('<!--','/').'(unit|list|this)\.([a-z]+)'.preg_quote('-->','/').'/i',$str)){
		preg_match_all('/'.preg_quote('<!--unit.','/').'([a-z]+)'.preg_quote('-->','/').'(.*?)'.preg_quote('<!--unit.','/').'\1'.preg_quote('-->','/').'/is',$r['html'],$tmp);
		if(!empty($tmp[0])){
			foreach(array_keys($tmp[0]) as $key){
				$s = array();
				$s = html_element($tmp[2][$key],$pre.'-'.$tmp[1][$key]);
				$r['html'] = str_replace($tmp[0][$key],$s['html'],$r['html']);
				$r['func'] = $r['func'].$s['func'];
			}
		}
		preg_match_all('/'.preg_quote('<!--','/').'list\.([a-z]+)'.preg_quote('-->','/').'(.*?)'.preg_quote('<!--','/').'list\.\1'.preg_quote('-->','/').'/is',$r['html'],$tmp);
		if(!empty($tmp[0])){
			foreach(array_keys($tmp[0]) as $key){
				$s = array();
				$s = html_listing($tmp[2][$key],$pre.'-'.$tmp[1][$key]);
				$r['html'] = str_replace($tmp[0][$key],$s['html'],$r['html']);
				$r['func'] = $r['func'].$s['func'];
			}
		}
		preg_match_all('/'.preg_quote('<!--','/').'this\.([a-z]+)'.preg_quote('-->','/').'/is',$r['html'],$tmp);
		if(!empty($tmp[0])){
			foreach(array_keys($tmp[0]) as $key){
				$s = '';
				$s = html_string($pre.'-'.$tmp[1][$key]);
				$r['html'] = str_replace($tmp[0][$key],'\'.'.$s.'.\'',$r['html']);
			}
		}
	}
	return $r;
}
function html_build($raw){
	$r = false;
	$tpl = '';
	if(is_file($raw['raw'])){
		$tpl = file_get_contents($raw['raw']);
	}
	if(!empty($tpl)){
		$out = array();
		$out = html_element($tpl,'');
		if(!empty($out['html'])){
				$out['sync'] = '<?php
'.$out['func'].'
function html_handler($raw){
	$r = \'\';
	$r = \''.$out['html'].'\';
	return $r;
}
?>'.PHP_EOL;
		}
		if(!empty($out['sync']) && file_put_contents($raw['out'],$out['sync'])){
			$r = true;
		}
	}
	return $r;
}
function html_render($str,$raw){
	global $conf;
	$r = '';
	$tpl = array();
	$tpl['raw'] = __DIR__.'/'.$str.'.html';
	$tpl['out'] = __DIR__.'/tmp/'.md5($tpl['raw']);
	if(!is_file($tpl['out'])){
		html_build($tpl);
	}
	include($tpl['out']);
	$r = html_handler($raw);
	return $r;
}
?>
