$(document).ready(function() {
    var brandPrimary = '#33b35a';
    var rate = number;
    var options = {
        line_width: 5,
        color: brandPrimary,
        percent: rate-20,
    }
    var progress_circle = $("#progress-circle").gmpc(options);
    progress_circle.gmpc('animate', rate, 1000);
});
