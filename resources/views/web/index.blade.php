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
    <a mod-id="logo" class="mod-logo fl" href="//www.lianjia.com/" title="链家网"></a>
    <div class="mod-switch_channel fl">
        <p>二手房</p>
        <ul>
            <i style="width: 100%;position: absolute;height: 8px;top: -8px;left: 0;"></i>
            <span></span>
            <li><a href="/ditu/">二手房</a></li>
            <li><a href="/dituzufang/">租房</a></li>
            <li><a href="https://zz.fang.lianjia.com/ditu/">新房</a></li>
        </ul>
    </div>
    <div class="loninContaner"><div class="overlay_bg"></div><div class="panel_login animated" id="dialog"><div class="panel_info"><i class="close_login">×</i><div class="panel_tab"><div class="title"><div class="fl">账号密码登录</div></div><div class="clear"></div><div id="con_login_user"><form action="" method="post"><ul><li class="item border-t userName"><input type="text" class="the_input topSpecial users" placeholder="请输入手机号" maxlength="11"></li><li class="item border-b pwd"><input type="password" class="the_input password" maxlength="20" placeholder="请输入登录密码"><em class="password-view"></em></li><li class="item checkVerimg" style="display:none;"><input type="text" class="the_input ver-img" maxlength="6" placeholder="请输入验证码"><img class="verImg"></li><li class="item drag" style="display:none;"><div id="drag"></div></li><li class="show-error"><dd>用户名或密码错误</dd></li><li class="li_01"><label class="checkbox-btn"><span class="active"><input type="checkbox" name="remember" value="1" class="mind-login" checked=""></span>7天内免登录</label><a href="javascript:;" rel="nofollow" class="toforget">忘记密码</a></li><li class="li_btn"><a class="login-user-btn">登录</a></li><li class="footer-link"><a href="javascript:;" rel="nofollow" class="totellogin">手机快捷登录</a></li></ul></form></div><div id="con_login_agent" class="undis"><form action="" method="post"><ul><li class="item"><dd></dd><input type="text" class="the_input users" placeholder="输入经纪人ID号码"></li><li class="item"><input type="password" class="the_input password" placeholder="登录密码"></li><li class="li_01"><label class="checkbox-btn"><span class="active"><input type="checkbox" name="remember" value="1" class="mind-login" checked=""></span>7天内免登录</label><a href="https://passport.lianjia.com/register/resources/lianjia/forget.html?service=http://bj.lianjia.com/" rel="nofollow">忘记密码</a></li><li><input class="login-agent-btn" value="立即登录"></li></ul></form></div></div></div><div class="registered"></div></div><div class="panel_login animated" id="dialog_tel"><div class="panel_info"><i class="close_login">×</i><div class="panel_tab"><div class="title"><div class="fl">手机快捷登录</div><div class="register_text_tel">别担心，无账号自动注册不会导致手机号被泄露</div></div><div class="clear"></div><div id="con_login_user_tel"><form action="" method="post"><ul><li class="item border-t userName"><input type="text" class="the_input topSpecial users_tel" maxlength="11" placeholder="请输入手机号"></li><!-- <li class="item pwd"><input type="password" class="the_input password_tel"  placeholder="请输入短信验证码"/></li> --><li class="item checkVerimg" style=""><input type="text" class="the_input ver-img" maxlength="6" placeholder="请输入验证码"><img class="verImg"></li><li class="item border-b Verify"><input type="text" class="the_input verifycode" maxlength="6" placeholder="请输入短信验证码"><a class="send_verify_code" id="send_verify_code_tel" href="javascript:;" rel="nofollow"><em>获取验证码</em></a></li><li class="send_verify_code_s" id="send_verify_code_tel_s" href="javascript:;" rel="nofollow"><em>没有收到验证码？</em><a class="voice_a">发送语音验证码</a></li><li class="show-error"><dd>用户名或密码错误</dd></li><li class="li_01"><label class="checkbox-btn"><span class="active"><input type="checkbox" name="remember" value="1" class="mind-login" checked=""></span>7天内免登录</label></li><li class="li_btn"><a class="login-user-tel-btn">登录</a></li><li class="footer-link"><a href="javascript:;" rel="nofollow" class="tologin">账号密码登录</a></li></ul></form></div></div></div><div class="registered"></div></div><div class="panel_login animated" id="dialog_reg"><div class="panel_info"><i class="close_login">×</i><div class="panel_tab"><div class="title"><div class="fl">手机号码注册</div><label class="fr register_text">已有账号？<a href="javascript:;" rel="nofollow" class="tologin">去登录</a></label></div><div class="clear"></div><div id="con_login_user_reg"><form action="" method="post"><ul><li class="item border-t userName"><input type="text" class="the_input topSpecial users_reg" maxlength="11" placeholder="请输入手机号"></li><li class="item checkVerimg" style=""><input type="text" class="the_input ver-img" maxlength="6" placeholder="请输入验证码"><img class="verImg"></li><li class="item border-c Verify"><input type="text" class="the_input verifycode" maxlength="6" placeholder="请输入短信验证码"><a class="send_verify_code" id="send_verify_code_reg" href="javascript:;" rel="nofollow"><em>获取验证码</em></a></li><li class="item border-b pwd"><input type="password" class="the_input password_reg" maxlength="20" placeholder="请输入密码（最少8位，数字+字母）"><em class="password-view"></em></li><li class="send_verify_code_s" id="send_verify_code_reg_s" href="javascript:;" rel="nofollow"><em>没有收到验证码？</em><a class="voice_a">发送语音验证码</a></li><li class="show-error"><dd>用户名或密码错误</dd></li><li class="li_01"><label class="checkbox-btn"><span class="active"><input type="checkbox" name="read" value="1" class="read-protocol" checked=""></span>我已阅读并同意</label><a class="toprotocol" href="//www.lianjia.com/zhuanti/protocol" target="_blank">《链家用户使用协议》</a></li><li class="li_btn"><a class="register-user-btn">注册</a></li></ul></form></div></div></div><div class="registered"></div></div><div class="panel_login animated" id="dialog_forget"><div class="panel_info"><i class="close_login">×</i><div class="panel_tab"><div class="title"><div class="fl">找回密码</div></div><div class="clear"></div><div id="con_forget_user_tel" class="con_forget_user_tel"><form action="" method="post"><ul><li class="item border-t userName"><input type="text" class="the_input topSpecial user_forget_phone" placeholder="请输入手机号" maxlength="11"></li><li class="item checkVerimg" style=""><input type="text" class="the_input ver-img" maxlength="6" placeholder="请输入验证码"><img class="verImg"></li><li class="item border-b Verify"><input type="text" class="the_input verifycode" maxlength="6" placeholder="请输入短信验证码"><a class="send_verify_code" id="send_verify_code_forget" href="javascript:;" rel="nofollow"><em>获取验证码</em></a></li><li class="item border-t pwd" style="margin-top:-1px;"><input type="password" class="the_input password_reg" maxlength="20" placeholder="请输入密码（最少8位，数字+字母）"><em class="password-view"></em></li><li class="send_verify_code_s" id="send_verify_code_forget_s"><em>没有收到验证码？</em><a class="voice_a">发送语音验证码</a></li><li class="show-error"><dd>用户名或密码错误</dd></li><li class="li_btn"><a class="user-forget">修改密码</a></li></ul></form></div><div id="con_forget_user_pw" class="con_forget_user_pw"><form action="" method="post"><ul><li class="item border-t pwd"><input type="password" class="the_input password_reg" maxlength="20" placeholder="请输入密码（最少8位，数字+字母）"><em class="password-view"></em></li><li class="show-error"><dd>用户名或密码错误</dd></li><li class="li_btn"><a class="modify-user-pswd">修改密码</a></li></ul></form></div></div></div><div class="registered"></div></div></div>
    <div class="mod-search fl" id="search" mod-id="search">
        <div class="form fl" style="position: relative;">
            <input type="text" autocomplete="off" id="searchInput" placeholder="输入小区或地铁站开始找房">
            <button class="btn">
                <i></i>
            </button>
            <div class="sug-search" style="display: none;"></div></div>
        <div class="aside fl">
            <ol>
                <li class="li li-filter" data-type="sellPrice">
                    <span>售价</span>
                    <i class="drop-i"></i>
                    <ol class="drop-list" style="display: none;"><li data-value="" class="item clicked">不限</li><li data-value="min_price=&amp;max_price=100" class="item">100万以下</li><li data-value="min_price=100&amp;max_price=150" class="item">100-150万</li><li data-value="min_price=150&amp;max_price=200" class="item">150-200万</li><li data-value="min_price=200&amp;max_price=250" class="item">200-250万</li><li data-value="min_price=250&amp;max_price=300" class="item">250-300万</li><li data-value="min_price=300&amp;max_price=500" class="item">300-500万</li><li data-value="min_price=500&amp;max_price=1000" class="item">500-1000万</li><li data-value="min_price=1000&amp;max_price=" class="item">1000万以上</li></ol></li>
                <li class="li li-filter" data-type="roomArea">
                    <span>面积</span>
                    <i class="drop-i"></i>
                    <ol class="drop-list" style="display: none;"><li data-value="" class="item clicked">不限</li><li data-value="min_area=&amp;max_area=50" class="item">50平以下</li><li data-value="min_area=50&amp;max_area=70" class="item">50-70平</li><li data-value="min_area=70&amp;max_area=90" class="item">70-90平</li><li data-value="min_area=90&amp;max_area=110" class="item">90-110平</li><li data-value="min_area=110&amp;max_area=130" class="item">110-130平</li><li data-value="min_area=130&amp;max_area=150" class="item">130-150平</li><li data-value="min_area=150&amp;max_area=200" class="item">150-200平</li><li data-value="min_area=200&amp;max_area=" class="item">200平以上</li></ol></li>
                <li class="li li-filter" data-type="roomType">
                    <span>房型</span>
                    <i class="drop-i"></i>
                </li>
                <li class="li-other" data-type="more">
                    <span>更多</span>
                    <i class="drop-i"></i>
                    <ol class="li-mixin"><li class="li li-filter" data-type="direction"><p>朝向</p><span>不限</span><i class="drop-i"></i></li><li class="li li-filter" data-type="roomAge"><p>楼龄</p><span>不限</span><i class="drop-i"></i></li><li class="li li-filter" data-type="roomFloor"><p>楼层</p><span>不限</span><i class="drop-i"></i></li><li class="li li-filter" data-type="roomTag"><p>其他</p><span>不限</span><i class="drop-i"></i></li></ol></li>
                <li class="li-btn">
                    <i></i>清除全部条件
                </li>
            </ol>
        </div>
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
