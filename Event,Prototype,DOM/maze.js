/* CSE326 : Web Application Development
 * Lab 10 - Maze Assignment
 * 2013042776 컴퓨터공학과 남궁선
 */

"use strict";

var loser = true; // whether the user has hit a wall

window.onload = function() {
  var divs = $$(".boundary");
  for (var i = 0; i < divs.length - 1; i++) {
    divs[i].observe("mouseover", overBoundary);
  }
  $("end").observe("mouseover", overEnd);
  $("start").observe("click", startClick);
  $("maze").observe("mouseleave", overBody);

};

// called when mouse enters the walls;
// signals the end of the game with a loss
function overBoundary(event) {

  if (loser === false) {
    var divs = $$(".boundary");
    for (var i = 0; i < divs.length - 1; i++) {
      divs[i].addClassName("youlose");
    }
    //alert("You lose :(");
    $("status").innerHTML = "You lose!";
    loser = true;
  }

}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
  if (loser === true) {
    var divs = $$(".boundary");
    for (var i = 0; i < divs.length - 1; i++) {
      divs[i].removeClassName("youlose");
      $("status").innerHTML = "Start!";
    }
    loser = false;
  }

}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
  if (loser === false) {
    //alert("You win :)");
    $("status").innerHTML = "You Win!";
    loser = true;
  }
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
  if (loser === false) {
    var divs = $$(".boundary");
    for (var i = 0; i < divs.length - 1; i++) {
      divs[i].addClassName("youlose");
    }
    //alert("You lose :(");
    $("status").innerHTML = "You lose!";
    loser = true;
  }
}
