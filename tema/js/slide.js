            function slideshow(){
                 max_number_img = 6;
                 i = 3;
                 dispari = true;
                 timer_cambio_img = setInterval('rullo()', 6000);
            }
            function rullo(){
                browser = null;
                if (window.ActiveXObject) {
                    if (navigator.userAgent.toLowerCase().indexOf("msie 5") != -1) {
                        browser = "ie";
                    } else {
                        browser = "ie";
                    }
                }
                if (!browser && typeof(XMLHttpRequest) != 'undefined') {
                      browser = "ch";
                }
                if(i < 10){
                    src = "splash" + i;
                    } else {
                        src = "splash" + i;
                    }

                timer_fade = setInterval('fade()', 100)
            }
            function fade(){
            if(browser == "ie"){
            if(dispari){
                        var valore1 = document.getElementById("box_01").filters.alpha.opacity;
                        var valore2 = document.getElementById("box_02").filters.alpha.opacity;
                        var incremento = 5;
                            if (valore1 < 100){
                                valore1 = valore1 + incremento;
                                document.getElementById("box_01").filters.alpha.opacity = valore1;
                                valore2 = valore2 - incremento;
                                document.getElementById("box_02").filters.alpha.opacity = valore2;
                            } else {
                                    stop_timer(timer_fade);
                                    dispari = false;
                                    document.getElementById("box_02").src = "/tema/immagini/"+ src + ".jpg";
                                    if(i<max_number_img){
                                      i++;
                                    } else {
                                        i = 1;
                                    }

                            }
            } else {
                        var valore1 = document.getElementById("box_02").filters.alpha.opacity;
                        var valore2 = document.getElementById("box_01").filters.alpha.opacity;
                        var incremento = 5;
                            if (valore1 < 100){
                                valore1 = valore1 + incremento;
                                    document.getElementById("box_02").filters.alpha.opacity = valore1;
                                valore2 = valore2 - incremento;
                                    document.getElementById("box_01").filters.alpha.opacity = valore2;
                            } else {
                                    stop_timer(timer_fade);
                                    dispari = true;
                                    document.getElementById("box_01").src = "/tema/immagini/"+ src + ".jpg";
                                    if(i<max_number_img){
                                      i++;
                                    } else {
                                        i = 1;
                                    }
                            }
            }
        } else {
            if(dispari){
                        var valore1 = document.getElementById("box_01").style.opacity;
                        var valore2 = document.getElementById("box_02").style.opacity;
                        var incremento = 0.1;
                            if (valore1 < 1){
                                valore1 = eval(valore1) + eval(incremento);
                                    document.getElementById("box_01").style.opacity = valore1;
                                valore2 = eval(valore2) - eval(incremento);
                                    document.getElementById("box_02").style.opacity = valore2;
                            } else {
                                    stop_timer(timer_fade);
                                    dispari = false;
                                    document.getElementById("box_02").src = "/tema/immagini/"+ src + ".jpg";
                                    if(i<max_number_img){
                                      i++;
                                    } else {
                                        i = 1;
                                    }

                            }
            } else {
                        var valore1 = document.getElementById("box_02").style.opacity;
                        var valore2 = document.getElementById("box_01").style.opacity;
                        var incremento = 0.1;
                            if (valore1 < 1){
                                valore1 = eval(valore1) + eval(incremento);
                                    document.getElementById("box_02").style.opacity = valore1;
                                valore2 = eval(valore2) - eval(incremento);
                                    document.getElementById("box_01").style.opacity = valore2;
                            } else {
                                    stop_timer(timer_fade);
                                    dispari = true;
                                    document.getElementById("box_01").src = "/tema/immagini/"+ src + ".jpg";
                                    if( i < max_number_img ){
                                      i++;
                                    } else {
                                        i = 1;
                                    }
                            }
            }
        }
    }
    function stop_timer(id){
        clearInterval(id);
    }