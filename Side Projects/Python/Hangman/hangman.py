import random
import sys


# changes gWord characters from "_" to specified symbol or char
def autofill_symbol(w, gList, s):
    count = w.count(s)
    if count > 0:
        index = word.find(s)
        gList[index] = s
        for _ in range(count - 1):
            index = word.find(s, index + 1)
            gWord[index] = s
    return


# outputs which letters were used in alphabetical order, and how many guesses still remain
def end_guess_output(guessList, n):
    guessList.sort()
    print("Guessed letters: {}".format("".join(guessList)))
    print("Number of Incorrect Guesses Remaining: {}\n".format(n))
    return


play = True
guessedLetter = []  # list of used letters
wList = []  # list of all usable words
guess = numGuess = 6  # max number of allotted guesses before failure
right = wrong = 0  # score tracker

# opens file of usable words which are inserted into wList
f = open(sys.argv[1], 'r')
wList.extend(f.read().splitlines())
f.close()

wList = [i.lower() for i in wList]

# infinite outer loop for playing a round of hangman
while play:
    wordR = random.randint(0, len(wList) - 1)
    word = wList[wordR]
    gWord = ["_"] * len(word)  # list for holding correct and not guessed letters of word length

    symbols = [" ", "-", "&"]
    for i in range(len(symbols)):
        autofill_symbol(word, gWord, symbols[i])
    rCount = gWord.count("_")

    # user guesses letter or chooses to enter word
    while guess > 0:
        c = input("To guess word enter \"word\"! Guess Letter: ")
        c = c.lower()

        # user may guess word if "word" is inputted
        if c == "word":
            # user guesses word
            print("When guessing include all spaces between words and symbols!")
            c = input("Guess Word: ")
            c = c.lower()
            if c == word:
                print("Congrats! Guessed Word Correctly")
                rCount = 0
                right += 1
                break
            else:
                print("Incorrect Guess!")
                guess -= 1
                end_guess_output(guessedLetter, guess)
        # letter is inputted
        else:
            # check to ensure that a single char is inputted
            while guessedLetter.count(c) != 0 or len(c) != 1 or c.isdigit() or c in symbols:
                c = input("Letter used or Guess more than 1 letter! Guess Letter: ")
                c = c.lower()
            guessedLetter.append(c)
            autofill_symbol(word, gWord, c)
            if word.count(c) == 0:  # if letter does not exist in word
                guess -= 1
            print(" ".join(gWord))  # outputs current state of gWord
            rCount = gWord.count("_")
            if rCount == 0:
                print("Congrats! Guessed Word Correctly")
                right += 1
                break
            end_guess_output(guessedLetter, guess)
    # user runs out of guesses
    # if "_" still exist in gWord output message and word
    if rCount > 0:
        print("Sorry, Out of guesses. Try Again")
        print("Word is: {}".format(word))
        wrong += 1

    print("Correct Answers: {}, Wrong Answers: {}".format(right, wrong))

    # user chooses to play again or not
    replay = input("Play Again? (y/n) ")
    replay = replay.lower()
    while replay not in ["y", "n"]:
        replay = input("Enter y or n, Play Again? (y/n) ")
        replay = replay.lower()
    # if user wants to play again, update beginning parameters
    if replay == "y":
        guess = numGuess
        guessedLetter.clear()
    else:
        print("Thank You for playing!")
        play = False
