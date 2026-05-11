$(document).ready(function() {
var allStates = $("#map-svg path");
allStates.on("click", function(idx) {
$(".dList > div").hide()
$(".dList #dData_"+$(this).index()).show();
allStates.removeAttr("class");
$(this).attr("class", "selected");
});

$svg = $("#map-svg-locations");
var wStatus = "shw";
var unsStatus = "shw";
var mceStatus = "shw";
var hStatus = "shw";
var htStatus = "shw";
var fStatus = "shw";

$(".unscoBtn").click(function(){
if(unsStatus=="shw")
{$(".unsco", $svg).attr('style', "fill:"+"url(#unscoBg);filter:"+"drop-shadow(5px 1px 0px rgb(115, 69, 0))");
$(this).addClass("CatSelected");
unsStatus = "clz";
}
else{$(".unsco", $svg).attr('style', "fill:"+"#FFD686");
$(this).removeClass("CatSelected");
unsStatus = "shw";}
});

$(".miceBtn").click(function(){
if(mceStatus=="shw")
{$(".mice", $svg).attr('style', "fill:"+"url(#miceBg);filter:"+"drop-shadow(5px 1px 0px rgb(115, 69, 0))");
$(this).addClass("CatSelected");
mceStatus = "clz";
}
else{$(".mice", $svg).attr('style', "fill:"+"#FFD686");
$(this).removeClass("CatSelected");
mceStatus = "shw";}
});

$(".htBtn").click(function(){
if(htStatus=="shw")
{$(".htrsr", $svg).attr('style', "fill:"+"url(#htBg);filter:"+"drop-shadow(5px 1px 0px rgb(115, 69, 0))");
$(this).addClass("CatSelected");
htStatus = "clz";
}
else{$(".htrsr", $svg).attr('style', "fill:"+"#FFD686");
$(this).removeClass("CatSelected");
htStatus = "shw";}
});

$(".wildBtn").click(function(){
if(wStatus=="shw")
{
//$('<pattern id="hBg" patternUnits="userSpaceOnUse" width="50" height="50"><image xlink:href="monu.png" x="" width="50" height="50" /></pattern>').appendTo(".wild");
//$(".wild", $svg).attr('style', "");
$(".wild", $svg).attr('style', "fill:"+"url(#wBg);filter:"+"drop-shadow(5px 1px 0px rgb(115, 69, 0))");
$(this).addClass("CatSelected");
wStatus = "clz";
}
else{$(".wild", $svg).attr('style', "fill:"+"#FFD686");
$(this).removeClass("CatSelected");
wStatus = "shw";}
});

$(".hrtgBtn").click(function(){
if(hStatus=="shw")
{$(".hrtg", $svg).attr('style', "fill:"+"url(#hBg)");
$(this).addClass("CatSelected");
hStatus = "clz";}
else{$(".hrtg", $svg).attr('style', "fill:"+"#FFD686");
$(this).removeClass("CatSelected");
hStatus = "shw";}
});

$(".fstvlBtn").click(function(){
if(fStatus=="shw")
{$(".hrtg", $svg).attr('style', "fill:"+"#0000FF");
$(this).addClass("CatSelected");
fStatus = "clz";}
else{$(".hrtg", $svg).attr('style', "fill:"+"#FFD686");
$(this).removeClass("CatSelected");
fStatus = "shw";}
});



});



var transformMatrix = [1, 0, 0, 1, 0, 0];
var svg = document.getElementById('map-svg');
var tooltip = svg.getElementById('tooltip');
var tooltipText = tooltip.getElementsByTagName('text')[0];
var tooltipRects = tooltip.getElementsByTagName('rect');
var triggers = svg.getElementsByClassName('territory');

var viewbox = svg.getAttributeNS(null, "viewBox").split(" ");
var centerX = parseFloat(viewbox[2]) / 2;
var centerY = parseFloat(viewbox[3]) / 2;
var matrixGroup = svg.getElementById("matrix-group");

for (var i = 0; i < triggers.length; i++) {
triggers[i].addEventListener('mousemove', showTooltip);
triggers[i].addEventListener('mouseout', hideTooltip);
}

function showTooltip(evt) {
var CTM = svg.getScreenCTM();
var x = (evt.clientX - CTM.e + 6) / CTM.a;
var y = (evt.clientY - CTM.f + 20) / CTM.d;
tooltip.setAttributeNS(null, "transform", "translate(" + x + " " + y + ")");
tooltip.setAttributeNS(null, "visibility", "visible");

tooltipText.firstChild.data = evt.target.getAttributeNS(null, "id");
var length = tooltipText.getComputedTextLength();
for (var i = 0; i < tooltipRects.length; i++) {
tooltipRects[i].setAttributeNS(null, "width", length + 8);
}
}
function hideTooltip(evt) {
tooltip.setAttributeNS(null, "visibility", "hidden");
}

/* */
var svgCat = document.getElementById('map-svg-locations');
var tooltipCat = svgCat.getElementById('tooltip');
var tooltipTextCat = tooltipCat.getElementsByTagName('text')[0];
var tooltipRectsCat = tooltipCat.getElementsByTagName('rect');
var triggersCat = svgCat.getElementsByClassName('territory');


for (var i = 0; i < triggersCat.length; i++) {
triggersCat[i].addEventListener('mousemove', showTooltipCat);
triggersCat[i].addEventListener('mouseout', hideTooltipCat);
}

function showTooltipCat(evt) {
var CTM = svgCat.getScreenCTM();
var x = (evt.clientX - CTM.e + 6) / CTM.a;
var y = (evt.clientY - CTM.f + 20) / CTM.d;
tooltipCat.setAttributeNS(null, "transform", "translate(" + x + " " + y + ")");
tooltipCat.setAttributeNS(null, "visibility", "visible");

tooltipTextCat.firstChild.data = evt.target.getAttributeNS(null, "id");
var length = tooltipTextCat.getComputedTextLength();
for (var i = 0; i < tooltipRectsCat.length; i++) {
tooltipRectsCat[i].setAttributeNS(null, "width", length + 8);
}
}

function hideTooltipCat(evt) {
tooltipCat.setAttributeNS(null, "visibility", "hidden");
}
