
    // var center = document.getElementById("change-Class")
    // var addClass = center.getElementsByClassName("changec")

    // for(let i = 0; i < addClass.length; i++) {
    //     addClass[i].addEventListener("click",function() {
    //         var current = document.getElementsByClassName("left__hover")
    //         current[0].className = current[0].className.replace(" left__hover", "")
    //         sessionStorage.setItem("classchange",this.i)
           
    //         this.className += " left__hover"
    //     })
    // }
    // var abccc = sessionStorage.getItem("classchange")
    // console.log(abccc);
    $(document).ready(function() {
        $(".changec").click(function () {
            $(this).addClass("left__hover");
            $(".changec").not(this).removeClass("left__hover");
        });
        
        });