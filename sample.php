<?php
include __DIR__.'/onion.php';
$start = microtime(true);
$sample = array();
$sample['lang'] = 'en-US';
$sample['title'] = 'Page Title';

$sample['header']['site'] = 'Demo Site';
$sample['header']['link'] = 'http://example.com/';
$sample['header']['logo'] = 'http://placeimg.com/200/80/tech/grayscale';
$sample['header']['title'] = 'Demo Title';

$sample['foobar']['name'] = 'unit foobar';
$sample['foobar']['title'] = 'foobar title';
$sample['foobar']['link'] = 'foobar title';
$sample['foobar']['suffix'] = 'foobar suffix';
$sample['foobar']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['sample'][] = array('name'=>md5(mt_rand()),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['sample'][] = array('name'=>md5(mt_rand()),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['sample'][] = array('name'=>md5(mt_rand()),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['sample'][] = array('name'=>md5(mt_rand()),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['foobar']['sample'][] = array('name'=>md5(mt_rand()),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['another']['name'] = 'another unit';
$sample['another']['title'] = 'another title';
$sample['another']['link'] = 'another link';
$sample['another']['prefix'] = 'another prefix';
$sample['another']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['another']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['another']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['another']['test'][] = array('name'=>mt_rand(),'title'=>'','link'=>'','prefix'=>'','suffix'=>'');
$sample['footer']['copyright'] = 'copyright string';
$sample['footer']['system'] = 'load in '.number_format(microtime(true)-$start,5).'s';
echo html_render('sample',$sample);
?>
