$(document).ready(function () {
    // Calculate the radius based on the screen width or other criteria
    var screenWidth = $(window).width();
    var radius = screenWidth < 1536 ? 150 : 260; 
		var width = screenWidth < 1536 ? 32 : 48;

    $("#slider").roundSlider({
    radius: radius,
    circleShape: "half-top",
    sliderType: "default",
    value: 51,
    showTooltip: true,
    width: width,
    drag: "traceEvent",
    create: "traceEvent"
  });
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

