/**************************************************
 * Player
 * Implementation of the Player class
 **************************************************/
class Player {
   health;
   weapon;
   armor ;
   jumped;
   ducked;   
   constructor() {
      this.health = 50;
      this.weapon = "";
      this.jumped = false;
      this.ducked = false;
   }

   /************************************
    * Displays the players stats
    ************************************/
   displayPlayerStats() {
      document.getElementById("health").innerHTML = this.health;
      document.getElementById("weapon").innerHTML = this.weapon;
   }

   /************************************
    * Sets the players weapon
    ************************************/
   setWeapon(x) {
      this.weapon = x;
   }

   /************************************
    * The player attacks
    ************************************/
   attack(dragon) {
      displayText("You attack.");
      var damage = 0;
      var hit = 0;
      // Get the damage and roll for a hit
      switch (this.weapon) {
         case weapons.rustySword:
            damage = 5;
            hit = roll() - 2;
            if (hit == 18) {
               // There is a small chance
               // that the Rusty Sword
               // will kill the dragon
               // automatically
               // (Tetanus is very deadly!)
               damage = 200;
               displayText("The dragon gets tetanus and dies.");
            } else if (hit == -1) {
               // There is also a small
               // chance that the Rusty
               // Sword will kill the player
               // automatically
               this.health = 0;
               displayText("Your Rusty Sword slips out of your hand and cuts your foot. You get tetanus and die.")
            }
            break;
         case weapons.ironAxe:
            damage = 10;
            hit = roll() + 2;
            break;
         case weapons.javelin:
            damage = 5;
            hit = roll() + 3;
            break;
         case weapons.steelMace:
            damage = 20;
            hit = roll() - 2
         default:
            damage = 3;
            hit = roll();
            break;   
      }

      if (hit >= 20) {
         // Critical hit
         dragon.health -= damage + 20;
         displayText("Critical hit!");
      } else if (hit > 10) {
         // Normal hit
         dragon.health -= damage;
         displayText("You hit the dragon!");
      } else if (hit == 1) {
         // Critical fail
         this.health -= damage / 2;
         displayText("You miss and hit yourself. :(");
      } else {
         // Miss
         displayText("You missed.");
      }

      //Update the stats
      this.displayPlayerStats();
      dragon.displayDragonStats();

      //Check what happens next
      if (dragon.health <= 0) {
         // Dragon is dead
         advanceTo(scenario.seven)
      } else if (this.health <= 0) {
         advanceTo(scenario.six);
      } else {
         dragon.attack(this);
      }
   }

   jump() {
      this.jumped = true;
   }

   duck() {
      this.ducked = true;
   }
}

/*******************************************
 * Dragon
 * Implementation of the Dragon class
 *******************************************/
class Dragon {
   health;
   max_damage;
   constructor() {
      this.health = 200;
      this.max_damage = 15;
   }

   /****************************************
    * The Dragon attacks
    ****************************************/
   attack(player) {
      displayText("The dragon attacks.");
      var damage = getRandInteger(1, this.max_damage);
      var hit = roll();
      if (hit == 20) {
         //Critical hit
         player.health -= damage + 10;
         displayText("Critical hit!");
      } else if (hit > 12) {
         //Normal hit
         if (player.jumped) {
            if (hit % 2 == 0) {
               player.health -= damage;
               displayText("You jumped but the dragon still got you!");
            } else {
               displayText("The dragon missed!");
            }
            player.jumped = false;
         } else if (player.ducked) {
            if (hit % 2 != 0) {
               player.health -= damage;
               displayText("You ducked but the dragon still got you!");
            } else {
               displayText("The dragon missed!");
            }
            player.ducked = false;
         } else {
            player.health -= damage;
            displayText("You got hit!");
         }
      } else if (hit == 1) {
         // Critical fail
         this.health -= damage;
         displayText("The dragon misses and hits itself!");
      } else {
         //miss
         displayText("The dragon missed.");
      }
   }

   /**************************************
    * Show the Dragon's stats
    **************************************/
   displayDragonStats() {
      document.getElementById("dHealth").innerHTML = this.health;
   }
}

/***********************************
 * Simulates rolling a 20 sided die
 ***********************************/
function roll() {
   var number = Math.floor(Math.random() * 20 ) + 1;
   console.log(number);

   return number;
}

/***********************************
 * Returns a random integer between 
 * the min and the max parameters
 ***********************************/
function getRandInteger(min, max) {
   return Math.floor(Math.random() * (max - min) + 1);
}

/***********************************
 * Takes a string as a parameter and 
 * adds it to the game div
 ***********************************/
function displayText(text) {
   var node = document.createElement("P");
   var textNode = document.createTextNode(text);
   node.appendChild(textNode);
   document.getElementById("game").appendChild(node);
}

/**********************************
 * Takes a list of buttons as a 
 * parameter and displays each button
 **********************************/
function showButtons(buttons) {
   var userInput = document.getElementById("userInput");
   userInput.innerHTML = "";
   for (var i = 0; i < buttons.length; i++) {
     userInput.innerHTML += "<button onClick=" + buttons[i][1]+">" + buttons[i][0] + "</button>";
   }
}

var scenario = {
   one: {
      text: "You find yourself in a dark tunnel with bones along the walls. " +
              "There are weapons on the ground. Which one do you pick?",
      buttons: [["Rusty Sword", "setPlayerWeapon(weapons.rustySword),advanceTo(scenario.two)"], 
                  ["Iron Axe", "setPlayerWeapon(weapons.ironAxe),advanceTo(scenario.two)"],
                  ["Javelin", "setPlayerWeapon(weapons.javelin),advanceTo(scenario.two)"],
                  ["Steel Mace", "setPlayerWeapon(weapons.steelMace),advanceTo(scenario.two)"]]
   },
   two: {
      text: "As you continue down the tunnel you enter a large tunnel lit by a " +
            "tall chandelier dangling from the ceiling.",
      buttons: [["Continue", "advanceTo(scenario.three)"]]
   },
   three: {
      text: "As you examine the chandelier, you realize that the chandelier is actually " + 
            "a dragon!",
      buttons: [["Continue", "advanceTo(scenario.four)"]]
   },
   four: {
      text: "The dragon jumps down and attacks!",
      buttons: [["Continue", "advanceTo(scenario.five),scrollBottom()"]]
   },
   five: {
      text: "What do you do?",
      buttons: [["Jump", "player.jump(),dragon.attack(player),scrollBottom()"], ["Duck", "player.duck(),dragon.attack(player),scrollBottom()"], ["Attack", "player.attack(dragon),scrollBottom()"]]
   },
   six: {
      text: "You have died. What do you do?",
      buttons: [["Try again", "document.location.reload()"], ["End game", "advanceTo(scenario.eight)"]]
   },
   seven: {
      text: "The dragon is dead! You won! What do you do?",
      buttons: [["Play again", "document.location.reload()"], ["End game", "advanceTo(scenario.eight)"]]
   },
   eight: {
      text: "Thanks for playing!",
      buttons: [["Try again", "document.location.reload()"]]
   }
}

var weapons = { 
   rustySword: "Rusty Sword", 
   ironAxe: "Iron Axe", 
   javelin: "Javelin", 
   steelMace: "Steel Mace" 
}

var player = new Player();
var dragon = new Dragon();

function setPlayerWeapon(weapon) {
   player.setWeapon(weapon);
}

function scrollBottom() {
   var div = document.getElementById("game");
   div.scrollTop = div.scrollHeight;
}

function advanceTo(x) {
   displayText(x.text);
   showButtons(x.buttons);
   player.displayPlayerStats();
   dragon.displayDragonStats();
}