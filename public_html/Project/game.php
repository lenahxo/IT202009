<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<!--https://www.thatsoftwaredude.com/content/6417/how-to-code-blackjack-using-javascript-->

<!--Setting up game area-->
<div class="game">
     <div class="game">
            <h3>Blackjack</h3>
    
    <div class="game-body">
           <div class="game-options">
            <input type="button" id="btnStart" class="btn" value="start" onclick="startblackjack()">
            <input type="button" class="btn" value="hit me" onclick="hitMe()">
            <input type="button" class="btn" value="stay" onclick="stay()">
            </div>
    
                <div class="status" id="status"></div>
    
            <div id="deck" class="deck">
                <div id="deckcount">52</div>
            </div>
    
            <div id="players" class="players">
            </div>
    
            <div class="clear"></div>
    </div>
</div>

<script>

    /**
     * Building deck
     */
    var suits = ["Spades", "Hearts", "Diamonds", "Clubs"];
    var values = ["2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A"];
    var deck = new Array();
    var players = new Array();
    var currentPlayer = 0;

    function createDeck()
    {
        deck = new Array();
        for (var i = 0 ; i < values.length; i++)
        {
            for(var x = 0; x < suits.length; x++)
            {
                var weight = parseInt(values[i]);
                if (values[i] == "J" || values[i] == "Q" || values[i] == "K")
                    weight = 10;
                if (values[i] == "A")
                    weight = 11;
                var card = { Value: values[i], Suit: suits[x], Weight: weight };
                deck.push(card);
            }
        }
    }

    
    /**
     * createPlayer
     */
    function createPlayers(num)
    {
        players = new Array();

        for(var i = 1; i <= num; i++)
        {
            var hand = new Array();
            var player = { Name: 'Player ' + i, ID: i, Points: 0, Hand: hand };
            players.push(player);
        }
    }


    /**
     * Player UI
     */
    function createPlayersUI()
    {
        document.getElementById('players').innerHTML = '';

        for(var i = 0; i < players.length; i++)
        {
            var div_player = document.createElement('div');
            var div_playerid = document.createElement('div');
            var div_hand = document.createElement('div');
            var div_points = document.createElement('div');

            div_points.className = 'points';
            div_points.id = 'points_' + i;
            div_player.id = 'player_' + i;
            div_player.className = 'player';
            div_hand.id = 'hand_' + i;

            div_playerid.innerHTML = 'Player ' + players[i].ID;
            div_player.appendChild(div_playerid);
            div_player.appendChild(div_hand);
            div_player.appendChild(div_points);
            document.getElementById('players').appendChild(div_player);
        }
    }


    /**
     * Shuffle
     */
    function shuffle()
    {
        // for 1000 turns
        // switch the values of two random cards
        for (var i = 0; i < 1000; i++)
        {
            var location1 = Math.floor((Math.random() * deck.length));
            var location2 = Math.floor((Math.random() * deck.length));
            var tmp = deck[location1];

            deck[location1] = deck[location2];
            deck[location2] = tmp;
        }
    }


    /**
     * dealHands
     */
    function dealHands()
    {
        // alternate handing cards to each player
        // 2 cards each
        for(var i = 0; i < 2; i++)
        {
            for (var x = 0; x < players.length; x++)
            {
                var card = deck.pop();
                players[x].Hand.push(card);
                renderCard(card, x);
                updatePoints();
            }
        }

        updateDeck();
    }


    /**
     * renderCard
     */
    function renderCard(card, player)
    {
        var hand = document.getElementById('hand_' + player);
        hand.appendChild(getCardUI(card));
    }


    /**
     * Card UI
     */
    function getCardUI(card)
    {
        var el = document.createElement('div');
        var icon = '';
        if (card.Suit == 'Hearts')
        icon='&hearts;';
        else if (card.Suit == 'Spades')
        icon = '&spades;';
        else if (card.Suit == 'Diamonds')
        icon = '&diams;';
        else
        icon = '&clubs;';
        
        el.className = 'card';
        el.innerHTML = card.Value + '<br/>' + icon;
        return el;
    }

    
    /**
     * getPoints
     */
    function getPoints(player)
    {
        var points = 0;
        for(var i = 0; i < players[player].Hand.length; i++)
        {
            points += players[player].Hand[i].Weight;
        }
        players[player].Points = points;
        return points;
    }


    /**
     * updatePoints
     */
    function updatePoints()
    {
        for (var i = 0 ; i < players.length; i++)
        {
            getPoints(i);
            document.getElementById('points_' + i).innerHTML = players[i].Points;
        }
    }


    /**
     * hitMe
     */
    function hitMe()
    {
        // pop a card from the deck to the current player
        // check if current player new points are over 21
        var card = deck.pop();
        players[currentPlayer].Hand.push(card);
        renderCard(card, currentPlayer);
        updatePoints();
        updateDeck();
        check();
    }

    
    /**
     * Stay
     */
    function stay()
    {
        // move on to next player, if any
        if (currentPlayer != players.length-1) {
            document.getElementById('player_' + currentPlayer).classList.remove('active');
            currentPlayer += 1;
            document.getElementById('player_' + currentPlayer).classList.add('active');
        }

        else {
            end();
        }
    }


    /**
     * Start Game
     */
    function startblackjack()
    {
        document.getElementById('btnStart').value = 'Restart';
        document.getElementById("status").style.display="none";

        // deal 2 cards to every player object
        currentPlayer = 0;
        createDeck();
        shuffle();
        createPlayers(2);
        createPlayersUI();
        dealHands();
        document.getElementById('player_' + currentPlayer).classList.add('active');
    }

    /**
     * End Method
     * --
     * Calculates winner and score
     * Sends score to save_score api
    */
    function end()
    {
        var winner = -1;
        var score = 0;
        var myScore = 0;

        for(var i = 0; i < players.length; i++)
        {
            if (players[i].Points > score && players[i].Points < 22)
            {
                winner = i;
                score = players[i].Points;

                //save player1 score separately to send to save_score
                if (i == 0)
                {
                    if ( score != 0)
                    {
                        myScore = score;
                    }
                }
            }
        }

        console.log("Winner " + (winner+1) + " Score: " + score);


        document.getElementById('status').innerHTML = 'Winner: Player ' + players[winner].ID;
        document.getElementById("status").style.display = "inline-block";

        
        //SENDING SCORE
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = () =>
        {
            if (this.readyState == 4 && this.status === 200)
            {
                    document.getElementById("points_").innerHTML = this.responseText;
                    console.log("received data", data);
                    console.log("Saved score");
            }
        }

        xhttp.open("POST", "api/save_score.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(`score=${myScore}`);
        
    }


    /**
     * Check points
     */
    function check()
    {
        if (players[currentPlayer].Points > 21)
        {
            document.getElementById('status').innerHTML = 'Player: ' + players[currentPlayer].ID + ' LOST';
            document.getElementById('status').style.display = "inline-block";
            end();
        }
    }


    /**
     * updateDeck
     */
    function updateDeck()
    {
        document.getElementById('deckcount').innerHTML = deck.length;
    }

    window.addEventListener('load', function(){
        createDeck();
        shuffle();
        createPlayers(1);
        });


</script>


<!--Styling for game-->else
<style>

.game
{
    width: 720px;
    border: solid 1px #ddd;
    margin: 0 auto;
    background: #3ac7fe;
    border: solid 10px;
    text-align:center;
    min-height:430px;
    background-color: rgb(142, 116, 255);
}

.btn{
    border:none;
    padding: 10px 30px;
    border-radius:10px;
    cursor:pointer;
}

.btn:hover{
    background-color:rgb(92, 76, 163)
}

.game h3
{
padding: 10px;
background:black;
color:white;
}

.game .game-body
{
padding: 20px;
}

.game .game-options
{
text-align:center;
}
.game .card{
    width: 50px;
    height: 80px;
    padding: 10px;
    border: solid 1px #808080;
    background-color: white;
    display: inline-block;
    border-radius: 10px;
    font-size: 10pt;
    text-align: center;
    margin: 3px;
    border:solid 3px;
}

.game .status
{
    display: inline-block;
    background: gold;
    border: solid 5px white;
    border-radius: 10px;
    padding: 5px 20px;
    margin: 0 auto;
    margin-top: 10px;
    display:none;
}


.players{
       width: 500px;
margin: 0 auto;
margin-top: 20px;
text-align: center;
}

.player{
    width: 40%;
    border: solid 5px #f5f5f5;
    border-radius: 10px;
    padding: 10px;
    display: inline-block;
    margin:1%;
    vertical-align: top;
    background:#f5f5f5;
}

.player.active{
    border: solid 5px #222;
}

.points{
    text-align: center;
    font-size: 20pt;
    font-weight: bold;
    margin: 10px;
}

.deck{
    float:left;
    background: white;
    color:#222;
    padding: 10px;
    border-radius:10px;
    border: double 5px;
}

.btn
{
    background:#222;
    color:white !important;
    border-radius:0px;
}

</style>





<?php
require_once(__DIR__ . "/../../partials/flash.php");
?>
