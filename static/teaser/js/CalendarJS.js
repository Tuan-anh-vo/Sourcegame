var Calendar = function (o) {
    //Store div id
    this.divId = o.ParentID;

    // Days of week, starting on Sunday
    this.DaysOfWeek = o.DaysOfWeek;

    // Months, stating on January
    this.Months = o.Months;

    // Set the current month, year
    var d = new Date();

    this.CurrentMonth = d.getMonth();

    this.CurrentYear = d.getFullYear();
    var f = o.Format;

    if (typeof (f) == 'string') {
        this.f = f.charAt(0).toUpperCase();
    } else {
        this.f = 'M';
    }
};

// Goes to next month
Calendar.prototype.nextMonth = function () {
    if (this.CurrentMonth == 11) {
        this.CurrentMonth = 0;
        this.CurrentYear = this.CurrentYear + 1;
    } else {
        this.CurrentMonth = this.CurrentMonth + 1;
    }
    this.showCurrent();
};

// Goes to previous month
Calendar.prototype.previousMonth = function () {
    if (this.CurrentMonth == 0) {
        this.CurrentMonth = 11;
        this.CurrentYear = this.CurrentYear - 1;
    } else {
        this.CurrentMonth = this.CurrentMonth - 1;
    }

    this.showCurrent();
};

//
Calendar.prototype.previousYear = function () {
    this.CurrentYear = this.CurrentYear - 1;
    this.showCurrent();
}

//
Calendar.prototype.nextYear = function () {
    this.CurrentYear = this.CurrentYear + 1;
    this.showCurrent();
}

// Show current month
Calendar.prototype.showCurrent = function () {
    this.Calendar(this.CurrentYear, this.CurrentMonth);
};

// Show month (year, month)
Calendar.prototype.Calendar = function (y, m) {
    typeof (y) == 'number' ? this.CurrentYear = y : null;
    typeof (y) == 'number' ? this.CurrentMonth = m : null;
    // 1st day of the selected month
    var firstDayOfCurrentMonth = new Date(y, m, 1).getDay();
    // Last date of the selected month
    var lastDateOfCurrentMonth = new Date(y, m + 1, 0).getDate();
    // Last day of the previous month
    var lastDateOfLastMonth = m == 0 ? new Date(y - 1, 11, 0).getDate() : new Date(y, m, 0).getDate();
    // Write selected month and year. This HTML goes into <div id="year"></div>
    //var yearhtml = '<span class="yearspan">' + y + '</span>';

    // Write selected month and year. This HTML goes into <div id="month"></div>
    //var monthhtml = '<span class="monthspan">' + this.Months[m] + '</span>';

    // Write selected month and year. This HTML goes into <div id="month"></div>
    var monthandyearhtml = '<span id="monthandyearspan">' + this.Months[m] + ' năm ' + y + '</span>';
    var html = '';
    html += '<table class="table-content-04" id="tb1">';

    // Write the header of the days of the week
    html += '<tr>';
    for (var i = 0; i < 7; i++) {
        html += '<th class="daysheader">' + this.DaysOfWeek[i] + '</th>';
    }

    html += '</tr>';
    //this.f = 'X';

    var p = dm = this.f == 'M' ? 1 : firstDayOfCurrentMonth == 0 ? -5 : 2;

    /*var p, dm;

    if(this.f =='M') {
      dm = 1;

      p = dm;
    } else {
      if(firstDayOfCurrentMonth == 0) {
        firstDayOfCurrentMonth == -5;
      } else {
        firstDayOfCurrentMonth == 2;
      }
    }*/
    var cellvalue;
    var cellvalue2;
    for (var d, i = 0, z0 = 0; z0 < 6; z0++) {
        html += '<tr>';

        for (var z0a = 0; z0a < 7; z0a++) {
            d = i + dm - firstDayOfCurrentMonth;
            // Dates from prev month
            if (d < 1) {
                cellvalue = lastDateOfLastMonth - firstDayOfCurrentMonth + p++;
                html += '<td  class="prevmonthdates" id="' + this.CurrentYear.toString() + '' + (this.CurrentMonth).toString() + '' + (cellvalue) + '" >' +
                      '<p id="' + this.CurrentYear.toString() + '' + (this.CurrentMonth).toString() + '' + (cellvalue) + '" >' + '<a href="javascript:;" onclick="HandleClickRollUp(\'' + this.CurrentYear.toString() + '\-' + (this.CurrentMonth).toString() + '\-' + (cellvalue) + '\');" data-id="' + this.CurrentYear.toString() + '-' + (this.CurrentMonth).toString() + '-' + (cellvalue) + '">' + (cellvalue) + '</a></p>' + '</td>';

                // Dates from next month
            } else if (d > lastDateOfCurrentMonth) {

                cellvalue2 = p++;

                html += '<td  class="nextmonthdates" id="' + this.CurrentYear.toString() + '' + (this.CurrentMonth + 2).toString() + '' + (cellvalue2) + '" >' + '<p id="' + this.CurrentYear.toString() + '' + (this.CurrentMonth + 2).toString() + '' + (cellvalue2) + '" >' + '<a  href="javascript:;" onclick="HandleClickRollUp(\'' + this.CurrentYear.toString() + '\-' + (this.CurrentMonth + 2).toString() + '\-' + (cellvalue2) + '\');" data-id="' + this.CurrentYear.toString() + '-' + (this.CurrentMonth + 2).toString() + '-' + (cellvalue2) + '">' + (cellvalue2) + '</a></p>' + '</td>';

                // Current month dates
            } else {
                html += '<td class="nentb" id="' + this.CurrentYear.toString() + '' + (this.CurrentMonth + 1).toString() + '' + (d) + '">' + '<p id="' + this.CurrentYear.toString() + '' + (this.CurrentMonth + 1).toString() + '' + (d) + '" >' + '<a href="javascript:;" onclick="HandleClickRollUp(\'' + this.CurrentYear.toString() + '\-' + (this.CurrentMonth + 1).toString() + '\-' + (d) + '\');" data-id="' + this.CurrentYear.toString() + '-' + (this.CurrentMonth + 1).toString() + '-' + (d) + '">' + (d) + '</a></p>' + '</td>';
                p = 1;
            }

            if (i % 7 == 6 && d >= lastDateOfCurrentMonth) {
                z0 = 10; // no more rows
            }
            i++;
        }

        html += '</tr>';
    }

    // Closes table
    html += '</table>';

    // Write HTML to the div
    //document.getElementById("year").innerHTML = yearhtml;

    //document.getElementById("month").innerHTML = monthhtml;

    document.getElementById("monthandyear").innerHTML = monthandyearhtml;
    document.getElementById(this.divId).innerHTML = '';
    document.getElementById(this.divId).innerHTML = html;
};

// On Load of the window
window.onload = function () {
    // Start calendar
    var c = new Calendar({
        ParentID: "divcalendartable",

        DaysOfWeek: [
           'THỨ 2',
           'THỨ 3',
           'THỨ 4',
           'THỨ 5',
           'THỨ 6',
           'THỨ 7',
           'CN'
        ],

        Months: ['THÁNG 1', 'THÁNG 2', 'THÁNG 3', 'THÁNG 4', 'THÁNG 5', 'THÁNG 6', 'THÁNG 7', 'THÁNG 8', 'THÁNG 9', 'THÁNG 10', 'THÁNG 11', 'THÁNG 12'],

        //DaysOfWeek: [
        //'MON',
        //'TUE',
        //'WED',
        //'THU',
        //'FRI',
        //'SAT',
        //'SUN'
        //],

        //Months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],

        Format: 'dd/mm/yyyy'
    });

    c.showCurrent();

    // Bind next and previous button clicks
    getId('btnPrev').onclick = function () {
        c.previousMonth();
        GetListRollUp();
    };

    //getId('btnPrevYr').onclick = function () {
    //    c.previousYear();
    //};

    getId('btnNext').onclick = function () {
        c.nextMonth();
        GetListRollUp();
    };

    //getId('btnNextYr').onclick = function () {
    //    c.nextYear();
    //};
}

// Get element by id
function getId(id) {
    return document.getElementById(id);
}

function GetListRollUp() {
    try {
        $.ajax({
            type: 'GET',
            url: appPath + 'Home/RollUpTable',
            processData: true,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            crossDomain: true,
            xhrFields: { withCredentials: true },
            cache: false,
            success: function (data) {
                if (data != null) {
                    var dataArr = data.split('|');
                    console.log(dataArr[1]);
                    if (dataArr[1] < 10) {
                        $("#countRollup").html("0" + dataArr[1]);
                    }
                    else {
                        $("#countRollup").html(dataArr[1]);
                    }
                    console.log(dataArr[0]);
                    var text = '{"DATA":' + dataArr[0] + '}';
                    obj = JSON.parse(text);
                    var length = Object.keys(obj.DATA).length;
                    console.log(obj);
                    console.log(obj.DATA[0].RollupTime);
                    for (i = 0; i < length; i++) {
                        $("td#" + obj.DATA[i].RollupTime).css("background", "url('https://dolongky.vtcgame.vn/teaser/images/tick-tb.png') no-repeat center center");
                    }
                }
            }
        });
    }
    catch (err) {
        alert(err);
    }
};

function HandleClickRollUp(value) {
    var currentdate = new Date();
   
    var datetime2 = currentdate.getFullYear() + "-"
        + (currentdate.getMonth() + 1) + "-"
        + currentdate.getDate();
    console.log(datetime2);

    console.log(value);
    if (Date.parse(value) == Date.parse(datetime2)) {
        BaoDanh(value);
    }
    if (Date.parse(value) < Date.parse(datetime2)) {
        if (accountId == '0') {
            PopupCtrl.PopupLogin();
            return;
        }
        else {
            BaoDanh(value);
        }
    }
    if (Date.parse(value) > Date.parse(datetime2)) {
        if (accountId == '0') {
            PopupCtrl.PopupLogin();
            return;
        }
        else {
            PopupCtrl.PopupMessage("Ngày báo danh không hợp lệ!");
            GetListRollUp();
        }
    }
}

function BaoDanh(value) {
    if (accountId == '0') {
        PopupCtrl.PopupLogin();
        return;
    }
    var url = appPath + "Home/RollUp";
    $.ajax({
        url: url,
        type: "POST",
        data: { RollupTime: value },
        success: function (response) {
            if (response.ResponseCode >= 0) {
                PopupCtrl.PopupMessage(response.Message);
                GetListRollUp();
            }
            else {
                PopupCtrl.PopupMessage(response.Message);
                GetListRollUp();
            }
        },
        error: function () {
            PopupCtrl.PopupMessage("Hệ thống bận. Vui lòng quay lại sau!");
            GetListRollUp();
        }
    });
}



function MuaBaoDanh() {
    if (!jsConfig.isLogin) {
        ThongBao("Bạn chưa đăng nhập! Hãy đăng nhập để quay.");
        return;
    }
    var rollupTime = $('#RollUpBuy').attr('data-id');
    var url = jsConfig.urlRoot + "Home/MuaBaoDanh";
    $.ajax({
        url: url,
        type: "POST",
        data: { time: rollupTime, token: jsConfig._token },
        success: function (response) {
            if (response.ResponseStatus >= 0) {
                ThongBao("Mua báo danh thành công!");
                setTimeout(function () {
                    location.reload();
                }, 2000);
            }
            if (response.ResponseStatus == -600) {
                ThongBao("Ngày báo danh không hợp lệ!");
            }
            if (response.ResponseStatus == -50) {
                ThongBao("Tài khoản không tồn tại!");
            }
            if (response.ResponseStatus == -51) {
                ThongBao("Bạn không đủ vcoin để mua báo danh!");
            }
            if (response.ResponseStatus == -1) {
                ThongBao("Lỗi hệ thống. Vui lòng quay lại sau!");
            }
            if (response.ResponseStatus == -99) {
                ThongBao("Báo danh thất bại!");
            }
        },
        error: function () {
            ThongBao("Hệ thống bận. Vui lòng quay lại sau!");
        }
    });
}

function BaoDanhAlert(mes) {
    var html = '';
    html += '<div class="popup-1">';
    html += '<a href="javascript:;" onclick="ClosePopUp();" class="btn-close"><img src="images/btn-close.png"></a>';
    html += '<span class="title-baodanh">Báo Danh</span>';
    html += '<p class="text-thongbao-popup">' + mes + '</p>';
    html += '<a href="javascript:;" class="btn-xacnhan">Xác nhận</a>';
    html += '</div>';
    $('#PopupThongBao').html(html).modal('show');
}

function MuaBaoDanhAlert(mes, value, time) {
    var html = '';
    html += '<div class="popup-2">';
    html += '<a href="javascript:;" onclick="ClosePopUp();" class="btn-close"><img src="images/btn-close.png"></a>';
    html += '<span class="title-baodanh">Báo Danh</span>';
    html += '<p class="text-thongbao-popup text-vocin-popup">' + mes + '</p>';
    html += '<span class="text-thongbao-popup text2-vocin-popup">Báo danh bù : <b>' + value + ' vcoin</b></span>';
    html += '<center><ul>';
    html += '<li><a id="RollUpBuy" href="javascript:;" onclick="MuaBaoDanh();" data-id="' + time + '">Xác nhận</a></li>';
    html += '<li><a href="javascript:;" onclick="ClosePopUp();">Hủy</a></li>';
    html += '</ul></center>';
    html += '</div>';
    $('#PopupThongBao').html(html).modal('show');
}