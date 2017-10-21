// Our labels and three data series
var data1 = {
  labels: [],
  series: [
    [5, 4, 3, 7, 5, 10]
  ]
};

var data2 = {
  labels: [],
  series: [
    [3, 2, 9, 5, 4, 6]
  ]
};

var data3 = {
  labels: [],
  series: [
    [2, 1, -3, -4, -2, 0]
  ]
};

// We are setting a few options for our chart and override the defaults
var options = {
  // Don't draw the line chart points
  showPoint: true,
  // Disable line smoothing
  lineSmooth: true,
  // X-Axis specific configuration
  axisX: {
    // We can disable the grid for this axis
    showGrid: true,
    // and also don't show the label
    showLabel: true
  },
  // Y-Axis specific configuration
  axisY: {
    // Lets offset the chart a bit from the labels
    offset: 10,
    // The label interpolation function enables you to modify the values
    // used for the labels on each axis. Here we are converting the
    // values into million pound.
    labelInterpolationFnc: function(value) {
      // return '$' + value + 'm';
      return value;
    }
  }
};

// All you need to do is pass your configuration as third parameter to the chart function
new Chartist.Line('.ct-chart1', data1, options);
new Chartist.Line('.ct-chart2', data2, options);
new Chartist.Line('.ct-chart3', data3, options);
