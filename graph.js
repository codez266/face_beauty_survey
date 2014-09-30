function drawGraph(data,selector){
	//var data = [4, 8, 15, 16, 23, 42];

		var x = d3.scale.linear()
    .domain([0, 5])//d3.max(data)
    .range([0, 500]);

    d3.select(selector)
  .selectAll("div")
    .data(data)
  .enter().append("div")
    .style("width", function(d) { return x(d) + "px"; })
    .text(function(d) { return d; }).append("span").html(function(d,i){return "#"+(i+1);});
}
function drawRatioGraph(data,selector){
	//var data = [4, 8, 15, 16, 23, 42];

		var x = d3.scale.linear()
    .domain([0, 100])
    .range([0, 500]);

    d3.select(selector)
  .selectAll("div")
    .data(data)
  .enter().append("div")
    .style("width", function(d) { return x(d) + "px"; })
    .text(function(d) { return d+"%"; }).append("span").html(function(d,i){return "#"+(i+1);});
}