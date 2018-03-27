
<script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/MarkerClusterer/1.2/src/MarkerClusterer_min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
<link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
{{--http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js--}}
{{--http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css--}}
{{--http://api.map.baidu.com/library/GeoUtils/1.2/src/GeoUtils_min.js--}}
{{--http://api.map.baidu.com/library/InfoBox/1.2/src/InfoBox_min.js--}}

<script>
    // 获取可视区域
    //    function getBounds(){
    //        var bs = map.getBounds();   //获取可视区域
    //        var bssw = bs.getSouthWest();   //可视区域左下角
    //        var bsne = bs.getNorthEast();   //可视区域右上角
    //        console.log("当前地图可视范围是：" + bssw.lng + "," + bssw.lat + " 到 " + bsne.lng + "," + bsne.lat);
    //        return {bs:bs, bssw: bssw, bsne: bsne};
    //    }
    //    getBounds();



    function getBoundary() {
//        var bdary = new BMap.Boundary();
//        var rst = bdary.get('郑州市金水区', function (rs) {
//            console.log('rs', rs);
//            map.clearOverlays();        //清除地图覆盖物
//            var count = rs.boundaries.length; //行政区域的点有多少个
//            if (count === 0) {
//                alert('未能获取当前输入行政区域');
//                return ;
//            }
//            var pointArray = [];
//            for (var i = 0; i < count; i++) {
//                var ply = new BMap.Polygon(rs.boundaries[i], {strokeWeight: 2, strokeColor: "#ff0000"}); //建立多边形覆盖物
//                map.addOverlay(ply);  //添加覆盖物
//                pointArray = pointArray.concat(ply.getPath());
//            }
//            map.setViewport(pointArray);    //调整视野
//        });
//        console.log('bdary rst : ', rst);
    }

    //    console.log('可视区域', getBounds());
    //    console.log('bdary', getBoundary());

    var styleOptions = {
        strokeColor:"red",    //边线颜色。
        fillColor:"red",      //填充颜色。当参数为空时，圆形将没有填充效果。
        strokeWeight: 3,       //边线的宽度，以像素为单位。
        strokeOpacity: 0.8,    //边线透明度，取值范围0 - 1。
        fillOpacity: 0.6,      //填充的透明度，取值范围0 - 1。
        strokeStyle: 'solid' //边线的样式，solid或dashed。
    };
    //实例化鼠标绘制工具
    var drawingManager = new BMapLib.DrawingManager(map, {
        isOpen: false, //是否开启绘制模式
        enableDrawingTool: true, //是否显示工具栏
        drawingToolOptions: {
            anchor: BMAP_ANCHOR_TOP_RIGHT, //位置
            offset: new BMap.Size(5, 5), //偏离值
        },
        circleOptions: styleOptions, //圆的样式
        polylineOptions: styleOptions, //线的样式
        polygonOptions: styleOptions, //多边形的样式
        rectangleOptions: styleOptions //矩形的样式
    });



    function juhe() {
        var defImg = "https://s1.ljcdn.com/xinfang/pc/asset/xinfang/map/img/city-circle.png";
        var defAreaImg = "https://s1.ljcdn.com/xinfang/pc/asset/xinfang/map/img/district-circle.png";
        var actAreaImg = "https://s1.ljcdn.com/xinfang/pc/asset/xinfang/map/img/district-circle-hover.png";

        var myIcon = new BMap.Icon(defImg, new BMap.Size(92,92));
        var MAX = cityData.length;
        var markers = [];
        var points = [];
        var pt = null;
        var i = 0;
//    console.log(cityDatas);
        for (; i < MAX; i++) {
            pt = new BMap.Point(cityData[i].lng, cityData[i].lat);
            points.push(pt);
            var marker = new BMap.Marker(pt, {icon:myIcon});
//            marker.setLabel(new BMap.Label(cityData[i].name,{offset:new BMap.Size(10,10)}));
            marker.setTitle(cityData[i].name);
            markers.push(marker);
        }
        //最简单的用法，生成一个marker数组，然后调用markerClusterer类即可。
//        var markerClusterer = new BMapLib.MarkerClusterer(map, {markers:markers});
        var options = {
            size: BMAP_POINT_SIZE_HUGE,
            shape: BMAP_POINT_SHAPE_CIRCLE,
            color: '#d340c3'
        };
        var pointCollection = new BMap.PointCollection(points, options);
        map.addOverlay(pointCollection);
    }



    //    juhe();
</script>