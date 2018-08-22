<?php

return array(
	'thumbnail' => array(
		array( 300, 200, true ),
	),
	'medium'    => array(
		array(
			array( 640, 480 ),
			'picture' => '<source srcset="{src}" media="(min-width: 415px)">',
			'bg'      => '',
			'srcset'  => '{w}w',
			'sizes'   => '(min-width: 415px) {w}px',
		),
		'rwd-mobile' => 'inherit',
	),
	'large'     => array(
		array(
			array( 1100, 800 ),
			'picture' => '<source srcset="{src}" media="(min-width: 981px)">',
			'bg'      => '',
			'srcset'  => '{w}w',
			'sizes'   => '(min-width: 981px) {w}px',
		),
		'rwd-tablet' => 'inherit',
		'rwd-mobile' => 'inherit',
	),
	'hd'        => array(
		array(
			array( 1600, 1200 ),
			'picture' => '<source srcset="{src}" media="(min-width: 1281px)">',
			'bg'      => '',
			'srcset'  => '{w}w',
			'sizes'   => '(min-width: 1281px) {w}px',
		),
		'rwd-tablet' => 'inherit',
		'rwd-laptop' => 'inherit',
		'rwd-mobile' => 'inherit',
	),
	'uhd'       => array(
		'rwd-desktop' => 'inherit',
		'rwd-laptop'  => 'inherit',
		'rwd-tablet'  => 'inherit',
		'rwd-mobile'  => 'inherit',
	),
);
