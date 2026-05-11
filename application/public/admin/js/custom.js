(function() {
    "use strict";

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    var forms = document.querySelectorAll(".needs-validation");
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener(
            "submit",
            function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add("was-validated");
            },
            false
        );
    });

    $(document)
        .ajaxStart(function() {
            $.blockUI({
                message: '<h1><img src="' +
                    ajaxUrl +
                    '/busy.gif" /> Please Wait...</h1>',
            });
        })
        .ajaxComplete(function() {
            $.unblockUI({
                message: '<h1><img src="' +
                    ajaxUrl +
                    '/busy.gif" /> Please Wait...</h1>',
            });
        })
        .ajaxError(function() {
            $.unblockUI({
                message: '<h1><img src="' +
                    ajaxUrl +
                    '/busy.gif" /> Please Wait...</h1>',
            });
            // error("Oop! Something went wrong please reload this page and try again.");
            // error("Oops! Something Went Wrong Please Try After Some Time.");
        });


    // Global Sidebar Enhancements (Active State & Scroll Persistence)
    $(document).ready(function() {
        let path = window.location.href.split('?')[0];
        
        // 1. Active State & Submenu Expansion
        $('.navsidebar a').each(function() {
            let linkHref = this.href.split('?')[0];
            
            if (linkHref === path) {
                $(this).addClass('active');
                
                let parentUl = $(this).closest('.sub-menu');
                if (parentUl.length > 0) {
                    parentUl.addClass('show');
                    let triggerLi = parentUl.prev('.menu_item');
                    triggerLi.removeClass('collapsed').attr('aria-expanded', 'true');
                }
            }
        });

        // 2. Scroll Persistence
        const sidebarContent = $('.menuscrollwrap .nano-content, .sidebar .scrollwrap .nano-content');
        
        // Restore scroll position
        const storedScrollPos = localStorage.getItem('sidebar_scroll_pos');
        if (storedScrollPos && sidebarContent.length > 0) {
            sidebarContent.scrollTop(storedScrollPos);
        }

        // Save scroll position on scroll (throttled)
        let scrollTimeout;
        sidebarContent.on('scroll', function() {
            clearTimeout(scrollTimeout);
            scrollTimeout = setTimeout(() => {
                localStorage.setItem('sidebar_scroll_pos', $(this).scrollTop());
            }, 100);
        });
        
        // Also save on link click
        $('.navsidebar a').on('click', function() {
            if(sidebarContent.length > 0) {
                localStorage.setItem('sidebar_scroll_pos', sidebarContent.scrollTop());
            }
        });
    });

})();

function closed() {
    $(".screen").hide();
}

function addValidity() {
    $(".needs-validation").addClass("was-validated");
}

function removeValidity() {
    $(".needs-validation").removeClass("was-validated");
    $(".ctarea").val("");
}



function error(msg) {
    $.toast({
        heading: "Error",
        text: msg,
        icon: "error",
        loader: true,
        loaderBg: "#8b0404",
        showHideTransition: "fadeup",
        hideAfter: 4500,
        position: {
            right: 20,
            top: 20,
        },
    });
}

function success(msg) {
    $.toast({
        heading: "Success",
        text: msg,
        icon: "success",
        loader: true,
        loaderBg: "#114404",
        showHideTransition: "fadeup",
        hideAfter: 4500,
        position: {
            right: 20,
            top: 20,
        },
    });
}

function info(msg) {
    $.toast({
        heading: "Info",
        text: msg,
        icon: "info",
        loader: true,
        loaderBg: "#034b6d",
        showHideTransition: "fadeup",
        hideAfter: 4500,
        position: {
            right: 20,
            top: 20,
        },
    });
}

function warning(msg) {
    $.toast({
        heading: "Warning",
        text: msg,
        icon: "warning",
        loader: true,
        loaderBg: "#ff7a59",
        showHideTransition: "fadeup",
        hideAfter: 4500,
        position: {
            right: 20,
            top: 20,
        },
    });
}

$(".cp_refresh").on("click", function() {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/cp_refresh/",
        dataType: "json",
        success: function(res) {
            console.log(res)
            $("#cp_refresh").html(res.Code1 + '+' + res.Code2);
            $(".refreshc").val(res.capchaCode);
        },
    });
});

$("#submit").submit(function(e) {
    e.preventDefault();
    if ($("#submit")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    $("#responsive").load(" #responsive");
                    $(".btn-close").click();
                    $(".form-control").val("");
                    $("#submit").removeClass("was-validated");
                    tableRendor();
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#submit").addClass("was-validated");
});

$("#submit2").submit(function(e) {
    e.preventDefault();
    if ($("#submit2")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    $("#responsive").load(" #responsive");
                    $(".btn-close").click();
                    $(".form-control").val("");
                    $("#submit2").removeClass("was-validated");
                    tableRendor();
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#submit2").addClass("was-validated");
});

$("#ajxReload").submit(function(e) {
    console.log(e.msg)
    e.preventDefault();
    if ($("#ajxReload")[0].checkValidity() === false) {

        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#ajxReload").addClass("was-validated");
});

function deleteRole(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: ajaxUrl + "/deleteRole/" + id,
                dataType: "json",
                success: function(res) {
                    success(res.msg);
                    $("#responsive").load(" #responsive");
                    tableRendor();
                },
            });
        }
    });
}

$(".options").on("click", function() {
    $(".options").removeClass("active");
    $(".bhoechie-tab-content").removeClass("active");
    $(this).addClass("active");
    var id = $(this).attr("data-id");
    $(".options" + id).addClass("active");
});

var cnt = 0;

// $("#country").on("change", function () {
//     if (cnt > 0) $("#district_id").val("");

//     var countryID = $(this).val();
//     var id = $(this).attr("data-id");
//     if (countryID) {
//         $.ajax({
//             type: "GET",
//             url: ajaxUrl + "/getStateData/" + countryID,
//             success: function (html) {
//                 $("#state").html(html);
//                 $("#district").html(
//                     '<option value="">Select District</option>'
//                 );

//                 if (cnt <= 0) $("#state").val(id);

//                 cnt = 1;
//                 var did = $("#district_id").val();
//                 if (did != "") {
//                     $.ajax({
//                         type: "GET",
//                         url: ajaxUrl + "/getCityData/" + id,
//                         success: function (html) {
//                             $("#district").html(html);
//                             $("#district").val(did);
//                         },
//                     });
//                 }
//             },
//         });
//     }
// });

// $("#state").on("change", function () {
//     var stateID = $(this).val();
//     var id = $(this).attr("data-id");
//     if (stateID) {
//         $.ajax({
//             type: "GET",
//             url: ajaxUrl + "/getCityData/" + stateID,
//             success: function (html) {
//                 $("#district").html(html);
//             },
//         });
//     }
// });
$("#division_name").on("change", function () {
    var division = $(this).val();
    var district =$('#district_id').val();
    console.log(division)
    if (division) {
        $.ajax({
            type: "GET",
            url: ajaxUrl + "/getCitybyDiv/" + division + '/'+ district,
            success: function (html) {
                $("#district_name").html(html);
            },
        });
    }
});

$("#reload").submit(function(e) {
    e.preventDefault();
    if ($("#reload")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    // window.location.href = res.url;
                    window.location.reload();
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#reload").addClass("was-validated");
});

$("#reload_two").submit(function(e) {
    e.preventDefault();
    if ($("#reload_two")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        swal({
            title: 'क्या आप सबमिट करना चाहते हैं?',
            text: "एक बार सबमिट करने के बाद, डेटा को संपादित नहीं किया जा सकता।",
            icon: 'warning',
            buttons: {
                cancel: {
                    text: "रद्द करें",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                  },
                  confirm: {
                    text: "पुष्टि करें",
                    value: true,
                    visible: true,
                    className: "",
                    closeModal: true
                  }
              },
          }).then((result) => {
            if (result===true) {
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(res) {
                        if (res.error == false) {
                            success(res.msg);
                            window.location.href = res.url;
                            // window.location.reload();
                        } else {
                            error(res.msg);
                        }
                    },
                });;
            }
        });
    }
    $("#reload_two").addClass("was-validated");
});


$("#forgot").submit(function(e) {
    console.log('heelo');
    e.preventDefault();
    if ($("#forgot")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {

                    // $('#forgotpassword').modal('show')
                    success(res.msg);
                    // window.location.href = res.url;
                } else {


                    error(res.msg);
                }
            },
        });
    }
    $("#forgot").addClass("was-validated");
});


$("#preregistration").submit(function(e) {
    e.preventDefault();
    if ($("#preregistration")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#preregistration").addClass("was-validated");
});

$("#basic_detail").submit(function(e) {
    e.preventDefault();
    if ($("#basic_detail")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#basic_detail").addClass("was-validated");
});

$("#communication_detail").submit(function(e) {
    e.preventDefault();
    if ($("#communication_detail")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#communication_detail").addClass("was-validated");
});

$("#education_detail").submit(function(e) {
    e.preventDefault();
    console.log($("#education_detail")[0].checkValidity())
    if ($("#education_detail")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        // var actionUrl = ajaxUrl+"/admin/post_master_add";
        var maximum_marks = parseInt($('#maximum_marks').val());
        var obtained_marks = parseInt($('#obtained_marks').val());



      
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.error == false) {
                        // window.location.reload();
                        success(res.msg);
                        window.location.href = res.url;
                    } else {
                        error(res.msg);
                    }
                },
            });
      
    }
    $("#education_detail").addClass("was-validated");
});

$("#date_management").submit(function(e) {
    e.preventDefault();
    if ($("#date_management")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        var start_date = new Date($("#start_date").val());
        var end_date = new Date($("#end_date").val());
        if (end_date > start_date) {
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.error == false) {
                        success(res.msg);
                        window.location.href = res.url;
                    } else {
                        error(res.msg);
                    }
                },
            });
        } else {
            error("End Date is smaller than Start Date.");
        }
    }
    $("#date_management").addClass("was-validated");
});

$("#document_detail").submit(function(e) {
    e.preventDefault();

    if ($("#document_detail")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    // window.location.reload();
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });

    }
    $("#document_detail").addClass("was-validated");
});

$("#submit_detail").submit(function(e) {
    e.preventDefault();

    if ($("#submit_detail")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        if ($("#chek").prop('checked') == true) {
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                dataType: "json",
                contentType: false,
                cache: false,
                processData: false,
                success: function(res) {
                    if (res.error == false) {
                        // window.location.reload();
                        window.location.href = res.url;
                        success(res.msg);
                    } else {
                        error(res.msg);
                    }
                },
            });
        } else {
            error("Please select I Agree checkbox./कृपया मैं सहमत हूं चेकबॉक्स का चयन करें।");
        }

    }
    $("#submit_detail").addClass("was-validated");
});


$("#otpVerify").submit(function(e) {

    e.preventDefault();
    if ($("#otpVerify")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {


                    success(res.msg);
                    setTimeout(() => {
                        window.location.href = res.url;
                    }, 1000);
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#otpVerify").addClass("was-validated");
});
var timeleft = 20;

function resendOtp() {
    $(".after-time-out").hide();
    $(".otp-time").show();
    timeleft = 20;
    $("#otp1").val("");
    $("#otp2").val("");
    $("#otp3").val("");
    $("#otp4").val("");
    $("#otp5").val("");
    $("#otp6").val("");
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/resendOtp/",
        success: function(res) {
            if (res.error == false) {
                success(res.msg);
            } else {
                error(res.msg);
            }
        },
    });
}

$(".after-time-out").hide();
var downloadTimer = setInterval(function() {
    if (timeleft <= 0) {
        $(".after-time-out").show();
        $(".otp-time").hide();
    } else {
        $("#countdown").html(timeleft);
    }
    timeleft -= 1;
}, 1000);


$("#login").submit(function(e) {
    e.preventDefault();
    if ($("#login")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                // console.log(res['route']);exit;
                !1 == res.error ?
                    location.replace(res["route"]) :
                    error(res.msg);
            },
        });
    }
    $("#login").addClass("was-validated");
});

function IsNumeric(e, id) {
    console.log(e)
    if (e.data != null)
        $("#otp" + id).focus();
    else
        $("#otp" + (id - 2)).focus();
}

$("#adminlogin").submit(function(e) {
    e.preventDefault();
    if ($("#adminlogin")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#adminlogin").addClass("was-validated");
});

function departmentStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/departmentStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

function sectorStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/sectorStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

function stateStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/stateStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
            window.location.href = "admin/state";
        },
    });
}

function cityStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/cityStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}


function updateState(id) {
    var state = $("#state" + id).val();
    if (state != "") {
        $.ajax({
            method: "POST",
            url: ajaxUrl + "/admin/stateUpdate",
            data: { id: id, state: state },
            dataType: "json",
            success: function(res) {
                success(res.msg);
                $(".state" + id).hide();
                $(".stateup" + id).show();
                $("#stateup" + id).html($("#state" + id).val());
            },
        });
    } else {
        error("Please Enter State Name");
    }
}

function updateCompet(id) {
    var name = $("#state" + id).val();
    if (name != "") {
        $.ajax({
            method: "POST",
            url: ajaxUrl + "/admin/compUpdate",
            data: { id: id, name: name },
            dataType: "json",
            success: function(res) {
                success(res.msg);
                $(".state" + id).hide();
                $(".stateup" + id).show();
                $("#stateup" + id).html($("#state" + id).val());
            },
        });
    } else {
        error("Please Enter State Name");
    }
}

function updateEvent(id) {
    var name = $("#state" + id).val();
    if (name != "") {
        $.ajax({
            method: "POST",
            url: ajaxUrl + "/admin/eventUpdate",
            data: { id: id, name: name },
            dataType: "json",
            success: function(res) {
                success(res.msg);
                $(".state" + id).hide();
                $(".stateup" + id).show();
                $("#stateup" + id).html($("#state" + id).val());
            },
        });
    } else {
        error("Please Enter State Name");
    }
}

// $(document).ready(function () {
var check = 1;

function getParent(id) {
    if (id > 0 && check > 1) {
        $.ajax({
            type: "GET",
            url: ajaxUrl + "/admin/getPage/" + id,
            success: function(html) {
                $("#page_parent").html(html);
            },
        });
    }
    check = 2;
}
//});

function moduleStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/moduleStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

function pageStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/pageStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

function updateDepartment(id) {
    $(".update-from").show();
    $(".update-department").hide();
    $("#up_department_code").val($("#department_code" + id).html());
    $("#up_department").val($("#department" + id).html());
    $("#department_id").val(id);
}

function backDepartment() {
    $(".update-from").hide();
    $(".update-department").show();
}

function updateSector(id) {
    $(".update-from").show();
    $(".update-sector").hide();
    $("#up_sector").val($("#sector" + id).html());
    $("#sector_id").val(id);
}

function backSector() {
    $(".update-from").hide();
    $(".update-sector").show();
}

$("#updateSector").submit(function(e) {
    e.preventDefault();
    if ($("#updateSector")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    var id = $("#sector_id").val();
                    $(".update-from").hide();
                    $(".update-sector").show();
                    $("#sector" + id).html($("#up_sector").val());
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#updateSector").addClass("was-validated");
});

$("#updatedepartment").submit(function(e) {
    e.preventDefault();
    if ($("#updatedepartment")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    var id = $("#department_id").val();
                    $(".update-from").hide();
                    $(".update-department").show();
                    $("#department_code" + id).html(
                        $("#up_department_code").val()
                    );
                    $("#department" + id).html($("#up_department").val());
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#updatedepartment").addClass("was-validated");
});

function updateCity(id, state_id) {
    $(".update-from").show();
    $(".update-city").hide();
    $("#state_id_up").val(state_id);
    $("#upcity").val($("#upcity" + id).html());
    $("#city_id").val(id);
}

function backCity() {
    $(".update-from").hide();
    $(".update-city").show();
}
//stateup
let stateName = "";

$("#state_id_up").change(function() {
    stateName = $(this).find(":selected").data("value");
});

$("#updatecitya").submit(function(e) {
    e.preventDefault();
    if ($("#updatecitya")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    var id = $("#city_id").val();
                    $(".update-from").hide();
                    $(".update-city").show();
                    $("#stateup" + id).html(stateName);
                    $("#upcity" + id).html($("#upcity").val());
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#updatecitya").addClass("was-validated");
});

//public/busy.gif
///$.blockUI({ message: '<h1><img src="'+ajaxUrl+'/public/busy.gif" /> Just a moment...</h1>' });

function updateRole(id) {
    $(".update-from").show();
    $(".update-role").hide();
    $("#up_role_name").val($("#rolename" + id).html());
    $("#role_id").val(id);
}

function backRole() {
    $(".update-from").hide();
    $(".update-role").show();
}

$("#updateroles").submit(function(e) {
    e.preventDefault();
    if ($("#updateroles")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    var id = $("#role_id").val();
                    $(".update-from").hide();
                    $(".update-role").show();
                    $("#rolename" + id).html($("#up_role_name").val());
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#updateroles").addClass("was-validated");
});

function roleStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/roleStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

function sportEventStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/SEventStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}


function openAccessPlant() {
    $(".hidebtn").hide();
    $(".openAccessplant").show();
    $("#otherInformation").hide();
}

function showPPA() {
    $(".hidebtn").hide();
    $(".ppsoler").show();
    $("#otherInformation").hide();
}

function showPPS() {
    $(".hidebtn").hide();
    $(".ppsolerppark").show();
    $("#otherInformation").hide();
}

function showPPSPrivate() {
    $(".hidebtn").hide();
    $(".ppsolerpparkprivate").show();
    $("#otherInformation").hide();
}

function hidePlant() {
    $("#otherInformation").hide();
    $(".hidebtn").hide();
    $(".openAccessplant").hide();
}

function show1() {
    swal({
        title: "Important",
        text: "Participate in Bid Invited by DISCOM/UPPCL and thereafter apply for registration on receipt of LOI/Signing of PPA",
        icon: "success",
        button: "Ok",
    }).then((willDelete) => {
        location.replace("registered-project");
    });
}

function showopenaccess() {
    swal({
        title: "Important",
        text: "You will be informed on receipt of imformation from upptcl regarding feasibility of connectivity.",
        icon: "success",
        button: "Ok",
    }).then((willDelete) => {
        location.replace("registered-project");
    });
}

function otherRemark() {
    swal({
        title: "Important",
        text: "You will be contacted by UPNEDA.",
        icon: "success",
        button: "Ok",
    }).then((willDelete) => {
        location.replace("registered-project");
    });
}

$(".back").click(function() {
    window.history.go(-1);
    return false;
});

function show2() {
    swal({
        title: "Important",
        text: "You will be notified after approval of UPPTCL",
        icon: "success",
        button: "Ok",
    }).then((willDelete) => {
        location.replace("registered-project");
    });
}

function show3() {
    swal({
        title: "Important",
        text: "You will be notified after approval of UPPTCL",
        icon: "success",
        button: "Ok",
    }).then((willDelete) => {
        location.replace("registered-project");
    });
}

function updateMenu(id) {
    $(".update-from").show();
    $(".update-menu").hide();
    $("#up_menu_name").val($("#menuname" + id).html());
    $("#up_order").val($("#menuorder" + id).html());
    $("#menu_di").val(id);
}

function backmenu() {
    $(".update-from").hide();
    $(".update-menu").show();
}

$("#updatemenu").submit(function(e) {
    e.preventDefault();
    if ($("#updatemenu")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    var id = $("#menu_di").val();
                    $(".update-from").hide();
                    $(".update-menu").show();
                    $("#menuname" + id).html($("#up_menu_name").val());
                    $("#menuorder" + id).html($("#up_order").val());
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#updatemenu").addClass("was-validated");
});

function menuStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/menuStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

function usersStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/usersStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

$("#reloadSolar").submit(function(e) {
    e.preventDefault();
    if ($("#reloadSolar")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    if (res.type == 1) {
                        show1();
                    } else if (res.type == 2) {
                        show2();
                    } else if (res.type == 22) {
                        showopenaccess();
                    } else if (res.type == 9) {
                        otherRemark();
                    } else {
                        show3();
                    }
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#reloadSolar").addClass("was-validated");
});

$("#preference_first").on("change", function() {
    var value = $(this).val();

    //  $("#preference_first option").removeAttr("disabled");
    //  $("#preference_second option").removeAttr("disabled");
    //  $("#preference_third option").removeAttr("disabled");

    $("#preference_second option[value='" + value + "']").attr(
        "disabled",
        "disabled"
    );
    $("#preference_third option[value='" + value + "']").attr(
        "disabled",
        "disabled"
    );
});

$("#preference_second").on("change", function() {
    var value = $(this).val();

    // $("#preference_first option").removeAttr("disabled");
    // $("#preference_second option").removeAttr("disabled");
    // $("#preference_third option").removeAttr("disabled");

    $("#preference_first option[value='" + value + "']").attr(
        "disabled",
        "disabled"
    );
    $("#preference_third option[value='" + value + "']").attr(
        "disabled",
        "disabled"
    );
});

$("#preference_third").on("change", function() {
    var value = $(this).val();

    // $("#preference_first option").removeAttr("disabled");
    //$("#preference_second option").removeAttr("disabled");
    // $("#preference_third option").removeAttr("disabled");

    $("#preference_second option[value='" + value + "']").attr(
        "disabled",
        "disabled"
    );
    $("#preference_first option[value='" + value + "']").attr(
        "disabled",
        "disabled"
    );
});

var page = 0;
var pages = 0;
var searchs = 0;
var search = "";
var project_filter = "";
var sports_comp = "";
var post_name = "";
var position_medal = "";
var comp_from_date = "";
var comp_to_date = "";
var status_filter = "";
var city_filter = "";
var from_date = "";
var to_date = "";
var seg = 0;


var sendUrl = ajaxUrl + "/filterData?page=";
// if ($("#table_data_department").length) {
//     sendUrl = ajaxUrl + "/department/projectdashboard?page=";
// }
$("#exportExcel").click(function() {

    var sendUrl = ajaxUrl + "/exportExcel?page=";
    // let form_type = 3;
    let form_type = $("#form_type").val();
    let lenght = $("#table_length").val();
    let search = $("#table_search").val();
    let seg = $("#seg").val();
    let seg4 = $("#seg4").val();
    if (seg != 3 && seg != 4 && seg < 10) {
        status_filter = $("#seg").val();
    }
    // window.location.href=ajaxUrl +"/exportExcel/4"
    window.location.href = sendUrl + page + "&lenght=" + lenght +
        "&seg=" + seg +
        "&seg4=" + seg4 +
        "&form_type=" + form_type +
        "&search=" +
        search +
        "&project_filter=" +
        project_filter +
        "&sports_comp=" +
        sports_comp +
        "&post_name=" +
        post_name +
        "&position_medal=" +
        position_medal +
        "&status_filter=" +
        status_filter +
        "&city_filter=" +
        city_filter +
        "&from_date=" +
        from_date +
        "&to_date=" +
        to_date + "&comp_from_date=" +
        comp_from_date +
        "&comp_to_date=" +
        comp_to_date;
});


$("#exportPdf").click(function() {

    var sendUrl = ajaxUrl + "/exportPdf?page=";
    let form_type = $("#form_type").val();
    let lenght = $("#table_length").val();
    let search = $("#table_search").val();
    let seg = $("#seg").val();
    let seg4 = $("#seg4").val();
    if (seg != 3 && seg != 4 && seg < 10) {
        status_filter = $("#seg").val();
    }
    // window.location.href=ajaxUrl +"/exportExcel/4"
    window.location.href = sendUrl + page + "&lenght=" + lenght + "&seg=" + seg + "&form_type=" + form_type +
        "&search=" +
        search +
        "&seg4=" +
        seg4 +
        "&project_filter=" +
        project_filter +
        "&sports_comp=" +
        sports_comp +
        "&post_name=" +
        post_name +
        "&position_medal=" +
        position_medal +
        "&status_filter=" +
        status_filter +
        "&city_filter=" +
        city_filter +
        "&from_date=" +
        from_date +
        "&to_date=" +
        to_date + "&comp_from_date=" +
        comp_from_date +
        "&comp_to_date=" +
        comp_to_date;
});

function fetch_data(page) {
    let form_type = $("#form_type").val();
    let lenght = $("#table_length").val();
    let search = $("#table_search").val();
    let seg4 = $("#seg4").val();
    let seg = $("#seg").val();
    if (seg != 3 && seg != 4 && seg < 10) {
        status_filter = $("#seg").val();
    }
    $.ajax({
        url: sendUrl +
            page +
            "&lenght=" +
            lenght +
            "&seg4=" +
            seg4 +
            "&seg=" +
            seg +
            "&form_type=" +
            form_type +
            "&search=" +
            search +
            "&project_filter=" +
            project_filter +
            "&sports_comp=" +
            sports_comp +
            "&post_name=" +
            post_name +
            "&position_medal=" +
            position_medal +
            "&status_filter=" +
            status_filter +
            "&city_filter=" +
            city_filter +
            "&from_date=" +
            from_date +
            "&to_date=" +
            to_date +
            "&comp_from_date=" +
            comp_from_date +
            "&comp_to_date=" +
            comp_to_date,
        success: function(data) {
            if ($("#table_data").length) {
                $("#table_data").html(data);
                $(".table-responsive").load(" .table-responsive");
                tableRendor();
            } else {
                $("#table_data_department").html(data);
                tableRendor();
            }
        },
    });
}

if ($("#table_data").length) {
    fetch_data(1);
}
if ($("#table_data_department").length) {
    fetch_data(1);
}

$(document).ready(function() {
    $(document).on("click", ".pagination a", function(event) {
        if ($("#table_data").length) {
            event.preventDefault();
            page = $(this).attr("href").split("page=")[1];
            fetch_data(page);
        }
    });
});

function searchCollection(value) {
    // || searchs == 1 value.length >= 2 &&
    if (searchs == 0) {
        fetch_data(1);
        searchStatus();
    }
}

function searchStatus() {
    searchs = 1;
    setTimeout(() => {
        searchs = 0;
    }, 500);
}

$("#table_length").on("change", function() {
    if (pages != 0) fetch_data(1);

    pages = 1;
});
var handeChanges = 0;

function handeChange(e) {
    if (e.name == "project_filter") {
        project_filter = e.value;
        if (project_filter == "all") {
            project_filter = "";
        }
    } else if (e.name == "status_filter") {
        status_filter = e.value;
        if (status_filter == "all") {
            status_filter = "";
        }
    } else if (e.name == "city_filter") {

        city_filter = e.value;
        if (city_filter == "all") {
            city_filter = "";
        }
    } else if (e.name == "from_date") {
        from_date = e.value;
    } else if (e.name == "to_date") {
        to_date = e.value;
    }
    // new filter for direct recruitment

    else if (e.name == "sports_comp") {

        sports_comp = e.value;
        if (sports_comp == "all") {
            sports_comp = "";
        }
    }
    else if (e.name == "post_name") {

        post_name = e.value;
        if (post_name == "all") {
            post_name = "";
        }
    }
    else if (e.name == "position_medal") {

        position_medal = e.value;
        if (position_medal == "all") {
            position_medal = "";
        }
    }
    else if (e.name == "comp_from_date") {
        comp_from_date = e.value;
    } else if (e.name == "comp_to_date") {
        comp_to_date = e.value;
    }
    // end new filter
    if (e.value != "" || handeChange == 1) {
        if (e.name != "from_date" || e.name != "to_date") {
            fetch_data(1);
        } else if (from_date != "" || to_date != "") {
            fetch_data(1);
        }
    }

    handeChanges = 1;
}

function resetButton() {
    project_filter = "";
    sports_comp = "";
    post_name = "";
    position_medal = "";
    status_filter = "";
    city_filter = "";
    from_date = "";
    to_date = "";
    comp_from_date = "";
    comp_to_date = "";
    $("#table_search").val(" ");
    $("#table_length").val("100000");


    fetch_data(1);
}

function showFeasibleModal(id) {
    $("#Feasible").modal("show");
    $(".project_summary_id").val(id);
    $("#FeasibleLabel").html("Revert");
    $("#project_rejected").val(0);
    $(".FeasibilityAction").show();
}

function showForwordModal(id) {
    $("#forwarded").modal("show");
    $(".project_summary_id").val(id);
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/logintype",
        success: function(res) {
            $("#forward_to").html(res);
        },
    });
}

function showRejectModal(id) {
    $("#FeasibleLabel").html("Reject");
    $("#project_rejected").val(1);
    $("#Feasible").modal("show");
    $(".FeasibilityAction").hide();
    $(".project_summary_id").val(id);
}

$("#forward_submit").submit(function(e) {
    e.preventDefault();
    if ($("#forward_submit")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    $("#replace" + $(".project_summary_id").val()).html(
                        '<span class="badge bg-success">Forwarded</span>'
                    );
                    $("#forwarded").modal("hide");
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#forward_submit").addClass("was-validated");
});

$("#revert_submit").submit(function(e) {
    e.preventDefault();
    if ($("#revert_submit")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    $("#replace" + $(".project_summary_id").val()).html(
                        '<span class="badge bg-success">Reverted</span>'
                    );
                    $("#Feasible").modal("hide");
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#revert_submit").addClass("was-validated");
});

if ($("#RegisteredInvestors").length) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/registeredInvestors/",
        success: function(res) {
            $("#RegisteredInvestors").html(res);
        },
    });
}

if ($("#FiledProjects").length) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/filedProjects/",
        success: function(res) {
            $("#FiledProjects").html(res);
        },
    });
}

$('button[type="reset"]').click(function(evt) {
    $("#preference_first option").removeAttr("disabled");
    $("#preference_second option").removeAttr("disabled");
    $("#preference_third option").removeAttr("disabled");
});

function getNativeOfup(value) {
    if (value == 2) {
        $("#nativealert").modal("toggle");
        $(".btn-info,.rounded-pill").prop("disabled", true);
    } else {
        $(".btn-info,.rounded-pill").prop("disabled", false);
    }
}

function getfileext(value, id) {

    var file_size = $("#File" + id)[0].files[0].size;
    // var file_size = value.files[0].size;

    var fileExtension = ["jpeg", "jpg", "pdf"];
    var filevalue = value;
    // var filevalue = value.value;
    if ($.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1) {
        $("#File" + id).val("");
        // $(this).value='';
        error("Please Upload File in Valid Format.");
    } else if (file_size > 2097152) {
        $("#File" + id).val("");
        error("File Size should not exceed 2 MB.");
    }
}
function getfileextp(value, id) {

   
    var file_size = $("#File" + id)[0].files[0].size;
    // var file_size = value.files[0].size;

    var fileExtension = ["pdf"];
    var filevalue = value;
    // var filevalue = value.value;
    if ($.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1) {
        $("#File" + id).val("");
        // $(this).value='';
        error("Please Upload File in Valid Format.");
    } else if (file_size > 2097152) {
        $("#File" + id).val("");
        error("File Size should not exceed 2 MB.");
    }
}

function getfileext3(value, id) {
    var fileExtension = ["jpeg", "jpg"];
    var filevalue = value.value;
    var file_size = value.files[0].size;
    if (
        $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
    ) {
        $("#File" + id).val("");
        $("#photo").attr("src", "");
        error("Please Upload File in Valid Format.");
    } else if (file_size > 2097152) {
        $("#File" + id).val("");
        $("#photo").attr("src", "");
        error("File Size should not exceed 2 MB.");
    } else {
        if (value.files && value.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#photo").css("display", "block");
                $("#photo").attr("src", e.target.result);
            };

            reader.readAsDataURL(value.files[0]);
        }
    }
}


function getfileext11(value, id) {

    var file_size = $("#File" + id)[0].files[0].size;

    var fileExtension = ["jpeg", "jpg"];
    if ($.inArray(value.split(".").pop().toLowerCase(), fileExtension) == -1) {
        $("#File" + id).val("");
        // $(this).value='';
        error("Please Upload File in Valid Format.");
    } else if (file_size > 2097152) {
        $("#File" + id).val("");
        error("File Size should not exceed 2 MB.");
    }
}

function getfileext2(value, id) {


    var fileExtension = ["jpeg", "jpg"];
    var file_size = value.files[0].size;
    var filevalue = value.value;
    if (
        $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
    ) {
        $("#File" + id).val("");
        $("#photo").attr("src", "");
        error("Please Upload File in Valid Format.");
    } else if (file_size > 2097152) {
        $("#File" + id).val("");
        $("#photo").attr("src", "");
        error("File Size should not exceed 2 MB.");
    } else {
        if (value.files && value.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#photo").css("display", "inline-block");
                $("#photo").attr("src", e.target.result);
            };

            reader.readAsDataURL(value.files[0]);
        }
    }
}


function getfileext25(value, id) {


    var fileExtension = ["jpeg", "jpg", "pdf"];
    var file_size = value.files[0].size;
    var filevalue = value.value;
    if (
        $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
    ) {
        $("#File" + id).val("");
        $("#sign").attr("src", "");
        error("Please Upload File in Valid Format.");
    } else if (file_size > 2097152) {
        $("#File" + id).val("");
        $("#sign").attr("src", "");
        error("File Size should not exceed 2 MB.");
    } else {
        if (value.files && value.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $("#sign").css("display", "inline-block");
                $("#sign").attr("src", e.target.result);
            };

            reader.readAsDataURL(value.files[0]);
        }
    }
}



// FileT3.onchange = evt => {
//     var value  = $('#FileT3').val();
//     var fileExtension = ['jpeg', 'jpg'];
//     alert($.inArray(value.split('.').pop().toLowerCase(), fileExtension));
//     // $("#sign").css("display", "block");
//     // $("#sign").attr('src','');
//     // if(FileT3.files.length){
//     //     const [file] = FileT3.files
//     //     if (file) {
//     //     sign.src = URL.createObjectURL(file)
//     //     }
//     // }

// }

function queryFormReply(type, id) {
    $.ajax({
        type: "POST",
        url: ajaxUrl + "/getReplyDetails",
        data: { type: type, id: id },
        success: function(res) {
            $("#query_form_reply").modal("show");
            $("#query_form_reply_append").html(res);
        },
    });
}

$(".query_form_marked").submit(function(e) {
    e.preventDefault();
    if ($(".query_form_marked")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    location.reload();
                    success(res.msg);
                    $("#query-form-marked-table").load(" #query-form-marked-table");
                    $(".please-load").load(" .please-load");
                    $(".query_form_marked").trigger("reset");
                    $("#query_form_marked").modal("hide");
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $(".query_form_marked").addClass("was-validated");
});

$("#post_detail").submit(function(e) {
    e.preventDefault();
    if ($("#post_detail")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {

                    // success(res.msg);
                    var data = res.data;
                    // console.log(res.data)
                    var span = "";
                    data.forEach((item) => {
                        ///setTimeout(() => {
                        // console.log(item['post_name'])
                        span += `<p>${item['post_name']}</p>`;

                        ///}, 20)
                    });
                    $("#post_details").empty();
                    $("#post_details").append(span);
                    $("#post_view").modal("show");
                    $("#lock").attr("href", res.url)
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#post_detail").addClass("was-validated");
});


function PrintDoc() {
    const today = new Date();
    const date = today.getDate() + "/" + today.getMonth() + "/" + today.getFullYear();
    const time =
        today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

    // document.getElementById("printDateTime").innerHTML = "Printed on: " + date + " at " + time;
    // $('#tableID').DataTable().destroy();
    $('.fa-download').text('Uploaded');
    var toPrint = document.getElementById('prodiv');

    var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

    popupWin.document.open();

    popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .img-query {width: 60px;   height: 60px; border-radius: 8px;} #logo{display:block !important; position: absolute; width: 70px; top: -7px; left: 0;} .bg-light{background-color: #dee2e6 !important; font-size: 14px !important;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:4px 5px; font-size: 12px;}</style></head><body onload="window.print()">')

    popupWin.document.write(toPrint.innerHTML);

    popupWin.document.write('</body></html>');

    popupWin.document.close();
    $('.fa-download').text('');

    // $('#tableID').DataTable();
}

function queryReply() {
    var formData = new FormData();
    var files = $(".query_doc_image_reply")[0].files;
    var queryMark = $("#is_mark_query_reply").val();
    var queryId = $("#queryIdReply").val();
    var queryType = $("#queryTypeReply").val();

    if (queryMark != "") {
        formData.append("query_doc", files[0]);
        formData.append("is_mark_query", queryMark);
        formData.append("queryId", queryId);
        formData.append("queryType", queryType);
        $.ajax({
            type: "POST",
            url: ajaxUrl + "/directMarkQuery",
            data: formData,
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    $(".directMarkQuery").trigger("reset");
                    $("#query-form-marked-table").load(" #query-form-marked-table");
                    queryFormReply(res.type, res.id);
                } else {
                    error(res.msg);
                }
            },
        });
    } else {
        error("Please Enter Details.");
    }
}

$('.role_manager_id').click(function() {
    var role_id = $(this).data('id');
    var role_name = $(this).data('name');
    $('#role_id').val(role_id);
    $('#role_name').val(role_name);
});

function appendImage(img, pdf) {
    $("#query_form_iamge").modal("show");
    if (pdf == "pdf") {
        $("#query_form_image_append").html('<iframe src="' + img + '" height="575"></iframe>');
    } else {
        $("#query_form_image_append").html('<img src="' + img + '" style="width: 656px;height: 575px;margin-left: 65px;"/>');
    }
}

$(".sport_type").attr("style", "pointer-events: none;");

function queryClosed(type, id) {
    // error("File Size should not exceed 2 MB.");
    $.ajax({
        type: "POST",
        url: ajaxUrl + "/admin/queryClosed",
        data: { type: type, id: id },
        success: function(res) {
            if (res.error == false) {
                location.reload();
                success(res.msg);
            }
        },
    });
}




function pageStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/pageStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}

function userManagerStatus(id) {
    $.ajax({
        type: "GET",
        url: ajaxUrl + "/admin/userManagerStatus/" + id,
        dataType: "json",
        success: function(res) {
            success(res.msg);
        },
    });
}
$('.module_select,.user_select,.role_select').change(function() {
    var module_select = $('.module_select').val();
    var user_select = $('.user_select').val();
    var role_select = $('.role_select').val();
    var checkBoxList = $('.CheckBoxList:checked').val();

    if ((role_select != '' || user_select != '') && module_select != '') {
        $.ajax({
            url: ajaxUrl + "/admin/userRolePageManagement",
            method: "post",
            data: {
                role: role_select,
                user: user_select,
                module: module_select,
                checked: checkBoxList
            },
            success: function(response) {

                var myObj = $.parseJSON(response);
                var check_data = '';

                var role_pages = [];
                $.each(myObj.role_module, function(key, val) {
                    role_pages.push(val.page_id);
                });
                if (myObj.module_pages != '') {

                    $.each(myObj.module_pages, function(i, val) {
                        if (role_pages.includes(val.id)) {
                            var checked = 'checked';
                        } else {
                            var checked = '';
                        }
                        check_data += '<a data-toggle="tooltip" data-placement="right"  title="' + val.page_url + '" href="javascript://"><label>' + val.page_name + '<input ' + checked + ' type="checkbox" class="checkBoxClass form-check-input" name="page_module[]" value="' + val.id + '"></label></a>';
                    });
                } else {

                }

                if (check_data != '') {
                    $('#sel_all').show();
                }

                $('.module_role_div').html(check_data).show();

                $(function() {
                    $('[data-toggle="tooltip"]').tooltip()
                });
            }
        });
    }
});

$("#form").submit(function(e) {
    e.preventDefault();
    console.log($("#form")[0].checkValidity())
    if ($("#form")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        // var actionUrl = ajaxUrl+"/admin/post_master_add";
        var general_post = parseInt($('#general_post').val());
        var obc_post = parseInt($('#obc_post').val());
        var sc_post = parseInt($('#sc_post').val());
        var st_post = parseInt($('#st_post').val());
        var ews_post = parseInt($('#ews_post').val());
        var pwd_post = parseInt($('#pwd_post').val());

        var total_post = parseInt($('#total_post').val());
        var cat_post_total = general_post + obc_post + sc_post + st_post + ews_post + pwd_post;

        // if (cat_post_total === total_post) {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    // window.location.reload();
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
        // }
        // else {
        //     error("Total Post And category Wise Post Not same.");
        // }
    }
    $("#form").addClass("was-validated");
});

function modalShow(modal) {
    $("#" + modal).show();
}

$('#ckbCheckAll').click(function(event) {
    if (this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
});

// $("#from_date").datepicker({ changeMonth: true, changeYear: true, minDate: '-60Y', maxDate: '0', dateFormat: 'dd-mm-yy' });
// $("#to_date").datepicker({ changeMonth: true, changeYear: true, minDate: '-60Y', maxDate: '0', dateFormat: 'dd-mm-yy' });

function tableRendor() {
    $("#dataTable").dataTable({
        "paging": false,
        "searching": false
    });
}


$('.datatable').DataTable({
    //"scrollY":"200px",
    "scrollCollapse": true,
    "paging": true,
    aLengthMenu: [
        [10, 25, 50, 100, 200, -1],
        [10, 25, 50, 100, 200, "All"]
    ],

    // iDisplayLength: 25
    iDisplayLength: -1
        //"scrollX": true,
});




$("#offlinePayment").submit(function(e) {
    e.preventDefault();
    if ($("#offlinePayment")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    // window.location.offlinePayment();
                    success(res.msg);

                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#offlinePayment").addClass("was-validated");

});



$("#formAccept").submit(function(e) {
    e.preventDefault();
    if ($("#formAccept")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {

                    // success(res.msg);
                    window.location.reload(true);

                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#formAccept").addClass("was-validated");

});




$("#formReject").submit(function(e) {
    e.preventDefault();
    if ($("#formReject")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {

                    // success(res.msg);
                    window.location.reload(true);

                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#formReject").addClass("was-validated");

});




//rso section

function forward(id) {
    $('.financial_forward').val(id);
	$('.reg_id').val($("#h" + id).data("reg_id"));
    $('.application_no').val($("#h" + id).data("application_no"));
    // change done as per subhi on 15-12-2023
    $(".remove_danger").text("");

    $("#File10").removeAttr("required");
    $(".remove_danger").removeAttr("required");


    console.log('gfdgdf')
    var type = $("#h" + id).data("data");
    var form_type = $("#h" + id).data("form_type");
    console.log(form_type)
    console.log(type)
    if (type == 0) {
        if(form_type == 6){
            $("#tt_ile").text("Examination Committee");
        }else{
        $("#tt_ile").text("Association");
        }
        $("#verification_document").text("Upload Relevant application verification document (if any)");
        $("#verification_document .text-danger").text("");

        $("#File10").removeAttr("required");


    }

    if(type == 1){
        if(form_type == 6){
            $("#tt_ile").text("Directorate");
        }else{
            $("#tt_ile").text("Dealing Assistance");
        }
    }
    if(type == 2){
        if(form_type == 6){
            $("#tt_ile").text("Dealing Assistance");
        }else{
            $("#tt_ile").text("Examination Committee");
        }
    }
    if(type == 3){
        $("#tt_ile").text("Association");
    }
    if(type == 5){
        $("#tt_ile").text("Directorate");
    }

    $('#forward_to').val(type);

   

}

function released(id) {
    $('.financial_released').val(id);
}


function set_reply_data(sender_id, reciever_id) {
    console.log(reciever_id)
    $(".remove_danger").text("");
    $(".remove_danger").removeAttr("required");
    $('.reciever_id').val(reciever_id);
    $('.sender_id').val(sender_id);
}

// $('.show_released_id').click( function () {
//     var idd = $( this ).data( 'id' );
//     $( '.financial_released' ).val( idd );
// } );

// $('.show_data_id').click( function () {
//     var idd = $(this).data('id');
//     console.log(idd)
//     $( '.financial_forward' ).val( idd );
// } );


function PrintIt(name) {
    // $('#tableID').DataTable().destroy();
    $('.fa-download').text('Uploaded');
    var toPrint = document.getElementById('prodiv');

    var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

    popupWin.document.open();

    popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .img-query {width: 60px;   height: 60px; border-radius: 8px;} #logo{display:block !important; position: absolute; width: 70px; top: -7px; left: 0;} .intentbtn { display: table; width: 100%; margin-bottom: 10px; margin-top: 5px; background-image: url(../images/corner-1.png); background-position: right top; background-size: contain; min-height: 100px; } a{ text-decoration: none; } .bg-light{background-color: #dee2e6 !important; font-size: 14px !important;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:4px 5px; font-size: 12px;}</style></head><body onload="window.print()"><div style="border-bottom: 0px solid #000; padding-bottom: 2vw; text-align:center;">  <div style="font-size: 25px; font-weight: bold;" text-align:center;>  Khel Sathi Portal / खेल साथी पोर्टल </div> <div style="text-align:center; font-size: 2vw; font-weight: bold;"> Government of Uttar Pradesh/उत्तर प्रदेश सरकार </div> <h3 style="text-align:center;">' + name + ' Dashboard Record</h3> </div>')

    popupWin.document.write(toPrint.innerHTML);

    popupWin.document.write('</body></html>');

    popupWin.document.close();
    $('.fa-download').text('');
    // $('#tableID').DataTable();
}


function ExportToExcel(title, type, fn, dl) {

    var elt = document.getElementById('dataTable');

    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }, { password: 'test1234' }) :
        XLSX.writeFile(wb, fn || (title + '.' + (type || 'xlsx')), { password: 'test1234' });
}

$("#inventory").submit(function(e) {
    e.preventDefault();
    if ($("#inventory")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    if (typeof(res.url) != "undefined" && res.url !== null) {
                        window.location.href = res.url;
                        success(res.msg);
                    } else {
                        window.location.reload();
                        success(res.msg);
                    }

                    // window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#inventory").addClass("was-validated");
});

$("#save_Template").submit(function(e) {
    e.preventDefault();
    if ($("#save_Template")[0].checkValidity() === false) {
        e.stopPropagation();
    } else {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
        }
        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function(res) {
                if (res.error == false) {
                    if (typeof(res.url) != "undefined" && res.url !== null) {
                        window.location.href = res.url;
                        success(res.msg);
                    } else {
                        window.location.reload();
                        success(res.msg);
                    }

                    // window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#save_Template").addClass("was-validated");
});


function orderDetails(id) {
    $.ajax({
        type: "POST",
        url: ajaxUrl + "/admin/orderDetails",
        data: { id: id },
        success: function(res) {
            $("#query_form_reply").modal("show");
            $("#query_form_reply_append").html(res);
        },
    });
}

function intentDetails(id) {
    $.ajax({
        type: "POST",
        url: ajaxUrl + "/admin/indentDetails",
        data: { id: id },
        success: function(res) {
            $("#query_form_reply").modal("show");
            $("#query_form_reply_append").html(res);
        },
    });
}

function indents_pending(id) {
    $.ajax({
        type: "POST",
        url: ajaxUrl + "/admin/indents_pending_to_process",
        data: { id: id },
        success: function(res) {
            $("#query_form_reply").modal("show");
            $("#query_form_reply_append").html(res);
        },
    });
}

function itemsDetails(orderNo, item_id, type) {
    $.ajax({
        type: "POST",
        url: ajaxUrl + "/admin/itemsDetails",
        data: { orderNo: orderNo, item_id: item_id, type: type },
        success: function(res) {
            $("#query_form_reply").modal("show");
            $("#query_form_reply_append").html(res);
        },
    });
}

function challanDetails(challan_no, item_id, type) {
    $.ajax({
        type: "POST",
        url: ajaxUrl + "/admin/challanDetails",
        data: { challan_no: challan_no, item_id: item_id, type: type },
        success: function(res) {
            $("#query_form_reply").modal("show");
            $("#query_form_reply_append").html(res);
        },
    });
}

// login with otp start

function validateEmailId(input_email) {
    var validChar = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (validChar.test(input_email) || input_email == "") {
        return true;
    } else {
        return false;
    }
}

$(document).ready(function() {
    $(".otplink").click(function() {
        console.log("heello")
        $('#password-field').removeAttr('required');
        $("#otp_data").prop('required', true);
        $('#err_invalid_log').hide();
        $('#type').val('0');
        var form_type = $('#form_type').val();
        if ($("#email").val() == "") {
            error('Please Enter Registered Email ID.');
            return false;
        }
        if ($("#email").val() != "") {
            var function_output = validateEmailId($("#email").val());
            if (function_output == false) {
                error('Please Enter Valid Email ID.');
                return false;
            } else {

                $.ajax({
                    url: ajaxUrl + "/checkEmailValidity",
                    type: 'post',
                    data: {
                        'email': $("#email").val(),
                        'form_type': form_type
                    },
                    // async: false,
                    success: function(result_data) {
                        if (!result_data) {
                            error('Please Enter Registered Email ID.');
                            return false;
                        } else {

                            setTimeout(function() {

                                $.blockUI({
                                    message: '<h1><img src="' +
                                        ajaxUrl +
                                        '/public/busy.gif" /> Please Wait...</h1>',
                                });

                            }, 100);


                            $.ajax({
                                url: ajaxUrl + "/checkandsendOTP",
                                type: 'post',
                                data: {
                                    'email': $("#email").val(),
                                    'form_type': form_type
                                },
                                // async: false,
                                success: function(result_data) {

                                    // if (result_data == 2) {
                                    // 	$(".popmain").hide();
                                    //     error('Please Enter Registered Email ID.');
                                    // 	$('#err_invalid_log').css('color', 'red').text('You have exceeded maximum login attempts. Please try again after some time.').show();
                                    // 	return false;
                                    // } else
                                    if (result_data == 1) {
                                        success('An OTP has been sent on registered Email ID & Mobile No. Kindly fill & verify it.');
                                        $("#email").attr("style", "pointer-events: none;background-image: none");
                                        $(".password, .otplink").addClass("hidefield");
                                        $(".enterotp, .passlink").addClass("showfield");
                                        $(".password, .otplink").removeClass("showfield");
                                        $("#type").val('0');
                                    } else {
                                        error('Some technical error occured. Please try again later.');
                                        return false;
                                    }

                                    setTimeout(function() {

                                        $.unblockUI({
                                            message: '<h1><img src="' +
                                                ajaxUrl +
                                                '/public/busy.gif" /> Please Wait...</h1>',
                                        });

                                    }, 100);

                                }
                            });

                        }
                    }
                });

            }
        }
    });

    function validateEmailId(input_email) {
        var validChar = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        if (validChar.test(input_email) || input_email == "") {
            return true;
        } else {
            return false;
        }
    }

    $(".passlink").click(function() {

        console.log('hello');
        $('#password-field').prop('required', true);
        $("#otp_data").removeAttr('required');
        $('#type').val('1');
        $('#succ_email').hide();
        $(".password, .otplink").addClass("showfield");
        $(".enterotp, .passlink").addClass("hidefield");
        $(".enterotp, .passlink").removeClass("showfield");

    });

    $('.resendotpLogin').click(function() {
        setTimeout(function() {
            var email = $("#email").val();
            var form_type = $('#form_type').val();
            $.ajax({
                url: ajaxUrl + "/checkandsendOTP",
                type: 'post',
                data: {
                    'email': email,
                    'form_type': form_type
                },
                // async: false,
                success: function(result_data) {
                    success('An OTP has been re-sent on registered Email ID & Mobile No. Kindly fill & verify it.');
                }
            });
        }, 50);
    });

});


// $('.alphanumeric').on('keypress', function (event) {
//     var regex = new RegExp("^[a-zA-Z0-9.]+$");
//     var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
//     if (!regex.test(key)) {
//        event.preventDefault();

//        return false;
//     }
// });
// $('input').bind('copy paste', function (e) {
//     e.preventDefault();
//  });

// login with otp end


jQuery('#ifscupper').keyup(function() {
    $(this).val($(this).val().toUpperCase());
});

function getBankDetails(bankifsc) {
    if (bankifsc == '') {
        alert("Please Enter IFSC Code.");
    } else {
        $.ajax({
            type: 'POST',
            url: ajaxUrl + "/financial-assistance/ifsc",
            data: {

                ifsc: bankifsc
            },
            dataType: "json",
            success: function(res) {
                if (res.error == false) {
                    console.log(res.data);
                    $("#bankName").val(res.data.BANK);
                    $('#bank_branch').val(res.data.BRANCH);
                } else {

                }
            }
        });
    }
};

function toDate(dateStr) {
    var parts = dateStr.split("-")
    return new Date(parts[2], parts[1] - 1, parts[0])
}

function toDatee(dateStr) {
    var parts = dateStr.split("/")
    return new Date(parts[2], parts[1] - 1, parts[0])
}

$(document.body).on('change', '.firstDate', function() {
    var selecteditem = $(this);
    $('.firstDate').each(function(index, value) {
        var item = $(this);
        if (item.val() != '' && (!selecteditem.is(item))) {
            if ((item.val()) === (selecteditem.val())) {
                selecteditem.val("");
                alert("Date Already Selected");
                return false;
            }
        }
    });
});

function checkDate(id) {
    console.log($('#doc' + id).val())
    var first = $('#doc' + id).val();
    var second = $('#' + id + 'to').val();
    if (second != "" && (toDate(first) > toDate(second))) {
        // $('#doc'+id).val('');
        $('#' + id + 'to').val('');
        alert("To date not less than From date");
        
    }
    return false;
};

$(document.body).on('change', '.datepicker-here', function(e) {

    var first = $('#from_date').val();
    var second = $('#to_date').val();
    console.log("first" + toDatee(first) + "second" + toDatee(second))
    if (second != "" && (toDatee(first) > toDatee(second))) {

        $('#to_date').val('');
        alert("To date not less than From date");
        return false;
    }
});

$(".dateTime").datepicker({
    changeMonth: true,
    changeYear: true,
    maxDate: '0',
    dateFormat: 'dd-mm-yy'
});
function toDatee(dateStr) {
    var parts = dateStr.split("-")
    return new Date(parts[2], parts[1] - 1, parts[0])
}
$(document.body).on('change', '.dateTime', function(e) {

var first = $('#from_date').val();
var second = $('#to_date').val();
console.log("first" + toDatee(first) + "second" + toDatee(second))
if (second != "" && (toDatee(first) > toDatee(second))) {

    $('#to_date').val('');
    alert("To date not less than From date");
    return false;
}
});