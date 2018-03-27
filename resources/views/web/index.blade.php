<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <link rel="stylesheet" href="{{asset('css/map.css')}}">
    <style type="text/css">
        body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
        #allmap{width:100%;height:100%;}

        /*--楼盘文字--*/
        .lp-text{
            padding: 2px 10px;
            display: inline-block;
            background-color: #EE5D5B;
            border-radius: 2px;
            border: 1px solid #EE3C4A;
            min-width: 40px;
            -webkit-transition: all .01s ease-in-out;
            -moz-transition: all .01s ease-in-out;
            -o-transition: all .01s ease-in-out;
            transition: all .01s ease-in-out;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            box-shadow: 0 2px 2px rgba(0,0,0,0.2);
            opacity: 0.9;
            position: absolute;
            color: white;
            height: 18px;
            line-height: 18px;
            white-space: nowrap;
            font-size: 12px;
        }

        .biz-circle-text, .district-text{
            padding: 2px;
            display: inline-block;
            background-color: #4BB377;
            border-radius: 50%;
            border: 1px solid #038758;
            width: 90px;
            -webkit-transition: all .01s ease-in-out;
            -moz-transition: all .01s ease-in-out;
            -o-transition: all .01s ease-in-out;
            transition: all .01s ease-in-out;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            box-shadow: 0 2px 2px rgba(0,0,0,0.2);
            position: absolute;
            color: white;
            height: 90px;
            line-height: 50px;
            white-space: nowrap;
            font-size: 12px;
            opacity: 0.9;
        }

        .biz-circle-text:hover, .district-text:hover{
            background-color: #f8d016;
            border: 1px solid #f8d016;
            cursor: pointer;
            opacity:1;
            color: #513910
        }

        .lp-text .lp-arrow{
            border: 6px solid transparent;
            border-top-color: #EE3C4A;
            border-top-width: 8px;
            display: block;
            width: 0;
            height: 0;
            margin: 0 auto;
            -webkit-transition: all .05s ease-in-out;
            -moz-transition: all .05s ease-in-out;
            -o-transition: all .05s ease-in-out;
            transition: all .05s ease-in-out;
            margin-left: 15px;
            margin-top: 3px;
        }

        .lp-text:hover .lp-arrow{
            background-position: 0px -20px;
            border-top-color: #f8d016;
        }

        .lp-text:hover{
            background-color: #f8d016;
            border: 1px solid #f8d016;
            cursor: pointer;
            opacity:1;
            color: #513910
        }
        .biz-circle-text p, .district-text p{
            margin: 8px 0 0 0; padding: 0px;
            line-height: 15px;
            text-align: center;
        }
        p.dis_name{
            margin-top: 25px;
        }
        label.more-info{
            margin-left: 5px;
        }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=swbB7s48BYdma5N70szRtjUG0Y1Y341i"></script>

    <script type="text/javascript" src="{{asset('/js/map/MarkerManager.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/map/HouseMap.js')}}"></script>

    <title>Map测试</title>
</head>
<body>
<div class="header clear">

</div>

<div id="allmap"></div>

</body>
</html>
<script type="text/javascript">

    // 百度地图API功能 最小缩放，最大缩放，背景POI点击
    var map = new BMap.Map("allmap",{ maxZoom:20, enableMapClick:false});
    map.centerAndZoom(new BMap.Point(113.65000,34.76667), 12);
    map.enableScrollWheelZoom();
    map.disableAutoResize();
    map.addControl(new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_RIGHT}));

    // 搜索后的数据结果
    var searchRstData = JSON.parse('{!! $cityDataJson !!}');
    var dataLength = searchRstData.length;
    // 行政区域数据
    var districtData = JSON.parse('{!! $districtDataJson !!}');
    var disDataLength = districtData.length;
    // 商圈区域数据
    var bizCircleData = JSON.parse('{!! $bizCircleDataJson !!}');
    var bizCircleDataLength = bizCircleData.length;

    // marker管理器
    var mgr = new BMapLib.MarkerManager(map, {
        maxZoom: 18,
        trackMarkers: true
    });

    var houseMap = new BMapLib.HouseMap(map);
    var bizCircleMap = new BMapLib.BizCircleMap(map);


    var districtDataConfig = {minZoom: 8, maxZoom: 13, markerCount:disDataLength, diyType: 'district'};
    var bizCircleDataConfig = {minZoom: 14, maxZoom: 15, markerCount:bizCircleDataLength, diyType: 'bizCircle'};
    var searchDataConfig = {minZoom: 16, maxZoom: 20, markerCount:dataLength, diyType: 'house'};

    function init(){
        for(var circleIndex=0; circleIndex < bizCircleDataLength; circleIndex++){
            var newCirclePoint = new BMap.Point(bizCircleData[circleIndex].lng, bizCircleData[circleIndex].lat);
            var circleOverText = "<p class='dis_name'>" + bizCircleData[circleIndex].name + "</p>";
            circleOverText += "<p>" + parseInt(bizCircleData[circleIndex].count, 10) + "套</p>";
            var newCircleMarker = new ComplexCustomOverlay(newCirclePoint, circleOverText, circleOverText, bizCircleDataConfig, bizCircleData[circleIndex].position_border);
            bizCircleMap.addMarker(newCircleMarker)
        }
        bizCircleMap.showBizHouseMarkers();

        for (var i=0; i < dataLength; i++) {
            var txt = searchRstData[i].name;
            var moreText = parseInt(searchRstData[i].total, 10) + "套";
            var rstPoint = new BMap.Point(searchRstData[i].lng, searchRstData[i].lat);
            var myCompOverlay = new ComplexCustomOverlay(rstPoint, txt, moreText, searchDataConfig);
            houseMap.addMarker(myCompOverlay);
        }
        houseMap.showHouseMarkers();

        for(var dIndex=0; dIndex < disDataLength; dIndex++){
            var newPoint = new BMap.Point(districtData[dIndex].lng, districtData[dIndex].lat);
            var dName =  "<p class='dis_name' data-lat='" + districtData[dIndex].lat + "'   data-lng='"+ districtData[dIndex].lng +"'>" + districtData[dIndex].name + "</p>";
            dName += "<p>" + parseInt(districtData[dIndex].count, 10) + "套</p>";
            var newMarker = new ComplexCustomOverlay(newPoint, dName, dName, districtDataConfig, districtData[dIndex].position_border);
//            var newMarker = new BMap.Marker(newPoint);
//            console.log(newMarker);
            mgr.addMarker(newMarker, districtDataConfig.minZoom, districtDataConfig.maxZoom)
        }
        mgr.showMarkers();
    }

    function log(){
        var str = "当前zoom"+ map.getZoom() +
            "<div>地图上marker的数量" + mgr.getMarkerCount(map.getZoom())+ "</div>";
        document.getElementById("log").innerHTML = "<h3>调试信息显示：</h3>"+ str;
    }

    // ------------------- 普通自定义标注遮盖 start ----------------

    function ComplexCustomOverlay(point, text, overText, config, positionBorder){
        this._point = point;
        this._text = text;
        this._overText = overText;
        this._minZoom = config.minZoom;
        this._maxZoom = config.maxZoom;
        this._diyType = config.diyType;
        this._plyList = [];
        this._positionBorder = positionBorder;
    }

    ComplexCustomOverlay.prototype = new BMap.Overlay();
    ComplexCustomOverlay.prototype.initialize = function(map){
        this._map = map;

        console.log('diy type is ', this._diyType);

        var div = this._div = document.createElement("div");
        if(this._diyType == 'district'){
            div.classList.add('district-text');
        }
        if(this._diyType == 'bizCircle'){
            div.classList.add('biz-circle-text');
        }
        if(this._diyType == 'house'){
            var span = document.createElement("span");
            var moreInfo = document.createElement("label");
            moreInfo.classList.add('more-info');
            moreInfo.innerHTML = this._overText;
            div.classList.add('lp-text');
            span.classList.add('lp-name');
            span.appendChild(document.createTextNode(this._text));
            span.appendChild(moreInfo);
            div.appendChild(span);
        }else{
            div.innerHTML = div.innerHTML + this._text;
        }

        div.style.zIndex = BMap.Overlay.getZIndex(this._point.lat);

        var that = this;

        if(this._diyType == 'house') {
            var arrow = this._arrow = document.createElement("div");
            arrow.classList.add('lp-arrow');
            arrow.style.top = "22px";
            arrow.style.left = "10px";
            div.appendChild(arrow);
        }

        div.onmouseover = function(){
            this.style.zIndex *= -1;
            var pbPointList = that._positionBorder.split(';');
            for (var i = 0,len = pbPointList.length; i < len; i++) {
                var pbPoint = pbPointList[i].split(',');
//                console.log(pbPoint);
                pbPointList[i] = new BMap.Point(pbPoint[0], pbPoint[1])
            }
            var o = new BMap.Polygon(pbPointList, {
                strokeWeight: 2,
                strokeColor: "#f8d016",
                fillColor: "#038758",
                fillOpacity: .5
            });
            that._plyList.push(o);
            map.addOverlay(o);
        };

        div.onmouseout = function(){
            this.style.zIndex *= -1;
            var t = that._plyList.length;
            if (t) {
                for (var e = 0; e < t; e++) map.removeOverlay(that._plyList[e]);
                that._plyList = []
            }
        };

        div.onclick = function () {
            //console.log(that._point);
        };

        map.getPanes().labelPane.appendChild(div);

        return div;
    };
    ComplexCustomOverlay.prototype.draw = function(){
        var map = this._map;
        var pixel = map.pointToOverlayPixel(this._point);
        if(this._diyType == 'house'){
            this._div.style.left = (pixel.x - parseInt(this._arrow.style.left)) + "px";
        }else{
            this._div.style.left = (pixel.x - 90) + "px";
        }
        this._div.style.top = (pixel.y - 90) + "px";
    };
    // ------------------- 普通自定义标注遮盖 end ----------------


    // ----- 初始化 start ----
    init();
    // ----- 初始化 end ----
</script>
