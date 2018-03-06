<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <title>Canvas Hexagonal Map</title>
        <style type="text/css">
        	body{
        		padding: 0;
        		margin: 0;
                height: 100%;
                width: 100%;
        	}
            canvas { 
                border:0;
                display:block;
            }
        </style>
    </head>
    <body>
        <canvas id="hexmap" width="660" height="624"></canvas>
        <script>
        var canvas = document.getElementById('hexmap');
        var ctx = canvas.getContext('2d');
        var height = document.body.offsetHeight;
        var width = document.body.offsetWidth;
        var hex_height = 50;
        var hex_widht = 50;
        var hex_size = 23;
        var camera_x = 0;
        var camera_y = 0;
        var vector_camera_x = 0;
        var vector_camera_y = 0;
        var fps = 60;
        var color = "#555555";
        var e = window.event;
        $("canvas").attr( "height", height);
        $("canvas").attr( "width", width);
        var hexagon = [];
        var c = 0;
        for (var i = 0; i < hex_widht; i++) {
            for (var b = 0; b < hex_widht; b++) {
                c++; 
                var type = Math.floor((Math.random() * 4) + 0);
                hexagon[c] = {x:i, y:b, id:c, type:type};
            }
        }
        wait();
        function wait(){
            if (true){
                if(vector_camera_x<0.1&&vector_camera_x>-0.1&&vector_camera_y<0.1&&vector_camera_y>-0.1){
                    fps = 10;
                }
                else{
                    fps = 60;
                }
                console.log(fps);
                setTimeout(wait,1000/fps);
                update();
                redraw();
            }
        }       
        function update(){
            $("body").click(function(e) {
                x_client = e.clientX;
                y_client = e.clientY; 
                if(x_client>(width-200)){vector_camera_x=vector_camera_x-0.2;}
                if(x_client<200){vector_camera_x=vector_camera_x+0.2;}
                if(y_client>(height-100)){vector_camera_y=vector_camera_y-0.2;}
                if(y_client<100){vector_camera_y=vector_camera_y+0.2;
                console.log(vector_camera_x+":"+vector_camera_y);
                }   
            });
            $(document).keydown(function(e) {
                x_client = e.clientX;
                y_client = e.clientY;
                if (e.keyCode == 37||e.keyCode==65){vector_camera_x=vector_camera_x+0.1;}
                if (e.keyCode == 39||e.keyCode==68){vector_camera_x=vector_camera_x-0.1;}
                if (e.keyCode == 38||e.keyCode==87){vector_camera_y=vector_camera_y+0.1;}
                if (e.keyCode == 40||e.keyCode==83){vector_camera_y=vector_camera_y-0.1;}
            });
            if(camera_x>hex_size*20){camera_x=hex_size*20}
            if(camera_y>hex_size*10){camera_y=hex_size*10}
            if(camera_x<-(hex_size*hex_widht)/2-(hex_size*45)){camera_x=-(hex_size*hex_widht)/2-(hex_size*45);}
            if(camera_y<-(hex_size*hex_widht)/2-(hex_size*65)){camera_y=-(hex_size*hex_widht)/2-(hex_size*65);}
            if(vector_camera_x>10){vector_camera_x = 10;}
            if(vector_camera_y>10){vector_camera_y = 10;}
            if(vector_camera_x<-10){vector_camera_x = -10;}
            if(vector_camera_y<-10){vector_camera_y = -10;}
            camera_x = (Math.round((camera_x + vector_camera_x)*10000)/10000);
            vector_camera_x = (Math.round((vector_camera_x/1.3)*10000)/10000);
            camera_y = (Math.round((camera_y + vector_camera_y)*10000)/10000);
            vector_camera_y = (Math.round((vector_camera_y/1.3)*10000)/10000);
        }
        function redraw(){
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (var i = 1; i < hexagon.length; i++) {
                if(hexagon[i].type==0){color = "#44AA44"}
                if(hexagon[i].type==1){color = "#44AA44"}
                if(hexagon[i].type==2){color = "#44AA44"}
                if(hexagon[i].type==3){color = "#4444FF"}
                if (hexagon[i].x & 1) {
                    drawHexagon(hexagon[i].x*hex_size*2-(hexagon[i].x*3), hexagon[i].y*hex_size*2, color);
                }
                else{
                    drawHexagon(hexagon[i].x*hex_size*2-(hexagon[i].x*3), hexagon[i].y*hex_size*2+(hex_size), color);
                }
            }
        }
        function getMousePos(evt) {
            var rect = ctx.getBoundingClientRect();
            return {
                x: evt.clientX - rect.left,
                y: evt.clientY - rect.top
            };
        }
        function drawHexagon(x, y, color) {
            x = x + camera_x;
            y = y + camera_y;
            if(y<(height-hex_size)&&y>(0+hex_size)&&x<(width-hex_size)&&x>(0+hex_size)){
                var height_center = height/2;
                var width_center = width/2;
                var a = height_center - y;
                var b = width_center - x;  
                var c = Math.sqrt( a*a + b*b );
                hex_size_pl = hex_size / (c*0.002);
                if(hex_size_pl>hex_size){
                    hex_size_pl=hex_size;
                }
                ctx.beginPath();
                ctx.moveTo(x + hex_size_pl * Math.cos(0), y + hex_size_pl * Math.sin(0));
                var side = 0;
                for (side; side < 7; side++) {
                  ctx.lineTo(x + hex_size_pl * Math.cos(side * 2 * Math.PI / 6), y + hex_size_pl * Math.sin(side * 2 * Math.PI / 6));
                }
                ctx.fillStyle = color;
                ctx.fill();
            }
        }
        </script>
    </body>
</html>