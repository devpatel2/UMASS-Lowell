import random
import sys


def autofill_symbol(w, gList, s):
    count = w.count(s)
    if count > 0:
        index = word.find(s)
        gList[index] = s
        for _ in range(count - 1):
            index = word.find(s, index + 1)
            gWord[index] = s
    return


def end_guess_output(guessList, n):
    guessList.sort()
    print("Guessed letters: {}".format("".join(guessList)))
    print("Number of Incorrect Guesses Remaining: {}\n".format(n))
    return


play = True
guessedLetter = []
wList = []
guess = numGuess = 6
f = open(sys.argv[1], 'r')
wList.extend(f.read().splitlines())
f.close()

wList = [i.lower() for i in wList]

while play:
    wordR = random.randint(0, len(wList) - 1)
    word = wList[wordR]
    gWord = ["_"] * len(word)

    autofill_symbol(word, gWord, " ")
    autofill_symbol(word, gWord, "-")
    autofill_symbol(word, gWord, "&")
    rCount = gWord.count("-")

    while guess > 0:
        c = input("To guess word enter \"word\"! Guess Letter: ")
        c = c.lower()

        if c == "word":
            print("When guessing include all spaces between words and symbols!")
            c = input("Guess Word: ")
            c = c.lower()
            if c == word:
                print("Congrats! Guessed Word Correctly")
                rCount = 0
                break
            else:
                print("Incorrect Guess!")
                guess -= 1
                end_guess_output(guessedLetter, guess)
        else:
            while guessedLetter.count(c) != 0 or len(c) != 1:
                c = input("Letter used or Guess more than 1 letter! Guess Letter: ")
                c = c.lower()
            guessedLetter.append(c)
            autofill_symbol(word, gWord, c)
            if word.count(c) == 0:
                guess -= 1
            print(" ".join(gWord))
            rCount = gWord.count("_")
            if rCount == 0:
                print("Congrats! Guessed Word Correctly")
                break
            end_guess_output(guessedLetter, guess)
    if rCount > 0:
        print("Sorry, Out of guesses. Try Again")
        print("Word is: {}".format(word))
    replay = input("Play Again? (y/n) ")
    replay = replay.lower()
    while replay not in ["y", "n"]:
        replay = input("Enter y or n, Play Again? (y/n) ")
        replay = replay.lower()
    if replay == "y":
        play = True
        guess = numGuess
        guessedLetter.clear()
    else:
        print("Thank You for playing!")
        play = False
