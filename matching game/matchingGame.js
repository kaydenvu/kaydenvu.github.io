var cards = document.querySelectorAll('.card');
var flippedCards = [];
var matchedCards = [];
var lockBoard = false;
var matchedAmount = 0;

// function to flip a card
function flipCard() {
  if (lockBoard) return;
  if (this === flippedCards[0]) return;
  this.classList.add('flipped');
  flippedCards.push(this);
  if (flippedCards.length === 0) {
    return;
  }
  checkForMatch();
}

// function to check for a match
function checkForMatch() {
  var card1 = flippedCards[0].querySelector('.front').getAttribute('src');
  var card2 = flippedCards[1].querySelector('.front').getAttribute('src');
  if (card1 === card2) {
    // match adds 2 of the same card
    matchedAmount += 2
    disableCards();
    // if all cards are matched
    if (matchedAmount === cards.length) {
      setTimeout(() => {
        resetGame();
      }, 5000);
    }
  } else {
    // not a match
    unflipCards();
  }
}

// function to disable matched cards
function disableCards() {
  flippedCards[0].removeEventListener('click', flipCard);
  flippedCards[1].removeEventListener('click', flipCard);
  matchedCards.push(flippedCards.pop())
  matchedCards.push(flippedCards.pop())
  resetBoard();
}

// function to unflip cards that don't match
function unflipCards() {
  lockBoard = true;

  setTimeout(() => {
    flippedCards[0].classList.remove('flipped');
    flippedCards[1].classList.remove('flipped');
    resetBoard();
  }, 1500);
}

// function to reset the game board
function resetBoard() {
  flippedCards = [];
  lockBoard = false;
}

// function to reset the game
function resetGame() {
  matchedAmount = 0;
  for (let i = 0; i < matchedCards.length; i++) {
    matchedCards[i].classList.remove('flipped');
  }
  matchedCards = [];
  shuffleCards();
  cards.forEach(card => card.addEventListener('click', flipCard));
}

// function to shuffle the cards
function shuffleCards() {
  const gameContainer = document.getElementById("game-container");
  for (let i = gameContainer.children.length; i >= 0; i--) {
    gameContainer.appendChild(gameContainer.children[Math.random() * i | 0]);
  }
}

// shuffle the cards at the start of the game
shuffleCards();

// event listener for card clicks
cards.forEach(card => card.addEventListener('click', flipCard));