<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/www/wwwroot/chate.uincloud.cn/public/../application/service/view/log/data.html";i:1635326346;}*/ ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" href="/static/component/pear/css/pear.css" />
</head>
<body class="pear-container">
<div class="layui-card">
	<div class="layui-card-body">
		<form class="layui-form" action="">
			<div class="layui-form-item">
				<div class="layui-form-item layui-inline">
					<label class="layui-form-label">选择时间</label>
					<div class="layui-input-inline">
						<input type="text" name="time" placeholder="请选择时间" class="layui-input" autocomplete="off" id="date-time">
					</div>
				</div>
				<div class="layui-form-item layui-inline">
					<button class="pear-btn pear-btn-md pear-btn-primary" lay-submit lay-filter="query">
						<i class="layui-icon layui-icon-search"></i>
						查询
					</button>
					<button type="reset" class="pear-btn pear-btn-md">
						<i class="layui-icon layui-icon-refresh"></i>
						重置
					</button>
				</div>
			</div>
		</form>
	</div>
</div>
		<div class="layui-card">
			<div class="layui-card-body">
				<table id="dataTable" lay-filter="dataTable"></table>
			</div>
		</div>
		
        <script src="/static/component/layui/layui.js"></script>
        <script src="/static/component/pear/pear.js"></script>
        <script>
			layui.use(['table', 'form', 'jquery','common','laydate'], function() {
				let table = layui.table;
				let form = layui.form;
				let $ = layui.jquery;
				let common = layui.common;
				let laydate = layui.laydate;

				let MODULE_PATH = "/service/";

                let cols = [
                        [{
                                field: 'id',
                                title: '序号',
                                unresize: true,
                                align: 'center',
                                width: 80
                            },{
                                field: 'date',
                                title: '日期',
                                unresize: true,
                                align: 'center'
                            }, {
                                field: 'new_queue',
                                title: '新增客户',
                                unresize: true,
                                align: 'center',
                            },
                            {
                                field: 'reply_date',
                                title: '有效回复率',
                                align: 'center',
                                unresize: true,
                            }
                        ]
                    ];

				table.render({
					elem: '#dataTable',
					url: MODULE_PATH + 'log/data',
					page: false,
					cols: cols,
                    cellMinWidth: 100,
					skin: 'line',
					toolbar: '#toolbar',
					defaultToolbar: [{
						title: '刷新',
						layEvent: 'refresh',
						icon: 'layui-icon-refresh',
					}, 'filter', 'print', 'exports']
				});

				table.on('toolbar(dataTable)', function(obj) {
					if (obj.event === 'refresh') {
						window.refresh();
					}
				});

                form.on('submit(query)', function(data) {
                    table.reload('dataTable', {
                        where: data.field,
                        page:{curr: 1}
                    });
                    return false;
                });
                
				window.refresh = function(param) {
					table.reload('dataTable');
				};

                laydate.render({
                    range: '~', elem: '#date-time', done: function (value) {
                        $(this.elem).val(value).trigger('change');
                    }
                });
			})
		</script>
</body>
</html>
