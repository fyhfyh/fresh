{extend name="public/container"}
{block name="content"}
<script type="text/javascript" language="javascript" src="{__PUBLIC_PATH}LodopFuncs.js"></script>
<object id="LODOP_OB"
        classid="clsid:2105C259-1E0C-4534-8141-A753534CB4CA" width="0"
        height="0">
    <embed id="LODOP_EM" type="application/x-print-lodop" width="0"
           height="0"></embed>
</object>
<div class="ibox-content order-info" id='d1'>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    收货信息
                    <button style='float: right' class="btn btn-primary btn-xs"onclick='MyPreview()'><i class="fa fa-print"></i>打印预览11111111</button>
                </div>
                <div class="panel-body">
                    <div class="row show-grid">
                        <div class="col-xs-12 KH">客户名称: {$userInfo.nickname}</div>
                        <div class="col-xs-12 SHR">收货人: {$orderInfo.real_name}</div>
                        <div class="col-xs-12 DH">联系电话: {$orderInfo.user_phone}</div>
                        <div class="col-xs-12 DZ">收货地址: {$orderInfo.user_address}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    订单信息
                </div>
                <div class="panel-body">
                    <div class="row show-grid">
                        <div class="col-xs-6 DDH" >订单编号: {$orderInfo.order_id}</div>
                        <div class="col-xs-6" style="color: #8BC34A;">订单状态:
                            {if condition="$orderInfo['paid'] eq 0 && $orderInfo['status'] eq 0"}
                            未支付
                            {elseif condition="$orderInfo['paid'] eq 1 && $orderInfo['shipping_type'] eq 1 && $orderInfo['status'] eq 0 && $orderInfo['refund_status'] eq 0"/}
                            未发货
                            {elseif condition="$orderInfo['paid'] eq 1 && $orderInfo['shipping_type'] eq 2 && $orderInfo['status'] eq 0 && $orderInfo['refund_status'] eq 0"/}
                            待核销
                            {elseif condition="$orderInfo['paid'] eq 1 && $orderInfo['shipping_type'] eq 1 && $orderInfo['status'] eq 1 && $orderInfo['refund_status'] eq 0"/}
                            待收货
                            {elseif condition="$orderInfo['paid'] eq 1 && $orderInfo['status'] eq 2 && $orderInfo['refund_status'] eq 0"/}
                            待评价
                            {elseif condition="$orderInfo['paid'] eq 1 && $orderInfo['status'] eq 3 && $orderInfo['refund_status'] eq 0"/}
                            交易完成
                            {elseif condition="$orderInfo['paid'] eq 1 && $orderInfo['refund_status'] eq 1"/}
                            申请退款<b style="color:#f124c7">{$orderInfo.refund_reason_wap}</b>
                            {elseif condition="$orderInfo['paid'] eq 1 && $orderInfo['refund_status'] eq 2"/}
                            已退款
                            {/if}
                        </div>
                        <div class="col-xs-6">商品总数: {$orderInfo.total_num}</div>
                        <div class="col-xs-6 ZJ">商品总价: ￥{$orderInfo.total_price}</div>
                        <div class="col-xs-6">支付邮费: ￥{$orderInfo.total_postage}</div>
                        <!-- <div class="col-xs-6">优惠券金额: ￥{$orderInfo.coupon_price}</div> -->
                        <div class="col-xs-6">实际支付: ￥{$orderInfo.pay_price}</div>
                        {if condition="$orderInfo['refund_price'] > 0"}
                        <div class="col-xs-6" style="color: #f1a417">退款金额: ￥{$orderInfo.refund_price}</div>
                        {/if}
                        {if condition="$orderInfo['use_integral'] > 0"}
                        <div class="col-xs-6" style="color: #f1a417">使用积分: {$orderInfo.use_integral}积分(抵扣了￥{$orderInfo.deduction_price})</div>
                        {/if}
                        {if condition="$orderInfo['back_integral'] > 0"}
                        <div class="col-xs-6" style="color: #f1a417">退回积分: ￥{$orderInfo.back_integral}</div>
                        {/if}
                        <div class="col-xs-6">创建时间: {$orderInfo.add_time|date="Y/m/d H:i"}</div>
                       <!--  <div class="col-xs-6">支付方式:
                            {if condition="$orderInfo['paid'] eq 1"}
                               {if condition="$orderInfo['pay_type'] eq 'weixin'"}
                               微信支付
                               {elseif condition="$orderInfo['pay_type'] eq 'yue'"}
                               余额支付
                               {elseif condition="$orderInfo['pay_type'] eq 'offline'"}
                               线下支付
                               {else/}
                               其他支付
                               {/if}
                            {else/}
                            {if condition="$orderInfo['pay_type'] eq 'offline'"}
                            线下支付
                            {else/}
                            未支付
                            {/if}
                            {/if}
                        </div> -->
                        {notempty name="orderInfo.pay_time"}
                        <div class="col-xs-6">支付时间: {$orderInfo.pay_time|date="Y/m/d H:i"}</div>
                        {/notempty}
                        <div class="col-xs-6" style="color: #ff0005">用户备注: {$orderInfo.mark?:'无'}</div>
                        <!-- <div class="col-xs-6" style="color: #733AF9">推广人: {if $spread}{$spread}{else}无{/if}</div> -->
                        <div class="col-xs-6" style="color: #733b5c">商家备注: {$orderInfo.remark?:'无'}</div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    商品清单
                </div>
                <div class="panel-body">
                    <div class="row show-grid QD">
                   {foreach $_info as $key=>$value} 
                        
                        <div class="col-xs-12 shoplist" >
                        <img width='50' src="{$value.cart_info.productInfo.image}">
  <!-- 属性名称 -->
<span id='MC'>{$value.cart_info.productInfo.store_name}{present name="value.cart_info.productInfo.attrInfo"}|{$value.cart_info.productInfo.attrInfo.suk}{/present} </span>    
                           
<span id='JG'>￥{$value.cart_info.truePrice}/{$value.cart_info.productInfo.unit_name}</span>
                        <span id='SL'>x{$value.cart_info.cart_num}</span>
                        </div>                       
                    {/foreach}
                    </div>
                </div>
            </div>
        </div>
        {if condition="$orderInfo['delivery_type'] eq 'express'"}
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    物流信息
                </div>
                <div class="panel-body">
                    <div class="row show-grid">
                        <div class="col-xs-6" >快递公司: {$orderInfo.delivery_name}</div>
                        <div class="col-xs-6">快递单号: {$orderInfo.delivery_id} | <button class="btn btn-info btn-xs" type="button"  onclick="$eb.createModalFrame('物流查询','{:Url('express',array('oid'=>$orderInfo['id']))}',{w:322,h:568})">物流查询</button></div>
                    </div>
                </div>
            </div>
        </div>
        {elseif condition="$orderInfo['delivery_type'] eq 'send'"}
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    配送信息
                </div>
                <div class="panel-body">
                    <div class="row show-grid">
                        <div class="col-xs-6" >送货人姓名: {$orderInfo.delivery_name}</div>
                        <div class="col-xs-6">送货人电话: {$orderInfo.delivery_id}</div>
                    </div>
                </div>
            </div>
        </div>
        {/if}
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    备注信息
                </div>
                <div class="panel-body">
                    <div class="row show-grid">
                        <div class="col-xs-6" >{if $orderInfo.mark}{$orderInfo.mark}{else}暂无备注信息{/if}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   var LODOP; //声明为全局变量
    function ReSumMoney() { 
        var fSumvalue=0;
        for (i = 1; i < 8; i++) {
            if (document.getElementById("CK"+i).checked) {
                fSumvalue=fSumvalue+parseFloat(document.getElementById("DJ"+i).value);
            }            
        }   
        document.getElementById("HJ").value=fSumvalue.toFixed(2);
    };
    function MyPreview() {  
        AddTitle();
        //商品清单数据
        var shoplen = $('.shoplist').length;
        var iCurLine=96;//标题行之后的数据从位置80px开始打印
        var qd = $('.QD');
        var ZJ = $('.ZJ').text();
        var KH = $('.KH').text();
        var SHR = $('.SHR').text();
        var DH = $('.DH').text();
        var DZ = $('.DZ').text();
        var DDH = $('.DDH').text();
        
        for (i = 0; i < shoplen; i++) {                    
                LODOP.ADD_PRINT_TEXT(iCurLine,20,100,20,qd.children().eq(i).find('#MC').text());
                LODOP.ADD_PRINT_TEXT(iCurLine,238,100,20,qd.children().eq(i).find('#JG').text());
                LODOP.ADD_PRINT_TEXT(iCurLine,409,100,20,qd.children().eq(i).find('#SL').text().substr(1));
                iCurLine=iCurLine+25;//每行占25px          
        }       
        var myDate=new Date() 
        var getFullYear = myDate.getFullYear(); //获取完整的年份(4位)
        var getMonth =myDate.getMonth()+1; //获取当前月份(0-11,0代表1月)
        var getDate = myDate.getDate(); //获取当前日(1-31)
        LODOP.ADD_PRINT_LINE(iCurLine,14,iCurLine,510,0,1);
        LODOP.ADD_PRINT_TEXT(20,345,355,30,"No.{$orderInfo.order_id}");
        LODOP.ADD_PRINT_TEXT(40,20,355,30,"客户：{$userInfo.nickname}");
        LODOP.ADD_PRINT_TEXT(40,395,355,30,getFullYear+"年"+getMonth+'月'+getDate+'日');
        LODOP.SET_PRINT_STYLEA(0,"FontSize",10);
        LODOP.ADD_PRINT_TEXT(iCurLine+5,20,300,20,SHR);
        LODOP.ADD_PRINT_TEXT(iCurLine+5,346,150,20,ZJ); 
        LODOP.ADD_PRINT_TEXT(iCurLine+25,20,300,20,DH);         
        LODOP.SET_PRINT_PAGESIZE(3,1385,45,"");//这里3表示纵向打印且纸高“按内容的高度”；1385表示纸宽138.5mm；45表示页底空白4.5mm
        LODOP.PREVIEW();    
    };
    function AddTitle(){    
        LODOP=getLodop();  
        LODOP.PRINT_INIT("打印");
        LODOP.ADD_PRINT_TEXT(15,212,355,30,"收 款 收 据");
        LODOP.SET_PRINT_STYLEA(1,"FontSize",14);
        LODOP.SET_PRINT_STYLEA(1,"FontColor",'red');
        LODOP.SET_PRINT_STYLEA(1,"Bold",5);
        LODOP.SET_PRINT_STYLEA(1,"Underline",1);//文本加下划线
        LODOP.ADD_PRINT_TEXT(70,20,100,20,"商品名称");
        LODOP.SET_PRINT_STYLEA(3,"FontSize",10);
        LODOP.SET_PRINT_STYLEA(3,"Bold",1);
        LODOP.ADD_PRINT_TEXT(70,238,100,20,"商品数量");
        LODOP.SET_PRINT_STYLEA(4,"FontSize",10);
        LODOP.SET_PRINT_STYLEA(4,"Bold",1);
        LODOP.ADD_PRINT_TEXT(70,409,100,20,"单价(元)");
        LODOP.SET_PRINT_STYLEA(5,"FontSize",10);
        LODOP.SET_PRINT_STYLEA(5,"Bold",1);
        LODOP.ADD_PRINT_LINE(87,14,87,510,0,1);
    };  
</script>  

<script src="{__FRAME_PATH}js/content.min.js?v=1.0.0"></script>
  
{/block}
{block name="script"}

{/block}
