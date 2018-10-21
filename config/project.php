<?php

/**
 * 项目相关属性定义
 */

return [
	/*
	 * 项目状态定义列表
	 */
	'status' => [
		'analysis' => '竞品分析',
		'requirements' => '需求分析',
		'design' => '原型UI设计',
		'develop' => '开发中',
		'operation' => '运营中',
		'closed' => '关闭'
	],
	/*
	 * 项目Issue状态定义列表
	 */
	'issue' => [
		'status' => [
			'opening' => '开启',
			'closed' => '关闭'
		],
		'delete'
	],
	/*
	 * 项目需求状态定义列表
	 */
	'requirement' => [
		'status' => [
			'unconfirmed' => '待确认',
			'rejected' => '已驳回',
			'developing' => '开发中',
			'delivered' => '已交付',
		]
	]
];
