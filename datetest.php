<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI 日期選擇器（Datepicker） - 民國年格式</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  <script>
    // 设置中文本地化选项
    $.datepicker.regional['zh-TW'] = {
      closeText: '關閉',
      prevText: '&#x3C;上個月',
      nextText: '下個月&#x3E;',
      currentText: '今天',
      monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
      monthNamesShort: ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二'],
      dayNames: ['星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六'],
      dayNamesShort: ['日', '一', '二', '三', '四', '五', '六'],
      dayNamesMin: ['日', '一', '二', '三', '四', '五', '六'],
      weekHeader: '周',
      dateFormat: 'yy年 mm月dd日',
      altFormat: 'yy-mm-dd',
      firstDay: 1,
      isRTL: false,
      showMonthAfterYear: true,
      yearSuffix: '年'
     
      
    };
    $.datepicker.setDefaults($.datepicker.regional['zh-TW']);

    $(function() {
      $.datepicker.setDefaults({
        altField: "#altDate",
        changeYear: true,
        yearRange: "c-100:c+10"
      });

      $("#datepicker").datepicker({
        onSelect: function(dateText, inst) {
          var selectedDate = new Date(inst.selectedYear, inst.selectedMonth, inst.selectedDay);
          var republicEraYear = selectedDate.getFullYear() - 1911;
          var formattedRepublicDate = "民國" + republicEraYear + "年 " + $.datepicker.formatDate("mm月dd日", selectedDate);
          $("#datepicker").val(formattedRepublicDate);
          $("#altDate").val($.datepicker.formatDate("yy-mm-dd", selectedDate));
        },

      });
    });

    
  </script>
</head>
<body>
 
<p>日期：<input type="text" id="datepicker" size="30" autocomplete="off"></p>
<p>隱藏日期：<input type="text" id="altDate" size="30" disabled></p>
 
</body>
</html>