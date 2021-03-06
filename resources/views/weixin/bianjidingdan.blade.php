@extends('weixin.layout.master')
@section('title','天天送')
@section('css')
    <link rel="stylesheet" href="<?=asset('weixin/css/swiper.min.css')?>">
    <link rel="stylesheet" href="<?=asset('weixin/css/fullcalendar.min.css')?>">
    <link rel="stylesheet" href="<?=asset('weixin/css/swiper.min.css')?>">
    <link href="<?=asset('font-awesome/css/font-awesome.css') ?>" rel="stylesheet">
    <link href="<?=asset('css/plugins/datepicker/datepicker3.css')?>" rel="stylesheet">

@endsection
@section('content')

    <header>
        <a class="headl fanh" href="javascript:void(0)"></a>
        <h1>产品详情</h1>

    </header>
    <div class="bann">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @if(isset($file1) && $file1)
                    <div class="swiper-slide"><img class="bimg" src="{{$file1}}"></div>
                @endif
                @if(isset($file2) && $file2)
                    <div class="swiper-slide"><img class="bimg" src="{{$file2}}"></div>
                @endif
                @if(isset($file3) && $file3)
                    <div class="swiper-slide"><img class="bimg" src="{{$file3}}"></div>
                @endif
                @if(isset($file4) && $file4)
                    <div class="swiper-slide"><img class="bimg" src="{{$file4}}"></div>
                @endif
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <div class="protop">
        <h3>{{$product->name}} {{$product->bottle_type_name}}</h3>
        <p>{{$product->introduction}}</p>
        <table class="prodz" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>月单</td>
                <td class="dzmon">￥{{$month_price}}</td>
            </tr>
            <tr>
                <td>季单</td>
                <td class="dzmon">￥{{$season_price}}</td>
            </tr>
            <tr>
                <td height="16">半年单</td>
                <td class="dzmon">￥{{$half_year_price}}</td>
            </tr>
        </table>
    </div>

    <div class="dnsl pa2t">
        <input type="hidden" id="wechat_order_product_id" value="{{$wop->id}}">
        <input type="hidden" id="product_id" value="{{$product->id}}">
        <input type="hidden" id="group_id" value="{{$group_id}}"/>

        <div class="dnsli clearfix">
            <div class="dnsti">订单类型：</div>
            <select class="dnsel" id="order_type">
                @if (isset($factory_order_types))
                    @foreach ($factory_order_types as $fot)
                        @if($fot->order_type == $wop->order_type)
                            <option value="{{$fot->order_type}}" selected>{{$fot->order_type_name}}</option>
                        @else
                            <option value="{{$fot->order_type}}">{{$fot->order_type_name}}</option>
                        @endif
                    @endforeach
                @endif
            </select>
            <div class="clear"></div>
        </div>
        <div class="dnsli clearfix">
            <div class="dnsti">订奶数量：</div>
                 <span class="addSubtract">
                  <a class="subtract" href="javascript:;">-</a>
                  <input type="text" id="total_count" value="{{$wop->total_count}}" style="ime-mode: disabled;">
                  <a class="add" href="javascript:;">+</a>
                 </span>（瓶）
        </div>
        <div class="dnsli clearfix">
            <div class="dnsti">配送规则：</div>
            <select class="dnsel" id="delivery_type" onChange="javascript:dnsel_changed(this.value)">
                <option value="dnsel_item0"
                        data-value="{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_EVERY_DAY}}">天天送
                </option>
                <option value="dnsel_item1"
                        data-value="{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_EACH_TWICE_DAY}}">隔日送
                </option>
                <option value="dnsel_item2"
                        data-value="{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_WEEK}}">按周送
                </option>
                <option value="dnsel_item3"
                        data-value="{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_MONTH}}">随心送
                </option>
            </select>
            <div class="clear"></div>
        </div>

        <!-- combo box change -->
        <!-- 天天送 -->
        <div class="dnsli clearfix dnsel_item" id="dnsel_item0">
            <div class="dnsti">每天配送数量：</div>
            <span class="addSubtract">
                <a class="subtract" href="javascript:;">-</a>
                <input type="text" value="1" style="ime-mode: disabled;">
                <a class="add" href="javascript:;">+</a>
            </span>（瓶）
        </div>

        <!--隔日送 -->
        <div class="dnsli clearfix dnsel_item" id="dnsel_item1">
            <div class="dnsti">每天配送数量：</div>
            <span class="addSubtract">
                <a class="subtract" href="javascript:;">-</a>
                <input type="text" value="1" style="ime-mode: disabled;">
                <a class="add" href="javascript:;">+</a>
            </span>（瓶）
        </div>

        <!-- 按周规则 -->
        <div class="dnsli clearfix dnsel_item" id="dnsel_item2">
            <table class="psgzb" width="" border="0" cellspacing="0" cellpadding="0" id="week">
            </table>
        </div>

        <!-- 随心送 -->
        <div class="dnsel_item" id="dnsel_item3">
            <table class="psgzb" width="" border="0" cellspacing="0" cellpadding="0" id="calendar">
            </table>
        </div>

        <div class="dnsli clearfix">
            <div class="dnsti">起送时间：</div>
            <div classs="input-group">
                <input class="qssj single_date" name="start_at" id="start_at" value="{{$wop->start_at}}">
                <span><i class="fa fa-calendar"></i></span>
            </div>
        </div>

        <div class="dnsall">
            <div class="dnsts">
                订购天数：<span>16天</span>
                <a class="cxsd" href="javascript:void(0);">重新设定</a>
            </div>
            <p>规格：{{$product->bottle_type_name}}</p>
            <p>保质期：{{$product->guarantee_period}}天</p>
            <p>储藏条件：{{$product->guarantee_req}}</p>
            {{--<p>包装：玻璃瓶</p>--}}
            <p>配料：{{$product->material}}</p>
        </div>

    </div>
    <div class="dnxx">
        <div class="dnxti"><strong>详细介绍</strong>
            <span>DETAILED INTRODUCTION</span>
        </div>
        <div class="nnadv">
            精选内蒙古草原有机牧场自然好牛奶发酵
        </div>
        <dl class="dnsdl clearfix">
            <dt>营养丰富</dt>
            <dd>在原味酸奶的基础上添加"维C之王"的好几山东撒
                发生的都擦碘伏。
            </dd>
        </dl>
        <dl class="dnsdl clearfix dnsdl2">
            <dt>有机牛奶</dt>
            <dd>在原味酸奶的基础上添加"维C之王"的好几山东撒
                发生的都擦碘伏。
            </dd>
        </dl>
        <div class="nnadv2">
            精选内蒙古草原有机牧场自然好牛奶发酵
        </div>

        <div class="nntj pa2t">
            <p><span>条件一：</span>源于有机农业生产体系</p>
            <p><span>条件二：</span>种植、养殖全部过程遵循自然规律、生态规律严禁使用
                化肥。农药。无刺激生长调节剂、催奶剂、食品添加剂
                等人工合成的化学物质</p>
            <p><span>条件二：</span>种植、养殖全部过程遵循自然规律、生态规律严禁使用
                化肥。农药。无刺激生长调节剂、催奶剂、食品添加剂
                等人工合成的化学物质</p>
            <p><span>条件二：</span>种植、养殖全部过程遵循自然规律、生态规律严禁使用
                化肥。农药。无刺激生长调节剂、催奶剂、食品添加剂
                等人工合成的化学物质</p>
        </div>

        <div class="nntip"><p>种植、养殖<span>全部过程遵循</span>自然规律、生态规律严禁使用
                化肥。农药。无刺激生长调节剂、催奶剂、食品添加剂
                等人工合成的化学物质</p>
            <img class="bimg" src="images/bann.jpg">
        </div>

    </div>
    <div class="sppj pa2t">
        <div class="sppti">商品评价</div>
        <ul class="sppul">
            <li>
                <div class="spnum"><span class="spstart"><i></i><i></i><i></i><i></i><i></i></span>137*******125</div>
                <div class="pjxx">
                    牛奶配送人员很守时，每天按时配送，也很贴心的提醒我家里哈登三角符
                    可见哈登哈哈客和卡号的好多号喝酒肯定很
                </div>

            </li>
            <li>
                <div class="spnum"><span class="spstart"><i></i><i></i><i></i><i></i><i class="stno"></i></span>137*******125
                </div>
                <div class="pjxx">
                    牛奶配送人员很守时，每天按时配送，也很贴心的提醒我家里哈登三角符
                    可见哈登哈哈客和卡号的好多号喝酒肯定很
                </div>

            </li>
        </ul>
    </div>
    <div class="he50"></div>

    <div class="dnsbt clearfix">
        <button id="cancel" class="dnsb1"><i class="fa fa-reply"></i> 取消</button>
        <button id="submit_order" class="dnsb2"><i class="fa fa-save"></i> 保存</button>
    </div>
@endsection
@section('script')

    <!-- Date picker and Date Range Picker-->
    <script src="<?=asset('js/plugins/datepicker/bootstrap-datepicker.js') ?>"></script>
    <script src="<?=asset('weixin/js/showfullcalendar.js')?>"></script>
    <script src="<?=asset('weixin/js/showmyweek.js')?>"></script>

    <script type="text/javascript">
        var calen, week;
        $(function () {
            calen = new showfullcalendar("calendar");
            week = new showmyweek("week");
            dnsel_changed("dnsel_item0");
        });

        function dnsel_changed(id) {
            $(".dnsel_item").css("display", "none");
            $("#" + id).css("display", "block");
        }

        $(document).ready(function () {
            var swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                paginationClickable: true,
                spaceBetween: 30,
            });

                    @if(isset($gap_day))
            var gap_day = parseInt("{{$gap_day}}");
                    @endif

            var today = new Date();
            var able_date = new Date();
            if (gap_day)
                able_date.setDate(today.getDate() + gap_day);
            else {
                able_date.setDate(today.getDate() + 3);
            }

            //Single and Multiple Datepicker
            $('.single_date').datepicker({
                todayBtn: false,
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: false,
                autoclose: true,
                startDate: able_date,
            });

            init_wechat_order_product();

        });

        $('button#cancel').click(function(){
            var group_id = $('#group_id').val();
            window.location.href = SITE_URL + "weixin/querendingdan?group_id="+group_id;
        });

        $('button#submit_order').click(function (e) {
            e.preventDefault();
            var send_data = new FormData();

            //wechat order product id
            var wechat_order_product_id = $('#wechat_order_product_id').val();
            send_data.append('wechat_order_product_id', wechat_order_product_id);

            //product_id
            var product_id = $('#product_id').val();
            send_data.append('product_id', product_id);

            //order_type
            var order_type = $('#order_type').val();
            send_data.append('order_type', order_type);
            //total_count
            var total_count = $('#total_count').val();
            send_data.append('total_count', total_count);

            //add delivery type and bottle_count or custom_dates
            var delivery_type = $('#delivery_type option:selected').data('value');
            send_data.append('delivery_type', delivery_type);

            var count = 0;
            var custom_date = "";
            if (($('#dnsel_item0')).css('display') != "none") {
                count = $('#dnsel_item0 input').val();
                if (!count) {
                    show_warning_msg('请填写产品的所有字段')
                    return;
                }
                send_data.append('count_per', count);

            }
            else if (($('#dnsel_item1')).css('display') != "none") {
                count = $('#dnsel_item1 input').val();
                if (!count) {
                    show_warning_msg('请填写产品的所有字段')
                    return;
                }
                send_data.append('count_per', count);

            }
            else if (($('#dnsel_item2')).css('display') != "none") {
                //week dates
                custom_date = week.get_submit_value();
                if (!custom_date) {
                    show_warning_msg('请填写产品的所有字段')
                    return;
                }
                send_data.append('custom_date', custom_date);

            }
            else {
                //month dates
                custom_date = calen.get_submit_value();
                if (!custom_date) {
                    show_warning_msg('请填写产品的所有字段')
                    return;
                }
                send_data.append('custom_date', custom_date);
            }

            //start at
            var start_at = $('#start_at').val();
            if (!start_at) {
                show_warning_msg('请填写产品的所有字段');
                return;
            }
            send_data.append('start_at', start_at);
            console.log(send_data);

            var group_id = $('#group_id').val();

            $.ajax({
                type: "POST",
                url: SITE_URL + "weixin/bianjidingdan/save_changed_order_item",
                data: send_data,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data.status == "success") {
                        show_success_msg("变化产品成功");
                        //go to shanpin qurendingdan
                        window.location.href = SITE_URL + "weixin/querendingdan?group_id="+group_id;
                    } else
                    {
                        if(data.message)
                        {
                            show_warning_msg(data.message);
                        }
                    }
                },
                error: function (data) {
                    console.log(data);
                    show_warning_msg("附加产品失败");
                }
            });
        })

        function init_wechat_order_product()
        {
            var delivery_type = parseInt("{{$wop->delivery_type}}");

            $('#delivery_type').find('option[data-value="'+delivery_type+'"]').prop('selected', true);

            $('#delivery_type').trigger('change');


            if(delivery_type == parseInt("{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_EVERY_DAY}}"))
            {
                var count_per = parseInt("{{$wop->count_per_day}}");
                $('#dnsel_item0 input').val(count_per);

            } else if ( delivery_type == parseInt("{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_EACH_TWICE_DAY}}"))
            {
                var count_per = parseInt("{{$wop->count_per_day}}");
                $('#dnsel_item1 input').val(count_per);

            } else if ( delivery_type == parseInt("{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_WEEK}}"))
            {
                //show custom bottle count on week
                week.custom_dates = "{{$wop->custom_date}}";
                week.set_custom_date();

            } else if (delivery_type == parseInt("{{\App\Model\DeliveryModel\DeliveryType::DELIVERY_TYPE_MONTH}}")){

                calen.custom_dates = "{{$wop->custom_date}}";
                calen.set_custom_date();

            } else {
                return;
            }

        }

    </script>

@endsection



