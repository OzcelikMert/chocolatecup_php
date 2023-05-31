$(window).on("load", function(){
	GetData();
	GetSettings();
})
// Get Leader Board Settings
function GetSettings(){
	$.ajax({
        url: "./pages/rank/functions/get_settings.php",
		method: "POST",
		data: { is_active: '1'},
        success: function(result){
			var json_result = $.parseJSON(result);
			if(json_result.interval != 0)
			LeaderBoardValues.Interval = json_result.interval;
			if(json_result.sort != "")
			LeaderBoardValues.Sort = json_result.sort;
			if(json_result.max != 0)
			LeaderBoardValues.Max = json_result.max;
			// Check Active Status
			var CheckActiveValue = setInterval(function() {
				GetActiveValue();
				if(ContestActiveStatus == "0"){
					StartLeaderBoard();
					clearInterval(CheckActiveValue);
				}
			}, 2000);
        }
	})
}
var ContestActiveStatus = "1";
// Get Contest Active Value
function GetActiveValue(){
	$.ajax({
        url: "./pages/rank/functions/get_active_value.php",
		method: "POST",
		data: { is_active: '1'},
        success: function(result){
			var json_result = $.parseJSON(result);
			ContestActiveStatus = json_result.active;
        }
	})
}
// Get All Data
function GetData(){
	$.ajax({
        url: "./pages/rank/functions/get_ranks.php",
		method: "POST",
		data: { is_active: '1'},
        success: function(result){
			var json_result = $.parseJSON(result);
			LeaderBoardValues.Data = json_result;
        }
	})
}
// Get Ranks
function GetRanks(){
	$total_index = 0;

	console.error(LeaderBoardValues.Length);
	// Range Control
	if(LeaderBoardValues.Data.points != undefined && LeaderBoardValues.Length + 1 <= LeaderBoardValues.Data.points.length){
		LeaderBoardValues.Length++;
		LeaderBoardValues.Ranks = [];
		// For Index
		for (let index = 0; index < LeaderBoardValues.Length; index++) {
			// For Poins Index Length
			LeaderBoardValues.Data.points[index].forEach(function(element){
				// Point Average
				var point_average = (element.point / LeaderBoardValues.Length);
				// Find Saved Old Data
				var find_index = LeaderBoardValues.Ranks.findIndex(function(item, i){
					return item.id == element.id;
				});
				if(find_index > -1){
					LeaderBoardValues.Ranks[find_index].point += point_average;
				}else{
					// New Add Data
					LeaderBoardValues.Ranks[$total_index] = {id: element.id, title: element.title, point: point_average, sort: 0};
					$total_index++;
				}
			});
		}
		// Set Sort Edit
		LeaderBoardValues.Ranks.sort(function(a,b){
			if(a.point == b.point)
				return 0;
			if(a.point < b.point)
				return -1;
			if(a.point > b.point)
				return 1;
		});
		// Set Sort Point
		LeaderBoardValues.Ranks.forEach(function(element, index){
			element.sort = (LeaderBoardValues.Ranks.length - index)
		});
	}
}
/*
================
Leader Board
================
*/
const LeaderBoardValues = {
	Interval: 999,
	Sort: "point",
	Max: 1,
	Ranks: [],
	Data: {},
	Length: 0
};

//polyfill for requestAnimationFrame
(function() {
    var lastTime = 0;
    var vendors = ['webkit', 'moz'];
    for(var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x]+'RequestAnimationFrame'];
        window.cancelAnimationFrame =
          window[vendors[x]+'CancelAnimationFrame'] || window[vendors[x]+'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame)
        window.requestAnimationFrame = function(callback, element) {
            var currTime = new Date().getTime();
            var timeToCall = Math.max(0, 16 - (currTime - lastTime));
            var id = window.setTimeout(function() { callback(currTime + timeToCall); },
              timeToCall);
            lastTime = currTime + timeToCall;
            return id;
        };

    if (!window.cancelAnimationFrame)
        window.cancelAnimationFrame = function(id) {
            clearTimeout(id);
        };
}());

Object.keys =Object.keys || function(o) {
	if (o !== Object(o))
		throw new TypeError('Object.keys called on a non-object');
	var k=[],p;
	for (p in o) if (Object.prototype.hasOwnProperty.call(o,p)) k.push(p);
	return k;
};

window.assert = window.assert || function (value,message){
	if(!message){
		message = value;
		value = true;
	}
	var ul = document.getElementById('assert');
	if(!ul){
		ul = document.createElement('ul');
		ul.id = 'assert';
		document.body.appendChild(ul);
	}
	var li = document.createElement('li');
	li.className = value ? 'success':'fail';
	li.appendChild(document.createTextNode(message));
	ul.appendChild(li);
};

Array.prototype.forEach = Array.prototype.forEach || function(callback,context){
	for(var i = 0,len = this.length;i < len;i++){
		callback.call(context || null,this[i],i,this);
	}
};

Array.prototype.difference = Array.prototype.difference || function(ar,fn){
	var isInArray,result = [];
	fn = fn || function(a,b){
		return a===b;
	};
	for(var i = 0,len = this.length;i<len;i++){
		isInArray = false;
		for (var x = 0,lenx = ar.length;x<lenx;x++){
			if (fn(this[i],ar[x])){
				isInArray = true;
				break;
			}
		}
		if(!isInArray){
			result.push(this[i]);
		}
	}
	return result;
};

//Leaderboard
function LBFunction(Matrix){
	var Leaderboard = function(o){
		this.config = Matrix.extend({
			max: LeaderBoardValues.Max,
			interval: (LeaderBoardValues.Interval * 2),
			elemId:'leaderboard',
			sort: LeaderBoardValues.Sort,
			margin:0,
			transitionClass:'move',
			display:function(data){
				return data.toString();
			},
			dataCallback:function(){return [];}
		},o);
		this.data = [];
		this.uiList = [];
		this.ul = document.createElement("ul");
	};
	Leaderboard.prototype = {
		constructor:Leaderboard,
		start:function(){
			var that = this,
				tStart = 0,
				progress = 0,
				interval = that.config.interval * 1000;

			(function run(timestamp){ //This should be moved into it's own .. passing in something like {startTime:0,interval:1000,callback:fn,endOnly:true}
				progress = timestamp - tStart ;
				if (progress > interval || progress === 0){
					tStart = timestamp;
					that.getData();
					that.doTransition();
				}
				requestAnimationFrame( run );
			})(0);
		},
		stop:function(){
			//This no worky
			console.log(this.animationRequestId);
			cancelAnimationFrame(0);
		},
		getData:function(){
			var that = this;
			this.data = this.config.dataCallback();
			this.data.sort(function(a,b){
				return b[that.config.sort] - a[that.config.sort];
			});
			this.data =  this.config.max > this.data.length?this.data: this.data.slice(0, this.config.max);
			//do something about the uiList when it's shorter than max
			if (this.data.length !== this.uiList.length){
				this.buildUI();
			}
			return this;
		},
		buildUI:function(){
			var elem = this.elem || document.getElementById(this.config.elemId) || document.body.appendChild(document.createElement("div"));
			elem.innerHTML = this.ul.innerHTML = ""; // Is there a better way?
			elem.appendChild(this.ul);
			for (var i = 0;i < this.config.max;i++){
				this.uiList.push({
					elem:this.ul.appendChild(document.createElement("li")),
					id:null,
					content:'',
					sort:0
                });
                this.uiList[i].elem.style.top = "0px";
				this.uiList[i].elem.innerHTML = "Loading...";
			}
			return this;
		},
		doTransition:function(){
			var oldElem = [],
				heights = [],
				replaceElem = [],
				that = this;

			replaceElem = this.data.difference(this.uiList,function(a,b){
				return a.id === b.id;
			});
			this.uiList.forEach(function(v,i,a){
				var	uiIndex,nextAvailable;

				uiIndex = Matrix.ArrayIndexOf(that.data,v.id,function(a,b){
					return a === b.id;
				});

				if (uiIndex >= 0){
					v.elem.classList.add("move");
					v.sort = that.data[uiIndex][that.config.sort];
					that.display(v.elem,that.data[uiIndex]);
				}else{
					v.elem.classList.add("replace");
					nextAvailable = replaceElem.shift();
					v.id = nextAvailable.id;
					that.display(v.elem,nextAvailable);
					v.sort =nextAvailable[that.config.sort];
				}
			});
			this.uiList.sort(function(a,b){
				return b.sort - a.sort;
			});
			this.uiList.forEach(function(v,i,a){
				heights .push(i>0?that.uiList[i-1].elem.offsetHeight + heights[i-1] + that.config.margin :0);
				v.elem.style.top = heights[i] + "px";
				setTimeout(function(){ // terrible hack.. my attempted transistionEnd event does not fire on all elements
					v.elem.className = "";
				}, 3000);
			});
			this.ul.style.height = (heights[heights.length - 1] + this.uiList[this.uiList.length - 1].elem.offsetHeight  + that.config.margin)+ "px";
			return this;
		},
		display:function(elem,data){
			var display = this.config.display(data);
			elem.innerHTML = ""; // Is this the best way to empty?
			if (typeof display === "object"){
				elem.appendChild(display);
			}else if (typeof display === "string"){
				elem.innerHTML = display;
			}
		}
	};

	Matrix.Leaderboard = Leaderboard;
	window.Matrix = Matrix;
};

function StartLeaderBoard(){
	setTimeout(() => {
		LBFunction(window.Matrix || {});
		// Set Ranks in Leader Board
		var Ranks = new Matrix.Leaderboard({
			interval:LeaderBoardValues.Interval,
			max:LeaderBoardValues.Max,
			margin:0,
			display:function(item){
		        var content = document.createElement('div'),
		        p = content.appendChild(document.createElement('p')),
				a = content.appendChild(document.createElement('a')),
		        span = content.appendChild(document.createElement('span'));
		    	p.classList.add("sort-number");
		    	p.innerHTML = "#" + item.sort;
				a.innerHTML = item.title;
				a.href = "#";
		        span.innerHTML = parseFloat(item.point).toFixed(1).toString();
				return content;
			},
			sort: LeaderBoardValues.Sort,
			dataCallback:function(){
				GetRanks();
				return LeaderBoardValues.Ranks;
			}
		});
		Ranks.start();
	}, 2000);
}

/*
================
end Leader Board
================
*/