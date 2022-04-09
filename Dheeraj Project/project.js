 alert("hello")
var data2=[]
var expvsreal=[]
var dt=new Date();
document.querySelector(".date-time").innerHTML=dt;
var datasheet=[];
function adddata(){
     alert("hello2")
    for(var i=0;i<6;i++){
    myChart.datasets.data[i]=data2[i]
    myChart.update();
    }
}
function expvsrealfunc(){
    var z=expvsreal[0]-expvsreal[1]
    document.getElementById("evr").value=z;
}
function ttnpr(){
    var sum=0;
    for(var i=0;i<6;i++){
        sum=sum+data2[i];   
    }
    document.getElementById("tcat").value=sum;
    //for categary
    document.getElementById("ex").value=Math.floor(data2[0]*100/sum)+"%";
    document.getElementById("ed").value=Math.floor(data2[1]*100/sum)+"%";
    document.getElementById("gr").value=Math.floor(data2[2]*100/sum)+"%";
    document.getElementById("hc").value=Math.floor(data2[3]*100/sum)+"%";
    document.getElementById("bil").value=Math.floor(data2[4]*100/sum)+"%";
    document.getElementById("otr").value=Math.floor(data2[5]*100/sum)+"%";
    
}
function myfunc(){
    var a=document.getElementById("ee").value;
    a=parseInt(a);
    expvsreal.push(a);
    var b=document.getElementById("ae").value;
    b=parseInt(b);
    expvsreal.push(b);    
    var u=document.getElementById("electronics").value;
    u=parseInt(u);
    data2.push(u);
    var v=document.getElementById("education").value;
    v=parseInt(v);
    data2.push(v);
    var w=document.getElementById("groceries").value;
    w=parseInt(w);
    data2.push(w);
    var x=document.getElementById("HEALTH-CARE").value;
    x=parseInt(x);
    data2.push(x);
    var y=document.getElementById("bills").value;
    y=parseInt(y);
    data2.push(y);
    var z=document.getElementById("others").value;
    z=parseInt(z);
    data2.push(z);
    alert(data2);
    document.getElementById("graph1").style.display="block";
    expvsrealfunc();
    ttnpr();
}
