<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Time Color</title>
	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}
		body {
			display: flex;
			background: black;
		}
		.clock_wrap {
			position: relative;
			margin: auto;
			width: min(100vw, 100vh);
			height: min(100vh, 100vw);

			display: flex;
			flex-flow: row wrap;
			justify-content: center;
			align-items: center;
			align-content: stretch;
			background: black;
		}

		.d1, .d2, .d3 {
			position: relative;
			flex: 1 100%;

			display: flex;
			flex-flow: row wrap;
			justify-content: center;
			align-items: center;
		}
		.d1 {
			height: 15%;
		}

		.d2 {
			height: 50%;
		}

		.d3 {
			height: 33%;
		}

		canvas {
			position: relative;
			flex: 1 0;
			height: 100%;
			padding: 8px;
			object-fit: contain;
		}
		#canvas_7 {
			top: -30%;
		}

		
	</style>
</head>
<body>
	<div class="clock_wrap">
		<div class="d1">
			<canvas id="canvas_6" class="yearday"></canvas>
			<canvas id="canvas_5" class="date"></canvas>
			<canvas id="canvas_4" class="day"></canvas>
		</div>

		<div class="d2">
			<canvas id="canvas_1" class="hr"></canvas>
			<canvas id="canvas_2" class="mn"></canvas>		
		</div>
		<div class="d3">
			<canvas id="canvas_8" class="age"></canvas>
			<canvas id="canvas_7" class="ms"></canvas>
			<canvas id="canvas_3" class="s"></canvas>
		</div>
	</div>

	<script>
		let pi = Math.PI;
		let pi2 = 2 * Math.PI;
		let sin = x => Math.sin(x); 
		let cos = x => Math.cos(x); 
		let deg = pi/180;

		let canvas_1 = document.querySelector("#canvas_1");
		let canvas_2 = document.querySelector("#canvas_2");
		let canvas_3 = document.querySelector("#canvas_3");
		let canvas_4 = document.querySelector("#canvas_4");
		let canvas_5 = document.querySelector("#canvas_5");
		let canvas_6 = document.querySelector("#canvas_6");
		let canvas_7 = document.querySelector("#canvas_7");

		let ctx_1 = canvas_1.getContext("2d");
		let ctx_2 = canvas_2.getContext("2d");
		let ctx_3 = canvas_3.getContext("2d");
		let ctx_4 = canvas_4.getContext("2d");
		let ctx_5 = canvas_5.getContext("2d");
		let ctx_6 = canvas_6.getContext("2d");
		let ctx_7 = canvas_7.getContext("2d");
		let ctx_8 = canvas_8.getContext("2d");

		canvas_1.width = 1000;
		canvas_2.width = 1000;
		canvas_3.width = 1000;
		canvas_4.width = 1000;
		canvas_5.width = 1000;
		canvas_6.width = 1000;
		canvas_7.width = 1000;
		canvas_8.width = 1000;

		canvas_1.height = 1000;
		canvas_2.height = 1000;
		canvas_3.height = 1000;
		canvas_4.height = 1000;
		canvas_5.height = 1000;
		canvas_6.height = 1000;
		canvas_7.height = 1000;
		canvas_8.height = 1000;

		let bkd_clr = "hsla(0,0%,5%,1)";
		let txt_clr = "hsla(0,0%,60%,1)";
		let txt_fnt = "bold 60px arial";

		let k1_clock = () => {

			let ktime = new Date();
			let year  = ktime.getFullYear();
			let month  = ktime.getMonth();
			let date  = ktime.getDate();
			let day   = ktime.getDay();
			let h     = ktime.getHours();
			let mn    = ktime.getMinutes();
			let s     = ktime.getSeconds();
			let ms    = ktime.getMilliseconds();
			let ms2   = Math.floor(ms/10);
			let ms3   = Math.floor(ms/100);
			let age   = Math.floor(((ktime - new Date(1986,4,2,7,45))/1000/60/60/24));
			let age_h = Math.floor(((ktime - new Date(1986,4,2,7,45))/1000/60/60));
			// let age_y = Math.floor(age/365) ;
			let age_y = (age/365).toFixed(2) ;
			let age_y2a = ((ktime - new Date(1986,4,2,7,45))/1000/(3600*24*365));
			let age_y2b = age_y2a.toFixed(2);

			let day0  = new Date(year, 0, 0);
			let yearday = Math.floor((ktime - day0)/ 86400000);
			let mn_per_day = h   * 60   + mn;
			let s_per_day  = mn  * 60   + s;
			let ms_per_s   = s   * 1000 + ms;
			let h_per_day  = day * 24   + h;

			let day_s;
			switch (day) {
			  case 0:day_s = "Sun"; break;
			  case 1:day_s = "Mon"; break;
			  case 2:day_s = "Tue"; break;
			  case 3:day_s = "Wed"; break;
			  case 4:day_s = "Thu"; break;
			  case 5:day_s = "Fri"; break;
			  case 6:day_s = "Sat"; 
			}

			let h_per_month = date * 24 + h;
			let date_s;
			switch (date) {
			  case 1:date_s = date + "st"; break;
			  case 2:date_s = date + "nd"; break;
			  case 3:date_s = date + "rd"; break;
			  case 21:date_s = date + "st"; break;
			  case 22:date_s = date + "nd"; break;
			  case 23:date_s = date + "rd"; break;
			  case 31:date_s = date + "st"; break;
			  default: date_s = date + "th"; break;
			}

			let month_s;{
				switch(month) {
					case 0: month_s = "Jan"; break;
					case 1: month_s = "Feb"; break;
					case 2: month_s = "Mar"; break;
					case 3: month_s = "Apr"; break;
					case 4: month_s = "May"; break;
					case 5: month_s = "Jun"; break;
					case 6: month_s = "Jul"; break;
					case 7: month_s = "Aug"; break;
					case 8: month_s = "Sep"; break;
					case 9: month_s = "Oct"; break;
					case 10: month_s = "Nov"; break;
					case 11: month_s = "Dec";
				}
			}

			ctx_1.clearRect(0,0,1000,1000);
			ctx_2.clearRect(0,0,1000,1000);
			ctx_3.clearRect(0,0,1000,1000);
			ctx_7.clearRect(0,0,1000,1000);
			ctx_4.clearRect(0,0,1000,1000);
			ctx_5.clearRect(0,0,1000,1000);
			ctx_6.clearRect(0,0,1000,1000);
			ctx_8.clearRect(0,0,1000,1000);



			ctx_1.font = "bold 60px arial";
			ctx_2.font = "bold 60px arial";
			ctx_3.font = "bold 60px arial";
			ctx_4.font = "bold 100px arial";
			ctx_5.font = "bold 150px arial";
			ctx_6.font = "bold 100px arial";
			ctx_7.font = "bold 50px arial";;
			ctx_8.font = "bold 50px arial";

			ctx_1.beginPath();
			ctx_2.beginPath();
			ctx_3.beginPath();
			ctx_7.beginPath();
			ctx_4.beginPath();
			ctx_5.beginPath();
			ctx_6.beginPath();
			ctx_8.beginPath();

			ctx_1.arc(500, 500, 500, 0 , 2*pi);
			ctx_2.arc(500, 500, 500, 0 , 2*pi);
			ctx_3.arc(500, 500, 500, 0 , 2*pi);
			ctx_4.arc(500, 500, 500, 0 , 2*pi);
			ctx_5.arc(500, 500, 500, 0 , 2*pi);
			ctx_6.arc(500, 500, 500, 0 , 2*pi);
			ctx_7.arc(500, 500, 300, 0 , 2*pi);
			ctx_8.arc(500, 500, 500, 0 , 2*pi);

			ctx_1.closePath();
			ctx_2.closePath();
			ctx_3.closePath();
			ctx_7.closePath();
			ctx_4.closePath();
			ctx_5.closePath();
			ctx_6.closePath();
			ctx_8.closePath();

			ctx_1.fillStyle = bkd_clr;
			ctx_2.fillStyle = bkd_clr;
			ctx_3.fillStyle = bkd_clr;
			ctx_4.fillStyle = bkd_clr;
			ctx_5.fillStyle = bkd_clr;
			ctx_6.fillStyle = bkd_clr;
			ctx_7.fillStyle = bkd_clr;
			ctx_8.fillStyle = bkd_clr;

			ctx_1.fill();
			ctx_2.fill();
			ctx_3.fill();
			ctx_4.fill();
			ctx_5.fill();
			ctx_6.fill();
			ctx_7.fill();
			ctx_8.fill();

			ctx_1.beginPath();
			ctx_2.beginPath();
			ctx_3.beginPath();
			ctx_4.beginPath();
			ctx_5.beginPath();
			ctx_6.beginPath();
			ctx_7.beginPath();
			ctx_8.beginPath();

			ctx_1.moveTo(500, 500);
			ctx_2.moveTo(500, 500);
			ctx_3.moveTo(500, 500);
			ctx_4.moveTo(500, 500);
			ctx_5.moveTo(500, 500);
			ctx_6.moveTo(500, 500);
			ctx_8.moveTo(500, 500);
			// ctx_7.moveTo(500, 500);

			ctx_1.arc(500, 500, 500, 0, -mn_per_day  * pi/720    , true);
			ctx_2.arc(500, 500, 500, 0, -s_per_day   * pi/1800   , true);
			ctx_3.arc(500, 500, 500, 0, -ms_per_s    * pi/30000  , true);
			ctx_4.arc(500, 500, 500, 0, -h_per_day   * pi/84     , true);
			ctx_5.arc(500, 500, 500, 0, -h_per_month * pi/372    , true);
			ctx_6.arc(500, 500, 500, 0, -yearday * 2 * pi/365    , true);
			ctx_8.arc(500, 500, 500, 0, -age         * pi/14610  , true);
			// ctx_7.arc(500, 500, 500, 0, -ms          * pi/500    , true);
			// ctx_7.arc(500, 500, 300, -ms * pi/500 , -ms * pi/500 , true);
			ctx_7.arc(500 + (250 *  cos(-ms2 * pi/50)), 500 +  (250 * sin(-ms2 * pi/50)), 50, 0 , pi2, true);

			ctx_1.closePath();
			ctx_2.closePath();
			ctx_3.closePath();
			ctx_4.closePath();
			ctx_5.closePath();
			ctx_6.closePath();
			ctx_7.closePath();
			ctx_8.closePath();

			ctx_1.fillStyle   = "hsla(" +  mn_per_day  * 0.16   + " , 44%,22%,1)" ;
			ctx_2.fillStyle   = "hsla(" +  s_per_day   * 0.066  + " , 44%,22%,1)" ;
			ctx_3.fillStyle   = "hsla(" +  ms_per_s    * 0.004  + " , 44%,22%,1)" ;
			ctx_4.fillStyle   = "hsla(" +  h_per_day   * 1.428  + " , 44%,22%,1)" ;
			ctx_5.fillStyle   = "hsla(" +  h_per_month * 0.322  + " , 44%,22%,1)" ;
			ctx_6.fillStyle   = "hsla(" +  yearday     * 0.657  + " , 44%,22%,1)" ;
			ctx_7.fillStyle   = "hsla(" +  ms          * 0.24   + " , 40%,20%,1)" ;
			ctx_8.fillStyle   = "hsla(" +  age         * 0.008  + " , 40%,20%,1)" ;

			ctx_1.fill();
			ctx_2.fill();
			ctx_3.fill();
			ctx_4.fill();
			ctx_5.fill();
			ctx_6.fill();
			ctx_7.fill();
			ctx_8.fill();

			ctx_1.fillStyle = txt_clr;
			ctx_2.fillStyle = txt_clr;
			ctx_3.fillStyle = txt_clr;
			ctx_7.fillStyle = txt_clr;
			ctx_4.fillStyle = txt_clr;
			ctx_5.fillStyle = txt_clr;
			ctx_6.fillStyle = txt_clr;
			ctx_8.fillStyle = txt_clr;

			ctx_1.textAlign = "center";
			ctx_2.textAlign = "center";
			ctx_3.textAlign = "center";
			ctx_7.textAlign = "center";
			ctx_4.textAlign = "center";
			ctx_5.textAlign = "center";
			ctx_6.textAlign = "center";
			ctx_8.textAlign = "center";

			ctx_1.fillText( h       , 500 , 520 );
			ctx_2.fillText( mn      , 500 , 520 );
			ctx_3.fillText( s       , 500 , 520 );
			ctx_7.fillText( ms3     , 500 , 520 );
			ctx_4.fillText( day_s   , 500 , 520 );
			ctx_5.fillText( date_s  , 500 , 520 );
			ctx_6.fillText( yearday , 500 , 540 );
			// ctx_8.fillText( age_y , 500 , 400 );
			ctx_8.fillText( age_y2b , 500 , 400 );
			ctx_8.fillText( age.toLocaleString() , 500 , 500 );
			ctx_8.fillText( age_h.toLocaleString() , 500 , 600 );




			ctx_1.beginPath();
			ctx_1.moveTo(500, 500);
			ctx_1.arc(500, 500, 500, -8 * pi/12, -8 * pi/12, true);
			ctx_1.closePath();
			ctx_1.strokeStyle = "hsla(" +  mn_per_day  * 0.16   + " , 44%,22%,1)" ;
			ctx_1.lineWidth = 2;
			// ctx_1.stroke();

			ctx_2.beginPath();
			ctx_2.moveTo(500, 500);
			ctx_2.arc(500, 500, 500, -15 * pi/30, -18 * pi/30, true);
			ctx_2.closePath();
			ctx_2.strokeStyle = "hsla(" +  s_per_day   * 0.066  + " , 44%,22%,1)";
			ctx_2.fillStyle = "hsla(" +  s_per_day   * 0.066  + " , 50%,30%,1)";
			// ctx_2.fill();

			ctx_6.beginPath();
			ctx_6.moveTo(500, 500);
			ctx_6.arc(500, 500, 500, -91 * 2 * pi/365, -92 * 2 * pi/365, true);
			ctx_6.closePath();
			ctx_6.fillStyle = "hsla(" +  yearday     * 0.657  + " , 44%,42%,1)"
			// ctx_6.fill();

			ctx_8.beginPath();
			ctx_8.moveTo(500, 500);
			ctx_8.arc(500, 500, 500, -37 * pi/40, -37 * pi/40, true);
			ctx_8.closePath();
			ctx_8.strokeStyle = "limegreen";
			ctx_8.lineWidth = 1;
			// ctx_8.stroke();

			setTimeout(k1_clock, 10);
		}
		k1_clock();

	</script>
</body>
</html>