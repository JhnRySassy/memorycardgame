<?php
session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Rick and Morty Memory Card Game</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<style>
body {
    margin:unset;
    background-image: linear-gradient(rgba(44, 94, 44, 0.8),rgba(44, 94, 44, 0.8)),url(Background.jpg);
}
.title-header {
    background: #8cce96;
    margin: unset !important;
    height: 10vh;
    font-size: 25px;
    display: flex;
    align-items: center;
}
.title-header>.title {
    margin: auto;
    padding-left: 300px;
}
.title-header a{
    text-decoration: none;
    padding-right: 90px;
    color: black;
    font-weight: 900;
}
.title-header a:hover{
    color: rgb(8, 114, 34);
}
.card-field {
    /*display: content;*/
    width: 90%;
    margin: auto;
    perspective: 1000px;
}
.card {
    display: inline-flex;
    margin: 0.5%;
    width: 10%;
    height: 14.9vh;
    border: 2px solid black;
    padding: 5px;
    align-items: center;
    cursor: pointer;
    float: left;
    position: relative;
    background-color: #f7f7f7;
    transition: transform 0.8s;
    transform-style: preserve-3d;
    border-radius:3px;
    
}
.card-cover{
    width: 100%;
    height: 100%;
    background-image: url(card.png);
    position: absolute;
    right:0;
    left:0;
    background-size: cover;
    background-position: center;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.rectShape {
	width: 50px;
	height:70px;
}
.circShape{
    width:50px;
    height:50px;
    border-radius:50%
}
.sqShape{
    width:50px;     
    height:50px;
}
.ovalShape{
    width:50px;
    height:75px;
    border-radius:50%
}
.card-content{
    margin:auto;
    -webkit-backface-visibility: hidden; /* Safari */
    backface-visibility: hidden;
    transform: rotateY(180deg);
}

.modal {
    position: absolute;
    z-index: 999;
    margin: auto;
    display: inline-flex;
    background: #00000085;
    height: 100%;
    width: 100%;
    left: 0;
    top: 0;
}
.modal-content {
    background: white;
    width: 80%;
    margin: auto;
    padding: 1.3rem;
    border-radius: 10px;
    min-height: 15vw;
    display: inline-flex;
    align-items: center;
    text-align: center;
}
.mAuto{
    margin:auto;
}
.message {
    font-size: 50px;
    font-weight: bolder;
    font-style: italic;
    font-family: monospace;
}
#transistion{
    display:none;
}
div#play-btn-field {
    position: absolute;
    background: #000000ad;
    width: 100%;
    left: 0;
    top: 34vh;
    height: 16vh;
    display: inline-flex;
    align-items: center;
}
button#start,.modal-content button {
    margin: auto;
    background: #00c1fb;
    border: unset;
    height: 5vh;
    width: 15vw;
    border-radius: 3px;
    font-family: monospace;
    font-size: 25px;
    font-weight: bolder;
    color: white;
    cursor: pointer;
}
#skip{
    background: #00c1fb;
    border: unset;
    border-radius: 3px;
    font-family: monospace;
    font-weight: bolder;
    color: white;
    cursor: pointer;
    height: 3vh;
}
#countdown-field span{
    font-size:15px;
    color:red;
    font-family: monospace;
    font-style:italic;
}
button#start:hover {
    background: #00aafb;
    cursor: pointer;
}
.text-center{
    text-align:center;
}
</style>
</head>
<body>
    <div class="title-header"><div class='title'><h3>Rick and Morty Memory Card Game</h3></div><a href="game.php" class="button">Back to Main Menu</a></div>
    <div></small><b>How to Play</b></small></div>
    <ul>
    	<li>This is a two (2) player game.</li>
        <li>Each Player will match the card to gain points for only 1 try for each turn.</li>
	    <li>Players will be given 30 seconds to memorize the placements of the cards before the match is on.</li>
    </ul>
    
    <hr>

    <br>

 <script>
    // Data
    var $card_c = [];
 
    $card_c[0] = [{'shape':'circShape','color':'red','pair':'p1'}];
    $card_c[1] = [{'shape':'sqShape','color':'red','pair':'p2'}];
    $card_c[2] = [{'shape':'ovalShape','color':'red','pair':'p3'}];
    $card_c[3] = [{'shape':'rectShape','color':'red','pair':'p4'}];

    $card_c[4] = [{'shape':'circShape','color':'blue','pair':'p5'}];
    $card_c[5] = [{'shape':'sqShape','color':'blue','pair':'p6'}];
    $card_c[6] = [{'shape':'ovalShape','color':'blue','pair':'p7'}];
    $card_c[7] = [{'shape':'rectShape','color':'blue','pair':'p8'}];

    $card_c[9] = [{'shape':'circShape','color':'green','pair':'p9'}];
    $card_c[10] = [{'shape':'sqShape','color':'green','pair':'p10'}];
    $card_c[11] = [{'shape':'ovalShape','color':'green','pair':'p11'}];
    $card_c[12] = [{'shape':'rectShape','color':'green','pair':'p12'}];

    $card_c[13] = [{'shape':'circShape','color':'yellow','pair':'p13'}];
    $card_c[14] = [{'shape':'sqShape','color':'yellow','pair':'p14'}];
    $card_c[15] = [{'shape':'ovalShape','color':'yellow','pair':'p15'}];
    $card_c[16] = [{'shape':'rectShape','color':'yellow','pair':'p16'}];

    $card_c[17] = [{'shape':'circShape','color':'black','pair':'p17'}];
    $card_c[18] = [{'shape':'sqShape','color':'black','pair':'p18'}];
    $card_c[19] = [{'shape':'ovalShape','color':'black','pair':'p19'}];
    $card_c[20] = [{'shape':'rectShape','color':'black','pair':'p20'}];

    $card_c[21] = [{'shape':'circShape','color':'red','pair':'p1'}];
    $card_c[22] = [{'shape':'sqShape','color':'red','pair':'p2'}];
    $card_c[23] = [{'shape':'ovalShape','color':'red','pair':'p3'}];
    $card_c[24] = [{'shape':'rectShape','color':'red','pair':'p4'}];

    $card_c[25] = [{'shape':'circShape','color':'blue','pair':'p5'}];
    $card_c[26] = [{'shape':'sqShape','color':'blue','pair':'p6'}];
    $card_c[27] = [{'shape':'ovalShape','color':'blue','pair':'p7'}];
    $card_c[28] = [{'shape':'rectShape','color':'blue','pair':'p8'}];

    $card_c[29] = [{'shape':'circShape','color':'green','pair':'p9'}];
    $card_c[30] = [{'shape':'sqShape','color':'green','pair':'p10'}];
    $card_c[31] = [{'shape':'ovalShape','color':'green','pair':'p11'}];
    $card_c[32] = [{'shape':'rectShape','color':'green','pair':'p12'}];

    $card_c[33] = [{'shape':'circShape','color':'yellow','pair':'p13'}];
    $card_c[34] = [{'shape':'sqShape','color':'yellow','pair':'p14'}];
    $card_c[35] = [{'shape':'ovalShape','color':'yellow','pair':'p15'}];
    $card_c[36] = [{'shape':'rectShape','color':'yellow','pair':'p16'}];

    $card_c[37] = [{'shape':'circShape','color':'black','pair':'p17'}];
    $card_c[38] = [{'shape':'sqShape','color':'black','pair':'p18'}];
    $card_c[39] = [{'shape':'ovalShape','color':'black','pair':'p19'}];
    $card_c[40] = [{'shape':'rectShape','color':'black','pair':'p20'}];  
</script>
    

    <div id='countdown-field' style="display:none">
        The game will start after <span></span> second/s <button id="skip" type="button"> Skip Countdown</button> 
    </div>
        <br>
    <table width="100%" style="display:none" id="scoreboard">
        <tr>
            <th colspan="3" class="text-center"><h1><b><i>Scoreboard</i></b></h1></th>   
        </tr>
        <tr>
            <td widt="33.33%" class="text-center"><h2>Player 1 : <span id="p1S">0</span> </h2></td>
            <td widt="33.33%" class="text-center"></td>
            <td widt="33.33%" class="text-center"><h2>Player 2 : <span id="p2S">0</span> </h2></td>
        </tr>
    </table>
    <hr>

    <input type="hidden" id="first" value="">
    <input type="hidden" id="second" value="">
    <input type="hidden" id="turn" value="1">

    <div class="card-field" align="middle">
    </div>

    <div id="play-btn-field">
            <button type="button" id='start'>Play Now</button>
        </div>
    <br>

    <div id='transistion'>
    <div class="modal">
        <div class="modal-content">
            <div id="p1transistion" class='mAuto' style="display: none">
                <center><p class="message"><b>Player 1's Turn</b></p></center>
            </div>
            <div id="p2transistion" class='mAuto' style="display: none">
                <center><p class="message"><b>Player 2's Turn</b></p></center>
            </div>
            <div id="win" class='mAuto' style="display: none">
                <center><p class="message"><b>Player <span id="pwin"></span> Wins</b></p></center>

            </div>
            <div id="windraw" class='mAuto' style="display: none">
                <center><p class="message"><b>DRAW</b></p></center>

            </div>

        </div>
    </div>
    </div>

    <div id="clone_card" style="display:none">
         <div class="card">
            
                <div class="card-cover" style""></div>
                <div class="card-content" ></div>
            </div>
    </div>
</body>
<script>
    window.load_cards = function(){
       var card = Object.keys($card_c);
            card.sort(function() {
                return Math.random() - 0.5;
            });
            $('.card-field').html('')
    card.forEach(function(i) {
            var c  = $('#clone_card .card').clone()
                    $card_c[i] = $card_c[i][0]
                console.log($card_c[i])
                c.find('.card-content').addClass($card_c[i]['pair'])
                c.find('.card-content').addClass($card_c[i]['shape'])
                c.find('.card-content').attr('data-pair',$card_c[i]['pair'])
                c.find('.card-content').css({'background-color':$card_c[i]['color']})
                $('.card-field').append(c)


    });
    }

    var timer;
$(document).ready(function(){

    $('#start').click(function(){
        $('.card').css({"transform":"rotateY(180deg)"})
        $(this).parent().hide()
        start_countdown()
    })
    $("#skip").click(function(){
        skip_cd();
    })
    
load_cards()
})
function start_game(){
    $('#p1S').html(0)
    $('#p2S').html(0)
    $('.card').each(function(){
    $(this).click(function(){
        if($(this).hasClass('open') == true)
            return false;
        $(this).css({"transform":"rotateY(180deg)"})
        $(this).addClass('open')
                
                if($('#first').val() == ''){
                    $('#first').val($(this).find('.card-content').attr('data-pair'))
                }else{
                    $('#second').val($(this).find('.card-content').attr('data-pair'))
                    match();
                }
    })
    })
  
}
function update_score(){
    var p = $('#turn').val()
    var score = $('#p'+p+'S').html();
    score++;
    $('#p'+p+'S').html(score);
}
function show_trasistion(){
    var p1 = $('#p1S').html();
    var p2 = $('#p2S').html();
    if((parseInt(p1) + parseInt(p2)) == 20){
        var win = '';
        if(p1 > p2){
            win = 2;
        }else if(p2 > p1){
            win = 1;
        }else if(p2 == p1){
            win = 'draw'
        }
        scoreboard = $("#scoreboard").clone();
        scoreboard.css({'width':'50vw'})
        if(win == 'draw'){
            $('#windraw').append(scoreboard)
            $('#windraw').show()
        $('#windraw').append('<br><button type="button" onclick="location.reload()">Play Again</button')
        }else{
            $('#win').append(scoreboard)
            $('#win #pwin').html(win)
            $('#win').show()
        $('#win').append('<br><button type="button" onclick="location.reload()">Play Again</button')
        }
    $('#transistion').show();

        return false;
    }

    var p = $('#turn').val()
    $('#p'+p+'transistion').show()
    $('#transistion').show();
    setTimeout(function(){
        $('#transistion').hide();
        $('#p'+p+'transistion').hide()
    },1500)
}
function update_turn(){
    var p = $('#turn').val()
    if(p == 1)
    $('#turn').val(2)
    else{
    $('#turn').val(1)
    }
}
function skip_cd(){
        clearInterval(timer)
        $('#countdown-field').hide()
        $('.card').css({"transform":"unset"})
        $('#scoreboard').show()
        $('#countdown-field span').html(0)
        show_trasistion()
        start_game()

}
function start_countdown(){
    $('#countdown-field').show()
    var time = 30;
     timer = setInterval(function(){
        $('#countdown-field span').html(time)
        time--;
        if(time==0){
            clearInterval(timer)
        $('#countdown-field').hide()
        $('.card').css({"transform":"unset"})
        
        $('#scoreboard').show()
        show_trasistion()
        start_game()

        }
    },1000)
}
function match(){
    
    var p = $('#first').val()
    var pp = $('#second').val()
    // console.log(p,pp)
    // console.log(p,pp)
    if($('#first').val() == $('#second').val() ){
            $('#first').val('')
            $('#second').val('')
            update_score()
        }else{
            $('#first').val('')
            $('#second').val('')
            setTimeout(function(){
                $('.'+pp).parent().css({'transform':'unset'})
                $('.'+p).parent().css({'transform':'unset'})
                $('.'+pp).parent().removeClass('open')
                $('.'+p).parent().removeClass('open')
            },1500)
        }
    update_turn();
            setTimeout(function(){
                show_trasistion()
            },1750)
}
</script>