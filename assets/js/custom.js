$(document).ready(function () {
  // Calculate the radius based on the screen width or other criteria
  var screenWidth = $(window).width();
  var radius = screenWidth < 1537 ? 150 : 220;
  var width = screenWidth < 1537 ? 32 : 36;

  $("#slider").roundSlider({
    radius: radius,
    circleShape: "half-top",
    sliderType: "default",
    value: 51,
    showTooltip: true,
    width: width,
    drag: "traceEvent",
    create: "traceEvent",
    change: "traceEvent",
  });

  // Check if the device is mobile
  function isMobileDevice() {
    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
  }

  // If it's not a mobile device, initialize scrollify
  if (!isMobileDevice()) {
    jQuery.scrollify({
      section: ".section-scrollify",
    });

    jQuery(function () {
      jQuery.scrollify({
        section: ".section-scrollify",
        sectionName: false,
        interstitialSection: "",
        easing: "easeOutExpo",
        scrollSpeed: 1100,
        offset: 0,
        scrollbars: true,
        standardScrollElements: "",
        setHeights: true,
        overflowScroll: true,
        updateHash: true,
        touchScroll: true,
        before: function () { },
        after: function () { },
        afterResize: function () { },
        afterRender: function () { },
      });
    });
  };
});


  function traceEvent(e) {
    let input = Number(document.querySelector("#slider").innerText);
    let output = calculateOutput(input)
    document.querySelector("#answer").innerText = output;
    document.querySelector("#answer2").innerText = calculateOutput2(output);
  }

  function calculateOutput(input) {
    return Number(2.6 * input + 140).toFixed(0);
  }
  function calculateOutput2(input) {
    return Number(input / 5).toFixed(0);
  }



