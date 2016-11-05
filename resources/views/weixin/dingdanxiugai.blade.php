@extends('weixin.layout.master')
@section('title','订单修改')
@section('css')
    <link rel="stylesheet" href="css/themes/base/jquery-ui.css"/>
    <link href='css/fullcalendar.min.css' rel='stylesheet'/>
    <link rel="stylesheet" href="css/swiper.min.css">
@endsection
@section('content')
    <header>
        <a class="headl fanh" href="javascript:void(0)"></a>
        <h1>修改订单</h1>
    </header>

    <div class="ordtop pa2t clearfix">
        <img class="ordpro" src="images/zfx.jpg">
        <p>蒙牛纯甄酸奶低温 <span>剩余数量：32</span></p>
        <div class="ordye">金额：162元</div>
    </div>

    <div class="dnsli clearfix dnsli2">
        <div class="dnsti">更改奶品：</div>
        <select class="dnsel" name="" id="dnsel1" onChange="javascript:dnsel_changed()">
            <option value="1">不换奶</option>
            <option value="2">换一种奶</option>
            <option value="3">换多种奶</option>
        </select>
    </div>

    <div class="dnsli clearfix dnsli2">
        <div class="dnsti">配送规则：</div>
        <select class="dnsel" name="" id="dnsel2" onChange="javascript:dnsel_changed()">
            <option value="1">天天送</option>
            <option value="2">隔日送</option>
            <option value="3">按周送</option>
            <option value="4">随心送</option>
        </select>

    </div>

    <div class="dnsli clearfix dnsel_item" id="dnsel_0_2">
        <div class="dnsti">每天送：</div>
    <span class="addSubtract">
                  <a class="subtract" href="javascript:;">-</a>
                    <input type="text" value="1" style="ime-mode: disabled;">
                    <a class="add" href="javascript:;">+</a></span>（瓶）
    </div>

    <div class="dnsli clearfix dnsel_item" id="dnsel_0_3">
        <table class="psgzb" width="" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th scope="col">周一</th>
                <th scope="col">周二</th>
                <th scope="col">周三</th>
                <th scope="col">周四</th>
                <th scope="col">周五</th>
                <th scope="col">周六</th>
                <th scope="col">周日</th>
            </tr>
            <tr height="55px">
                <td>
                    <div><p>1</p></div>
                    <div><p>cls</p></div>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <div><p>5</p></div>
                    <div><p>cls</p></div>
                </td>
                <td>
                    <div><p>5</p></div>
                    <div><p>cls</p></div>
                </td>
            </tr>
        </table>
    </div>

    <div class="dncon dnsel_item" id="dnsel_2_0">
        <ul class="dnpro">
            <li class="pa2">
                <img class="ordpro" src="images/zfx.jpg">
                <p>蒙牛纯甄酸奶低温 <input class="ordfx" name="" type="checkbox" value="" checked><span class="khpro">可换：12瓶</span>
                </p>
                <div class="ordye">￥162</div>
            </li>
            <li class="pa2">
                <img class="ordpro" src="images/zfx.jpg">
                <p>蒙牛纯甄酸奶低温 <input class="ordfx" name="" type="checkbox" value=""></p>
                <div class="ordye">￥162</div>
            </li>
            <li class="pa2">
                <img class="ordpro" src="images/zfx.jpg">
                <p>蒙牛纯甄酸奶低温 <input class="ordfx" name="" type="checkbox" value=""></p>
                <div class="ordye">￥162</div>
            </li>
            <li class="pa2">
                <img class="ordpro" src="images/zfx.jpg">
                <p>蒙牛纯甄酸奶低温 <input class="ordfx" name="" type="checkbox" value=""></p>
                <div class="ordye">￥162</div>
            </li>

        </ul>
    </div>

    <div class="dnsel_item" id="dnsel_0_4">
        <div class="clear"></div>
        <div id='calendar'></div>
    </div>

    <div class="he50"></div>
    <div class="dnsbt clearfix">

        <a class="tjord tjord2" href="javascript:void(0);">提交</a>
    </div>
@endsection
@section('script')
    <script src="js/jquery-1.10.1.min.js"></script>
    <script src="js/ui/jquery-ui.js"></script>
    <script src='js/moment.min.js'></script>
    <script src='js/fullcalendar.min.js'></script>
    <script type="text/javascript">
        $(function () {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },
                firstDay: 0,
                editable: true,
                events: [
                    {
                        title: '2',
                        start: '2016-09-28',
                        type: 'count',

                    },
                    {
                        title: 'cls',
                        start: '2016-09-28',
                        type: 'clear',

                    },
                    {
                        start: '2016-09-28',
                        rendering: 'background',
                        color: '#00a040',
                        type: 'render',
                    }
                ],
                dayClick: function (date, jsEvent, view) {
                    var events = $('#calendar').fullCalendar('clientEvents');
                    var calCountEvent = null;
                    for (var i = 0; i < events.length; i++) {
                        if (moment(date).isSame(moment(events[i].start))) {
                            if (events[i].type == "count") {
                                calCountEvent = events[i];
                                break;
                            }
                        }
                    }
                    if (calCountEvent == null) {
                        var countEvent = new Object();
                        countEvent.start = date;
                        countEvent.title = '1';
                        countEvent.type = 'count';

                        var clearEvent = new Object();
                        clearEvent.start = date;
                        clearEvent.title = 'cls';
                        clearEvent.type = 'clear';

                        var addEventSource = [
                            {
                                title: '1',
                                start: date,
                                type: 'count',

                            },
                            {
                                title: 'cls',
                                start: date,
                                type: 'clear',

                            },
                            {
                                start: date,
                                rendering: 'background',
                                color: '#00a040',
                                type: 'render',
                            }
                        ];

                        $('#calendar').fullCalendar('addEventSource', addEventSource);
                    }
                },
                eventClick: function (calEvent, jsEvent, view) {
                    if (calEvent.type == "count") {
                        calEvent.title = parseInt(calEvent.title) + 1;
                        $('#calendar').fullCalendar('updateEvent', calEvent);
                    }
                    else if (calEvent.type == "clear") {
                        var events = $('#calendar').fullCalendar('clientEvents');
                        var calCountEvent;
                        var renderEvent;
                        for (var i = 0; i < events.length; i++) {
                            if (moment(calEvent.start).isSame(moment(events[i].start))) {
                                if (events[i].type == "count") {
                                    calCountEvent = events[i];
                                }
                                else if (events[i].type == "render") {
                                    renderEvent = events[i];
                                }
                            }
                        }
                        $('#calendar').fullCalendar('removeEvents', calEvent._id);
                        $('#calendar').fullCalendar('removeEvents', calCountEvent._id);
                        $('#calendar').fullCalendar('removeEvents', renderEvent._id);
                    }
                }

            });
            $("table.psgzb td > div").click(function(){
                if($(this).is(":first-child"))
                {
                    $(this).children().html(parseInt($(this).children().html())+1);
                }
                else
                {
                    $(this).parent().html("");
                }
                return false;
            });
            $("table.psgzb td").click(function(){
                if($(this).children().length != 2)
                {
                    $(this).html("<div><p>1</p></div><div><p>cls</p></div>");
                    $(this).children().click(function(){
                        if($(this).is(":first-child"))
                        {
                            $(this).children().html(parseInt($(this).children().html())+1);
                        }
                        else
                        {
                            $(this).parent().html("");
                        }
                        return false;
                    });
                }
            });
            dnsel_changed();
        });
    </script>

    <script>
        function dnsel_changed() {
            var combo1 = $("#dnsel1").val();
            var combo2 = $("#dnsel2").val();
            $(".dnsel_item").css("display", "none");
            if( combo1 == 1 && combo2 == 1 )
            {
                $("#dnsel_0_2").css("display", "block");
            }
            $("#dnsel_" + combo1 + "_" + combo2).css("display", "block");
            $("#dnsel_0_" + combo2).css("display", "block");
            $("#dnsel_" + combo1 + "_0").css("display", "block");
        }
    </script>

    <script>

        $(".addSubtract .add").click(function () {
            $(this).prev().val(parseInt($(this).prev().val()) + 1);
        });
        $(".addSubtract .subtract").click(function () {
            if (parseInt($(this).next().val()) > 10) {
                $(this).next().val(parseInt($(this).next().val()) - 1);
                $(this).removeClass("subtractDisable");
            }
            if (parseInt($(this).next().val()) <= 10) {
                $(this).addClass("subtractDisable");
            }
        });
    </script>
@endsection