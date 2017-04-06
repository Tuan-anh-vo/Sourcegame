(function (lib, img, cjs, ss) {

var p; // shortcut to reference prototypes

// library properties:
lib.properties = {
	width: 1920,
	height: 900,
	fps: 25,
	color: "#FFFFFF",
	manifest: [
		{src:"images/bgg.jpg?1471839683871", id:"bgg"},
		{src:"images/image95.png?1471839683871", id:"image95"},
		{src:"images/text1.png?1471839683871", id:"text1"},
		{src:"images/trang1_1.jpg?1471839683871", id:"trang1_1"},
		{src:"images/volam.png?1471839683871", id:"volam"}
	]
};



// symbols:



(lib.bgg = function() {
	this.initialize(img.bgg);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,1920,900);


(lib.image95 = function() {
	this.initialize(img.image95);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,16,15);


(lib.text1 = function() {
	this.initialize(img.text1);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,390,39);


(lib.trang1_1 = function() {
	this.initialize(img.trang1_1);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,1920,900);


(lib.volam = function() {
	this.initialize(img.volam);
}).prototype = p = new cjs.Bitmap();
p.nominalBounds = new cjs.Rectangle(0,0,660,306);


(lib.sprite37 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 2
	this.instance = new lib.trang1_1();

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,0,1920,900);


(lib.sprite3 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 1
	this.instance = new lib.bgg();

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(0,0,1920,900);


(lib.shape70 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 2
	this.instance = new lib.text1();
	this.instance.setTransform(331.1,-398.5);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(331.1,-398.5,390,39);


(lib.shape31 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 4
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgKAAQAAgEADgDIAPgCIACACIABAHIgCAGIgJAEg");
	this.shape.setTransform(2.9,-97.8);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 3
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AgKAAQAAgEADgDIAPgCIABACIACAHIgCAGQgFADgEABg");
	this.shape_1.setTransform(34.4,-89.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 2
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AADAQQgUgLgdgFIgBgBIgBgHQAAgZAwAUQAxATAAAGQAAALgOAAQgQAAgQgHg");
	this.shape_2.setTransform(-39.3,-202.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 1
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AgXAdIgBgCIgBgHIAZgkQAageAAAjQAAAHgPAQQgNASgGAAg");
	this.shape_3.setTransform(86.1,-111.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-44.2,-204.4,133,116);


(lib.shape30 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 5
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgKAAQAAgPASAHIABACIACAGIgCAHIgJAEg");
	this.shape.setTransform(86.1,-27.6);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 4
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AAAAOQgNgIgVgEIgBgCIgCgFQAAgVAlANQAlAMABAJQAAALgOAAQgQAAgIgFg");
	this.shape_1.setTransform(-43.5,-198.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 3
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AgIAEIgCgEQAAgHAKgDQALgDAAANIgBAIIgKAEg");
	this.shape_2.setTransform(1,-87.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 2
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AgKAEIgCgEQAAgHACgCIAUgCIABADIACAHIgFAFIgIAIg");
	this.shape_3.setTransform(24.3,-99.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 1
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgNAHQgMgHAAgBQAAgNAOAAQAOABAXATQgEAJgPAAQgHAAgNgIg");
	this.shape_4.setTransform(62.5,-103.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-47.3,-200.5,134.5,174.1);


(lib.shape29 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 5
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgMAGQgigSAAgDQAAgXAuAWQAvATAAAMIgBAIIgDADIgJACQgMAAgigWg");
	this.shape.setTransform(-52.4,-190.1);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 4
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AgKAHQgLgGAAgCQAAgNAVAAQAWAAAAASQAAAKgCgCQABADgKAAQgKAAgLgIg");
	this.shape_1.setTransform(-15.4,-78.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 3
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AgKAIIABgTQAUgIAAATIgCAMQABACgKAAQgIAAgCgGg");
	this.shape_2.setTransform(17.7,-88);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 2
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AgUAAQAAgKAMgCQALgCARAOIgCAIQgBAFgIAAQgdAAAAgNg");
	this.shape_3.setTransform(50.6,-92.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 1
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgNAIQgFgGAAgGIABgMIAWAFQAOAGAAAHIgBAIIgCAEQgBADgKAAQgLAAgHgJg");
	this.shape_4.setTransform(72.4,-23.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-57.1,-192.9,131.5,171);


(lib.shape28 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 8
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgbAbQAAgNAbghQAcgiAAAhQAAAOgRANQgVATgGALg");
	this.shape.setTransform(125.4,-135.1);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 7
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AgfAHQgCgBAAgFQAAgKAhgBQAigBAAAMQAAAHgFACIgdACQgYAAgHgFg");
	this.shape_1.setTransform(67.8,-93.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 6
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AAIAJQgHgNgkAAIgBgCIAAgHQgBgUAlAMQAlALAAAUQAAAJgPAHQgGgBgIgQg");
	this.shape_2.setTransform(-55.2,-178.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 5
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AgZAaIAAgKQAAgOANgQQAOgWAVACIACADQABABAAAGQAAAEgNASQgNAPAAAKIAAAHIgDACIgJADQgLAAgCgJg");
	this.shape_3.setTransform(-14.2,-72.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 4
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgLAFIgHgSQAAgZASAXIATAbIgCAMQABADgLAAQgIAAgKgWg");
	this.shape_4.setTransform(11.2,-80.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

	// Layer 3
	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#000000").s().p("AgLAFIgBgIIABgJIAQACQAIAFAAAHQAAAKgCgCQAAADgKAAQgIAAgEgIg");
	this.shape_5.setTransform(40.3,-87.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_5).wait(1));

	// Layer 2
	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#000000").s().p("AgXAMQgMgPAAgOIABgUQAXADgBARQgBAPAeAAQANAAAGAYQAAAQgMAAQgeAAgRgag");
	this.shape_6.setTransform(39.2,-85);

	this.timeline.addTween(cjs.Tween.get(this.shape_6).wait(1));

	// Layer 1
	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#000000").s().p("AgSAEIgDgKIABgIIAYAGQATAHAAAFQAAALgOAAQgTAAgIgLg");
	this.shape_7.setTransform(65.6,-23.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_7).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-59,-180.8,187.3,158.5);


(lib.shape27 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 15
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgKAAQAAgEADgDIAPgCIABACIACAHIgCAGIgJAEg");
	this.shape.setTransform(108.1,-155.6);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 14
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AgJAHIgBgHQAAgPAKABQALABAAANQAAANgLACQgHgDgCgFg");
	this.shape_1.setTransform(126,-127.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 13
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AgLAHIgBgHQAAgQAMABQANABAAAOIgCANQAAAEgKAAQgIAAgEgKg");
	this.shape_2.setTransform(108.7,-103.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 12
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AgSANIgDgXQAAgOALgKQAKgKAAAeQAAAOALALIALAPQAAALgNAAQgTAAgIgYg");
	this.shape_3.setTransform(64,-94.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 11
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgMAXIgEgEIAAgdQAOgPAPADIACADIACAHIgNAfIgCADIgGACg");
	this.shape_4.setTransform(37.3,-141);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

	// Layer 10
	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#000000").s().p("AgFAIQgcgMAAgDQAAgXAhARQAiAPAAAIQAAALgOAAg");
	this.shape_5.setTransform(-52.2,-168.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_5).wait(1));

	// Layer 9
	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#000000").s().p("AgJAFIgDgHIABgGIABgCIARgBQAGADAAAIIgBAHIgCACQgCADgGAAQgHAAgEgHg");
	this.shape_6.setTransform(-47.9,-51.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_6).wait(1));

	// Layer 8
	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#000000").s().p("AgGAGIgIgPQAAgOAOADQAPADAAARQAAAWgMAAQgDAAgGgQg");
	this.shape_7.setTransform(-17.3,-79.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_7).wait(1));

	// Layer 7
	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.f("#000000").s().p("AgNAGQgIgGAAgGIAAgGIACgDIAdAFQAMAEAAAIIgBAJIgCACIgIADQgNAAgLgKg");
	this.shape_8.setTransform(-14.2,-66.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_8).wait(1));

	// Layer 6
	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.f("#000000").s().p("AgJAJIgFgMQABgdANASQAHAKAHANIAAAGIgDAFIgIACQgFAAgHgNg");
	this.shape_9.setTransform(9.7,-76.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_9).wait(1));

	// Layer 5
	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.f("#000000").s().p("AguACIgBgCIgBgFQAAgIAHgCIAlAAQAqADALAQIgCAIQgDAEgKAAg");
	this.shape_10.setTransform(34.8,-94.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_10).wait(1));

	// Layer 4
	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.f("#000000").s().p("AgZAFIgCgGQAAgKAHgBQALgDAiAKIACACIABAGQAAAHgEACIgTACQgXAAgHgJg");
	this.shape_11.setTransform(32.3,-81.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_11).wait(1));

	// Layer 3
	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.f("#000000").s().p("AgOAKIgBgCIgBgHQABgFAHgFIAWgCIACADIABAHQgBAEgFAEQgGAFgFAAg");
	this.shape_12.setTransform(126.9,-36.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_12).wait(1));

	// Layer 2
	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.f("#000000").s().p("AgKAAQAAgEADgEIAPgBIABACIACAHIgCAGIgJAEg");
	this.shape_13.setTransform(129,-37.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_13).wait(1));

	// Layer 1
	this.shape_14 = new cjs.Shape();
	this.shape_14.graphics.f("#000000").s().p("AgKAJIgBgCIgBgHQAAgNAWAFIACACIABAGQAAALgNAAg");
	this.shape_14.setTransform(60,-21.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_14).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-55.6,-170.6,185.8,150.5);


(lib.shape26 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 14
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgogLQAAgIAGgDQAHgEANAIQgJhdAeA5QAQAcASAuIAAALQgDAIgIAFIAFAIIACAKIgBALIgCACIgIACg");
	this.shape.setTransform(-34.3,-190.4);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 13
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AgUAQIgDgjQAAgFgEgDQgEgDAAgFQAAghAfAgQAgAgAAARQAAALgbAcQgRAAgIgkg");
	this.shape_1.setTransform(-51.2,-145);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 12
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AACAMQgUgKgUAAIgBgCIgBgFQAAgaAoAPQApAOAAANQAAAKgBgBQgCADgKAAQgDAAgXgLg");
	this.shape_2.setTransform(33.3,-131);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 11
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AgIAHQgMgHAAgBQAAgOAOABQANABAOARIgFAGQgEAFgFAAQgFAAgKgIg");
	this.shape_3.setTransform(-14,-95.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 10
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgZAAQAAgHAFgDIAUgCIAXACIACADQABABAAAGQAAADgGAFQgGAFgJAAQgeAAAAgNg");
	this.shape_4.setTransform(-46.9,-47.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

	// Layer 9
	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#000000").s().p("AgNAGIgMgPQAAgXAZARQAaAQAAAIIAAAJIgCADIgJACQgOAAgOgRg");
	this.shape_5.setTransform(-22.9,-37.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_5).wait(1));

	// Layer 8
	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#000000").s().p("AgZgRIABgIQAVgCAOAOQAPANAAANIgBAJIgCADIgIACg");
	this.shape_6.setTransform(-15.7,-53.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_6).wait(1));

	// Layer 7
	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#000000").s().p("AgQAGIgLgSQAAgcAbAYQAcAXAAAKQAAALgNAAQgQAAgPgWg");
	this.shape_7.setTransform(-16.3,-70.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_7).wait(1));

	// Layer 6
	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.f("#000000").s().p("AgPAJQgKgPAAgGQAAgeAWAWIAdAmIgEAIQgDAFgKAAQgLAAgNgWg");
	this.shape_8.setTransform(9,-67.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_8).wait(1));

	// Layer 5
	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.f("#000000").s().p("AgMAGQgHgKgBgIQABgWATAOQAVAOAAARQAAAIgMAIQgLgHgKgOg");
	this.shape_9.setTransform(22.5,-68.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_9).wait(1));

	// Layer 4
	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.f("#000000").s().p("AgJAcQgIgMAIgOIgVgOQgIgGAAgIQAAggAmAnQAnAlAAAMQAAAMgPAAQgYAAgJgOg");
	this.shape_10.setTransform(30.8,-86.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_10).wait(1));

	// Layer 3
	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.f("#000000").s().p("AgbAHQgCgCAAgEQAAgKAdgBQAegBAAAMQAAAHgFACIgZACQgVAAgGgFg");
	this.shape_11.setTransform(56.9,-85.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_11).wait(1));

	// Layer 2
	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.f("#000000").s().p("AgQAJIgBgCIgBgHQABgGAHgCQAHgCATACIABACIABAGIgBAGIgBADIgQABg");
	this.shape_12.setTransform(119.9,-33.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_12).wait(1));

	// Layer 1
	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.f("#000000").s().p("AgXAAQAAgLALgBQAMgCAYAPQgBAIgDACIgNACQgeAAAAgNg");
	this.shape_13.setTransform(49.1,20.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_13).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-54.4,-198.1,176.3,220.3);


(lib.shape25 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 22
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgyAHIgCgGQAAgKA0gBQA1gBAAAMQAAAIgFABIgwACg");
	this.shape.setTransform(-61.7,51.3);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 21
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AghAcQAAgHAXgaQAYggARAAIABACIACAHQgiA7gVAHQgMgJAAgBg");
	this.shape_1.setTransform(85.3,-130.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 20
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AgUAKIgHgyQAAgYAWAGQAUAHACAbQAAAYAFASQAGAUAAAKQAAAFgDADQgDAEgFAAQgYAAgNgyg");
	this.shape_2.setTransform(-32.2,-172.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 19
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AAFAcQgFAPgGAAQgJAAgfhNQAAgVAuAnQAvAkAAAMIgBAGIgBADIgOACQgPAAgLgPg");
	this.shape_3.setTransform(-47.4,-130);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 18
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgIAHQgIgUAAgPIABgNQAXgCAHAgQADAOgCARIAAAMQgDAIgIACQgHgQgGgTg");
	this.shape_4.setTransform(31.6,-122.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

	// Layer 17
	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#000000").s().p("AgJAHIgUgOQAAgSAYAIQATAHAQARIgDAJQgBAFgIAAQgIAAgTgOg");
	this.shape_5.setTransform(4.8,-113.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_5).wait(1));

	// Layer 16
	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#000000").s().p("AgJAGQgWgMAAgGIAAgGIACgCQAHgBAYANQAaALAEAFIgCAIQgCAFgIAAQgJAAgUgPg");
	this.shape_6.setTransform(0.8,-119.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_6).wait(1));

	// Layer 15
	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#000000").s().p("AgdgOQAAgaAdAWQAeAVAAANIgBAIIgCADIgJACg");
	this.shape_7.setTransform(-12.3,-85.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_7).wait(1));

	// Layer 14
	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.f("#000000").s().p("AgLAEIgJgMIABgGIABgCQAMAAAMAKQAPAHAAAGQAAAKgOABQgIgBgKgNg");
	this.shape_8.setTransform(-15.9,-91);

	this.timeline.addTween(cjs.Tween.get(this.shape_8).wait(1));

	// Layer 13
	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.f("#000000").s().p("AgNAGIgQgOQAAgZAdAUQAeATAAAGQAAALgNAAQgNAAgRgRg");
	this.shape_9.setTransform(-45,-44.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_9).wait(1));

	// Layer 12
	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.f("#000000").s().p("AgIAHQgLgHAAgBQAAgOANABQAMABAOAOIgCAIQgCAGgHAAQgIAAgJgIg");
	this.shape_10.setTransform(-23.9,-35.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_10).wait(1));

	// Layer 11
	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.f("#000000").s().p("AgfgOQAAgaAfAWQAgATAAANIgBAIIgBAEQAAADgKAAQgJAAgqgrg");
	this.shape_11.setTransform(-16.7,-47.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_11).wait(1));

	// Layer 10
	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.f("#000000").s().p("AghgDQAAgQAYAGQANAEAeANQgBAIgDACIgOACQgxAAAAgTg");
	this.shape_12.setTransform(-19.1,-66.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_12).wait(1));

	// Layer 9
	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.f("#000000").s().p("AgJAEIgIgNIAAgFIACgDQAiADAAAUQAAAKgCgBQAAACgKAAQgHAAgJgNg");
	this.shape_13.setTransform(7.5,-60.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_13).wait(1));

	// Layer 8
	this.shape_14 = new cjs.Shape();
	this.shape_14.graphics.f("#000000").s().p("AgMAAQAAgTAMAAQANgBAAASQAAAGgEAHQgFAHgEACQgMgKAAgKg");
	this.shape_14.setTransform(16.8,-60.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_14).wait(1));

	// Layer 7
	this.shape_15 = new cjs.Shape();
	this.shape_15.graphics.f("#000000").s().p("AgOAIQgHgJAAgDQAAgIAVgIQAWgHAAAeIgBALQgDAIgPAAQgHAAgKgOg");
	this.shape_15.setTransform(27.2,-79.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_15).wait(1));

	// Layer 6
	this.shape_16 = new cjs.Shape();
	this.shape_16.graphics.f("#000000").s().p("AgPAFQgGgIAAgFIABgKQAKgBAPAKQARAJAAAIQAAALgNAAQgOAAgKgOg");
	this.shape_16.setTransform(53.4,-81.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_16).wait(1));

	// Layer 5
	this.shape_17 = new cjs.Shape();
	this.shape_17.graphics.f("#000000").s().p("AgPAHIAAgLIAAgOQAPAAAIAJQAJAIAAAFIgBAIIgCAEQgBADgKAAQgNAAgFgMg");
	this.shape_17.setTransform(55.2,-80.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_17).wait(1));

	// Layer 4
	this.shape_18 = new cjs.Shape();
	this.shape_18.graphics.f("#000000").s().p("Ag4AbIgBgBIgBgHQABgEAugUQAwgXATAAIABADIABAHQAAAMhhAjg");
	this.shape_18.setTransform(122,-33.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_18).wait(1));

	// Layer 3
	this.shape_19 = new cjs.Shape();
	this.shape_19.graphics.f("#000000").s().p("AgOAIIgBgCIAAgGQgBgHAIgCIAWAAIACADIABAGIgBAFIgCADIgOACg");
	this.shape_19.setTransform(108.7,-35.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_19).wait(1));

	// Layer 2
	this.shape_20 = new cjs.Shape();
	this.shape_20.graphics.f("#000000").s().p("AgWAHIgFgHQAAgZA3AZIgDAIQgBAFgIAAQgcAAgKgGg");
	this.shape_20.setTransform(-41.3,15.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_20).wait(1));

	// Layer 1
	this.shape_21 = new cjs.Shape();
	this.shape_21.graphics.f("#000000").s().p("AgKAFIgCgFQAAgGACgCQAEgGAQAEIABADIACAHIgEAFIgJAIg");
	this.shape_21.setTransform(46.8,22.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_21).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-67,-178.4,195,231);


(lib.shape24 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 27
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgaBCIAChUQAGgkAUABIABguQAWgCADAVIgDAYQAAAvgEAUQgGAqgTAGQAAAIAKAYQgEAKgHAAQgSAAgDgjg");
	this.shape.setTransform(84.3,-154.8);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 26
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AgXAGQAAgGAMgJQAOgKASAFIACADIABAHQAAAGgKAEIgaAKg");
	this.shape_1.setTransform(77.9,-117.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 25
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AgQAfQAJgdAHgTQARgrAAAkQgDA3gSALg");
	this.shape_2.setTransform(28.1,-102.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 24
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AgKAEIgEgdIAAgGIACgCQAagCABAWIgBAkIgBAHQgCAFgKAAQgGAAgFgfg");
	this.shape_3.setTransform(28,-102.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 23
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgVgaIABgJQAqAMAAArIgBAJIgCAFQACACgKAAQgCAAgeg+g");
	this.shape_4.setTransform(11.2,-73.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

	// Layer 22
	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#000000").s().p("AgMAIIgHghQAAgnATAtIAUAzIAAAHIgCADIgNACQgHAAgKgkg");
	this.shape_5.setTransform(0,-98.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_5).wait(1));

	// Layer 21
	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#000000").s().p("AgMAOIgLhEQAAgtANAYQAMAYAAAlIAWBWIAAAGIgDAEIgIACQgNAAgMhGg");
	this.shape_6.setTransform(-45.9,-182);

	this.timeline.addTween(cjs.Tween.get(this.shape_6).wait(1));

	// Layer 20
	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#000000").s().p("AgNAHIgIgtIABgOQAagCALAuQAFAUAAAeQAAAKgCgBQgBACgKAAQgLAAgLgug");
	this.shape_7.setTransform(-48.4,-183.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_7).wait(1));

	// Layer 19
	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.f("#000000").s().p("AgLAqIgHgOQAEgdAAgRIgCgZQABgQAQAFQAMAZAEAbQACAMgBAhIAAAGIgDAFIgIACQgJAAgJgOg");
	this.shape_8.setTransform(-26,-129);

	this.timeline.addTween(cjs.Tween.get(this.shape_8).wait(1));

	// Layer 18
	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.f("#000000").s().p("AgMALIgcgxQAAg1AoBBQAUAfAVAsQAAAFgDAEQgDAFgHAAQgLAAgdg0g");
	this.shape_9.setTransform(-41.6,-95.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_9).wait(1));

	// Layer 17
	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.f("#000000").s().p("AgBAfIABgJIAGgFQgtgtAAgQQABglAmAzQAoAxgBAYIAAANIgCACIgJACg");
	this.shape_10.setTransform(-44,-94.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_10).wait(1));

	// Layer 16
	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.f("#000000").s().p("AAJAlQgOgQAGgQQgJgBgYgRQgXgTAAgEQAAgjA3AwQA4AuAAASQAAAKgCgCIgNADQgRAAgPgPg");
	this.shape_11.setTransform(-15.7,-72.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_11).wait(1));

	// Layer 15
	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.f("#000000").s().p("AgsgbQAAgnAsAvQAtAtAAAJQAAAKgBgBQgCACgKAAg");
	this.shape_12.setTransform(9.7,-47.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_12).wait(1));

	// Layer 14
	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.f("#000000").s().p("AgLAHIgHgZQABgfARAdQATAcgBAKQAAAHgBADIgDAFQADACgKAAQgKAAgIgcg");
	this.shape_13.setTransform(-15,-46);

	this.timeline.addTween(cjs.Tween.get(this.shape_13).wait(1));

	// Layer 13
	this.shape_14 = new cjs.Shape();
	this.shape_14.graphics.f("#000000").s().p("AgFADQgWgQAAAEQAAgRAWAGQAWAHALAYIgCAHIgBACIgIACg");
	this.shape_14.setTransform(-43.6,-58.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_14).wait(1));

	// Layer 12
	this.shape_15 = new cjs.Shape();
	this.shape_15.graphics.f("#000000").s().p("AAKARQgEgKgGAAQgDAAgDAEQgDAEgFAAQgLAAgHgNIgEgNQAAgYAkARQAmASgBAPQAAAIgEACIgJABQgJAAgFgJg");
	this.shape_15.setTransform(-64,-58.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_15).wait(1));

	// Layer 11
	this.shape_16 = new cjs.Shape();
	this.shape_16.graphics.f("#000000").s().p("AgPAEIgSgVIABgIQAQgFAQASQAVAWANAFQgBAMgLAAQgRAAgUgXg");
	this.shape_16.setTransform(-40.4,-29.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_16).wait(1));

	// Layer 10
	this.shape_17 = new cjs.Shape();
	this.shape_17.graphics.f("#000000").s().p("AghASQgEgEAAgNIABgPIADgCIAIgCQAIAAADAKQACAIgBACIADADIAKACQALAAAEglQARgFAEAIQACADAAAMIgEAjQAAAHgFACIgSABQgiAAgKgPg");
	this.shape_17.setTransform(-25.2,-26.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_17).wait(1));

	// Layer 9
	this.shape_18 = new cjs.Shape();
	this.shape_18.graphics.f("#000000").s().p("AgLAJIgQgbQAAgJAXgJQAVgKAAAhIALAlIgDAMQgCAEgIAAQgKAAgQgfg");
	this.shape_18.setTransform(48.3,-66.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_18).wait(1));

	// Layer 8
	this.shape_19 = new cjs.Shape();
	this.shape_19.graphics.f("#000000").s().p("AgPANIgBgHQABgOAPgJQAQgJABAUQgBAGgFAFIgPAQQgJgDgCgFg");
	this.shape_19.setTransform(209.4,-20.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_19).wait(1));

	// Layer 7
	this.shape_20 = new cjs.Shape();
	this.shape_20.graphics.f("#000000").s().p("AgrAMQgBABAAgKQAAgIANgDIBJgFIABADIACAHQAAAFgLAEQgSAIglAAg");
	this.shape_20.setTransform(207.7,-21.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_20).wait(1));

	// Layer 6
	this.shape_21 = new cjs.Shape();
	this.shape_21.graphics.f("#000000").s().p("AgoAJQgCgBAAgFQAAgIANgEIBGgEIABACIABAIQAAAFgLAFQgPAHgaAAQgZAAgGgFg");
	this.shape_21.setTransform(199.1,-28.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_21).wait(1));

	// Layer 5
	this.shape_22 = new cjs.Shape();
	this.shape_22.graphics.f("#000000").s().p("AglAPQgBABAAgKQAAgLAmgIQAngIAAARQAAAEhAARg");
	this.shape_22.setTransform(144.8,-44.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_22).wait(1));

	// Layer 4
	this.shape_23 = new cjs.Shape();
	this.shape_23.graphics.f("#000000").s().p("AgdAKQgCgBAAgFQAAgHAfgJQAggIAAAUQAAAGgGADQgIAGgYAAQgRAAgGgFg");
	this.shape_23.setTransform(133.4,-28.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_23).wait(1));

	// Layer 3
	this.shape_24 = new cjs.Shape();
	this.shape_24.graphics.f("#000000").s().p("AggAMIgDgGQABgKAVgGIAtgJIACADIABAHQABAJgYAIIgjAMg");
	this.shape_24.setTransform(98.1,-31.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_24).wait(1));

	// Layer 2
	this.shape_25 = new cjs.Shape();
	this.shape_25.graphics.f("#000000").s().p("AgfAKIAAgIQAAgKAKgFIAygDIABABIACAIQAAAGgTAIQgSALgOAAQgKAAgCgIg");
	this.shape_25.setTransform(42.6,2.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_25).wait(1));

	// Layer 1
	this.shape_26 = new cjs.Shape();
	this.shape_26.graphics.f("#000000").s().p("AgNAFIgZgQQAAgXAmAVQAnASAAAIQAAAHgEADIgLABQgKAAgbgTg");
	this.shape_26.setTransform(-38.7,21.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_26).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-67.8,-190.5,280,214.9);


(lib.shape23 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 56
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgqAQIgBgHQAAgKAYgHQATgHAUAAIAMgGQAMgFAAALQAAADgjARQghASgHAAQgIAAgDgHgAgVAEIAAACIAJgDIAEgDg");
	this.shape.setTransform(153.8,5.9);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 55
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("AgKAGIAAgEQAAgLATABIABABIABAEIgPANQgFAAgBgEg");
	this.shape_1.setTransform(171.9,-7.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 54
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AgiAVQgBgHAegTQAcgVALAAIABABIABAFQAAADgeATQgaAUgIAEg");
	this.shape_2.setTransform(184,-5.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 53
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AhUAbQgBAAAAAAQAAgBAAAAQAAgBAAgBQAAgBAAgBQAAgNBVgVQBWgXAAAOQAAAChYAUIhLAbg");
	this.shape_3.setTransform(156.1,4);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 52
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgVAUQAAABAAgBQgBAAAAAAQAAgBAAgBQAAgBAAgBQAAgDARgPQARgSAJAAIABABIABADQAAAEgmAhg");
	this.shape_4.setTransform(125.3,-25.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

	// Layer 51
	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#000000").s().p("Ag2AOQAAgJA2gMIA2gMIABABIAAAEQAAAJgyALIg1AOg");
	this.shape_5.setTransform(112.3,-14.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_5).wait(1));

	// Layer 50
	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#000000").s().p("AgWAKQAAAAAAAAQgBAAAAgBQAAAAAAgBQAAgBAAgBQAAgFAXgKIAYgBQAAAHgMAGQgMAIgQAAg");
	this.shape_6.setTransform(98.4,-15.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_6).wait(1));

	// Layer 49
	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#000000").s().p("AgaAhQAAAAgBAAQAAAAAAgBQAAAAAAgBQAAgBAAgBIAWgdQAUgYABgIQAMgEAAAMQAAAFgPATQgOAQAAAEQAAAEgSAKg");
	this.shape_7.setTransform(91.4,-29);

	this.timeline.addTween(cjs.Tween.get(this.shape_7).wait(1));

	// Layer 48
	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.f("#000000").s().p("AgNAJIABgSIALABIACgEIALgEIABABIABAEQAAAHgSAVQgHAAgCgIg");
	this.shape_8.setTransform(92.9,-29.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_8).wait(1));

	// Layer 47
	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.f("#000000").s().p("AgjAmIAAgGIADgHQADgEAAgHIgDgDIgFAMQgDAJgIAAQgHAAgDgFIgCgFIAHgLIAHgKIAAgBIgFAGQgDAEgEAAQgHAAgCgGIgBgEQAAgMAOgGIAVgJQAVgPAGABIAGAEQAIAAgCALQgDAQADAFIAbgQQAWgMAEAAQANAAgDAMQAAAVgjALQgJADgIANQgJALgGAAIgKgCIgKgFQgDAMgHAAQgGAAgBgFgAATAAQAJABAMgFIAPgLIgBAAQgRADgSAMg");
	this.shape_9.setTransform(91.2,-40.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_9).wait(1));

	// Layer 46
	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.f("#000000").s().p("AgNAWIAAgFIgHAEIgHACQgHAAgBgDIAAgFQAAgKALgFQAJgFANAAQADAAAWgQQANgKAAAXQAAAIgGAIQgIANgSAAIgKAEQgGAAgBgDg");
	this.shape_10.setTransform(76.9,-41.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_10).wait(1));

	// Layer 45
	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.f("#000000").s().p("AgMBoIgDgCIAAgMIAAgBIgEAEIgGAEIgGgGIAEheIACgBIAEgCQAJAAAAAJIgBAPQAHgpAFgUQAGggANgdQAJASADAYIACAoQAAAegIAFIgIgMIgCgHIgLAxQgFAjgBAYQAAACgFAAg");
	this.shape_11.setTransform(72.6,-76.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_11).wait(1));

	// Layer 44
	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.f("#000000").s().p("AgXARIABgIIgEgIIAFgJQAIgLAIgDQAIgEAYAXQAAAEgIAAQgGAAgHgDIgGgHQgCADgEAPQgFAPgDAAQgIAAgBgHg");
	this.shape_12.setTransform(58.2,-63.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_12).wait(1));

	// Layer 43
	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.f("#000000").s().p("AgXAXIgKgSQAAgHAMACIADgbQAEgQANADIABAQQABAJAFACIAUANIAIALIgBAFQAAADgFAAQgFAAgEgIIgGgLQgJAHABAFIADALQAAASgOAAQgGAAgLgSg");
	this.shape_13.setTransform(42.1,-68.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_13).wait(1));

	// Layer 42
	this.shape_14 = new cjs.Shape();
	this.shape_14.graphics.f("#000000").s().p("AgTAcIgGgGIAEgLIgFgGQgFgDgBgCQAAgHAUACIgBgSIABgBIAFgCQAHAAAHALIAJANIAAgUQAAgMAPACIABABIAAAEIgEAbQgEAUgGAAQgHAAgBgHIgFgKQgEAEgBAOQgBAMgIAAQgEAAgGgFg");
	this.shape_14.setTransform(24.6,-66.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_14).wait(1));

	// Layer 41
	this.shape_15 = new cjs.Shape();
	this.shape_15.graphics.f("#000000").s().p("AgaAIIABgVIAFgBIAGACQAEgNAEAAQAFgCACAQIAMgEQAPAAAAAKQAAAHgHAAQgCAAgCgCIgDgCIgDAIQgEAJgFAAQgFAAgBgEIgBgHQgDADAAAKQgBAIgGABQgLgHAAgLg");
	this.shape_15.setTransform(44.8,-53.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_15).wait(1));

	// Layer 40
	this.shape_16 = new cjs.Shape();
	this.shape_16.graphics.f("#000000").s().p("AgIACIAAgDQAAgNAIAJIAJAJQAAAGgHAAQgHAAgDgIg");
	this.shape_16.setTransform(28,-33.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_16).wait(1));

	// Layer 39
	this.shape_17 = new cjs.Shape();
	this.shape_17.graphics.f("#000000").s().p("AgGAWIgBgFIADgnQAJgBACAMIABAMIgCANQgDAJgDAAg");
	this.shape_17.setTransform(29.5,-34.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_17).wait(1));

	// Layer 38
	this.shape_18 = new cjs.Shape();
	this.shape_18.graphics.f("#000000").s().p("AgGAMIgIgLIAAgHIACgBIAFgCQAEAAADAGIACAGIADgYQAIACACAIIAAAYQgBAJgHAAQgHAAgGgKg");
	this.shape_18.setTransform(30.4,-36.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_18).wait(1));

	// Layer 37
	this.shape_19 = new cjs.Shape();
	this.shape_19.graphics.f("#000000").s().p("AgKgSIAAgHQAPAHAEAHIACARIAAASIgGACg");
	this.shape_19.setTransform(19.8,-23.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_19).wait(1));

	// Layer 36
	this.shape_20 = new cjs.Shape();
	this.shape_20.graphics.f("#000000").s().p("AAOALIgJgNIABAMQgBAMgFAAQgFAAgDgIIgEgIIgBAMQAAAAAAABQAAAAgBAAQAAAAgBABQgBAAgCAAQgJAAgIgnQABgIAiAMQAjAMAAARIAAAHQgBADgEAAQgJAAgHgNg");
	this.shape_20.setTransform(19.8,-36.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_20).wait(1));

	// Layer 35
	this.shape_21 = new cjs.Shape();
	this.shape_21.graphics.f("#000000").s().p("AgGANIgFgIQAAgFAJAAQgCgGAAgFQACgKAMACIABABIABAEIgDATIAAAKQgBAFgGAAQgCAAgGgHg");
	this.shape_21.setTransform(31.1,-17.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_21).wait(1));

	// Layer 34
	this.shape_22 = new cjs.Shape();
	this.shape_22.graphics.f("#000000").s().p("AgMATIgFgHIABgFIAOABQADAAADgCIAAgHIgIgIQgDgBAAgHQAAgNALAJQAOAIAAANQAAAGgGAJQgHAKgHAAQgEAAgGgGg");
	this.shape_22.setTransform(31.7,-17.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_22).wait(1));

	// Layer 33
	this.shape_23 = new cjs.Shape();
	this.shape_23.graphics.f("#000000").s().p("AgOgPQAAgWAOAbIAPAeQAAAGgIAAQgFAAgQgpg");
	this.shape_23.setTransform(33,-26.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_23).wait(1));

	// Layer 32
	this.shape_24 = new cjs.Shape();
	this.shape_24.graphics.f("#000000").s().p("AgHAEQgQgLAAgEQAAgLAXALQAYAKAAALIgBAFQgBADgFAAQgJAAgPgOg");
	this.shape_24.setTransform(41.3,-8.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_24).wait(1));

	// Layer 31
	this.shape_25 = new cjs.Shape();
	this.shape_25.graphics.f("#000000").s().p("AgRADQgKgHAAgHIABgEIA2AZIgCAFIgJABQgVAAgNgNg");
	this.shape_25.setTransform(39.3,-9.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_25).wait(1));

	// Layer 30
	this.shape_26 = new cjs.Shape();
	this.shape_26.graphics.f("#000000").s().p("AgMASIgBgIIAIgiIAKANQAJALAAAGIgRATQgHAAgCgHg");
	this.shape_26.setTransform(38.1,13.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_26).wait(1));

	// Layer 29
	this.shape_27 = new cjs.Shape();
	this.shape_27.graphics.f("#000000").s().p("AgXALIAAgFQAAgPAIgFQAMgHAbAZIgBAFQgBADgEAAIgNgHQgHgFgDAAQgFAAgBAFIgCAJQAAABAAAAQAAAAgBABQAAAAgBAAQgBAAgBAAQgFAAgBgFg");
	this.shape_27.setTransform(-23.7,40.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_27).wait(1));

	// Layer 28
	this.shape_28 = new cjs.Shape();
	this.shape_28.graphics.f("#000000").s().p("AgDADQgXgPAAACQAAgRAaASQANAJAOALQAAAJgGAAg");
	this.shape_28.setTransform(-30.7,24.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_28).wait(1));

	// Layer 27
	this.shape_29 = new cjs.Shape();
	this.shape_29.graphics.f("#000000").s().p("AgPAGQgTgXAAgMQAAgHAEAAQADABAHAJIAMAHQAIADADAFIAXAaQAJAKAAAFQAAAHgHAAQgXAAgUgfg");
	this.shape_29.setTransform(-67.9,9.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_29).wait(1));

	// Layer 26
	this.shape_30 = new cjs.Shape();
	this.shape_30.graphics.f("#000000").s().p("AgHAGQgSgIAAgEQAAgRAZAPQAaANAAAFQAAAGgIAAQgKAAgPgKg");
	this.shape_30.setTransform(-52.3,-4.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_30).wait(1));

	// Layer 25
	this.shape_31 = new cjs.Shape();
	this.shape_31.graphics.f("#000000").s().p("AgWgXIABgEQALAAAQAUQARASAAALIgBAFIgHABQgIAAgdgzg");
	this.shape_31.setTransform(-12.3,1);

	this.timeline.addTween(cjs.Tween.get(this.shape_31).wait(1));

	// Layer 24
	this.shape_32 = new cjs.Shape();
	this.shape_32.graphics.f("#000000").s().p("AgKgKIABgFQAJgBAGAMQAFAGAAAFQAAAFgGAEg");
	this.shape_32.setTransform(-12.1,-7.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_32).wait(1));

	// Layer 23
	this.shape_33 = new cjs.Shape();
	this.shape_33.graphics.f("#000000").s().p("AgMgaQAAgYAMAfQANAdAAASQAAAFgGAEg");
	this.shape_33.setTransform(-12.2,-7.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_33).wait(1));

	// Layer 22
	this.shape_34 = new cjs.Shape();
	this.shape_34.graphics.f("#000000").s().p("AgDgBQgSgVAAAJQAAgPAVAQQAWAOAAAMQAAAHgHAAg");
	this.shape_34.setTransform(-19,-14.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_34).wait(1));

	// Layer 21
	this.shape_35 = new cjs.Shape();
	this.shape_35.graphics.f("#000000").s().p("AgFAEQgNgHAAgCQAAgOASAMQATAKAAAFIgBAEIgGACQgFAAgMgKg");
	this.shape_35.setTransform(4.6,-14.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_35).wait(1));

	// Layer 20
	this.shape_36 = new cjs.Shape();
	this.shape_36.graphics.f("#000000").s().p("AgSgRQAAgWAQASQAOASAHAbIAAAEQAAACgGAAQgGAAgZgvg");
	this.shape_36.setTransform(3.5,-15);

	this.timeline.addTween(cjs.Tween.get(this.shape_36).wait(1));

	// Layer 19
	this.shape_37 = new cjs.Shape();
	this.shape_37.graphics.f("#000000").s().p("AgCASIACgIIgQgeIABgEQALAAAKAUQALAPAAAHQAAAIgIAAQgLAAAAgIg");
	this.shape_37.setTransform(14.9,-21.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_37).wait(1));

	// Layer 18
	this.shape_38 = new cjs.Shape();
	this.shape_38.graphics.f("#000000").s().p("AgYgUQAAgGAJAAQAGAAAGAIQAEAIAKAAQAFAAAJASQAAAJgHAAQgDAAgDgDIgHgEIACAJIgCAHQAAAAAAABQAAAAgBAAQAAAAgBAAQgBAAgBAAQgCAAgXgvg");
	this.shape_38.setTransform(12.8,-22.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_38).wait(1));

	// Layer 17
	this.shape_39 = new cjs.Shape();
	this.shape_39.graphics.f("#000000").s().p("AgJAPIgCgOIACgcQAKgBAGATIAFAZIgEAIQgEAEgFAAQgGAAgCgNg");
	this.shape_39.setTransform(6,-23.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_39).wait(1));

	// Layer 16
	this.shape_40 = new cjs.Shape();
	this.shape_40.graphics.f("#000000").s().p("AgJgGIAAgFQAJgFAGALIAEANIgBAFQAAABgFAAg");
	this.shape_40.setTransform(-0.8,-35.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_40).wait(1));

	// Layer 15
	this.shape_41 = new cjs.Shape();
	this.shape_41.graphics.f("#000000").s().p("AgJAFIgCgQIABgJQASgCAEAkIgBAGIgGACQgKAAgEgRg");
	this.shape_41.setTransform(-0.8,-34.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_41).wait(1));

	// Layer 14
	this.shape_42 = new cjs.Shape();
	this.shape_42.graphics.f("#000000").s().p("AgEAiQAAAAAAgBQgBAAAAAAQAAgBAAgBQAAgBAAgBIAFgSQAAgKgFgJQgEgLAAgHQAAgQAJAUQAKAVAAAOIAAANQgBAJgIAAg");
	this.shape_42.setTransform(8,-30.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_42).wait(1));

	// Layer 13
	this.shape_43 = new cjs.Shape();
	this.shape_43.graphics.f("#000000").s().p("AgHAFIgBgPQAAgNAIAJQAJAJgBAJQAAANgGABQgGgEgDgJg");
	this.shape_43.setTransform(7.3,-38);

	this.timeline.addTween(cjs.Tween.get(this.shape_43).wait(1));

	// Layer 12
	this.shape_44 = new cjs.Shape();
	this.shape_44.graphics.f("#000000").s().p("AgUgDQAAgDADgBIAMgBQgDgWANAIQAQAHAAAMIAAAEQgCAEgGAAIACALQACAJgIAAg");
	this.shape_44.setTransform(7.5,-44.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_44).wait(1));

	// Layer 11
	this.shape_45 = new cjs.Shape();
	this.shape_45.graphics.f("#000000").s().p("AAAAVIAAgRIgIgOIgIgJQAAgYAQAdQARAbAAAIQAAAKgGAAQgLAAAAgKg");
	this.shape_45.setTransform(10.4,-50.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_45).wait(1));

	// Layer 10
	this.shape_46 = new cjs.Shape();
	this.shape_46.graphics.f("#000000").s().p("AgJgYQAAgUAJAYQAKAWAAAWQAAAKgGAAQgCAAgLg6g");
	this.shape_46.setTransform(10.9,-53);

	this.timeline.addTween(cjs.Tween.get(this.shape_46).wait(1));

	// Layer 9
	this.shape_47 = new cjs.Shape();
	this.shape_47.graphics.f("#000000").s().p("AAIAQQgEAEgEAAQgDAAgQgUIgOgSQAAgNAUAFQASAEAFAMIAYAfIgBAGIgFABQgNAAgHgMg");
	this.shape_47.setTransform(-3.6,-47.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_47).wait(1));

	// Layer 8
	this.shape_48 = new cjs.Shape();
	this.shape_48.graphics.f("#000000").s().p("AgFAKIABgdQAIgBACAJIgDAeQABAAgBAAQAAAAAAABQgBAAgBAAQgBAAAAAAQgEAAgBgKg");
	this.shape_48.setTransform(-9.3,-40.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_48).wait(1));

	// Layer 7
	this.shape_49 = new cjs.Shape();
	this.shape_49.graphics.f("#000000").s().p("AgPgOQAAgTAPARQAQAQAAAKQAAALgHAAQgEAAgDgJIgCgKIAAAVQAAACgEAAQgIAAgDgng");
	this.shape_49.setTransform(-12,-44.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_49).wait(1));

	// Layer 6
	this.shape_50 = new cjs.Shape();
	this.shape_50.graphics.f("#000000").s().p("AgMgQQAAgTAMAPQANAPAAAFIgEAPQgFANgEAAg");
	this.shape_50.setTransform(-27.4,-45.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_50).wait(1));

	// Layer 5
	this.shape_51 = new cjs.Shape();
	this.shape_51.graphics.f("#000000").s().p("AgOgUQAAggAOAOQAPAOAAAMIgBAGQAAADgFAAQgGAAgCgHIgBgIIAAgBIgCA9QABAAgBAAQAAABAAAAQgBAAgBAAQAAAAgCAAQgFAAgDg/g");
	this.shape_51.setTransform(-27.4,-45);

	this.timeline.addTween(cjs.Tween.get(this.shape_51).wait(1));

	// Layer 4
	this.shape_52 = new cjs.Shape();
	this.shape_52.graphics.f("#000000").s().p("AgJgXIABgEQAMgBAEATQACAHAAANQAAANgHAFQgMgOAAgmg");
	this.shape_52.setTransform(-30.2,-50.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_52).wait(1));

	// Layer 3
	this.shape_53 = new cjs.Shape();
	this.shape_53.graphics.f("#000000").s().p("AgJAcIgBgQIAFgYIgFgVIAAgFQAIgOAGAnQAHAfAAAQQAAAIgHAAQgKAAgDgOg");
	this.shape_53.setTransform(-12.4,-63.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_53).wait(1));

	// Layer 2
	this.shape_54 = new cjs.Shape();
	this.shape_54.graphics.f("#000000").s().p("AgJARIgFgqQAAgLAIgPQAGgPAAAQIgCASIAIAbQAJAZAAAIIgEAXIgBAGQAAADgFAAQgHAAgHgrg");
	this.shape_54.setTransform(-15.1,-73.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_54).wait(1));

	// Layer 1
	this.shape_55 = new cjs.Shape();
	this.shape_55.graphics.f("#000000").s().p("AACA/QgCgugBgHQgehLAAgKQAAgNAIgGQAJgGAEAVIABAAIgCgOIACgBIAEgBQAFAAADAgIAGAwIAOAtQAJAeAAAEIgSAhQgKAAgCgig");
	this.shape_55.setTransform(-34,-121.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_55).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-71.5,-131.3,259.1,173.2);


(lib.shape22 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 77
	this.shape = new cjs.Shape();
	this.shape.graphics.f("#000000").s().p("AgTAIQAAgEATgRIAUAAQAAAHgKAGQgKAJgNAFg");
	this.shape.setTransform(147.4,27.4);

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

	// Layer 76
	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.f("#000000").s().p("Ag2AnQAAgEA2grQA3guAAAOQAAAFgwAlQgsAkgLAGg");
	this.shape_1.setTransform(159.3,13.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_1).wait(1));

	// Layer 75
	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.f("#000000").s().p("AgUARIAMgSQANgVAOABIABABIABADQAAAFgOAPIgVAUg");
	this.shape_2.setTransform(154.9,6.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_2).wait(1));

	// Layer 74
	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.f("#000000").s().p("AhSA4QAAgMBMgwQA4gnAggSIABACIAAAEQAAALhOAzIhRA2g");
	this.shape_3.setTransform(135.8,19.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_3).wait(1));

	// Layer 73
	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.f("#000000").s().p("AgdAZQAAgHAdgdQAegeAAAPQAAAJgaAXIgbAag");
	this.shape_4.setTransform(121.9,-8.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_4).wait(1));

	// Layer 72
	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.f("#000000").s().p("AgcAfQAAAAAAgBQgBAAAAAAQAAgBAAgBQAAgBAAgBQAAgIARgVQATgdAWACIABABIAAAEIgMAIIgUARQgHAIgFAWIgHACg");
	this.shape_5.setTransform(115.2,-11.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_5).wait(1));

	// Layer 71
	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.f("#000000").s().p("AgOASQAAgGAOgWQAPgZAAAVQAAAEgKAPIgNAUg");
	this.shape_6.setTransform(91.3,-1.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_6).wait(1));

	// Layer 70
	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.f("#000000").s().p("AgYAcQAAgFAOgXQAQgeARgEIABABIABAEIgSAdQgQAcgJAHg");
	this.shape_7.setTransform(100.4,-2.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_7).wait(1));

	// Layer 69
	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.f("#000000").s().p("AgHAFIgFgRIABgKQAKgBAHASQAHAMAAAHQAAAJgHAAQgHAAgGgSg");
	this.shape_8.setTransform(73.4,-0.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_8).wait(1));

	// Layer 68
	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.f("#000000").s().p("AgBAMIgCgCIgDgPQAAgKAGAFQAHAFAAAHIAAAIQgBACgEAAg");
	this.shape_9.setTransform(96.4,-36);

	this.timeline.addTween(cjs.Tween.get(this.shape_9).wait(1));

	// Layer 67
	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.f("#000000").s().p("AgUAfIgBgLIAHgSQAIgOADAAQAEAAADAHIADAGIABAAQABgQAGgTQAHgVAAAjIgCAUQgEAQgGAAQgGAAgEgDIgCgFIgDAgQgBADgFAAQgGAAgDgMg");
	this.shape_10.setTransform(97.8,-37.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_10).wait(1));

	// Layer 66
	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.f("#000000").s().p("AgHAPIAAgGQAAgJAHgOQAIgQAAAXIgEAPQAAAAAAABQAAABAAAAQAAABABAAQAAAAABABIACAEQAAAGgIAAQgFAAgCgHg");
	this.shape_11.setTransform(79.4,-21.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_11).wait(1));

	// Layer 65
	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.f("#000000").s().p("AAAAiQgGgFAAgBIAGgUQAAgMgHgNIgHgQIABgEQAUAOAFAMIADAmQgBALgGAAQgEAAgEgEg");
	this.shape_12.setTransform(81.2,-25.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_12).wait(1));

	// Layer 64
	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.f("#000000").s().p("AgdBcIAAgiIAMhNIgEggIAOgmQACgKAGgIIATgMQAGALAAAkIAEAZQAAAXgPgEIgBAAQgDAbgCAwQgFArgXAeQgJgHgBgVgAgOBEIgBABIAAADIABAEIAAAAIABgIgAABgYIABgKIAMABIgBgYQgBAHgLAAg");
	this.shape_13.setTransform(66.9,-30.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_13).wait(1));

	// Layer 63
	this.shape_14 = new cjs.Shape();
	this.shape_14.graphics.f("#000000").s().p("AggAFIgBgEQAAgDAIgCIA6gCIABABIAAAEQAAADgGACIghADg");
	this.shape_14.setTransform(44.4,12.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_14).wait(1));

	// Layer 62
	this.shape_15 = new cjs.Shape();
	this.shape_15.graphics.f("#000000").s().p("AgFACIgFgMIAAgFQAKgBAFAMQAGAIAAAGIgBAFIgFABQgFAAgFgOg");
	this.shape_15.setTransform(25.2,8);

	this.timeline.addTween(cjs.Tween.get(this.shape_15).wait(1));

	// Layer 61
	this.shape_16 = new cjs.Shape();
	this.shape_16.graphics.f("#000000").s().p("AgGAXIgCgCIgCgRQAAgFAEgJQAGgNAKAAIABABIAAAEIgEAQQgFAJAAAOIgEADg");
	this.shape_16.setTransform(25.2,7.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_16).wait(1));

	// Layer 60
	this.shape_17 = new cjs.Shape();
	this.shape_17.graphics.f("#000000").s().p("AgJAeIAAgLQAAgLAJgeQAJghABAdIgNBCQgEAAgCgKg");
	this.shape_17.setTransform(38.3,-0.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_17).wait(1));

	// Layer 59
	this.shape_18 = new cjs.Shape();
	this.shape_18.graphics.f("#000000").s().p("AgHAAIgFgMQAAgPAMANQANANAAAOQAAAIgGAAQgHgGgHgPg");
	this.shape_18.setTransform(35.5,-7.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_18).wait(1));

	// Layer 58
	this.shape_19 = new cjs.Shape();
	this.shape_19.graphics.f("#000000").s().p("AgGAQIgEgOQAAgvAKAYQALAXAAAOIgBAKQgCADgEAAQgFAAgFgNg");
	this.shape_19.setTransform(35.3,-7.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_19).wait(1));

	// Layer 57
	this.shape_20 = new cjs.Shape();
	this.shape_20.graphics.f("#000000").s().p("AgHgQQAAgVAHAOQAHANABAQIgDAXIgEABQgBAAgHgug");
	this.shape_20.setTransform(15.2,-7.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_20).wait(1));

	// Layer 56
	this.shape_21 = new cjs.Shape();
	this.shape_21.graphics.f("#000000").s().p("AgNgeIABgGQANgCAHAfQAGASAAATIgBAGQAAACgFAAQgEAAgRhEg");
	this.shape_21.setTransform(8.5,-7.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_21).wait(1));

	// Layer 55
	this.shape_22 = new cjs.Shape();
	this.shape_22.graphics.f("#000000").s().p("AgGAFIAAghIAAgGQAKgFADAUIAAAnQgBAMgEAEQgHgJgBgWg");
	this.shape_22.setTransform(9.7,-11);

	this.timeline.addTween(cjs.Tween.get(this.shape_22).wait(1));

	// Layer 54
	this.shape_23 = new cjs.Shape();
	this.shape_23.graphics.f("#000000").s().p("AgJAaIAAgLQAAgTACgKQAEgWALAAIABACIABAEIgDAYQgEAOAAATIgCAJIgCABQgGAAgCgLg");
	this.shape_23.setTransform(10.9,-10.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_23).wait(1));

	// Layer 53
	this.shape_24 = new cjs.Shape();
	this.shape_24.graphics.f("#000000").s().p("AgIgMQABgTAHAUQAJARgBAIIgCAHIgDABQgFAAgGgig");
	this.shape_24.setTransform(24.5,-13.9);

	this.timeline.addTween(cjs.Tween.get(this.shape_24).wait(1));

	// Layer 52
	this.shape_25 = new cjs.Shape();
	this.shape_25.graphics.f("#000000").s().p("AgHAYIACgqQAAgRAGALQAHAKAAAMIgBAPQgCALgGAGg");
	this.shape_25.setTransform(25.2,-14);

	this.timeline.addTween(cjs.Tween.get(this.shape_25).wait(1));

	// Layer 51
	this.shape_26 = new cjs.Shape();
	this.shape_26.graphics.f("#000000").s().p("AgHAAIAAgxQAQgBgBAYQgBANgEANIgBAZQgBAQgCAJQgGgMAAgmg");
	this.shape_26.setTransform(28.8,-20.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_26).wait(1));

	// Layer 50
	this.shape_27 = new cjs.Shape();
	this.shape_27.graphics.f("#000000").s().p("AAAAUIgDgCIgDghIABgFQAJgCADAKIAAAeQAAADgFAAg");
	this.shape_27.setTransform(39.9,-27.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_27).wait(1));

	// Layer 49
	this.shape_28 = new cjs.Shape();
	this.shape_28.graphics.f("#000000").s().p("AgCAbIgBgCIgCgcQAAgnAFAYQAHAXgBANIAAAHQAAADgFAAg");
	this.shape_28.setTransform(40.5,-34.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_28).wait(1));

	// Layer 48
	this.shape_29 = new cjs.Shape();
	this.shape_29.graphics.f("#000000").s().p("AgNArIAAgKQAAghANggQAOgiAAAdIgHAlQgHAmAAAHQAAAGgGAAQgGAAgBgIg");
	this.shape_29.setTransform(43.2,-37);

	this.timeline.addTween(cjs.Tween.get(this.shape_29).wait(1));

	// Layer 47
	this.shape_30 = new cjs.Shape();
	this.shape_30.graphics.f("#000000").s().p("AgEAjIgCgCIAAgrQANgrAAAhIgDA1QgBACgDAAg");
	this.shape_30.setTransform(53.5,-46.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_30).wait(1));

	// Layer 46
	this.shape_31 = new cjs.Shape();
	this.shape_31.graphics.f("#000000").s().p("AgKADIgEgEQAAgKAOAFQAPAGAAACIgDAFIgJABQgHAAgGgFg");
	this.shape_31.setTransform(81.2,-72.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_31).wait(1));

	// Layer 45
	this.shape_32 = new cjs.Shape();
	this.shape_32.graphics.f("#000000").s().p("AgQAVQgFgIAAgXIAAgRQACgLAJAAQAHAAADALIACAQIADgZQADgOAHgFQAHgEAAAQIgMAxIgCAxQAAAAAAABQAAAAgBAAQAAAAgBAAQgBAAgBAAg");
	this.shape_32.setTransform(71.6,-73.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_32).wait(1));

	// Layer 44
	this.shape_33 = new cjs.Shape();
	this.shape_33.graphics.f("#000000").s().p("AgMAtIABgLIgGgMQgEgEAAgFIAIglQgMgIAAgDQAAgLAZgGQAagGAAAKQAAAEgHADIAAgBIgBADIAEAGIAEAEQAAAIgOgDIgDAtQgFAigIAAQgIAAAAgKg");
	this.shape_33.setTransform(66.3,-78.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_33).wait(1));

	// Layer 43
	this.shape_34 = new cjs.Shape();
	this.shape_34.graphics.f("#000000").s().p("AgBAeIgHgCQgIAAgCgIIAAgIQAAgOAPgVQAMgUgJAkIADgEQACgCAGAAQAKAAgCAXIAAANQgCAIgJAAg");
	this.shape_34.setTransform(20.2,-27.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_34).wait(1));

	// Layer 42
	this.shape_35 = new cjs.Shape();
	this.shape_35.graphics.f("#000000").s().p("AgGARIAAgUQABgmAFACQAHACgBAlIAAAWQAAASgGAAQgEAAgCgXg");
	this.shape_35.setTransform(20,-24);

	this.timeline.addTween(cjs.Tween.get(this.shape_35).wait(1));

	// Layer 41
	this.shape_36 = new cjs.Shape();
	this.shape_36.graphics.f("#000000").s().p("AgFAGQgDgKAAgHIABgNQAMgBADAVIABAVQAAAIgHAAQgDgEgEgPg");
	this.shape_36.setTransform(13.3,-31.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_36).wait(1));

	// Layer 40
	this.shape_37 = new cjs.Shape();
	this.shape_37.graphics.f("#000000").s().p("AgIAFIgEgXIAAgJQAFgBAJAZIALAZIgBAFIgHACQgHAAgGgYg");
	this.shape_37.setTransform(15.6,-31.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_37).wait(1));

	// Layer 39
	this.shape_38 = new cjs.Shape();
	this.shape_38.graphics.f("#000000").s().p("AgOgSQAAgaAOAfIAPAlQAAAHgIAAQgIAAgNgxg");
	this.shape_38.setTransform(8,-26.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_38).wait(1));

	// Layer 38
	this.shape_39 = new cjs.Shape();
	this.shape_39.graphics.f("#000000").s().p("AgGADIgGgWQAAgdAZBFIgBAFQgBACgFAAQgGAAgGgZg");
	this.shape_39.setTransform(9.2,-26.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_39).wait(1));

	// Layer 37
	this.shape_40 = new cjs.Shape();
	this.shape_40.graphics.f("#000000").s().p("AgMgLIABgEQAKgBAHAMQAHAIAAAGIgBAEIgFACQgFAAgOgbg");
	this.shape_40.setTransform(2.2,-44.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_40).wait(1));

	// Layer 36
	this.shape_41 = new cjs.Shape();
	this.shape_41.graphics.f("#000000").s().p("AgEAFIgKgJQAAgQANAKIAQASIgBAEQgBADgFAAg");
	this.shape_41.setTransform(10.4,-42.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_41).wait(1));

	// Layer 35
	this.shape_42 = new cjs.Shape();
	this.shape_42.graphics.f("#000000").s().p("AgFAFIgEgOQAAgUAJARQAKAQAAAIQAAAJgGAAQgEAAgFgQg");
	this.shape_42.setTransform(13.6,-39.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_42).wait(1));

	// Layer 34
	this.shape_43 = new cjs.Shape();
	this.shape_43.graphics.f("#000000").s().p("AgLgFQAAgKALAGQAMAFAAAIIgBAFQAAADgFAAg");
	this.shape_43.setTransform(13.4,-38);

	this.timeline.addTween(cjs.Tween.get(this.shape_43).wait(1));

	// Layer 33
	this.shape_44 = new cjs.Shape();
	this.shape_44.graphics.f("#000000").s().p("AgGAGIgDgWIABgLQARgCABAwIgDAIQABAAAAABQgBAAAAAAQgBAAAAAAQgBABgBAAQgHAAgDgXg");
	this.shape_44.setTransform(12.6,-38.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_44).wait(1));

	// Layer 32
	this.shape_45 = new cjs.Shape();
	this.shape_45.graphics.f("#000000").s().p("AgJAXQAAgLAJgYQADgTADACQAEABAAANIgEAWQgGAUgDADQgGgFAAgCg");
	this.shape_45.setTransform(14.2,-38);

	this.timeline.addTween(cjs.Tween.get(this.shape_45).wait(1));

	// Layer 31
	this.shape_46 = new cjs.Shape();
	this.shape_46.graphics.f("#000000").s().p("AgFAGIgBgHQAAgPAGAEQAHADAAAPQAAAIgGAAQgEAAgCgIg");
	this.shape_46.setTransform(36.1,-42.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_46).wait(1));

	// Layer 30
	this.shape_47 = new cjs.Shape();
	this.shape_47.graphics.f("#000000").s().p("AgFAFIgGgVQAAgVAIALQAFAKACANIACAMQACAKAEAFIgBAEQgBADgFAAQgFAAgFgag");
	this.shape_47.setTransform(34.8,-43.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_47).wait(1));

	// Layer 29
	this.shape_48 = new cjs.Shape();
	this.shape_48.graphics.f("#000000").s().p("AgUAuIAAgKIAKABQAPAAAEgRIAAgUIgFgpQAAgSAIAVQAJAVAAARIgBAdQgHAVgUAAQgLAAgCgEg");
	this.shape_48.setTransform(39.2,-49);

	this.timeline.addTween(cjs.Tween.get(this.shape_48).wait(1));

	// Layer 28
	this.shape_49 = new cjs.Shape();
	this.shape_49.graphics.f("#000000").s().p("AgJAqIAAgbQgCghABgSQADgfAQgBIABACIABADIgFAnQgFAYAAANIAEAvIgCAHQAAAAAAABQAAAAAAAAQgBAAgBAAQgBABAAAAQgHAAgCgbg");
	this.shape_49.setTransform(27.9,-41.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_49).wait(1));

	// Layer 27
	this.shape_50 = new cjs.Shape();
	this.shape_50.graphics.f("#000000").s().p("AgMAJQABgXAFgPQAGgOAAgQIAAgHQANgBgBATQABAGgIAQQgFARAAASQAAARAEAIQAHAIAAALIAAAKQgCAFgGAAQgJAAgGg7g");
	this.shape_50.setTransform(28.2,-39.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_50).wait(1));

	// Layer 26
	this.shape_51 = new cjs.Shape();
	this.shape_51.graphics.f("#000000").s().p("AgFAnIgCgCIAAhJQAQgJgBAWQgBALgEAMIgBAlQAAADgDAAg");
	this.shape_51.setTransform(23,-53);

	this.timeline.addTween(cjs.Tween.get(this.shape_51).wait(1));

	// Layer 25
	this.shape_52 = new cjs.Shape();
	this.shape_52.graphics.f("#000000").s().p("AgEgCQAAgNgCgLIgDgSIADgCQACgCAAgEQAFAJAFAhQAEAaAAAUIAAAKQgBAHgGAAQgGAAgBg3g");
	this.shape_52.setTransform(-25.4,-86.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_52).wait(1));

	// Layer 24
	this.shape_53 = new cjs.Shape();
	this.shape_53.graphics.f("#000000").s().p("AgHACIgGgqIABgEQAMgBAIAjQAGAXAAAUIAAAKQgBACgFAAQgIAAgHgrg");
	this.shape_53.setTransform(-21.9,-76.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_53).wait(1));

	// Layer 23
	this.shape_54 = new cjs.Shape();
	this.shape_54.graphics.f("#000000").s().p("AgLgKQAAgNALAKQAMALAAALQAAAJgGAAg");
	this.shape_54.setTransform(-9.5,-51.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_54).wait(1));

	// Layer 22
	this.shape_55 = new cjs.Shape();
	this.shape_55.graphics.f("#000000").s().p("AgJAPIgDgKIAFgOQAHgOALgCIABABIABAFIgGAXQgGAWgBgBQgGABgDgLg");
	this.shape_55.setTransform(-9.2,-52);

	this.timeline.addTween(cjs.Tween.get(this.shape_55).wait(1));

	// Layer 21
	this.shape_56 = new cjs.Shape();
	this.shape_56.graphics.f("#000000").s().p("AgFAFIgHgTIABgKQAPgBAGAWQADAJAAANIgCAFQAAABgFAAQgGAAgFgUg");
	this.shape_56.setTransform(0.6,-24.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_56).wait(1));

	// Layer 20
	this.shape_57 = new cjs.Shape();
	this.shape_57.graphics.f("#000000").s().p("AgaAGIgHgXIABgHIAGgCQAEAAAEAFIAFAHQANggAPAcIATAnIgBAEQAAADgFAAQgIAAgIgMIgCADQgBACgEAAQgCAAgCgCIgBgEIAAALQgBAGgIAAQgJAAgIgagAgPABIACALIAAAAQABgKgDgCg");
	this.shape_57.setTransform(0.7,-25.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_57).wait(1));

	// Layer 19
	this.shape_58 = new cjs.Shape();
	this.shape_58.graphics.f("#000000").s().p("AgQAFQAAgFAHAAIAKAEQAAgYAIgNQAIgNAAATQgIBCgCAAg");
	this.shape_58.setTransform(-5.1,-20.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_58).wait(1));

	// Layer 18
	this.shape_59 = new cjs.Shape();
	this.shape_59.graphics.f("#000000").s().p("AgLAHIACg7IABgEQAOgMAEAbQADANgBASIgBAcQAAADgFAAQgGAAAAgEQAAAcgBAPIgEABQgIAAACg2g");
	this.shape_59.setTransform(-4.8,-29);

	this.timeline.addTween(cjs.Tween.get(this.shape_59).wait(1));

	// Layer 17
	this.shape_60 = new cjs.Shape();
	this.shape_60.graphics.f("#000000").s().p("AAIAjIgCgCQAAgZgKgSIgNgPQAAgVARAZQASAXAAAYIgBAHQAAADgFAAg");
	this.shape_60.setTransform(-7.3,-39.3);

	this.timeline.addTween(cjs.Tween.get(this.shape_60).wait(1));

	// Layer 16
	this.shape_61 = new cjs.Shape();
	this.shape_61.graphics.f("#000000").s().p("AgVgPQAAgVAVAaQAWAXAAAFQAAAHgHAAQgHAAgdgog");
	this.shape_61.setTransform(-13,-23.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_61).wait(1));

	// Layer 15
	this.shape_62 = new cjs.Shape();
	this.shape_62.graphics.f("#000000").s().p("AgSgcIAAgFQAMADALAWQAOAUAAAOIgBAGQgBACgFAAg");
	this.shape_62.setTransform(-13.9,-27.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_62).wait(1));

	// Layer 14
	this.shape_63 = new cjs.Shape();
	this.shape_63.graphics.f("#000000").s().p("AgGAYIgBgEIADgsQALgBAAAMQABAGgDAHIAAAPQgBAKgEAAg");
	this.shape_63.setTransform(-13.6,-33.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_63).wait(1));

	// Layer 13
	this.shape_64 = new cjs.Shape();
	this.shape_64.graphics.f("#000000").s().p("AgGAFIAAgUQAKgBADAMIgBALQAAAFgGAEQgEgFgCgGg");
	this.shape_64.setTransform(-14,-12.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_64).wait(1));

	// Layer 12
	this.shape_65 = new cjs.Shape();
	this.shape_65.graphics.f("#000000").s().p("AgFAFIgCgMQAAgQAHAKQAIAKAAANQAAAIgHAAQgDAAgDgNg");
	this.shape_65.setTransform(-15.2,-11.6);

	this.timeline.addTween(cjs.Tween.get(this.shape_65).wait(1));

	// Layer 11
	this.shape_66 = new cjs.Shape();
	this.shape_66.graphics.f("#000000").s().p("AAHAdIgEgaQgCgIgMgRIgOgQQAAgTAZAhQAaAfAAAgIgBAEQAAADgFAAQgJAAgEgRg");
	this.shape_66.setTransform(-17.7,-20.7);

	this.timeline.addTween(cjs.Tween.get(this.shape_66).wait(1));

	// Layer 10
	this.shape_67 = new cjs.Shape();
	this.shape_67.graphics.f("#000000").s().p("AAAgEIgaguIABgFQAPAGATAsQASAlAAAKIAAAMQgCACgFAAQgKAAgKg8g");
	this.shape_67.setTransform(-19.4,-17.8);

	this.timeline.addTween(cjs.Tween.get(this.shape_67).wait(1));

	// Layer 9
	this.shape_68 = new cjs.Shape();
	this.shape_68.graphics.f("#000000").s().p("AgFAIIgKgIQAAgIAKABQgCgRAKANQANALAAAMQAAAGgHAAQgFAAgJgKg");
	this.shape_68.setTransform(0.1,18.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_68).wait(1));

	// Layer 8
	this.shape_69 = new cjs.Shape();
	this.shape_69.graphics.f("#000000").s().p("AgeAAIgBgEQAAgPAcAIQAZAIAKAKIgBAFQgBACgEAAQgugOgKAAg");
	this.shape_69.setTransform(-6.4,17.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_69).wait(1));

	// Layer 7
	this.shape_70 = new cjs.Shape();
	this.shape_70.graphics.f("#000000").s().p("AgNASQgNgJAGgJIgMgJQgFgEAAgGIAAgGQAGgCAhAUQAkASAAAHQAAAIgYAAQgPAAgMgIgAAGAKIgCACIAKABQgEgEgCgBg");
	this.shape_70.setTransform(-5.2,10.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_70).wait(1));

	// Layer 6
	this.shape_71 = new cjs.Shape();
	this.shape_71.graphics.f("#000000").s().p("AgVAFQAAgeAVAGQAWAFAAATIgIAKIgKAGQgZAAAAgQg");
	this.shape_71.setTransform(-18.7,11.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_71).wait(1));

	// Layer 5
	this.shape_72 = new cjs.Shape();
	this.shape_72.graphics.f("#000000").s().p("AgCACQgYgOAAADQAAgSAaASQAbAPAAAHQAAAGgGAAg");
	this.shape_72.setTransform(-54.8,-12.1);

	this.timeline.addTween(cjs.Tween.get(this.shape_72).wait(1));

	// Layer 4
	this.shape_73 = new cjs.Shape();
	this.shape_73.graphics.f("#000000").s().p("AgXgIQAAgYAXAVQAYATAAAGIgBAGQAAACgGAAg");
	this.shape_73.setTransform(-33,-5);

	this.timeline.addTween(cjs.Tween.get(this.shape_73).wait(1));

	// Layer 3
	this.shape_74 = new cjs.Shape();
	this.shape_74.graphics.f("#000000").s().p("AgrgbQABgNAqAcQArAaABAKQAAAIgLAAQgHAAhFg7g");
	this.shape_74.setTransform(-44.5,5.2);

	this.timeline.addTween(cjs.Tween.get(this.shape_74).wait(1));

	// Layer 2
	this.shape_75 = new cjs.Shape();
	this.shape_75.graphics.f("#000000").s().p("AgCgFQgUgKgMgKIAAgFQAXAHAQAJQAdAOAAAOQABANgIAEQgPgagOgKg");
	this.shape_75.setTransform(-57.5,19.4);

	this.timeline.addTween(cjs.Tween.get(this.shape_75).wait(1));

	// Layer 1
	this.shape_76 = new cjs.Shape();
	this.shape_76.graphics.f("#000000").s().p("AAAAEIgigQIgBgDQAjgDAHAHQAOANAOAFIgFADIAFADIAAADQAAAAABAAQAAAAAAABQgBAAAAAAQgBAAgBAAQgIAAgZgNgAAQAIIAIAEIABAAQgDgEgFAAIgBAAg");
	this.shape_76.setTransform(-56.6,42.5);

	this.timeline.addTween(cjs.Tween.get(this.shape_76).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-61,-91.8,225.8,136.1);


(lib.shape6 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 3
	this.instance = new lib.volam();
	this.instance.setTransform(-256.3,-171.9);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-256.3,-171.9,660,306);


(lib.shape96 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 1
	this.shape = new cjs.Shape();
	this.shape.graphics.bf(img.image95, null, new cjs.Matrix2D(1,0,0,1,-8,-7.5)).s().p("AhPBKIAAiTICfAAIAACTg");

	this.timeline.addTween(cjs.Tween.get(this.shape).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-8,-7.5,16,15);


(lib.sprite72 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_19 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(19).call(this.frame_19).wait(1));

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	var mask_graphics_0 = new cjs.Graphics().p("EglzABQIAAieMBLnAAAIAACeg");
	var mask_graphics_1 = new cjs.Graphics().p("EglzABhIAAjBMBLnAAAIAADBg");
	var mask_graphics_2 = new cjs.Graphics().p("EglzAByIAAjjMBLnAAAIAADjg");
	var mask_graphics_3 = new cjs.Graphics().p("EglzACDIAAkFMBLnAAAIAAEFg");
	var mask_graphics_4 = new cjs.Graphics().p("EglzACTIAAklMBLnAAAIAAElg");
	var mask_graphics_5 = new cjs.Graphics().p("EglzACkIAAlHMBLnAAAIAAFHg");
	var mask_graphics_6 = new cjs.Graphics().p("EglzAC1IAAlpMBLnAAAIAAFpg");
	var mask_graphics_7 = new cjs.Graphics().p("EglzADGIAAmLMBLnAAAIAAGLg");
	var mask_graphics_8 = new cjs.Graphics().p("EglzADXIAAmtMBLnAAAIAAGtg");
	var mask_graphics_9 = new cjs.Graphics().p("EglzADoIAAnPMBLnAAAIAAHPg");
	var mask_graphics_10 = new cjs.Graphics().p("EglzAD5IAAnxMBLnAAAIAAHxg");
	var mask_graphics_11 = new cjs.Graphics().p("EglzAEKIAAoTMBLnAAAIAAITg");
	var mask_graphics_12 = new cjs.Graphics().p("EglzAEbIAAo1MBLnAAAIAAI1g");
	var mask_graphics_13 = new cjs.Graphics().p("EglzAEsIAApXMBLnAAAIAAJXg");
	var mask_graphics_14 = new cjs.Graphics().p("EglzAE9IAAp5MBLnAAAIAAJ5g");
	var mask_graphics_15 = new cjs.Graphics().p("EglzAFOIAAqbMBLnAAAIAAKbg");
	var mask_graphics_16 = new cjs.Graphics().p("EglzAFfIAAq9MBLnAAAIAAK9g");
	var mask_graphics_17 = new cjs.Graphics().p("EglzAFwIAArfMBLnAAAIAALfg");
	var mask_graphics_18 = new cjs.Graphics().p("AwI0OIAAsCMBLmAAAIAAMCg");
	var mask_graphics_19 = new cjs.Graphics().p("EglzAGBIAAsBMBLnAAAIAAMBg");

	this.timeline.addTween(cjs.Tween.get(mask).to({graphics:mask_graphics_0,x:519.3,y:-344.1}).wait(1).to({graphics:mask_graphics_1,x:519.3,y:-345.8}).wait(1).to({graphics:mask_graphics_2,x:519.3,y:-347.5}).wait(1).to({graphics:mask_graphics_3,x:519.3,y:-349.2}).wait(1).to({graphics:mask_graphics_4,x:519.3,y:-350.9}).wait(1).to({graphics:mask_graphics_5,x:519.3,y:-352.6}).wait(1).to({graphics:mask_graphics_6,x:519.3,y:-354.3}).wait(1).to({graphics:mask_graphics_7,x:519.3,y:-356}).wait(1).to({graphics:mask_graphics_8,x:519.3,y:-357.7}).wait(1).to({graphics:mask_graphics_9,x:519.3,y:-359.3}).wait(1).to({graphics:mask_graphics_10,x:519.3,y:-361}).wait(1).to({graphics:mask_graphics_11,x:519.3,y:-362.7}).wait(1).to({graphics:mask_graphics_12,x:519.3,y:-364.4}).wait(1).to({graphics:mask_graphics_13,x:519.3,y:-366.1}).wait(1).to({graphics:mask_graphics_14,x:519.3,y:-367.8}).wait(1).to({graphics:mask_graphics_15,x:519.3,y:-369.5}).wait(1).to({graphics:mask_graphics_16,x:519.3,y:-371.2}).wait(1).to({graphics:mask_graphics_17,x:519.3,y:-372.9}).wait(1).to({graphics:mask_graphics_18,x:380.7,y:-206.6}).wait(1).to({graphics:mask_graphics_19,x:519.3,y:-374.6}).wait(1));

	// Masked Layer 2 - 1
	this.instance = new lib.shape70("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(20));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = null;


(lib.sprite32 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_14 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(14).call(this.frame_14).wait(1));

	// Layer 77
	this.instance = new lib.shape22("synched",0);

	this.timeline.addTween(cjs.Tween.get(this.instance).to({_off:true},1).wait(14));

	// Layer 56
	this.instance_1 = new lib.shape23("synched",0);
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(1).to({_off:false},0).to({_off:true},1).wait(13));

	// Layer 27
	this.instance_2 = new lib.shape24("synched",0);
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(2).to({_off:false},0).to({_off:true},1).wait(12));

	// Layer 22
	this.instance_3 = new lib.shape25("synched",0);
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(3).to({_off:false},0).to({_off:true},1).wait(11));

	// Layer 15
	this.instance_4 = new lib.shape27("synched",0);
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(5).to({_off:false},0).to({_off:true},1).wait(9));

	// Layer 14
	this.instance_5 = new lib.shape26("synched",0);
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(4).to({_off:false},0).to({_off:true},1).wait(10));

	// Layer 8
	this.instance_6 = new lib.shape28("synched",0);
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(6).to({_off:false},0).to({_off:true},2).wait(7));

	// Layer 5
	this.instance_7 = new lib.shape29("synched",0);

	this.instance_8 = new lib.shape30("synched",0);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[]}).to({state:[{t:this.instance_7}]},8).to({state:[{t:this.instance_8}]},2).to({state:[]},2).wait(3));

	// Layer 4
	this.instance_9 = new lib.shape31("synched",0);
	this.instance_9._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_9).wait(12).to({_off:false},0).to({_off:true},2).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-61,-91.8,225.8,136.1);


(lib.sprite20 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 1
	this.instance = new lib.shape6("synched",0);

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-256.3,-171.9,660,306);


(lib.sprite19 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("A9wF7QgpgDghgVQgkgWgMgjQgNgoAUgrQASgoAlgaQAegWAugSIBSgeQA2gUBSgrQBrg2AcgNQCmhNB/ATQAQADAzAMQAqAKAaACQAwADBDgSQBLgYAlgLQAzgOCJgUQB3gSBBgYIBwgyQBDgdAwgHQBAgIA4AhQA8AjADA6QBEgIBggYIClgoQCkgmDSgWQB7gNEAgQIAAgKQAhgBAdATQAcASANAeQAMAfgHAhQgHAigXAWQgXAWglALQgaAHgsAEIlGAZQjAAQiBAgIhkAcQg+AQgnAIQg3ALhjALQhtANgvAIQhOAPidAwQiaAwhRAOQhlARhWgJQhkgMhJgwQAFAZgPAZQgOAYgYAOQgVAMgdAGQgQAEgmAEQkXAjkKBPQg1AQgWAEQghAHgcAAIgPAAgATeiLQgvgCgdgVQgUgOgMgWQgMgXgBgYQAAgZAMgXQAMgWAUgOQARgLAYgGQAQgEAcgEQB8gPCpgDQBjgCDEAAIABgBQA1gFAfAEQAuAGAbAZQASARAJAYQAIAYgEAZQgEAYgQAVQgPAUgWALQgaAMgzACQg7ADjhACQiwAChsANQgyAGgaAAIgHAAg");
	mask.setTransform(60,101.5);

	// Masked Layer 2 - 1
	this.instance = new lib.shape6("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-143.2,63.6,406.5,70.5);


(lib.sprite17 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("AlAIIQgUgJgPgRQgPgRgHgVQgGgWADgWQACgXAMgTIAIgNQAEgIACgGQACgGAAgKIABgQQAAgSAJgVIADgHQgqApglAQQhEAfhNggQhMggghhFQgfhCALhZQAJhBAjhaQAYg8AYgvQAuhZA1gdQAkgUApAFQArAFAWAeQAKglAUgdQAWgfAfgRQAhgRAmAFQAnAFAXAbQAaAggDBGQgEBaAGAXIBEiDQAhhAAXgdQAQgRApgjQAoghAVgOQAkgXAhgIIABADQAigEAhAWQAeATASAiQAPAaALApIATBGQAaBXA0AdQASgiAJgPQARgaARgSQAVgVAZgLQAbgNAbADQAmADAcAhQAcAfAEAoQAHBIg6BJIgNARQgGAKgBAJQgBALAGAMIAOAWQAqA8gFA/QgDAigTAcQgUAegeAMQgIADgWAGQgUAFgKAGQgIAEgMAKIgUAPQggAWgqgFQgpgFgbgcQiPAVicASQgzAGgXABQgrADgigCQgQgBgOgDIgEAHQgNAXgDAMQgDAKAAAPIAAAaQgCAfgQAcQgPAbgZAUQgaAVghAGQgMADgMAAQgVAAgTgJg");
	mask.setTransform(193.5,38.5);

	// Masked Layer 2 - 1
	this.instance = new lib.shape6("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(124.1,-14.4,138.9,105.9);


(lib.sprite15 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("AmKHJQgYgFgSgPQgSgPgLgWQgKgWAAgYQABgbAOgbQANgZAXgUIAOgOQAHgJABgIQABgIgIgTQgJgZABgbQACgcAMgYQgogYgVgTQgegcgKgeQgJgdAHggQAHgdASgbQAQgXAZgYQAPgOAggaQAtglAcgRQAqgaAogGQApgHAnAQQApARASAjQAEgvAEgYQAGgoAOgdQAQgiAbgWQAcgYAigCIAAACQAXgFAdAWQArAgAHADQAKAEASADIAdAGQAgAJAVAdQAWAcAAAiQAQgZAbgNQAbgNAdACQAdACAYASQAZASAMAaQAEAJAFASQAFATADAIQAEAJAJARIANAZQALAagBAcQgBAdgNAZQgJASgYAbQgbAdgIAOQgNAVgPArQgQAvgLATQgPAdgeAdQgRAQgpAfQgjAbgSAMQgfAVgaALQggAPhFAPQgvAJgcgBQgrgCgagWQgcAbgrADQgrADgggXQgdArgUAVQggAggjAIQgLACgLAAQgMAAgNgDg");
	mask.setTransform(91.2,38.6);

	// Masked Layer 2 - 1
	this.instance = new lib.shape6("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(40.2,-7.5,102.1,92.2);


(lib.sprite13 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("AifG3QgOgDgVgKQgZgMgJgDQgQgFgugFQgpgEgVgKQgqgUgMgyQgNgzAcglIigBkQgsAbgWAKQgmATghAEQgoAEgjgQQgmgRgNgiQgLgbAHgzQAJg8gDgWQgEgXgTgoQgTgqgEgWQgGgkAQgiQARgkAfgTQAggOAMgLQALgJAEgMQAFgNgEgLQgkAGgigKQgjgKgYgYQgZgZgJgjQgJglANggQALgcAagWQAZgVAggKQAbgJAkgEQATgCAugBIF/gKIACACQA1gJAagCQAtgEAjAIQApAJAeAbQAhAdAGAlQCFgUBIgFQBzgGBaATIBoAcQA/ARArABQAmACBRgFQBEABAkAgQAbAaAIApQAHAmgKAoQAjAUAOArQANAqgNAmQgLAmggAgQgcAcgoASIgcAMQgQAIgIAKQgKALgJAcQgKAbgKALQgQASgjAGQgpAEgTADQgQADgcALQgeALgOADQgkAJgugGQgdgEg1gOQgaAmg0ARQgsAOg4gCQghgBhCgGQg7gDgmAJQgEAqgmAbQgcAUgeAAQgLAAgKgCg");
	mask.setTransform(-47.8,46.2);

	// Masked Layer 2 - 1
	this.instance = new lib.shape6("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-138.6,2,181.6,88.4);


(lib.sprite11 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("AjUNaQgbgUgLgiQgLgiALghQggAHgegVQgegUgMghQgTg1AYhPQAMgkAYg2QAhhJAGgPQBEikAFixQgVBJgQAlQgZA6giAmQgoAtg5AQQg8AQgxgaQACBYg6BKQg6BKhWATQgKAggHBGQgGBFgLAiQgQA1gtAgQgwAigtgUQhGggAKiLQAMi8Agi9Ik+DuQgxAlghAPQgxAXgqgJQg4gLgYg8QgYg8AhguQAJgMAVgYQASgWABgTQABgWgWgdQgaglgFgMQgPgoAkg8QAzhTAFgTQADgKAFgmQADgeAJgRQARggBNgnQBGgjAIgpQgWhBAfhEQAghDBAgZQgSgYAAgiQAAggAPgeQANgZAYgaQAOgPAfgcQBehWA1gpQBUhCBOglIAFAMQBugVBkBGQBkBGASBuQA1ACAjAxQAiAvgOAzQAXhLAWgtQAghAAtgmQA0grBEgBQBGgCAoAxQAeAlADA8QACApgMBDIhEGAQA4AGAiA0QAiA1gSAzQBzgQA4gLQBfgTBIgYQAagKBpgtQBQgjA1gOQBXgWCEADIDeAGIBogBQA7ACApARQAyAUAcAuQAfAxgSAtQgQAthAAeQhNAdgjARQgfAQgyAoQg2AqgZAPQg2AfhLAMQgwAIhbAEQhpAFg4gBQhagChGgOIhfgXQg5gNgoABQgtAAhWAWQg0ANgVARQgUAPgOAbQgJASgMAiIhxFHQgOAmgKATQgQAfgWAQQgbAVgkAAIgBAAQgjAAgcgTg");
	mask.setTransform(267,-92.7);

	// Masked Layer 2 - 1
	this.instance = new lib.shape6("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(118.1,-171.9,285.6,167);


(lib.sprite9 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("AtDNuQgbgQgQgbQgZgtAFhIQAIh7BGhmQASgZAmgwQAhgrANgjQAJgWAKg2QAJgzAMgaQAKgXAYghQAhgsAGgKQAcgtAVhIIAih+QAOgqAYg3IArhfQA5h6Awh8QASgxAIgSQAQgmAQgbQAjg5A3goQA3gpBBgSIACAGQAsgKAoAZQAqAYANArQAKAigJApQgGAfgTAqQhQC0iLCKQA4A0gnCCQg4C2hcCdQhiCniCB9ILRhEQAogEAXABQAiADAYAOIAGAFQAMgNAPgJQATgKAagFQAQgCAhgCQB8gGBjgKIAAgCQATACAfgBIAygCQA+AAAhAZQAWAPALAaQALAagDAaQgDAbgQAWQgRAWgYALQgTAJgaACIguACQg6ABhbAHIiEAKQgrADgXgCQglgDgZgQIgJgHQgUAUghAKQgXAIgsAGInCA8QhoAOgyALQhVARhAAbQhQAihFA5QggAbgIAFQgYARgWADIgNABQgWAAgWgNg");
	mask.setTransform(145.3,-80.6);

	// Masked Layer 2 - 1
	this.instance = new lib.shape6("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(55.3,-169.7,180.1,178.3);


(lib.sprite7 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Mask Layer 1 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	mask.graphics.p("AAKOPQgMgFgjgSQgfgPgTgGQgbgIg0gDQg4gCgZgGQgqgKgcgfQgegiALglQhigTiMgPIjxgYQklggivhDQhBgZgogjQgzgrgDg2QghgIgvACIhRAFQhoAFgugzQgWgXgHgkQgGggAHgjQAOhDA6gzQA2gwBJgSQBxgbCpAuICJAoQBSAYA5AJQBIALC3gDQCjgDBaAXQBUAVCXBQQCaBQBRAWQgqhbAXiaIAViBQAMhKgBg0QAAgpgNhUQgMhTAAgqQgBgVADgTIgEgFQgFgHgRgfQgRgegDgIQgFgPgCgVIgBgmQABgkABgOQADgbAIgUQAOgfAegUQAfgUAgABIAAgCQA/gFA2AgIANAHQAHAEAHAAQAHAAAJgEIAPgHQAagNAwgDQBJgFAkAbQAjAaAKA0QAJA3gaAkIgOAPIAVANQAjAZAkApQAWAZAoA0QA4g2A0hbQAeg1A2htQAxhgAxg7QBAhNBLgjIAEAKQAdgJAcASQAbARAMAeQASAugUBKQgOAzgdA7QAzgJA0ANQA6AOAsAjIAeAYQASANAPAFQAKAEAPABIAaACQBLADBIAWQAhAKAMACQAZAFATgFQAIgeAXgVQAXgWAegGQAegGAeANQAeAMAQAaQAVAgAAA+QgBBjgzAiQgDAVgNAUQgSAbgdAMQgdAMgxgEQhcgFgrgoIgPgPQgKgKgGgFQgTgOgqgIIgjgIIhEgGQhBgFgjgZQgKgHgQgQIgZgXQgjgcgeAIQAQAaAFAdQAGAegHAcQgIAdgTAWQgUAYgbAJQgcAKgegIQgegIgSgWQgKgMgKgWIgSgjIgGgKQhNCSgEBqIABAxQAXgpAegWQAcgWBBgYQBDgYAbgUQAWgQAognQAmgeAhABIAAACQAugFAsANQAtANAkAcQAlAcAXApQAXAoAHAuQAGArgJA+QgNBIgDAkIgFBAQgCAngFAYQgKAvgeA7Ig1BmIg6CFQgjBQgkAtQgnAyg2AlQhFAwhCAJQgdAFglgCQgXgBgsgGQgtgFgWgFQglgJgZgPQgfgSgQgdQgTghAHgfQgegNgXgfQgUgbgJgkQgIgdgBgoIgBgmIgEAGQgcAigKAPQgTAcgIAaQgFAPgFApQgFAkgIATQgLAagaAYQgRAQghAXQhGAygqARQgxAVg0ACIgLAAQgwAAgqgRgANPKjQAcAIANgCQAQgCAWgQQAbgTAUgaQAYgdATgqQAMgcASgzQAQguANgYQAIgQAVgiQAUgfAJgTQAQghAGggQAGgaAEg2IAEhGIgEABQgKAIgjAVQgcARgNAOQgLAMgLAWIgSAkQgPAdgpAuQgsAxgPAZQgIANgTArQgNAegEAPQgGAmgGATQgGAYgSAaQgIAOgZAgQgKANgBAHQgBAHACAKIAEARIAKgBQAMAAAUAFgAidJhQACAHAEABIABgBQgGgMgDgLQgBgFgCgDIgIgEIgPgIIABACIAAAAQAUAUAHAOgAj2IfQgJgIgOgGIgagLQgagLgvgdQgSgJglgQQglgPgSgJIgygdQgdgRgYgDQgLgCgdAAQixADjJgIIAAA8ICuAjQAzAKAaACQAkAEA8gCQBLgBArAFQAaADAiAIIA7AOQBSATBXANIAAAAgAFBhSIgGAcQgCAOgBAOIgKBoQAJgHATgVQASgSAMgIIAOgIQAHgGAFgFQAHgHAFgWIAEgRQASg9Adg1QgZgCgWgOQgiANgkgKQgFA5gGAdg");
	mask.setTransform(-103.7,-83.6);

	// Masked Layer 2 - 1
	this.instance = new lib.shape6("synched",0);

	this.instance.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-256.3,-171.9,331.3,181.2);


(lib.sprite97 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 7
	this.instance = new lib.shape96("synched",0);
	this.instance.setTransform(-444.1,349.7);
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(49).to({_off:false},0).to({scaleX:1,scaleY:1,rotation:-16.6,x:-444,y:342.5},1).to({scaleX:0.99,scaleY:0.99,rotation:-33.3,y:335.4},1).to({scaleX:0.99,scaleY:0.99,rotation:-50.1,y:328.3},1).to({rotation:-117.1,x:-444.1,y:299.8},4).to({scaleX:0.99,scaleY:0.99,rotation:-133.9,x:-444.2,y:292.8},1).to({scaleX:1,scaleY:1,rotation:-150.7,y:285.6},1).to({scaleX:1,scaleY:1,rotation:-167.5,x:-444.1,y:278.5},1).to({scaleX:1,scaleY:1,rotation:-184,y:271.4},1).to({scaleX:1,scaleY:1,rotation:-200.8,x:-444,y:264.3},1).to({rotation:-217.6,y:257.2},1).to({scaleX:1,scaleY:1,rotation:-234.4,x:-444.1,y:250},1).to({scaleX:0.99,scaleY:0.99,rotation:-231.2,x:-444,y:243},1).to({scaleX:0.99,scaleY:0.99,rotation:-227.9,y:235.9},1).to({scaleX:0.99,scaleY:0.99,rotation:-221.4,x:-443.9,y:221.6},2).to({scaleX:1,scaleY:1,rotation:-182.3,x:-444.1,y:136.2},12).to({rotation:-179.2,y:129.1},1).to({rotation:-176,y:122},1).to({scaleX:1,scaleY:1,rotation:-192.5,y:114.8},1).to({scaleX:0.99,scaleY:0.99,rotation:-226.1,x:-444,y:100.7},2).to({scaleX:0.99,scaleY:0.99,rotation:-276.3,y:79.3},3).to({rotation:-293.1,y:72.2},1).to({scaleX:0.99,scaleY:0.99,rotation:-309.9,y:65.1},1).to({scaleX:0.99,scaleY:0.99,rotation:-326.7,y:57.9},1).to({scaleX:1,scaleY:1,rotation:-343.4,y:50.8},1).to({scaleX:1,scaleY:1,rotation:-360,x:-444.1,y:43.7},1).to({x:-454.1,y:-77.8,alpha:0},18).wait(1));

	// Layer 6
	this.instance_1 = new lib.shape96("synched",0);
	this.instance_1.setTransform(-453.1,349.7);
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(19).to({_off:false},0).to({scaleX:0.99,scaleY:0.99,rotation:-12.5,x:-452.9,y:338.2},2).to({scaleX:0.99,scaleY:0.99,rotation:-31.6,x:-452.6,y:320.7},3).to({scaleX:1,scaleY:1,rotation:-161.2,x:-450.3,y:204.9},20).to({scaleX:1,scaleY:1,rotation:-167.5,y:199.1},1).to({scaleX:1,scaleY:1,rotation:-173.7,x:-450.2,y:193.4},1).to({rotation:-180,x:-450.1,y:187.6},1).to({scaleX:1,scaleY:1,rotation:-186.3,x:-450,y:181.9},1).to({scaleX:0.99,scaleY:0.99,rotation:-198.8,x:-449.7,y:170.2},2).to({scaleX:0.99,scaleY:0.99,rotation:-211.8,x:-449.5,y:158.7},2).to({rotation:-231.2,x:-449.1,y:141.2},3).to({scaleX:1,scaleY:1,rotation:-360,x:-447,y:25.5},20).to({y:-20.4,alpha:0.078},11).wait(1).to({y:-24.5,alpha:0},0).to({_off:true},9).wait(15));

	// Layer 5
	this.instance_2 = new lib.shape96("synched",0);
	this.instance_2.setTransform(-331.1,395,0.35,0.35);
	this.instance_2.alpha = 0;
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(3).to({_off:false},0).to({scaleX:0.35,scaleY:0.35,rotation:33.9,x:-330.2,y:392.4,alpha:0.09},1).to({scaleX:0.35,scaleY:0.35,rotation:67.9,x:-329.3,y:389.7,alpha:0.18},1).to({rotation:135.7,x:-327.7,y:384.1,alpha:0.34},2).to({scaleX:0.35,scaleY:0.35,rotation:169.7,x:-326.9,y:381.4,alpha:0.422},1).to({scaleX:0.35,scaleY:0.35,rotation:203.3,x:-326.1,y:378.7,alpha:0.5},1).to({rotation:177.4,x:-325.3,y:375.9,alpha:0.578},1).to({scaleX:0.35,scaleY:0.35,rotation:151.4,x:-324.4,y:373.2,alpha:0.66},1).to({rotation:125.3,x:-323.5,y:370.5,alpha:0.75},1).to({scaleX:0.35,scaleY:0.35,rotation:73.2,x:-321.9,y:365.1,alpha:0.922},2).to({rotation:46.9,x:-321.1,y:362.4,alpha:1},1).to({rotation:36.3,x:-320.6,y:360.1},1).to({scaleX:0.35,scaleY:0.35,rotation:43.9,x:-320.2,y:357.8},1).to({scaleX:0.35,scaleY:0.35,rotation:58.9,x:-319.2,y:353.3},2).to({scaleX:0.35,scaleY:0.35,rotation:178.2,x:-311.9,y:316.6},16).to({rotation:175.2,x:-311.1,y:312},2).to({rotation:180,x:-305.1,y:282.3},13).to({rotation:180.1,x:-304.7,y:280},1).to({rotation:180.3,x:-304.3,y:277.8},1).to({rotation:181.8,x:-301.4,y:264},6).to({rotation:182.3,x:-300.6,y:259.4},2).to({rotation:187,x:-296,y:236.6},10).to({rotation:176.7,x:-295.6,y:234.3},1).to({scaleX:0.35,scaleY:0.35,rotation:166.2,x:-295.1,y:232.1},1).to({scaleX:0.35,scaleY:0.35,rotation:145.2,x:-294.2,y:227.5},2).to({scaleX:0.35,scaleY:0.35,rotation:71.2,x:-291,y:211.4},7).to({scaleX:0.35,scaleY:0.35,rotation:66.2,y:209.4,alpha:0.93},1).to({scaleX:0.35,scaleY:0.35,rotation:56.2,y:205.4,alpha:0.789},2).to({scaleX:0.35,scaleY:0.35,rotation:0,x:-291.1,y:183.4,alpha:0},11).to({_off:true},1).wait(15));

	// Layer 4
	this.instance_3 = new lib.shape96("synched",0);
	this.instance_3.setTransform(-199.6,395,0.35,0.35);
	this.instance_3.alpha = 0;
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(3).to({_off:false},0).to({scaleX:0.35,scaleY:0.35,rotation:33.9,x:-199.7,y:392.3,alpha:0.09},1).to({scaleX:0.35,scaleY:0.35,rotation:67.9,x:-199.6,y:389.5,alpha:0.172},1).to({rotation:135.7,y:384.1,alpha:0.34},2).to({scaleX:0.35,scaleY:0.35,rotation:169.7,x:-199.5,y:381.4,alpha:0.422},1).to({scaleX:0.35,scaleY:0.35,rotation:203.3,x:-199.6,y:378.7,alpha:0.5},1).to({rotation:177.4,y:376,alpha:0.578},1).to({scaleX:0.35,scaleY:0.35,rotation:151.4,y:373.3,alpha:0.66},1).to({rotation:125.3,x:-199.5,y:370.6,alpha:0.75},1).to({scaleX:0.35,scaleY:0.35,rotation:73.2,x:-199.6,y:365.2,alpha:0.922},2).to({rotation:46.9,y:362.4,alpha:1},1).to({rotation:36.3,x:-199.5,y:359.3},1).to({scaleX:0.35,scaleY:0.35,rotation:43.9,y:356.3},1).to({scaleX:0.35,scaleY:0.35,rotation:51.4,x:-199.4,y:353.4},1).to({rotation:66.4,y:347.3},2).to({scaleX:0.35,scaleY:0.35,rotation:178.2,x:-199.6,y:301.9},15).to({rotation:185.5,y:298.9},1).to({rotation:175.2,x:-199.5,y:295.9},1).to({rotation:180,y:256.6},13).to({rotation:180.1,x:-199.6,y:253.6},1).to({rotation:180.3,y:250.6},1).to({rotation:182.3,y:226.5},8).to({rotation:182.5,y:223.4},1).to({rotation:183,y:220.4},1).to({rotation:186.5,x:-199.5,y:199.2},7).to({rotation:181.5,x:-199.6,y:196.2},1).to({scaleX:0.35,scaleY:0.35,rotation:176.7,x:-199.5,y:193.1},1).to({scaleX:0.35,scaleY:0.35,rotation:155.7,y:187.2},2).to({scaleX:0.35,scaleY:0.35,rotation:134.4,y:181},2).to({scaleX:0.35,scaleY:0.35,rotation:71.2,y:162.9},6).to({scaleX:0.35,scaleY:0.35,rotation:66.2,x:-198.1,y:161.7,alpha:0.93},1).to({scaleX:0.35,scaleY:0.35,rotation:61.2,x:-196.6,y:160.5,alpha:0.859},1).to({scaleX:0.35,scaleY:0.35,rotation:0,x:-179.6,y:144.9,alpha:0},12).to({_off:true},1).wait(15));

	// Layer 3
	this.instance_4 = new lib.shape96("synched",0);
	this.instance_4.setTransform(-348.6,380.8,0.6,0.6,75);
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(9).to({_off:false},0).to({scaleX:0.6,scaleY:0.6,rotation:61.2,x:-347.1,y:377.5},1).to({scaleX:0.61,scaleY:0.61,rotation:47.4,x:-345.7,y:374.2},1).to({scaleX:0.62,scaleY:0.62,rotation:19.8,x:-343.1,y:367.4},2).to({scaleX:0.62,scaleY:0.62,rotation:31.6,x:-343,y:363.8},1).to({scaleX:0.62,scaleY:0.62,rotation:43.6,x:-342.7,y:360.2},1).to({scaleX:0.63,scaleY:0.63,rotation:55.7,x:-342.6,y:356.6},1).to({scaleX:0.64,scaleY:0.64,rotation:79.7,x:-342.4,y:349.4},2).to({scaleX:0.68,scaleY:0.68,rotation:175.2,x:-341.6,y:320.6},8).to({scaleX:0.69,scaleY:0.69,rotation:187,x:-341.5,y:317},1).to({scaleX:0.69,scaleY:0.69,rotation:173.5,x:-341.6,y:313.4},1).to({scaleX:0.69,scaleY:0.69,rotation:159.7,x:-341.4,y:309.9},1).to({scaleX:0.7,scaleY:0.7,rotation:145.9,x:-341.1,y:306.4},1).to({scaleX:0.7,scaleY:0.7,rotation:132.1,x:-340.8,y:302.8},1).to({scaleX:0.71,scaleY:0.71,rotation:104.5,x:-340.4,y:295.5},2).to({scaleX:0.73,scaleY:0.73,rotation:63.2,x:-339.6,y:284.8},3).to({scaleX:0.74,scaleY:0.74,rotation:49.4,x:-339.2,y:281.3},1).to({scaleX:0.73,scaleY:0.73,rotation:48.4,x:-338.5,y:277.8},1).to({scaleX:0.72,scaleY:0.72,rotation:47.4,x:-337.8,y:274.3},1).to({scaleX:0.71,scaleY:0.71,rotation:46.6,x:-337.1,y:270.9},1).to({scaleX:0.69,scaleY:0.69,rotation:45.6,x:-336.4,y:267.4},1).to({scaleX:0.69,scaleY:0.69,rotation:44.6,x:-335.6,y:263.9},1).to({scaleX:0.66,scaleY:0.66,rotation:41.6,x:-333.4,y:253.5},3).to({scaleX:0.63,scaleY:0.63,rotation:37.6,x:-330.4,y:239.5},4).to({scaleX:0.43,scaleY:0.43,rotation:15.5,x:-311.8,y:152.1},25).to({scaleX:0.43,scaleY:0.43,rotation:14.5,x:-311.1,y:148.6,alpha:0.941},1).to({scaleX:0.4,scaleY:0.4,rotation:6.5,x:-306.5,y:120.4,alpha:0.48},8).to({scaleX:0.39,scaleY:0.39,rotation:4.5,x:-305.6,y:113.3,alpha:0.359},2).to({scaleX:0.37,scaleY:0.37,rotation:0,x:-302.9,y:92,alpha:0},6).to({_off:true},1).wait(19));

	// Layer 2
	this.instance_5 = new lib.shape96("synched",0);
	this.instance_5.setTransform(-288.6,380.8,0.6,0.6,75);
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(25).to({_off:false},0).to({scaleX:0.6,scaleY:0.6,rotation:61.2,x:-287.1,y:377.5},1).to({scaleX:0.61,scaleY:0.61,rotation:47.4,x:-285.7,y:374.1},1).to({scaleX:0.62,scaleY:0.62,rotation:19.8,x:-283.2,y:367.3},2).to({scaleX:0.62,scaleY:0.62,rotation:31.6,x:-283,y:363.9},1).to({scaleX:0.62,scaleY:0.62,rotation:43.6,y:360.2},1).to({scaleX:0.63,scaleY:0.63,rotation:67.7,x:-282.7,y:353},2).to({scaleX:0.66,scaleY:0.66,rotation:139.4,x:-281.9,y:331.4},6).to({scaleX:0.67,scaleY:0.67,rotation:163.4,x:-281.7,y:324.1},2).to({scaleX:0.68,scaleY:0.68,rotation:175.2,x:-281.5,y:320.6},1).to({scaleX:0.69,scaleY:0.69,rotation:187,x:-281.4,y:317},1).to({scaleX:0.69,scaleY:0.69,rotation:173.5,x:-281.6,y:313.4},1).to({scaleX:0.69,scaleY:0.69,rotation:159.7,x:-281.4,y:309.9},1).to({scaleX:0.7,scaleY:0.7,rotation:145.9,x:-281.3,y:306.4},1).to({scaleX:0.7,scaleY:0.7,rotation:132.1,x:-280.9,y:302.8},1).to({scaleX:0.71,scaleY:0.71,rotation:104.5,x:-280.3,y:295.7},2).to({scaleX:0.73,scaleY:0.73,rotation:63.2,x:-279.6,y:284.8},3).to({scaleX:0.74,scaleY:0.74,rotation:49.4,x:-279.2,y:281.3},1).to({scaleX:0.73,scaleY:0.73,rotation:48.4,x:-278.5,y:277.8},1).to({scaleX:0.72,scaleY:0.72,rotation:47.4,x:-277.8,y:274.3},1).to({scaleX:0.71,scaleY:0.71,rotation:46.6,x:-277.2,y:270.9},1).to({scaleX:0.69,scaleY:0.69,rotation:45.6,x:-276.5,y:267.4},1).to({scaleX:0.68,scaleY:0.68,rotation:44.6,x:-275.7,y:263.9},1).to({scaleX:0.66,scaleY:0.66,rotation:41.6,x:-273.3,y:253.5},3).to({scaleX:0.64,scaleY:0.64,rotation:39.6,x:-271.9,y:246.4},2).to({scaleX:0.63,scaleY:0.63,rotation:37.9,x:-270.3,y:239.3},2).to({scaleX:0.61,scaleY:0.61,rotation:35.9,x:-268.8,y:232.2},2).to({scaleX:0.43,scaleY:0.43,rotation:15.5,x:-251.8,y:152.1},23).to({scaleX:0.43,scaleY:0.43,rotation:14.5,x:-251.2,y:148.6,alpha:0.941},1).to({scaleX:0.4,scaleY:0.4,rotation:6.5,x:-246.7,y:120.3,alpha:0.48},8).to({scaleX:0.39,scaleY:0.39,rotation:4.5,x:-245.6,y:113.2,alpha:0.359},2).to({scaleX:0.37,scaleY:0.37,rotation:0,x:-242.9,y:92,alpha:0},6).to({_off:true},1).wait(3));

	// Layer 1
	this.instance_6 = new lib.shape96("synched",0);
	this.instance_6.setTransform(-380.6,402.5);
	this.instance_6.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).to({scaleX:1,scaleY:1,rotation:9.3,x:-383.5,y:395.3,alpha:0.129},1).to({scaleX:0.99,scaleY:0.99,rotation:37.3,x:-391.8,y:373.6,alpha:0.5},3).to({scaleX:0.99,scaleY:0.99,rotation:46.9,x:-393.8,y:366.3,alpha:0.629},1).to({scaleX:1,scaleY:1,rotation:75,x:-397,y:343.7,alpha:1},3).to({scaleX:1,scaleY:1,rotation:84,x:-385.9,y:315},4).to({scaleX:0.99,scaleY:0.99,rotation:107.5,x:-323.5,y:253.9},11).to({scaleX:0.99,scaleY:0.99,rotation:109.8,x:-317.4,y:248.7},1).to({scaleX:0.99,scaleY:0.99,rotation:112,x:-311.3,y:243.6},1).to({scaleX:1,scaleY:1,rotation:114.3,x:-305.2,y:238.5},1).to({scaleX:1,scaleY:1,rotation:116.7,x:-299.2,y:233.4},1).to({scaleX:1,scaleY:1,rotation:136.9,x:-293.4,y:228.6},1).to({rotation:157.2,x:-287.9,y:223.9},1).to({scaleX:1,scaleY:1,rotation:177.4,x:-282.2,y:219.1},1).to({scaleX:1,scaleY:1,rotation:197.3,x:-276.5,y:214.3},1).to({rotation:217.6,x:-271,y:209.7},1).to({rotation:237.9,x:-265.5,y:204.9},1).to({scaleX:0.99,scaleY:0.99,rotation:232.4,x:-259.9,y:200.2},1).to({scaleX:0.99,scaleY:0.99,rotation:226.9,x:-254.4,y:195.5},1).to({scaleX:0.99,scaleY:0.99,rotation:221.4,x:-249,y:190.8},1).to({rotation:215.8,x:-243.6,y:186},1).to({scaleX:1,scaleY:1,rotation:182.8,x:-214.8,y:153.4},6).to({rotation:177.2,x:-211.1,y:147.1},1).to({scaleX:1,scaleY:1,rotation:171.7,x:-207.7,y:140.3},1).to({rotation:166.2,x:-204.9,y:133.4},1).to({scaleX:1,scaleY:1,rotation:160.7,x:-202.6,y:126.1},1).to({scaleX:1,scaleY:1,rotation:180.8,x:-200.8,y:118.8},1).to({scaleX:1,scaleY:1,rotation:201,x:-199.6,y:111.3},1).to({scaleX:0.99,scaleY:0.99,rotation:199.5,x:-199,y:103.6},1).to({scaleX:0.99,scaleY:0.99,rotation:198,x:-198.6,y:95.7},1).to({scaleX:0.99,scaleY:0.99,rotation:195,x:-198.4,y:80.1},2).to({scaleX:1,scaleY:1,rotation:180.8,x:-200.3,y:2.3},10).to({rotation:179.5,x:-199.3,y:-4.9},1).to({rotation:177.9,x:-197.8,y:-12.6},1).to({scaleX:1,scaleY:1,rotation:198.8,x:-195.8,y:-20.2},1).to({scaleX:0.99,scaleY:0.99,rotation:219.9,x:-193.2,y:-27.4},1).to({rotation:241.2,x:-190.2,y:-34.5},1).to({scaleX:1,scaleY:1,rotation:262.2,x:-186.5,y:-41.1},1).to({scaleX:1,scaleY:1,rotation:283.3,x:-182.4,y:-47.5},1).to({scaleX:0.99,scaleY:0.99,rotation:289.5,x:-176.5,y:-55.8,alpha:0.961},1).to({scaleX:0.99,scaleY:0.99,rotation:295.8,x:-170,y:-63.9,alpha:0.922},1).to({scaleX:0.99,scaleY:0.99,rotation:308.4,x:-156.3,y:-79.4,alpha:0.84},2).to({scaleX:0.99,scaleY:0.99,rotation:321.4,x:-142.2,y:-95,alpha:0.762},2).to({scaleX:1,scaleY:1,rotation:435,x:-29,y:-256,alpha:0},18).to({_off:true},1).wait(16));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-388.6,395,16,15);


(lib.sprite21 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_49 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(49).call(this.frame_49).wait(1));

	// Layer 31
	this.instance = new lib.sprite20();
	this.instance.setTransform(240.5,261,1.3,1.3);
	this.instance.alpha = 0.199;
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(27).to({_off:false},0).to({scaleX:1,scaleY:1,alpha:0},7).to({_off:true},1).wait(15));

	// Layer 29
	this.instance_1 = new lib.sprite20();
	this.instance_1.setTransform(240.5,261,1.3,1.3);
	this.instance_1.alpha = 0.199;
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(24).to({_off:false},0).to({scaleX:1,scaleY:1,alpha:0},7).to({_off:true},1).wait(18));

	// Layer 25
	this.instance_2 = new lib.sprite19();
	this.instance_2.setTransform(-193.6,217,3.622,3.622);
	this.instance_2.alpha = 0;
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(21).to({_off:false},0).to({scaleX:3.33,scaleY:3.33,x:-145.3,y:222,alpha:0.109},1).to({scaleX:2.46,scaleY:2.46,x:-0.6,y:236.6,alpha:0.449},1).wait(1).to({scaleX:1,scaleY:1,x:240.5,y:261,alpha:1},0).wait(26));

	// Layer 21
	this.instance_3 = new lib.sprite17();
	this.instance_3.setTransform(240.5,261,4.787,4.787);
	this.instance_3.alpha = 0;
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(18).to({_off:false},0).to({scaleX:4.37,scaleY:4.37,y:260.9,alpha:0.109},1).to({scaleX:3.1,scaleY:3.1,y:261,alpha:0.449},1).wait(1).to({scaleX:1,scaleY:1,alpha:1},0).wait(29));

	// Layer 17
	this.instance_4 = new lib.sprite15();
	this.instance_4.setTransform(-149.4,581.9);
	this.instance_4.alpha = 0;
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(15).to({_off:false},0).to({x:-106.1,y:546.3,alpha:0.109},1).to({x:23.9,y:439.3,alpha:0.449},1).wait(1).to({x:240.5,y:261,alpha:1},0).wait(32));

	// Layer 13
	this.instance_5 = new lib.sprite13();
	this.instance_5.setTransform(-186.4,25);
	this.instance_5.alpha = 0;
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(11).to({_off:false},0).to({x:-139,y:51.2,alpha:0.109},1).to({x:3.3,y:129.9,alpha:0.449},1).wait(1).to({x:240.5,y:261,alpha:1},0).wait(36));

	// Layer 9
	this.instance_6 = new lib.sprite11();
	this.instance_6.setTransform(572.6,-378.2,1,1,11.2);
	this.instance_6.alpha = 0;
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(7).to({_off:false},0).to({scaleX:1,scaleY:1,rotation:10.5,x:551.9,y:-338.2,alpha:0.059},1).to({scaleX:1,scaleY:1,rotation:8.3,x:489.6,y:-218.4,alpha:0.25},1).to({rotation:4.8,x:385.8,y:-18.6,alpha:0.559},1).wait(1).to({rotation:0,x:240.5,y:261,alpha:1},0).wait(39));

	// Layer 5
	this.instance_7 = new lib.sprite9();
	this.instance_7.setTransform(-530.6,518.1,1,1,-8);
	this.instance_7.alpha = 0;
	this.instance_7._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(3).to({_off:false},0).to({rotation:-7.3,x:-482.5,y:502,alpha:0.059},1).to({rotation:-5.8,x:-337.8,y:453.8,alpha:0.25},1).to({rotation:-3.3,x:-96.8,y:373.5,alpha:0.559},1).wait(1).to({rotation:0,x:240.5,y:261,alpha:1},0).wait(43));

	// Layer 1
	this.instance_8 = new lib.sprite7();
	this.instance_8.setTransform(632.6,729.7,4.607,4.607);
	this.instance_8.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance_8).to({scaleX:4.21,scaleY:4.21,x:421.5,y:639.8,alpha:0.109},1).to({scaleX:3,scaleY:3,x:276.4,y:534.8,alpha:0.449},1).wait(1).to({scaleX:1,scaleY:1,x:240.5,y:261,alpha:1},0).wait(47));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-667.9,-83,3160.4,1430.2);


(lib.sprite98 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// Layer 10
	this.instance = new lib.sprite97();
	this.instance.setTransform(-20.6,179.2);
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(24).to({_off:false},0).wait(54));

	// Layer 9
	this.instance_1 = new lib.shape96("synched",0);
	this.instance_1.setTransform(-444.1,349.7);
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(41).to({_off:false},0).to({scaleX:1,scaleY:1,rotation:-20.5,y:341},1).to({scaleX:0.99,scaleY:0.99,rotation:-41.1,y:332.2},1).to({scaleX:0.99,scaleY:0.99,rotation:-61.7,y:323.5},1).to({rotation:-82.4,x:-444.2,y:314.8},1).to({rotation:-102.8,x:-444.1,y:306},1).to({scaleX:0.99,scaleY:0.99,rotation:-123.6,y:297.3},1).to({scaleX:1,scaleY:1,rotation:-144.2,y:288.5},1).to({scaleX:1,scaleY:1,rotation:-164.7,y:279.7},1).to({scaleX:1,scaleY:1,rotation:-185,y:271},1).to({scaleX:1,scaleY:1,rotation:-205.6,y:262.2},1).to({rotation:-226.4,y:253.6},1).to({scaleX:1,scaleY:1,rotation:-246.9,y:244.8},1).to({scaleX:1,scaleY:1,rotation:-241.9,y:236.1},1).to({scaleX:0.99,scaleY:0.99,rotation:-236.9,y:227.4},1).to({scaleX:0.99,scaleY:0.99,rotation:-231.7,y:218.6},1).to({scaleX:0.99,scaleY:0.99,rotation:-221.4,y:201.1},2).to({scaleX:0.99,scaleY:0.99,rotation:-200.6,y:166.1},4).to({scaleX:1,scaleY:1,rotation:-180,y:131.2},4).to({rotation:-175,y:122.4},1).to({scaleX:1,scaleY:1,rotation:-195.3,y:113.6},1).to({scaleX:1,scaleY:1,rotation:-215.9,x:-444,y:105},1).to({scaleX:1,scaleY:1,rotation:-236.6,x:-444.1,y:96.3},1).to({scaleX:0.99,scaleY:0.99,rotation:-257.2,y:87.5},1).to({scaleX:1,scaleY:1,rotation:-339.5,y:52.4},4).wait(1).to({scaleX:1,scaleY:1,rotation:-360,y:43.7},0).wait(2));

	// Layer 8
	this.instance_2 = new lib.shape96("synched",0);
	this.instance_2.setTransform(-453.1,349.7);
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(19).to({_off:false},0).to({scaleX:0.99,scaleY:0.99,rotation:-18,x:-452.7,y:333.6},2).to({scaleX:0.99,scaleY:0.99,rotation:-36.1,x:-452.4,y:317.2},2).to({scaleX:0.99,scaleY:0.99,rotation:-144.2,x:-450.6,y:220},12).to({scaleX:1,scaleY:1,rotation:-162.2,x:-450.4,y:203.8},2).to({scaleX:1,scaleY:1,rotation:-171.2,x:-450.2,y:195.7},1).to({rotation:-180,x:-450,y:187.6},1).to({scaleX:0.99,scaleY:0.99,rotation:-198,x:-449.5,y:171.6},2).to({scaleX:0.99,scaleY:0.99,rotation:-216.1,x:-449.2,y:155.3},2).to({scaleX:1,scaleY:1,rotation:-351.2,x:-447.1,y:33.6},15).wait(1).to({rotation:-360,x:-447,y:25.5},0).to({_off:true},4).wait(15));

	// Layer 7
	this.instance_3 = new lib.shape96("synched",0);
	this.instance_3.setTransform(-331.1,395,0.35,0.35);
	this.instance_3.alpha = 0;
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(3).to({_off:false},0).to({scaleX:0.35,scaleY:0.35,rotation:33.9,x:-330.2,y:392.4,alpha:0.09},1).to({scaleX:0.35,scaleY:0.35,rotation:67.9,x:-329.3,y:389.7,alpha:0.18},1).to({rotation:135.7,x:-327.7,y:384.1,alpha:0.34},2).to({scaleX:0.35,scaleY:0.35,rotation:169.7,x:-326.9,y:381.4,alpha:0.422},1).to({scaleX:0.35,scaleY:0.35,rotation:203.3,x:-326.1,y:378.7,alpha:0.5},1).to({rotation:177.4,x:-325.3,y:375.9,alpha:0.578},1).to({scaleX:0.35,scaleY:0.35,rotation:151.4,x:-324.4,y:373.2,alpha:0.66},1).to({rotation:125.3,x:-323.5,y:370.5,alpha:0.75},1).to({scaleX:0.35,scaleY:0.35,rotation:73.2,x:-321.9,y:365.1,alpha:0.922},2).to({rotation:46.9,x:-321.1,y:362.4,alpha:1},1).to({rotation:32.9,x:-320.5,y:359.3},1).to({scaleX:0.35,scaleY:0.35,rotation:42.9,x:-320,y:356.3},1).to({scaleX:0.35,scaleY:0.35,rotation:53.1,x:-319.4,y:353.4},1).to({rotation:73.4,x:-318.1,y:347.3},2).to({scaleX:0.35,scaleY:0.35,rotation:174.2,x:-312.1,y:317.1},10).to({rotation:184.3,x:-311.5,y:314.1},1).to({rotation:170.5,x:-310.8,y:311.1},1).to({rotation:179.2,x:-306,y:286.9},8).to({rotation:180,x:-305.4,y:283.9},1).to({rotation:196.3,x:-296.4,y:238.6},15).to({scaleX:0.35,scaleY:0.35,rotation:182.5,x:-295.8,y:235.6},1).to({scaleX:0.35,scaleY:0.35,rotation:168.7,x:-295.2,y:232.6},1).to({scaleX:0.35,scaleY:0.35,rotation:154.9,x:-294.6,y:229.5},1).to({scaleX:0.35,scaleY:0.35,rotation:140.9,x:-293.9,y:226.6},1).to({rotation:112.8,x:-292.7,y:220.5},2).to({scaleX:0.35,scaleY:0.35,rotation:71.2,x:-291,y:211.4},3).to({scaleX:0.35,scaleY:0.35,rotation:66.2,y:209.4,alpha:0.93},1).to({rotation:40.6,x:-291.1,y:199.4,alpha:0.57},5).wait(1).to({scaleX:0.35,scaleY:0.35,rotation:35.6,y:197.3,alpha:0.5},0).wait(6));

	// Layer 6
	this.instance_4 = new lib.shape96("synched",0);
	this.instance_4.setTransform(-199.6,395,0.35,0.35);
	this.instance_4.alpha = 0;
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(3).to({_off:false},0).to({scaleX:0.35,scaleY:0.35,rotation:33.9,y:392.2,alpha:0.09},1).to({scaleX:0.35,scaleY:0.35,rotation:67.9,x:-199.7,y:389.4,alpha:0.172},1).to({rotation:135.7,x:-199.8,y:384,alpha:0.34},2).to({scaleX:0.35,scaleY:0.35,rotation:169.7,x:-199.9,y:381.3,alpha:0.422},1).to({scaleX:0.35,scaleY:0.35,rotation:177.4,x:-200.1,y:375.9,alpha:0.578},2).to({scaleX:0.35,scaleY:0.35,rotation:151.4,x:-200.2,y:373.1,alpha:0.66},1).to({rotation:125.3,x:-200.3,y:370.4,alpha:0.75},1).to({scaleX:0.35,scaleY:0.35,rotation:73.2,x:-200.6,y:364.9,alpha:0.922},2).to({rotation:46.9,x:-200.7,y:362.2,alpha:1},1).to({rotation:32.9,x:-201,y:358.6},1).to({scaleX:0.35,scaleY:0.35,rotation:42.9,x:-201.2,y:355},1).to({scaleX:0.35,scaleY:0.35,rotation:53.1,x:-201.4,y:351.5},1).to({rotation:63.2,x:-201.7,y:347.8},1).to({scaleX:0.35,scaleY:0.35,rotation:174.2,x:-204.4,y:308.5},11).to({rotation:184.3,x:-204.6,y:304.9},1).to({rotation:170.5,x:-204.7,y:301.4},1).to({rotation:179.2,x:-205.6,y:272.5},8).to({rotation:180,y:268.8},1).to({rotation:196.3,x:-202.6,y:214.8},15).to({scaleX:0.35,scaleY:0.35,rotation:182.5,x:-202,y:211.1},1).to({scaleX:0.35,scaleY:0.35,rotation:168.7,x:-201.5,y:207.6},1).to({scaleX:0.35,scaleY:0.35,rotation:140.9,x:-200.2,y:200.6},2).to({rotation:112.8,x:-198.8,y:193.6},2).to({scaleX:0.35,scaleY:0.35,rotation:71.2,x:-196.2,y:183.4},3).to({scaleX:0.35,scaleY:0.35,rotation:66.2,x:-195.4,y:180.6,alpha:0.93},1).to({scaleX:0.35,scaleY:0.35,rotation:61.2,x:-194.5,y:177.7,alpha:0.859},1).to({scaleX:0.35,scaleY:0.35,rotation:40.6,x:-190.9,y:166.6,alpha:0.57},4).wait(1).to({scaleX:0.35,scaleY:0.35,rotation:35.6,x:-189.5,y:163.9,alpha:0.5},0).wait(6));

	// Layer 5
	this.instance_5 = new lib.shape96("synched",0);
	this.instance_5.setTransform(-348.6,380.8,0.6,0.6,75);
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(9).to({_off:false},0).to({scaleX:0.62,scaleY:0.62,rotation:26.8,x:-343.6,y:369.1},3).to({scaleX:0.62,scaleY:0.62,rotation:40.6,x:-343.3,y:365},1).to({scaleX:0.62,scaleY:0.62,rotation:54.7,x:-343.1,y:360.8},1).to({scaleX:0.63,scaleY:0.63,rotation:68.7,x:-342.9,y:356.6},1).to({scaleX:0.65,scaleY:0.65,rotation:124.1,x:-342.2,y:339.8},4).to({scaleX:0.66,scaleY:0.66,rotation:152.2,x:-341.9,y:331.4},2).to({scaleX:0.68,scaleY:0.68,rotation:180,x:-341.6,y:323},2).to({scaleX:0.68,scaleY:0.68,rotation:193.8,x:-341.4,y:318.8},1).to({scaleX:0.69,scaleY:0.69,rotation:178,x:-341.6,y:314.6},1).to({scaleX:0.69,scaleY:0.69,rotation:162,x:-341.4,y:310.5},1).to({scaleX:0.7,scaleY:0.7,rotation:145.9,x:-341.3,y:306.3},1).to({scaleX:0.7,scaleY:0.7,rotation:129.8,x:-341.1,y:302.2},1).to({scaleX:0.71,scaleY:0.71,rotation:113.6,x:-340.8,y:298},1).to({scaleX:0.72,scaleY:0.72,rotation:81.5,x:-340,y:289.6},2).to({scaleX:0.73,scaleY:0.73,rotation:65.5,x:-339.7,y:285.5},1).to({scaleX:0.74,scaleY:0.74,rotation:49.4,x:-339.2,y:281.3},1).to({scaleX:0.7,scaleY:0.7,rotation:46.9,x:-337.1,y:271.1},2).to({scaleX:0.68,scaleY:0.68,rotation:44.1,x:-334.9,y:260.7},2).to({scaleX:0.67,scaleY:0.67,rotation:42.6,x:-333.8,y:255.6},1).to({scaleX:0.43,scaleY:0.43,rotation:15.5,x:-311.8,y:152.1},20).to({scaleX:0.43,scaleY:0.43,rotation:14.5,x:-311.1,y:148.6,alpha:0.941},1).to({scaleX:0.4,scaleY:0.4,rotation:6.5,x:-306.6,y:120.3,alpha:0.48},8).to({scaleX:0.39,scaleY:0.39,rotation:4.5,x:-305.6,y:113.2,alpha:0.359},2).to({scaleX:0.37,scaleY:0.37,rotation:0,x:-302.9,y:92,alpha:0},6).to({_off:true},1).wait(2));

	// Layer 4
	this.instance_6 = new lib.shape96("synched",0);
	this.instance_6.setTransform(-461.9,361);
	this.instance_6._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(36).to({_off:false},0).to({scaleX:1,scaleY:1,rotation:41.1,x:-440},1).to({scaleX:1,scaleY:1,rotation:82.5,x:-418.3,y:359.8},1).to({rotation:123.6,x:-397.1,y:357.2},1).to({scaleX:1,scaleY:1,rotation:165,x:-375.9,y:353.3},1).to({rotation:206.1,x:-354.8,y:348.1},1).to({scaleX:1,scaleY:1,rotation:247.4,x:-334,y:341.7},1).to({scaleX:1,scaleY:1,rotation:288.6,x:-313.5,y:334.1},1).to({scaleX:1,scaleY:1,rotation:258,x:-293.3,y:325.3},1).to({rotation:227.1,x:-273.5,y:315.5},1).to({scaleX:1,scaleY:1,rotation:196.3,x:-254.2,y:304.5},1).to({rotation:165.7,x:-235.3,y:292.8},1).to({scaleX:1,scaleY:1,rotation:134.9,x:-216.9,y:280.3},1).to({scaleX:1,scaleY:1,rotation:176.2,x:-199.2,y:267.3},1).to({scaleX:1,scaleY:1,rotation:217.4,x:-181.8,y:253.4},1).to({scaleX:1,scaleY:1,rotation:300,x:-146.5,y:226.2},2).to({scaleX:1,scaleY:1,rotation:301.3,x:-137.5,y:220.9},1).to({scaleX:0.99,scaleY:0.99,rotation:302.6,x:-128.3,y:216.1},1).to({scaleX:0.99,scaleY:0.99,rotation:304.1,x:-118.9,y:211.6},1).to({scaleX:0.99,scaleY:0.99,rotation:307.1,x:-99.9,y:203.3},2).to({scaleX:1,scaleY:1,rotation:336.5,x:89.8,y:120.3},20).wait(1));

	// Layer 3
	this.instance_7 = new lib.shape96("synched",0);
	this.instance_7.setTransform(-288.6,380.8,0.6,0.6,75);
	this.instance_7._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(25).to({_off:false},0).to({scaleX:0.67,scaleY:0.67,rotation:170.2,x:-282.9,y:331.2},4).to({scaleX:0.68,scaleY:0.68,rotation:193.8,x:-281.5,y:318.8},1).to({scaleX:0.7,scaleY:0.7,rotation:145.9,x:-282,y:306.2},1).to({scaleX:0.74,scaleY:0.74,rotation:49.4,x:-279.2,y:281.3},2).to({scaleX:0.43,scaleY:0.43,rotation:15.5,x:-251.8,y:152.1},19).to({scaleX:0.37,scaleY:0.37,rotation:0,x:-242.9,y:92,alpha:0},12).to({_off:true},1).wait(13));

	// Layer 2
	this.instance_8 = new lib.shape96("synched",0);
	this.instance_8.setTransform(-349.1,381.1);
	this.instance_8._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_8).wait(19).to({_off:false},0).to({guide:{path:[-348.9,381,-344.2,347.1,-337.1,313.9,-330,280.7,-322,247.6,-314.1,214.6,-306.2,181.5,-298.3,148.4,-292,115,-278.6,44.1,-287.6,-17.2,-296.5,-78.7,-320.5,-135.2,-344.4,-191.7,-379.7,-245.3,-415,-298.8,-454.2,-353.7]}},26).to({_off:true},1).wait(32));

	// Layer 1
	this.instance_9 = new lib.shape96("synched",0);
	this.instance_9.setTransform(-380.6,402.5);
	this.instance_9.alpha = 0;

	this.timeline.addTween(cjs.Tween.get(this.instance_9).to({scaleX:1,scaleY:1,rotation:56.4,x:-400.8,y:359.2,alpha:0.75},3).to({scaleX:1,scaleY:1,rotation:75,x:-401.3,y:343.4,alpha:1},1).to({scaleX:1,scaleY:1,rotation:79.7,x:-393.8,y:327.8},1).to({scaleX:1,scaleY:1,rotation:84.5,x:-383,y:315.1},1).to({scaleX:1,scaleY:1,rotation:102.5,x:-336.9,y:266.9},4).to({rotation:107.1,x:-325.2,y:255.1},1).to({scaleX:1,scaleY:1,rotation:116.7,x:-299.9,y:232.7},2).to({scaleX:0.99,scaleY:0.99,rotation:126.1,x:-287.7,y:223.5},1).to({scaleX:0.99,scaleY:0.99,rotation:135.6,x:-275.2,y:214.5},1).to({rotation:145.2,x:-262.9,y:205.3},1).to({scaleX:0.99,scaleY:0.99,rotation:154.7,x:-251,y:195.8},1).to({scaleX:1,scaleY:1,rotation:173.7,x:-228.8,y:174.2},2).to({scaleX:1,scaleY:1,rotation:192.5,x:-212.5,y:148.6},2).to({scaleX:1,scaleY:1,rotation:221.2,x:-200.4,y:103.8},3).to({scaleX:1,scaleY:1,rotation:228.9,x:-198.5,y:84.7},1).to({scaleX:0.99,scaleY:0.99,rotation:236.7,x:-197.6,y:65.5},1).to({rotation:244.5,x:-197.1,y:46.7},1).to({rotation:252.2,x:-196.1,y:27.4},1).to({rotation:260,x:-194.3,y:8.3},1).to({scaleX:1,scaleY:1,rotation:283.3,x:-179.6,y:-46.8},3).to({scaleX:0.99,scaleY:0.99,rotation:294.8,x:-175.3,y:-55.4,alpha:0.93},1).to({scaleX:0.99,scaleY:0.99,rotation:318.4,x:-165.2,y:-71.6,alpha:0.77},2).to({scaleX:1,scaleY:1,rotation:411.7,x:-111.3,y:-127.7,alpha:0.148},8).to({scaleX:1,scaleY:1,rotation:435,x:-97,y:-141,alpha:0},2).to({_off:true},1).wait(2).to({_off:false,scaleX:5.09,scaleY:5.09,rotation:300,x:-502.6,y:382.5,alpha:1},0).to({scaleX:2.93,scaleY:2.93,rotation:275.3,guide:{path:[-502.5,382.4,-420.5,350.3,-341.8,312.5,-263.2,274.7,-190.3,228.6,-117.2,182.7,-50.8,126.9,-26.3,106.4,-3.2,84.2]}},15).to({scaleX:2.7,scaleY:2.7,rotation:272.3,guide:{path:[-3,83.9,-2.9,83.9,-2.9,83.9,19.6,62.1,41.2,39,41.2,39,41.2,39]},alpha:0.5},4).to({scaleX:2.64,scaleY:2.64,rotation:271.6,guide:{path:[41.2,38.8,46.5,33,51.8,27]},alpha:0.379},1).to({scaleX:2.53,scaleY:2.53,rotation:270.5,guide:{path:[51.9,27,62.6,15.1,73,3]},alpha:0.129},2).wait(1).to({scaleX:2.47,scaleY:2.47,rotation:270,x:81,y:-11,alpha:0},0).to({_off:true},2).wait(5));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(-388.6,395,16,15);


// stage content:



(lib.trang1 = function(mode,startPosition,loop) {
	this.initialize(mode,startPosition,loop,{});

	// timeline functions:
	this.frame_289 = function() {
		this.stop();
	}

	// actions tween:
	this.timeline.addTween(cjs.Tween.get(this).wait(289).call(this.frame_289).wait(1));

	// Layer 3
	this.instance = new lib.sprite98();
	this.instance.setTransform(-77.4,-570.1,3.32,3.32,0,2.1,-177.2);
	this.instance._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance).wait(53).to({_off:false},0).wait(237));

	// no3
	this.instance_1 = new lib.sprite32();
	this.instance_1.setTransform(1218.8,369,0.883,2.141,0,-81.1,95.9);
	this.instance_1._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(29).to({_off:false},0).to({_off:true},24).wait(237));

	// no2
	this.instance_2 = new lib.sprite32();
	this.instance_2.setTransform(913.8,401,0.883,2.141,0,-81.1,95.9);
	this.instance_2._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(16).to({_off:false},0).to({_off:true},19).wait(255));

	// text small
	this.instance_3 = new lib.sprite72();
	this.instance_3.setTransform(663,515.2);
	this.instance_3._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(53).to({_off:false},0).wait(237));

	// no1
	this.instance_4 = new lib.sprite32();
	this.instance_4.setTransform(913.8,192.9,0.883,2.141,0,-81.1,95.9);
	this.instance_4._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(7).to({_off:false},0).to({_off:true},25).wait(258));

	// Layer 23
	this.instance_5 = new lib.sprite21();
	this.instance_5.setTransform(606.8,80.2,1.41,1.41);
	this.instance_5._off = true;

	this.timeline.addTween(cjs.Tween.get(this.instance_5).wait(4).to({_off:false},0).wait(35).to({scaleX:1.32,scaleY:1.32,x:648.9,y:78.5},1).to({scaleX:1.06,scaleY:1.06,x:817.1,y:80.2},1).wait(1).to({scaleX:1.01,scaleY:1.01,x:943.1,y:84.1},0).wait(1).to({scaleX:0.95,scaleY:0.95,x:879.1},0).wait(247));

	// Layer 7
	this.shape = new cjs.Shape();
	this.shape.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-678.2,361.1,-151.1,144.6).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape.setTransform(1374.9,604.4);

	this.shape_1 = new cjs.Shape();
	this.shape_1.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-620.1,333.2,-93,116.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_1.setTransform(1374.9,604.4);

	this.shape_2 = new cjs.Shape();
	this.shape_2.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-562.1,305.2,-35,88.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_2.setTransform(1374.9,604.4);

	this.shape_3 = new cjs.Shape();
	this.shape_3.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-504.1,277.2,23,60.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_3.setTransform(1374.9,604.4);

	this.shape_4 = new cjs.Shape();
	this.shape_4.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-446.1,249.2,81,32.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_4.setTransform(1374.9,604.4);

	this.shape_5 = new cjs.Shape();
	this.shape_5.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-388,221.3,139.1,4.8).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_5.setTransform(1374.9,604.4);

	this.shape_6 = new cjs.Shape();
	this.shape_6.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-330,193.3,197.1,-23.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_6.setTransform(1374.9,604.4);

	this.shape_7 = new cjs.Shape();
	this.shape_7.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-272,165.3,255.1,-51.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_7.setTransform(1374.9,604.4);

	this.shape_8 = new cjs.Shape();
	this.shape_8.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-214,137.3,313.1,-79.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_8.setTransform(1374.9,604.4);

	this.shape_9 = new cjs.Shape();
	this.shape_9.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-156,109.4,371.1,-107.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_9.setTransform(1374.9,604.4);

	this.shape_10 = new cjs.Shape();
	this.shape_10.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-97.9,81.4,429.2,-135.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_10.setTransform(1374.9,604.4);

	this.shape_11 = new cjs.Shape();
	this.shape_11.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-39.9,53.4,487.2,-163.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_11.setTransform(1374.9,604.4);

	this.shape_12 = new cjs.Shape();
	this.shape_12.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],18.1,25.4,545.2,-191.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_12.setTransform(1374.9,604.4);

	this.shape_13 = new cjs.Shape();
	this.shape_13.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],76.2,-2.5,603.3,-219).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_13.setTransform(1374.9,604.4);

	this.shape_14 = new cjs.Shape();
	this.shape_14.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],134.2,-30.5,661.3,-247).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_14.setTransform(1374.9,604.4);

	this.shape_15 = new cjs.Shape();
	this.shape_15.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],192.2,-58.5,719.3,-275).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_15.setTransform(1374.9,604.4);

	this.shape_16 = new cjs.Shape();
	this.shape_16.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],250.2,-86.5,777.3,-303).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_16.setTransform(1374.9,604.4);

	this.shape_17 = new cjs.Shape();
	this.shape_17.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],308.3,-114.4,835.4,-330.9).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_17.setTransform(1374.9,604.4);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[]}).to({state:[{t:this.shape}]},271).to({state:[{t:this.shape_1}]},1).to({state:[{t:this.shape_2}]},1).to({state:[{t:this.shape_3}]},1).to({state:[{t:this.shape_4}]},1).to({state:[{t:this.shape_5}]},1).to({state:[{t:this.shape_6}]},1).to({state:[{t:this.shape_7}]},1).to({state:[{t:this.shape_8}]},1).to({state:[{t:this.shape_9}]},1).to({state:[{t:this.shape_10}]},1).to({state:[{t:this.shape_11}]},1).to({state:[{t:this.shape_12}]},1).to({state:[{t:this.shape_13}]},1).to({state:[{t:this.shape_14}]},1).to({state:[{t:this.shape_15}]},1).to({state:[{t:this.shape_16}]},1).to({state:[{t:this.shape_17}]},1).wait(2));

	// Layer 6
	this.shape_18 = new cjs.Shape();
	this.shape_18.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-678.2,361.1,-151.1,144.6).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_18.setTransform(1374.9,604.4);

	this.shape_19 = new cjs.Shape();
	this.shape_19.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-620.1,333.2,-93,116.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_19.setTransform(1374.9,604.4);

	this.shape_20 = new cjs.Shape();
	this.shape_20.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-562.1,305.2,-35,88.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_20.setTransform(1374.9,604.4);

	this.shape_21 = new cjs.Shape();
	this.shape_21.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-504.1,277.2,23,60.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_21.setTransform(1374.9,604.4);

	this.shape_22 = new cjs.Shape();
	this.shape_22.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-446.1,249.2,81,32.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_22.setTransform(1374.9,604.4);

	this.shape_23 = new cjs.Shape();
	this.shape_23.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-388,221.3,139.1,4.8).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_23.setTransform(1374.9,604.4);

	this.shape_24 = new cjs.Shape();
	this.shape_24.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-330,193.3,197.1,-23.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_24.setTransform(1374.9,604.4);

	this.shape_25 = new cjs.Shape();
	this.shape_25.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-272,165.3,255.1,-51.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_25.setTransform(1374.9,604.4);

	this.shape_26 = new cjs.Shape();
	this.shape_26.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-214,137.3,313.1,-79.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_26.setTransform(1374.9,604.4);

	this.shape_27 = new cjs.Shape();
	this.shape_27.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-156,109.4,371.1,-107.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_27.setTransform(1374.9,604.4);

	this.shape_28 = new cjs.Shape();
	this.shape_28.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-97.9,81.4,429.2,-135.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_28.setTransform(1374.9,604.4);

	this.shape_29 = new cjs.Shape();
	this.shape_29.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-39.9,53.4,487.2,-163.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_29.setTransform(1374.9,604.4);

	this.shape_30 = new cjs.Shape();
	this.shape_30.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],18.1,25.4,545.2,-191.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_30.setTransform(1374.9,604.4);

	this.shape_31 = new cjs.Shape();
	this.shape_31.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],76.2,-2.5,603.3,-219).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_31.setTransform(1374.9,604.4);

	this.shape_32 = new cjs.Shape();
	this.shape_32.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],134.2,-30.5,661.3,-247).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_32.setTransform(1374.9,604.4);

	this.shape_33 = new cjs.Shape();
	this.shape_33.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],192.2,-58.5,719.3,-275).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_33.setTransform(1374.9,604.4);

	this.shape_34 = new cjs.Shape();
	this.shape_34.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],250.2,-86.5,777.3,-303).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_34.setTransform(1374.9,604.4);

	this.shape_35 = new cjs.Shape();
	this.shape_35.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],308.3,-114.4,835.4,-330.9).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_35.setTransform(1374.9,604.4);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[]}).to({state:[{t:this.shape_18}]},195).to({state:[{t:this.shape_19}]},1).to({state:[{t:this.shape_20}]},1).to({state:[{t:this.shape_21}]},1).to({state:[{t:this.shape_22}]},1).to({state:[{t:this.shape_23}]},1).to({state:[{t:this.shape_24}]},1).to({state:[{t:this.shape_25}]},1).to({state:[{t:this.shape_26}]},1).to({state:[{t:this.shape_27}]},1).to({state:[{t:this.shape_28}]},1).to({state:[{t:this.shape_29}]},1).to({state:[{t:this.shape_30}]},1).to({state:[{t:this.shape_31}]},1).to({state:[{t:this.shape_32}]},1).to({state:[{t:this.shape_33}]},1).to({state:[{t:this.shape_34}]},1).to({state:[{t:this.shape_35}]},1).wait(78));

	// Layer 5
	this.shape_36 = new cjs.Shape();
	this.shape_36.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-678.2,361.1,-151.1,144.6).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_36.setTransform(1374.9,604.4);

	this.shape_37 = new cjs.Shape();
	this.shape_37.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-620.1,333.2,-93,116.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_37.setTransform(1374.9,604.4);

	this.shape_38 = new cjs.Shape();
	this.shape_38.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-562.1,305.2,-35,88.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_38.setTransform(1374.9,604.4);

	this.shape_39 = new cjs.Shape();
	this.shape_39.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-504.1,277.2,23,60.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_39.setTransform(1374.9,604.4);

	this.shape_40 = new cjs.Shape();
	this.shape_40.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-446.1,249.2,81,32.7).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_40.setTransform(1374.9,604.4);

	this.shape_41 = new cjs.Shape();
	this.shape_41.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-388,221.3,139.1,4.8).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_41.setTransform(1374.9,604.4);

	this.shape_42 = new cjs.Shape();
	this.shape_42.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-330,193.3,197.1,-23.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_42.setTransform(1374.9,604.4);

	this.shape_43 = new cjs.Shape();
	this.shape_43.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-272,165.3,255.1,-51.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_43.setTransform(1374.9,604.4);

	this.shape_44 = new cjs.Shape();
	this.shape_44.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-214,137.3,313.1,-79.2).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_44.setTransform(1374.9,604.4);

	this.shape_45 = new cjs.Shape();
	this.shape_45.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-156,109.4,371.1,-107.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_45.setTransform(1374.9,604.4);

	this.shape_46 = new cjs.Shape();
	this.shape_46.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-97.9,81.4,429.2,-135.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_46.setTransform(1374.9,604.4);

	this.shape_47 = new cjs.Shape();
	this.shape_47.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],-39.9,53.4,487.2,-163.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_47.setTransform(1374.9,604.4);

	this.shape_48 = new cjs.Shape();
	this.shape_48.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],18.1,25.4,545.2,-191.1).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_48.setTransform(1374.9,604.4);

	this.shape_49 = new cjs.Shape();
	this.shape_49.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],76.2,-2.5,603.3,-219).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_49.setTransform(1374.9,604.4);

	this.shape_50 = new cjs.Shape();
	this.shape_50.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],134.2,-30.5,661.3,-247).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_50.setTransform(1374.9,604.4);

	this.shape_51 = new cjs.Shape();
	this.shape_51.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],192.2,-58.5,719.3,-275).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_51.setTransform(1374.9,604.4);

	this.shape_52 = new cjs.Shape();
	this.shape_52.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],250.2,-86.5,777.3,-303).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_52.setTransform(1374.9,604.4);

	this.shape_53 = new cjs.Shape();
	this.shape_53.graphics.lf(["rgba(255,255,255,0)","#FFFFFF","rgba(255,255,255,0)"],[0,0.431,0.804],308.3,-114.4,835.4,-330.9).s().p("EAIeAlbQB0hoBHhjQBFh4kQALQmVAPh4AAQhbAAprg3IrqhFIsJhHQqDg7gtgCIjggTQi1gOgyALQACgPgyjaQCbg1TaBJQJtAmJOAwQSwCfKskaQD8hoDmi4QCEhpDdjSQEukMABmfQABkyium3QItmpDtpGQDDndgJpyQG2RggeORQgLFAhFEiQglCbhMDXQk7KblhFwQiRCXi/CRQhdBHkOC6QlXDrn8CYQl7BylwApQCAgqCWiHg");
	this.shape_53.setTransform(1374.9,604.4);

	this.timeline.addTween(cjs.Tween.get({}).to({state:[]}).to({state:[{t:this.shape_36}]},79).to({state:[{t:this.shape_37}]},1).to({state:[{t:this.shape_38}]},1).to({state:[{t:this.shape_39}]},1).to({state:[{t:this.shape_40}]},1).to({state:[{t:this.shape_41}]},1).to({state:[{t:this.shape_42}]},1).to({state:[{t:this.shape_43}]},1).to({state:[{t:this.shape_44}]},1).to({state:[{t:this.shape_45}]},1).to({state:[{t:this.shape_46}]},1).to({state:[{t:this.shape_47}]},1).to({state:[{t:this.shape_48}]},1).to({state:[{t:this.shape_49}]},1).to({state:[{t:this.shape_50}]},1).to({state:[{t:this.shape_51}]},1).to({state:[{t:this.shape_52}]},1).to({state:[{t:this.shape_53}]},1).wait(194));

	// Mask Layer 3 (mask)
	var mask = new cjs.Shape();
	mask._off = true;
	var mask_graphics_48 = new cjs.Graphics().p("A07iLMgqIAW/UA46gw5BregmwIAAAAUhWNBPUh0cA2XIAAAAUAb4gY3A0hgsKgEA1bgKzQlWGDmhFwIAAAAQljE3mTElIAAAAIlMDng");
	var mask_graphics_49 = new cjs.Graphics().p("EhktBVfQixgkAXiOQAIhMBBgUQAogLBPAJIA6AGQAHgcAKgFIALAAIAggJQAlgMAigDIBSBhQAQAVAAAIQgJA3ghAaQgjAig8gMQgWBphpAAQgcAAghgHgEhafAaXQU1zBUWvSI6OL0UA6AguXBDigrGMCPDANqMg/rAl+MiILBB/MAmfgd2UhOyAq3hj8AgWgEgrxBHLQABgEgMgWQgMgXALg5QAJg+AMgKIAJACIAjgMQAmgMAeAAIBSBiQATAPAAALQgIA7gjAcQgcAXgnAAQgvAAhBgigEi+RAlVQiTgXgchXQgEgPAKhUQAQhUBEhGQBOhMBaALQCQAWANBwQgPB9AAAIQgUB6gvAcQgZARg2AAQgiAAgtgGgEh0oAE5QACgHgMgVQgMgXAIg4IAFgoQAGgXAKgHIAKgBIAigJQAmgPAfgCIBPBZIAEAIQASAVgCAKQgIA5gfAdQgdAWgoAAQgwAAg/ggg");
	var mask_graphics_50 = new cjs.Graphics().p("EhtvAVpIZAy/Mg08AZ9UBzbhZ8A8KgjPMCghASSMg8eApvMjPJBsPMA7rgk3Ugj0AQbiTkAtVUAnrgnDArfgj5gEhnJBXWQiugoAViNQAKhMA+gSQApgPBNAPIA7AHQAIgeAJgGIAKACIAkgOQAkgJAfgDIBVBhQAQAUgEALQgGA4ggAYQgmAig4gKQgYBnhrAAQgbAAghgHgEjDwBReQiTgYgXhWQgCgPAHhUQAOhRBIhIQBKhLBeALQCQAYAMByIgSCCQgVB5gvAcQgVAQg1AAQgjAAgygHgEgZLA7xQgBgGgNgZQgLgUAJg5QALg8AMgIIAJABIAlgNQAkgNAegBQA/BNATARQATAVgBAKQgJA7gjAbQgbAWgnAAQguAAg/gfgEi/9AVHQAnguAlgSQANgEAugIIAaA9QgXA2hDARQgsgYgbgggEikNAVcQgugZgZgiQBMhlAxADQA7AhAMA3QgLAWgmAXQgpAYgdAAIgGAAgEi6nAQ1Qg8gEgTgOIgHgKQgbggAGg7QA7gxCYAoIAVA8QgPAngOAIQgaAXgvAAIgXgCgEhnPgeXQHelXIpkxQPzotGMh6QlDDLo7GJQo+GIpLFBQpMFB+rT0Qa9znG7k8gEhA4gnAQADgHgMgWQgLgVAIg5IAEgoQAJgYAIgIIAKABQABACAlgNQAlgOAagCIBTBZIAHAKQAQAUgCAIQgIA+gjAZQgdAWgoAAQgwAAhAgfg");
	var mask_graphics_51 = new cjs.Graphics().p("EimgBvCMBT7gxUMhfSAt1Mgh2gGmUA22gq/ACvgLnMgjlgH2MEhDiqnMBwYA1eMgzcApTUjleCpchEyAAAQ4RAAkR1FgECl3gWvUgIJAIIh1VBDFUBnzhDGAVrgIHgEA5IAycIgIgSQgIgPAJgtQAKguALgHIAJgBIBVgQIBCBGIAMAVQgKAqgcAXQgWAQghAAQgnAAg2gYgEi15AvyQADgFgLgMQgIgSALgqQAOg0ApgOQAggJBNAIQAyAIAqAOIAfAJIAFAPQADAMgIApQgRBCg+AHIgSABQg2AAiDgdgEBReAphIgXg8QgCgjAMgzQAWhnBZgyIEgiPQgBBagSA1QgSBfiCBmQh+BmhaAAIgDAAgEipyASrQgDggALg1IADgEIADADIBbAzIAEABIggA4QgaAngbAEgEh/sgIlIAMhVQAgiLByggQAPAlABAaQAEAegQA1QgbCGhwAvQgUgngDgggEgupgyMUg52AlYgMKAEiUAEkgEiBBcglYgEiFsgLhIBAgVQgcAngeAEgEhtWgrFIAAgxIA3gXIBDgNIgEAPQgNA1gfAmQgZAngfACg");
	var mask_graphics_52 = new cjs.Graphics().p("Eis1Bp2MBT8gxVMhfTAt1Mgh2gGlUA22gq/ACvgLnMhBRgKrQeCr4TwksIgKgdQgEggAMg1IACgFIADADIBMArUBvthmwCcCgvWMCEsA/yMg6UAz8UjgHCe4hM4AABUgiNAAAgFDgfegECtUAEQUgIKAIIh1WBDHUBn0hDIAVsgIHgEi5FAvlQADgFgLgLQgIgSALgrQAOgzApgOQAggKBNAJQAyAHAqAOIAfAKIAFAPQADALgIApQgRBDg+AGIgSABQg2AAiDgdgEiPEgjWIALhVQAhiLBxggQAPAlABAaQAEAegPA1QgcCGhwAvQgTgngDgggEhpWg4GIAAgxIA2gXIBEgNIgEAPQgNA1gfAmQgZAngfACg");
	var mask_graphics_53 = new cjs.Graphics().p("EibBBNwMAAAibfME2DAAAMAAACbfg");

	this.timeline.addTween(cjs.Tween.get(mask).to({graphics:null,x:0,y:0}).wait(48).to({graphics:mask_graphics_48,x:1677.6,y:10}).wait(1).to({graphics:mask_graphics_49,x:1371.4,y:110.7}).wait(1).to({graphics:mask_graphics_50,x:1126.6,y:288.2}).wait(1).to({graphics:mask_graphics_51,x:934.3,y:400.5}).wait(1).to({graphics:mask_graphics_52,x:954.7,y:401.8}).wait(1).to({graphics:mask_graphics_53,x:957,y:468.5}).wait(237));

	// Masked Layer 4 - 3
	this.instance_6 = new lib.sprite37();
	this.instance_6._off = true;

	this.instance_6.mask = mask;

	this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(48).to({_off:false},0).wait(242));

	// Layer 1
	this.instance_7 = new lib.sprite3();
	this.instance_7.filters = [new cjs.ColorMatrixFilter(new cjs.ColorMatrix(0, -14, 0, 0))];
	this.instance_7.cache(-2,-2,1924,904);

	this.timeline.addTween(cjs.Tween.get(this.instance_7).wait(10).to({x:-8,y:-2},0).to({regX:966.3,regY:488.2,scaleX:1.04,scaleY:1.04,x:974.3,y:476.2},1).to({regX:0,regY:0,scaleX:1,scaleY:1,x:-12,y:10},1).to({x:0,y:0},1).wait(13).to({regX:960,regY:451,scaleX:1.03,x:950,y:441},1).to({regX:0,regY:0,scaleX:1,x:4,y:0},1).to({regX:948.2,regY:468.2,scaleX:1.02,x:952.2,y:462.2},1).to({regX:0,regY:0,scaleX:1,x:0,y:0},1).wait(8).to({regX:982.3,regY:466.2,scaleX:1.03,scaleY:1.03,x:981,y:463.6},1).to({regX:0,regY:0,scaleX:1,scaleY:1,x:-2.6,y:-5.3},1).to({regX:982.3,regY:466.2,scaleX:1.03,scaleY:1.03,x:981,y:463.6},1).to({regX:0,regY:0,scaleX:1,scaleY:1,x:4,y:0},1).to({regX:954.3,regY:430.1,scaleX:1.04,scaleY:1.04,x:954.3,y:430.1},1).wait(3).to({regX:0,regY:0,scaleX:1,scaleY:1,x:0,y:0},0).wait(1).to({y:-10},0).wait(1).to({x:-18,y:-4},0).wait(1).to({x:0,y:0},0).wait(1).to({x:4,y:-2},0).wait(240));

}).prototype = p = new cjs.MovieClip();
p.nominalBounds = new cjs.Rectangle(960,450,1920,900);

})(lib = lib||{}, images = images||{}, createjs = createjs||{}, ss = ss||{});
var lib, images, createjs, ss;