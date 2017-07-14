<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_THEME' =>  'default',
     'TMPL_DETECT_THEME'=> true,
	'URL_ROUTER_ON' => true,
	'URL_ROUTE_RULES'=>array(
		'p_show' =>'Product/productlist',
		'p_list/:Cid' =>'Product/productlist',
		'p_info/:Pid' => 'Product/detail',
		'n_show' => 'News/newslist',
		'n_list/:Cid' =>'News/newslist',
		'n_info/:Nid' => 'News/detail',
		'minfo/:Mid' => 'Menu/index',
		'n_index/:Aid' => 'Index/index',

		// 'contact' => 'Index/contact',
		// 'introduction/:Mid' =>' Index/introduction',
	),
);