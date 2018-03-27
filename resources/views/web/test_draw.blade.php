<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
        body, html{width: 100%;height: 100%;overflow: hidden;margin:0;}
        #allmap {margin-right: 300px;height: 100%;overflow: hidden;}
        #result {border-left:1px dotted #999;height:100%;width:295px;position:absolute;top:0px;right:0px;font-size:12px;}
        dl,dt,dd,ul,li{
            margin:0;
            padding:0;
            list-style:none;
        }
        p{font-size:12px;}
        dt{
            font-size:14px;
            font-family:"微软雅黑";
            font-weight:bold;
            border-bottom:1px dotted #000;
            padding:5px 0 5px 5px;
            margin:5px 0;
        }
        dd{
            padding:5px 0 0 5px;
        }
        li{
            line-height:28px;
        }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=swbB7s48BYdma5N70szRtjUG0Y1Y341i"></script>
    <!--加载鼠标绘制工具-->
    <script type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
    <link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
    <!--加载检索信息窗口-->
    <script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.js"></script>
    <link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.4/src/SearchInfoWindow_min.css" />

    <title>鼠标绘制工具</title>
</head>
<body>
<div id="allmap" style="overflow:hidden;zoom:1;position:relative;">
    <div id="map" style="height:100%;-webkit-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;"></div>
    <div id="showPanelBtn" style="position:absolute;font-size:14px;top:50%;margin-top:-95px;right:0px;width:20px;padding:10px 10px;color:#999;cursor:pointer;text-align:center;height:170px;background:rgba(255,255,255,0.9);-webkit-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;font-family:'微软雅黑';font-weight:bold;">显示检索结果面板<br/><</div>
    <div id="panelWrap" style="width:0px;position:absolute;top:0px;right:0px;height:100%;overflow:auto;-webkit-transition: all 0.5s ease-in-out;transition: all 0.5s ease-in-out;">
        <div style="width:20px;height:200px;margin:-100px 0 0 -10px;color:#999;position:absolute;opacity:0.5;top:50%;left:50%;" id="showOverlayInfo">此处用于展示覆盖物信息</div>
        <div id="panel" style="position:absolute;"></div>
    </div>
</div>

<div id="result">
    <dl>
        <dt>绘制工具功能</dt>
        <ul>
            <li><label><input type="radio" name="openClose1" onclick="drawingManager.open()"/>打开</label>  <label><input type="radio" name="openClose1" onclick="drawingManager.close()" checked="checked"/>关闭</label></li>
        </ul>
        </dd>
        <dt>是否进行线或面积的计算(单位米)</dt>
        <ul>
            <li><label><input type="radio" name="openClose" onclick="drawingManager.enableCalculate()"/>打开</label>  <label><input type="radio" name="openClose" onclick="drawingManager.disableCalculate()"  checked="checked"/>关闭</label></li>
        </ul>
        </dd>
        <dt>绘制功能</dt>
        <dd>
            <ul>
                <li>
                    <label><input type="radio" name="drawmode" onclick="drawingManager.setDrawingMode(BMAP_DRAWING_MARKER)" checked="checked"/>画点</label>
                    <input type="checkbox" id="isInfowindow"/> 是否带信息窗口
                </li>
                <li>
                    <label><input type="radio" name="drawmode" onclick="drawingManager.setDrawingMode(BMAP_DRAWING_CIRCLE)"/>画圆</label>
                </li>
                <li>
                    <label><input type="radio" name="drawmode" onclick="drawingManager.setDrawingMode(BMAP_DRAWING_POLYLINE)"/>画线</label>
                </li>
                <li>
                    <label><input type="radio" name="drawmode" onclick="drawingManager.setDrawingMode(BMAP_DRAWING_POLYGON)"/>画多边形</label>
                </li>
                <li>
                    <label><input type="radio" name="drawmode" onclick="drawingManager.setDrawingMode(BMAP_DRAWING_RECTANGLE)"/>画矩形</label>
                </li>
            </ul>
        </dd>
        <dt>覆盖物操作</dt>
        <dd>
            <ul>
                <li>
                    <input type="button" value="获取绘制的覆盖物个数" onclick="alert(overlays.length)"/>
                    <input type="button" value="清除所有覆盖物" onclick="clearAll()"/>
                    <input type="button" value="获取最后一个覆盖物信息" id="getLastOverLay"/>
                </li>
            </ul>
        </dd>
    </dl>

</div>

<script type="text/javascript">

    // 百度地图API功能
    var map = new BMap.Map('map');
    var poi = new BMap.Point(116.307852,40.057031);
    map.centerAndZoom(poi, 16);
    map.enableScrollWheelZoom();

    $("getLastOverLay").onclick = function(){
        if(overlays.length){
            alert(overlays[overlays.length - 1]);
        }else{
            alert("没有覆盖物");
        }
    }

    //信息窗口的内容定义
    var content = '<div style="margin:0;line-height:20px;padding:2px;">' +
        '地址：北京市海淀区上地十街10号<br/>电话：(010)59928888<br/>简介：百度大厦位于北京市海淀区西二旗地铁站附近，为百度公司综合研发及办公总部。' +
        '</div>';

    //创建带信息窗口的poi点
    var searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
        title  : "百度大厦",      //标题
        width  : 290,             //宽度
        height : 105,              //高度
        panel  : "panel",         //检索结果面板
        enableAutoPan : true,     //自动平移
        searchTypes   :[
            BMAPLIB_TAB_SEARCH,   //周边检索
            BMAPLIB_TAB_TO_HERE,  //到这里去
            BMAPLIB_TAB_FROM_HERE //从这里出发
        ]
    });

    var overlays = [];
    //回调获得覆盖物信息
    var overlaycomplete = function(e){
        overlays.push(e.overlay);
        var result = "";
        result = "<p>";
        result += e.drawingMode + ":";
        if (e.drawingMode == BMAP_DRAWING_MARKER) {
            result += ' 坐标：' + e.overlay.getPosition().lng + ',' + e.overlay.getPosition().lat;
            if ($('isInfowindow').checked) {
                searchInfoWindow.open(e.overlay);
            }
        }
        if (e.drawingMode == BMAP_DRAWING_CIRCLE) {
            result += ' 半径：' + e.overlay.getRadius();
            result += ' 中心点：' + e.overlay.getCenter().lng + "," + e.overlay.getCenter().lat;
        }
        if (e.drawingMode == BMAP_DRAWING_POLYLINE || e.drawingMode == BMAP_DRAWING_POLYGON || e.drawingMode == BMAP_DRAWING_RECTANGLE) {
            result += ' 所画的点个数：' + e.overlay.getPath().length;
        }
        result += "</p>";
        $("showOverlayInfo").style.display = "none";
        $("panel").innerHTML += result; //将绘制的覆盖物信息结果输出到结果面板
    };

    var styleOptions = {
        strokeColor:"red",    //边线颜色。
        fillColor:"red",      //填充颜色。当参数为空时，圆形将没有填充效果。
        strokeWeight: 3,       //边线的宽度，以像素为单位。
        strokeOpacity: 0.8,	   //边线透明度，取值范围0 - 1。
        fillOpacity: 0.6,      //填充的透明度，取值范围0 - 1。
        strokeStyle: 'solid' //边线的样式，solid或dashed。
    }
    //实例化鼠标绘制工具
    var drawingManager = new BMapLib.DrawingManager(map, {
        isOpen: false, //是否开启绘制模式
        enableDrawingTool: true, //是否显示工具栏
        drawingToolOptions: {
            anchor: BMAP_ANCHOR_TOP_RIGHT, //位置
            offset: new BMap.Size(5, 5), //偏离值
            scale: 0.8 //工具栏缩放比例
        },
        circleOptions: styleOptions, //圆的样式
        polylineOptions: styleOptions, //线的样式
        polygonOptions: styleOptions, //多边形的样式
        rectangleOptions: styleOptions //矩形的样式
    });


    //添加鼠标绘制工具监听事件，用于获取绘制结果
    drawingManager.addEventListener('overlaycomplete', overlaycomplete);


    function $(id){
        return document.getElementById(id);
    }

    function clearAll() {
        for(var i = 0; i < overlays.length; i++){
            map.removeOverlay(overlays[i]);
        }
        overlays.length = 0
    }

    var isPanelShow = false;
    //显示结果面板动作
    $("showPanelBtn").onclick = showPanel;
    function showPanel(){
        if (isPanelShow == false) {
            isPanelShow = true;
            $("showPanelBtn").style.right = "230px";
            $("panelWrap").style.width = "230px";
            $("map").style.marginRight = "230px";
            $("showPanelBtn").innerHTML = "隐藏绘制结果信息<br/>>";
        } else {
            isPanelShow = false;
            $("showPanelBtn").style.right = "0px";
            $("panelWrap").style.width = "0px";
            $("map").style.marginRight = "0px";
            $("showPanelBtn").innerHTML = "显示绘制结果信息<br/><";
        }
    }

</script>

</body>
</html>

