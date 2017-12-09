function onClickBigger(){
  alert("Hello, world!");
  //$("textarea").style.fontSize = "24pt";
  setInterval("var size = parseInt($('textarea').style.fontSize);size += 2;$('textarea').style.fontSize = size + 'pt';", 500);
}

function onChangeCBox(){
  alert("CheckBox is changed");

  if($("checkbox").checked == true){
    $("textarea").style.color = "green";
    $("textarea").style.fontWeight = "bold";
    $("textarea").style.textDecoration = "underline";
    document.body.style.background = "url('http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/8/hundred.jpg')"
  }else{
    $("textarea").style.color = "black";
    $("textarea").style.fontWeight = "normal";
    $("textarea").style.textDecoration = "none";
    document.body.style.background = "none"
  }
}

function onClickSnoopy(){
  $("textarea").style.textTransform = "uppercase";
  var strs = $("textarea").value.split(".");
  $("textarea").value = strs.join("-izzle.");
}

function onClickLay(){
  var strs = $("textarea").value;
  var arr = strs.split(/\s/);
  for(var i = 0;i<arr.length;i++){
    var x = 0;
    while(x < arr[i].length){
      if(arr[i].charAt(0).match(/[^aeiou]/) != null){
        var first = arr[i].charAt(0);
        var temp = arr[i].substring(1,arr[i].length);
        if(temp.charAt(temp.length-1) == "."){
          var temp2 = temp.substring(0,temp.length-1);
          temp = temp2.concat(first);
          temp = temp.concat(".");
        }else{
          temp = temp.concat(first);
        }
        arr[i] = temp;
      }else{
        break;
      }
      x++;
    }
    if(arr[i].charAt(arr[i].length-1) == "."){
      var temp3 = arr[i].substring(0,temp.length-1);
      temp3 = temp3.concat("ay");
      arr[i] = temp3.concat(".");
    }else{
      arr[i] = arr[i].concat("ay");
    }
    // document.write(arr[i]);
    // document.write("\n");
  }
  var final = "";
  for(var i = 0;i<arr.length-1;i++){
    final = final.concat(arr[i]);
    final = final.concat(" ");
  }
    final = final.concat(arr[arr.length-1]);
  //document.write(final);
  $("textarea").value = final;
}

function onMalkovitch(){
  var strs = $("textarea").value;
  var arr = strs.split(/\s/);
  for(var i = 0;i<arr.length;i++){
    if(arr[i].charAt(arr[i].length-1) == "."){
      var temp = arr[i].substring(0,temp.length-1);
      if(temp.length>=5){
        var mal = "Malkovitch";
        arr[i] = mal.concat(".");
      }
    }else{
      if(arr[i].length>=5){
        var mal = "Malkovitch";
        arr[i] = mal;
      }
    }
  }

  var final = "";
  for(var i = 0;i<arr.length-1;i++){
    final = final.concat(arr[i]);
    final = final.concat(" ");
  }
  final = final.concat(arr[arr.length-1]);

  $("textarea").value = final;
}
