@extends('gongchang.layout.master')
@section('css')
    <style>
        select {
            height: 35px;
        }

        .station {
            border: 1px solid black;
        }

        .station_balance {
            font-size: 15px;
            color: #ff0000;
        }

        .station_body, .station_table {
            margin-top: 20px;
            overflow: auto;
        }

        .station_body label {
            padding: 5px;
            width: 100%;
        }

        .station_body a {
            width: 100%;
        }

    </style>
@endsection
@section('content')
    @include('gongchang.theme.sidebar')
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('gongchang.theme.header')
        <div class="row border-bottom">
            <ol class="breadcrumb gray-bg" style="padding:5px 0 5px 50px;">
                <li>
                    <a href="">财务管理</a>
                </li>
                <li>
                    <a href=""><strong>奶站账户台账</strong></a>
                </li>
            </ol>
        </div>

        <div class="row">
            <div class="ibox-content col-md-12">
                <div class="col-md-2">
                    <a data-toggle="modal" href="#insert_order" class="btn btn-lg btn-success" type="button"
                       style="width:100%;">奶站现金订单收款</a>
                </div>
                &nbsp;
                <div class="col-md-2">
                    <a href="{{URL::to('/gongchang/caiwu/taizhang/qitanaizhanzhuanzhang/')}}"
                       class="btn btn-lg btn-success" type="button" style="width:100%;">其他奶站转账</a>
                </div>
                &nbsp;
                <div class="col-md-2">
                    <a href="{{URL::to('/gongchang/caiwu/taizhang/naikakuanzhuanzhang')}}"
                       class="btn btn-lg btn-success" type="button" style="width:100%;">奶卡款转账</a>
                </div>
            </div>
            <div class="ibox-content col-md-12">
                <div class="feed-element">
                    <label class="col-md-1 text-right" style="padding-top: 5px;">奶站名称:</label>
                    <div class=" col-md-2">
                        <select data-placeholder="Choose..." class="choose_station" style="width: 100%;">
                            <option value="none"></option>
                            @if (isset($stations))
                                @foreach($stations as $station)
                                    <option value="{{$station->id}}">{{$station->name}}</option>
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <div class="col-md-2 col-md-offset-6">
                        <button class="btn btn-success btn-outline" type="button" data-action="show_selected">筛选
                        </button>
                        <button class="btn btn-success btn-outline" type="button" data-action="export_csv">导出</button>
                        <button class="btn btn-success btn-outline" type="button" data-action="print">打印</button>
                    </div>
                </div>

            </div>
            <div class="col-md-12" id="station_list">
                @if (isset($stations))
                    @foreach($stations as $station)
                        <div class="ibox-content station" data-sid="{{$station->id}}">
                            <div class="station_head">
                                <label class="station_name" style="font-size:20px;">{{$station->name}}</label>
                                &emsp;
                                <label class="station_balance">配送业务信用额度：{{$station->init_delivery_credit_amount}}</label>
                                &emsp;
                                <label class="station_balance">自营信用额度：{{$station->init_business_credit_amount}}</label>
                            </div>
                            <div class="station_body">

                                <div class="col-md-12">
                                    <div class="col-sm-2">
                                        <label class="text-left">本站现金订单应收余额</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input class="gray-bg text-center receivable_order_money" readonly
                                               value="{{$station->receivable_order_money}}">
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <label class="">信用余额</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input readonly class="gray-bg text-center delivery_credit_balance"
                                               value="{{$station->init_delivery_credit_amount+$station->delivery_credit_balance}}"/>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-2">
                                        <a href="{{URL::to('/gongchang/caiwu/taizhang/naizhandingdanjinetongji/'.$station->id)}}"
                                           class="btn btn-success">查看订单金额统计</a>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-sm-2">
                                        <label class="text-left">奶站账户期末余额</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input readonly class="gray-bg text-center credit_balance"
                                               value="{{$station->calculation_balance}}"/>
                                    </div>
                                    <div class="col-sm-1 col-sm-offset-1">
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-2">
                                        <a href="{{URL::to('/gongchang/caiwu/naizhanzhanghuyue/'.$station->id)}}"
                                           class="btn btn-success">查看详情</a>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="col-sm-2">
                                        <label class="text-left">自营账户期末余额</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input readonly class="gray-bg text-center"
                                               value="{{$station->business_credit_balance}}">
                                    </div>
                                    <div class="col-sm-2 text-right">
                                        <label class="">信用余额</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input readonly class="gray-bg text-center"
                                               value="{{$station->business_credit_balance+$station->init_business_credit_amount}}"/>
                                    </div>
                                    <div class="col-sm-2 col-sm-offset-2">
                                        <a href="{{URL::to('/gongchang/caiwu/ziyingzhanghu/'.$station->id)}}"
                                           class="btn btn-success">查看自营账户</a>
                                    </div>
                                </div>
                            </div>
                            <div class="station_table">
                                <table class="footable table table-bordered" data-page-size="10">
                                    <thead>
                                    <tr>
                                        <th data-sort-ignore="true" colspan="2">期初余额</th>
                                        <th data-sort-ignore="true" colspan="2">本期订单金额增加</th>
                                        <th data-sort-ignore="true" colspan="2">本期完成订单余额（减项）</th>
                                        <th data-sort-ignore="true" colspan="2">期末金额</th>
                                    </tr>
                                    <tr>
                                        <th data-sort-ignore="true">订单剩余数量（瓶）</th>
                                        <th data-sort-ignore="true">金额</th>
                                        <th data-sort-ignore="true">订单数量（瓶）</th>
                                        <th data-sort-ignore="true">金额</th>
                                        <th data-sort-ignore="true">配送数量（瓶）</th>
                                        <th data-sort-ignore="true">金额</th>
                                        <th data-sort-ignore="true">订单剩余数量（瓶）</th>
                                        <th data-sort-ignore="true">金额</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$station->bottle_count_before_this_term}}</td>
                                        <td>{{$station->term_start_amount}}</td>
                                        <td>{{$station->bottle_count_increased_this_term}}</td>
                                        <td>{{$station->order_amount_increased_this_term}}</td>
                                        <td>{{$station->bottle_count_done_this_term}}</td>
                                        <td>{{$station->order_amount_done_this_term}}</td>
                                        <td>{{$station->bottle_count_before_this_term + $station->bottle_count_increased_this_term - $station->bottle_count_done_this_term}}</td>
                                        <td>{{$station->term_start_amount + $station->order_amount_done_this_term}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div id="insert_order" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="insert_order_receipt_form">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="feed-element col-md-12">
                                        <label class="col-md-3" style="padding-top:5px;">选择奶站:</label>
                                        <div class="col-md-9">
                                            <select required data-placeholder="Choose..." class="chosen-select"
                                                    style="width:100%;" name="station_id">
                                                @if (isset($stations))
                                                    @foreach($stations as $station)
                                                        <option value="{{$station->id}}">{{$station->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-3">金额:</label>
                                        <div class="col-md-9">
                                            <input type="number" step="0.01" min="0" required name="amount"
                                                   style="width:100%;">
                                        </div>
                                    </div>
                                    <div class="feed-element col-md-12">
                                        <label class="col-md-3">流水号:</label>
                                        <div class="col-md-9">
                                            <input type="text" name="receipt_number" required style="width:100%;">
                                        </div>
                                    </div>
                                    <div class="feed-element col-md-12">
                                        <label class="col-md-3">备注:</label>
                                        <div class="col-md-9">
                                            <textarea rows="3" cols="40" name="comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-white">确定</button>
                                <button type="button" class="btn btn-white" data-dismiss="modal">取消 | 退出</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

    <script type="text/javascript">
        $(document).ready(function () {

        });

        $('#insert_order_receipt_form').on('submit', function (e) {
            e.preventDefault();

            var sendData = $('#insert_order_receipt_form').serializeArray();
            console.log(sendData);

            $.ajax({
                type: "POST",
                url: API_URL + "gongchang/caiwu/taizhang/insert_money_order_received",
                data: sendData,
                success: function (data) {
                    console.log(data);
                    if (data.status == "success") {
                        //add amount to delivery credit balance input
                        if (data.station_id && data.amount)
                            increase_delivery_credit_balance(data.station_id, data.amount);

                        show_success_msg('插入成功');
                        $('#insert_order').modal("hide");

                    } else {
                        if (data.message)
                            show_err_msg(data.message);
                        $('#insert_order').modal("hide");
                    }
                },
                error: function (data) {
                    console.log(data);
                    show_err_msg("在插入订单信息，发生错误");
                    $('#insert_order').modal("hide");
                }
            })
        });

        function increase_delivery_credit_balance(station_id, amount) {
            var station = $('.station[data-sid="' + station_id + '"]')[0];
            var dcb = $(station).find('.delivery_credit_balance');
            var ccb = $(station).find('.credit_balance');
            var rcb = $(station).find('.receivable_order_money');

            var new_dcbal = parseFloat($(dcb).val()) + parseFloat(amount);
            $(dcb).val(new_dcbal);

            var new_ccbal = parseFloat($(ccb).val()) + parseFloat(amount);
            $(ccb).val(new_ccbal);

            var new_rcbal = parseFloat($(rcb).val()) - parseFloat(amount);
            $(rcb).val(new_rcbal);

            return;
        }

        $('[data-action="show_selected"]').click(function () {
            var current_station = $('.choose_station').val();
            if (current_station != "none") {
                $('.station').each(function () {
                    if ($(this).data('sid') != current_station) {
                        $(this).hide();
                    } else {
                        $(this).show();
                    }
                });
            }
        });


        $('button[data-action = "export_csv"]').click(function () {
            return;
        });


        $('button[data-action = "print"]').click(function () {

            var printContents = $('#station_list')[0].innerHTML;

            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            window.print();
            document.body.innerHTML = originalContents;

        });


    </script>
@endsection