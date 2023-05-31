//Helper and common functions
(function(Matrix){
	Matrix.extend = function(obj){
		var key,
		args = Array.prototype.slice.call(arguments,1);
		args.forEach(function(value,index,array){
			for (key in value){
				if (value.hasOwnProperty(key)){
					obj[key] = value[key];
				}
			}
		});
		return obj;
	};
  
	Matrix.rnd = function (min,max){ //random on steriods
		if (min instanceof Array){ //returns random array item
			if(min.length === 0){
				return undefined;
			}
			if(min.length === 1){
				return min[0];
			}
			return min[rnd(0,min.length-1)];
		}
		if(typeof min === "object"){ // returns random object member
			min = Object.keys(min);
			return min[rnd(min.length-1)];
		}
		min = min === undefined?100:min; 
		if (!max){  
			max = min;
			min = 0;
		}
		return	Math.floor(Math.random() * (max-min+1) + min);
	};
  
	Matrix.ArrayIndexOf = function(array,value,fn){ //I did not want to override the Array.prototype.indexOf
		var result = -1;
		array.forEach(function(v,i,a){
			result = fn(value,v)?i:result;
		});
		return result;
	};
	window.Matrix = Matrix;
})(window.Matrix || {});