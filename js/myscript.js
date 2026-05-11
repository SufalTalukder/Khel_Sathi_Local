
$(document).ready(function () {
    if ($.cookie("css")) {
        $("#theme").attr("href", $.cookie("css"));
    }
    $(".defTheme").click(function () {
        $("#theme").attr("href", $(this).attr('href'));
        $.cookie("css", $(this).attr('href'));
        return false;
    });
    $(".hi-btn").click(function () {
        var cfrm = confirm("वेबसाइट के हिंदी संस्करण पर हस्तानांतरित किया जा रहा है");
        if (cfrm == true) {
            window.location(this.window.url + "/hi");
            return true;
        }
        else if (cfrm == false) {
            return false;
        }
        //alert(crm);
    });

    var comp = new RegExp(location.host);
    $('a').each(function () {
        if (comp.test($(this).attr('href'))) {
            // a link that contains the current host 
            $(this).addClass('local');
        }
        else {
            // a link that does not contain the current host
            $(this).addClass('external');
        }
    });

    //$('a').filter(function () {
    //        return this.hostname && this.hostname !== location.hostname;
    //    })
    //    .click(function () {
    //        $(this).attr('target', '_blank');
    //        var x = window.confirm('You are about to leave the website. and view the content of an external website.');
    //        var val = false;
    //        if (x)
    //            val = true;
    //        else
    //            val = false;
    //        return val;
    //    });

    $(".search").click(function () {
        $(".toggle").fadeToggle("slow");
    });

});

//$(window).scroll(function() {
//var height = $(window).scrollTop();
//if(height  > 150) {
//$(".top-nav").addClass("pwdFxd");
//}
//if(height  < 150) {
//$(".top-nav").removeClass("pwdFxd");
//}
// 
//});	

//// Date Time Function

tday = new Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
tmonth = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

function GetClock() {
    var d = new Date();
    var nday = d.getDay(), nmonth = d.getMonth(), ndate = d.getDate(), nyear = d.getYear();
    if (nyear < 1000) nyear += 1900;
    var nhour = d.getHours(), nmin = d.getMinutes(), nsec = d.getSeconds(), ap;

    if (nhour == 0) { ap = " AM"; nhour = 12; }
    else if (nhour < 12) { ap = " AM"; }
    else if (nhour == 12) { ap = " PM"; }
    else if (nhour > 12) { ap = " PM"; nhour -= 12; }

    if (nmin <= 9) nmin = "0" + nmin;
    if (nsec <= 9) nsec = "0" + nsec;

    document.getElementById('datetime').innerHTML = "" + tday[nday] + ", " + tmonth[nmonth] + " " + ndate + ", " + nyear + " " + nhour + ":" + nmin + ":" + nsec + ap + "";
}
window.onload = function () {
    GetClock();
    setInterval(GetClock, 1000);
}

/////////// END HERE



$(".sopen a").click(function () {
    $(".searchdiv").fadeToggle("slow");
});	