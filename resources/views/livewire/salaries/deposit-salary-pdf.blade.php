<title>نقرير ايداع الراتب</title>
<div class="">
    <div  style="direction: rtl;text-align: right"  class="">
    <h5><span>التاريخ : {{$date}}</span></h5>
    <h5><span>الموضوع تحويل راتب شهر  : {{$data["month"]}}</span></h5>
    <h5><span>الساده : {{$data["bank"]}}</span></h5>
    <h5><span>تحيه طيبه وبعد...........</span></h5>
    <h5><span>شركة :{{$data["company"]}}</span></h5>
    <h5><span>رقم حسابنا لديكم :  {{$data["account_number"]}}</span></h5>
    <h5><span>بالاشاره الى الموضوع المذكور اعلاه  العمل على تحويل راتب </span></h5>
    <h5><span>الى حساباتهم الوارده  كما في جدول </span></h5>
    <h5><span>قيد القيمه   {{$data["salary"]}}  ,  {{$data["amount_written"]}} </span></h5>
    <h5><span>وذالك  :    بدل راتب شهر (  {{$data["month"]}} )  </span></h5>
    <h5><span>قيدا على حسابنا  جاري لديكم  المذكور اعلاه واشعارنا بذالك  . حسب الكشف التالي </span></h5>
    <table class="table table-light">
        <thead>
            <tr>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">الاسم </td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">المبلغ</td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">كتابه </td>
                <td style="text-align: center; background-color:#03415F;color: #fff; font-size: 12px; width: 11%">iban </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align: center;padding-top: 8px; width: 35%"> {{$data["name"]}}</td>
                <td style="text-align: center;padding-top: 8px; width: 35%"> {{$data["salary"]}}</td>
                <td style="text-align: center;padding-top: 8px; width: 35%"> {{$data["amount_written"]}}</td>
                <td style="text-align: center;padding-top: 8px; width: 35%"> {{$data["iban"]}}</td>
            </tr>
        </tbody>
    </table>
    <div class="signatures" style="margin: 00px 0 0 0">
        <h5><span>توقيع المفوضين : </span></h5>
        @foreach ($signature as $item)
        <h5><span>{{$item["signature"]}} :</span></h5>
        @endforeach
        <h6><span>ختم الشركه : </span></h6>
    </div>
    </div>
</div>


