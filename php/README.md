### 登录页面
- URL：http://10.114.102.16

### 访问主表格
- URL：http://10.114.102.16/index.php/cover_report/report/report_summary
- 对应数据库表：report_summary
- 执行文件顺序
  1. /home/vincent.wang2/CI3/application/controllers/Cover_report.php：**Cover_report**.php的**report**函数并传参**report_summary**
  2. /home/vincent.wang2/CI3/application/views/pages/report_summary.php
- 功能
  1. 排序功能
  2. 点击cover_name下对应的子表名称即可进入子表
  3. 每行的百分比后面有隐藏按钮，鼠标放到对应位置显示。点击即可更新对应的最新数据库信息得到new_percent，并把上次的percent保存到pre_percent

### 访问子表格
- URL：http://10.114.102.16/index.php/cover_report/report/inst_hit
- 对应数据库表：除report_summary的任何表格
- 执行文件顺序
  1. /home/vincent.wang2/CI3/application/controllers/Cover_report.php：**Cover_report**.php的**report**函数并传参**inst_hit**
  2. /home/vincent.wang2/CI3/application/views/pages/report_sub.php
-  功能
   1. 排序功能
   2. 数值后有隐藏按钮exclude，鼠标放到对应位置显示，鼠标悬停即可显示对应坐标行列，点击即可对应坐标exclude，
   3. 默认多页显示，一页分30条数据显示（修改/home/vincent.wang2/CI3/application/views/pages/report_sub.php的变量subTablePageSize即可修改分页大小）。点击paging_display按钮，可切换页面单页多页显示
   4. 默认显示，隐藏exclude对应坐标的行和列；如果要显示exclude的行和列，网页后缀再加"/0"或者点击/0:exclude_show按钮
   5. 批量exclude功能，输入起始到结束点的坐标，并点击more_exclude按钮，即可使之全为exclude
   6. 批量取消exclude功能，输入起始到结束点的坐标，并点击remove_exclude按钮，即可使之全取消exclude
   7. 表头cover_name,cover_percent,all_bins,zero_bins,zero_bins_after_exclude,all_hit_count,exclude_bins信息自动计算
   8. 表尾error_exclude_coordinates信息自动计算



